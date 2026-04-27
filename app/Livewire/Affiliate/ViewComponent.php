<?php

namespace App\Livewire\Affiliate;

use App\Models\Affiliate;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ViewComponent extends Component
{
    use WithPagination;
    public $type = '', $concept = '', $affiliateId, $year = '';
    public function mount()
    {
        $user = Auth::user();
        $this->affiliateId = $user->affiliate->id ?? null;
        $payment = Affiliate::find($this->affiliateId)
            ->payments()
            ->where('status', 'Por pagar')
            ->orderBy('date', 'asc')
            ->first();
        $this->year =  $payment ? Carbon::parse($payment->date)->year : now()->year;
    }
    public function render()
    {


        /* if (! $this->affiliateId) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'No se encontró ningún afiliado asociado a este usuario.'
            ]);
            return;
        } */

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
                $query->whereHas('payment', fn($q) => $q->where('status', 'Por pagar'))
                    ->whereYear('date', '>=', $this->year)
                    ->when($this->type, fn($q) => $q->where('status', 'like', "%{$this->type}%"))
                    ->when($this->concept, fn($q) => $q->where('fee_id', $this->concept));
            }], 'amount')
            ->withSum(['payments as total_pagado' => function ($query) {
                $query->where('status', 'Pagado')->whereYear('date', '>=', $this->year)
                    ->when($this->type, fn($q) => $q->where('status', 'like', "%{$this->type}%"))
                    ->when($this->concept, fn($q) => $q->where('fee_id', $this->concept));
            }], 'amount')
            ->with([
                'user:name,last_name,ci,id,email',
                'user.phones:number,id,user_id'
            ])
            ->find($this->affiliateId);
        $payments = Payment::select('id', 'affiliate_id', 'date', 'status', 'amount', 'fee_id', 'updated_at', 'created_at')
            ->whereYear('date', '>=', $this->year)
            ->where('affiliate_id', $this->affiliateId)
            ->when($this->type, fn($q) => $q->where('status', 'like', "%{$this->type}%"))
            ->when($this->concept, fn($q) => $q->where('fee_id', $this->concept))
            ->addSelect([
                'debt' => Plan::selectRaw("
            CASE 
                WHEN payments.status = 'Pagado' THEN 0
                WHEN COUNT(plans.id) = 0 THEN payments.amount
                ELSE COALESCE(payments.amount - SUM(plans.amount), 0)
            END
        ")->whereColumn('plans.payment_id', 'payments.id')
            ])
            ->with(['fee:id,name'])
            ->orderBy('id', 'desc')
            ->paginate(10);
        $fees = Fee::get();
        return view('livewire.affiliate.view-component', compact('payments', 'affiliate', 'fees'));
    }
    public function update()
    {
        $this->resetPage();
        $this->dispatch('notify', text: 'La consulta fue realizada exitosamente', title: 'Registros actualizados', icon: 'info');
    }
}
