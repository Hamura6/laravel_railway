<?php

namespace App\Livewire;

use App\Models\Payment;
use App\Models\Plan;
use Livewire\Attributes\On;
use Livewire\Component;

use function Livewire\store;

class PlanPayment extends Component
{
    public Payment $payment;
    public $id, $amount,$debt;
    public function rules()
    {
        return [
            'amount' => ['required', 'numeric', 'gte:1', 'lte:' . $this->debt]
        ];
    }
    public function mount($ide)
    {
        $this->authorize('procedures.view');
         $this->loadPayment($ide);
    }
    protected function loadPayment($id)
    {
        $this->payment = Payment::with([
                'fee:id,name',
                'affiliate:id,user_id',
                'affiliate.user:id,name,last_name,ci,email',
                'affiliate.user.phones:id,user_id,number',
            ])
            ->withSum('plans as pay','amount') 
            ->findOrFail($id);
        $this->debt = $this->payment->amount- $this->payment->pay;
    }
    public function render()
    {
        $plans = Plan::where('payment_id', $this->payment->id)->select('amount', 'created_at', 'id')->orderBy('id', 'desc')->get();
        return view('livewire.procedures.plan-payment', compact('plans'));
    }
    public function check(Plan $plan)
    {
        $plan->status = 'Pagado';
        $plan->save();
        $this->dispatch('notify', title: 'Pago Realizado', icon: 'success', html: 'El pago fue realizado');
    }
    public function store()
    {
        $this->authorize('payments.pay');
        $this->validate();
        $this->payment->plans()->create([
            'amount' => $this->amount,
        ]);
        if ($this->payment->amount <= $this->payment->plans()->sum('amount')) {
            $this->payment->status = "Pagado";
            $this->payment->save();
        }
        $this->clear();
        $this->loadPayment($this->payment->id);
    }
    #[On('delete')]
    public function delete($id)
    {
        $plan=Plan::find($id)->delete();
        $this->payment->status='Por pagar';
        $this->payment->save();
        $this->loadPayment($this->payment->id);
        $this->dispatch('notify', text: 'Registro eliminado correctamente', title: 'Registro eliminado', icon: 'success');
    }
    public function clear()
    {
        $this->dispatch('close-modal');
        $this->resetValidation();
        $this->reset(['amount', 'id']);
    }
}
