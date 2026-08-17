<?php

namespace App\Livewire\Finances;

use App\Models\Affiliate;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Plan;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

use function Laravel\Prompts\text;

class DebtsDetailsComponent extends Component
{
    use WithPagination;
    public $type = '', $concept = '', $id, $year = '', $dateUltimate;
    public $types, $discountAmount, $cant, $dateTo, $dateFor, $payment_id;

    public function mount($id)
    {
        $this->authorize('Ver pagos realizados');
        $payment = Affiliate::find($id)
            ->payments()
            ->where('status', 'Por pagar')
            ->orderBy('date', 'asc')
            ->first();
        $this->year =  $payment ? Carbon::parse($payment->date)->year : now()->year;
        $this->id = $id;
    }
    public function render()
    {
        $fees = Fee::get();
        $affiliate = Affiliate::select('id', 'user_id')
            ->withSum(['payments as totalSum' => function ($query) {
                $query->whereYear('date', '>=', $this->year)
                    ->when($this->type, fn($q) => $q->where('status', 'like', "%{$this->type}%"))
                    ->when($this->concept, fn($q) => $q->where('fee_id', $this->concept));
            }], 'amount')
            ->withSum(['payments as prest' => function ($query) {
                $query->where('status', 'Por pagar')->whereYear('date', '>=', $this->year)
                    ->when($this->type, fn($q) => $q->where('status', 'like', "%{$this->type}%"))
                    ->when($this->concept, fn($q) => $q->where('fee_id', $this->concept));
            }], 'amount')
            ->withSum(['plans as planes' => function ($query) {
                $query->whereHas('payment', fn($q) => $q->where('status', 'Por pagar'))->whereYear('date', '>=', $this->year)
                    ->when($this->type, fn($q) => $q->where('status', 'like', "%{$this->type}%"))
                    ->when($this->concept, fn($q) => $q->where('fee_id', $this->concept));
            }], 'amount')
            ->withSum(['payments as total_pagado' => function ($query) {
                $query->where('status', 'pagado')->whereYear('date', '>=', $this->year)
                    ->when($this->type, fn($q) => $q->where('status', 'like', "%{$this->type}%"))
                    ->when($this->concept, fn($q) => $q->where('fee_id', $this->concept));
            }], 'amount')
            ->with([
                'user:name,last_name,ci,id,email',
                'user.phones:number,id,user_id'
            ])
            ->find($this->id);
        $payments = Payment::select('id', 'affiliate_id', 'date', 'status', 'discount', 'amount', 'fee_id', 'updated_at', 'created_at')
            ->whereYear('date', '>=', $this->year)
            ->where('affiliate_id', $this->id)
            ->when($this->type, fn($q) => $q->where('status', 'like', "%{$this->type}%"))
            ->when($this->concept, fn($q) => $q->where('fee_id', $this->concept))
            ->addSelect([
                'debt' => Plan::selectRaw("
            CASE 
                WHEN payments.status = 'Pagado' THEN 0
                WHEN COUNT(plans.id) = 0 THEN payments.amount
                ELSE COALESCE(payments.amount-SUM(plans.amount), 0)
            END
        ")
                    ->whereColumn('plans.payment_id', 'payments.id')
            ])
            ->with(['fee:id,name'])
            ->orderBy('date', 'asc')
            ->paginate(10);
        return view('livewire.finances.debts-details-component', compact('fees', 'affiliate', 'payments'));
    }

    #[On('toPay')]
    public function toPay($id)
    {
        $this->authorize('Realizar pago');
        $payment = Payment::find($id);
        $debt = $payment->amount - $payment->plans()->sum('amount');
        $payment->status = 'Pagado';
        if ($payment->fee->type == 'installments') {
            $payment->plans()->create([
                'amount' => $debt,
            ]);
        }
        $payment->save();
    }
    #[On('delete')]
    public function delete($id)
    {
        
        $payment = Payment::find($id);

        if (!$payment) {
            return;
        }
        if ($payment->fee_id !== 1) {
            $payment->delete();
            $this->dispatch('notify', text: 'El pago fue eliminado correctamente', title: 'Registro anulado', icon: 'info');
            $this->dateUltimate = Affiliate::find($this->id)
                ->payments()
                ->where('status', 'Pagado')
                ->where('fee_id', 1)
                ->orderBy('date', 'desc')
                ->limit(1)
                ->first()->id ?? 0;
            return;
        }
        if($payment->status=='Por pagar'){
            $payment->delete();
            $this->dispatch('notify', text: 'El registro fue eliminado correctamente', title: 'Eliminar registro', icon: 'info');
            return;

        }

        $affiliate = Affiliate::find($this->id);
        $startDate = Carbon::parse($payment->created_at)->startOfMonth();
        $endDate = Carbon::parse($payment->date)->startOfMonth();
        $diffInMonths = $startDate->diffInMonths($endDate) + 1;
        $currentDate = Carbon::now()->startOfMonth();

        $paymentAmount = $payment->amount;

        $paymentSame = Payment::whereMonth('date', $endDate->month)
            ->whereYear('date', $endDate->year)
            ->where('affiliate_id', $this->id)
            ->where('status', 'Por pagar')
            ->where('fee_id', 1)
            ->where('discount', 0)
            ->first();

        if ($paymentSame && Carbon::parse($paymentSame->date)->format('Y-m-d') === Carbon::parse($payment->date)->format('Y-m-d')) {
            $paymentAmount += $paymentSame->amount;
            $paymentSame->delete();
        }

        if ($payment->discount > 0) {
            $amount = ($paymentAmount / $diffInMonths) / (1 - ($payment->discount / 100));
        } else {
            $amount = $paymentAmount / $diffInMonths;
        }

        $date = $startDate->copy();
        while ($date <= $endDate && $date <= $currentDate) {
            $existing = Payment::where('affiliate_id', $this->id)
                ->where('fee_id', 1)
                ->where('status', 'Por pagar')
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->where('discount', 0)
                ->first();

            if ($existing) {
                if ($existing->amount < $amount) {
                    $existing->update(['amount' => $amount, 'created_at' => $date]);
                }
            } else {
                $affiliate->payments()->create([
                    'amount' => $amount,
                    'status' => 'Por pagar',
                    'date'   => $date,
                    'fee_id' => 1,
                    'type' => 'cash',
                    'created_at' => $date,
                    'user_id' => auth()->user()->id,
                ]);
            }

            $date->addMonth();
        }

        $payment->delete();
        $this->dispatch('notify', text: 'Los pagos fueron anulados correctamente', title: 'Aportes anulados', icon: 'info');
    }
    public function rules()
    {
        return [
            'cant'      => 'required|integer|gte:1|lte:99999',
            'discountAmount' => 'decimal:0,2|gte:0|lte:99|max:99',
        ];
    }
    #[On('')]
    public function edit(Payment $payment)
    {
        $this->cant = $payment->amount;
        $this->types = $payment->type;
        $this->payment_id = $payment->id;
        $this->discountAmount = $payment->discount;
        $this->dateTo = Carbon::parse($payment->created_at)->format('Y-m-d');
        $this->dateFor = $payment->date;
        $this->dispatch('show-modal');
    }
    public function update()
    {
        $payment = Payment::find($this->payment_id);
        $payment->update([
            'discount' => $this->discountAmount,
            'amount' => $this->cant
        ]);
        $this->clear();
    }
    public function updateQuery()
    {
        $this->resetPage();
        $this->dispatch('notify', text: 'La consulta fue realizada exitosamente', title: 'Registros actualizados', icon: 'info');
    }
    public function clear()
    {
        $this->category = 'E';
        $this->resetValidation();
        $this->dispatch('close-modal');
    }
}
