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
        $this->dateUltimate = Affiliate::find($id)
            ->payments()
            ->where('status', 'Pagado')
            ->where('fee_id', 1)
            ->orderBy('date', 'desc')
            ->limit(1)
            ->first()->id;
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
        $payments = Payment::select('id', 'affiliate_id', 'date', 'status', 'amount', 'fee_id', 'updated_at', 'created_at')
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
        $affiliate=Affiliate::find($this->id);
        $payment = Payment::find($id);
        $initialDate = Carbon::parse($payment->date);
        $createDate =Carbon::parse($payment->created_at);
        $diffInMonths = $createDate->diffInMonths($initialDate)+1;
        $fee=Fee::find(1);
        for ($i = 0; $i < $diffInMonths; $i++) {
            $affiliate->payments()->create([
                'amount' => $fee->amount,
                'status' => 'Por pagar',
                'date'   => $createDate,
                'fee_id' => 1,
                'type' => 'cash',
                'created_at' =>$createDate,
                'user_id' => auth()->user()->id
            ]);
            $createDate=$createDate->addMonth(1);
        }
        $payment->delete();
        $this->dispatch('notify', text: 'Los pagos fueron anulados correctamente', title: 'Aportes anulados', icon: 'info');

    }
    public function update()
    {
        $this->resetPage();
        $this->dispatch('notify', text: 'La consulta fue realizada exitosamente', title: 'Registros actualizados', icon: 'info');
    }
}
