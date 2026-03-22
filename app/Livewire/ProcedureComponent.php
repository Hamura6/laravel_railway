<?php

namespace App\Livewire;

use App\Livewire\Forms\PaymentForm;
use App\Models\Discount;
use App\Models\Fee;
use App\Models\Payment;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProcedureComponent extends Component
{
    use WithPagination;
    public PaymentForm $form;
    public $discounts, $search = '', $type = 'single_payment', $pay = 0, $selected, $discountAmount=0;
    public function mount()
    {
        $this->authorize('Ver procedimientos');
        $this->discounts = Discount::select('id', 'discount_value', 'start_date', 'end_date')
            ->WhereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->with(['fees:name,id'])
            ->get();
    }
    public function rules()
    {
        return [
            'pay' => (!$this->discountAmount || $this->discountAmount==0) ?'required|decimal:0,2|gte:0.00|lte:9999.99|max:' . $this->form->amount:'nullable',
            'discountAmount' => $this->discountAmount?'required|decimal:0,2|gte:0|lte:99|max:99':'nullable'
        ];
    }
    public function render()
    {
        $search = $this->search;
        $selected = $this->selected;

        $procedures = Payment::with([
            'fee:id,name,type',
            'affiliate.user:id,name,last_name,ci',
            'affiliate.user.phones:id,user_id,number',
        ])
            ->withSum('plans as pay', 'amount')
            ->withCount('plans as quantity')
            ->where('fee_id', '!=', 1)
            ->when($selected, fn($query) => $query->whereIn('fee_id', (array)$selected))
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas(
                        'affiliate.user',
                        fn($q2) =>
                        $q2->where('name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('ci', 'like', "%{$search}%")
                    )
                        ->orWhereHas(
                            'affiliate',
                            fn($q2) =>
                            $q2->where('id', 'like', "%{$search}%")
                        );
                });
            })
            ->orderByDesc('id')
            ->paginate(9);
            $procedures->getCollection()->transform(function ($payment) { $payment->debt = $payment->status === 'Por pagar' ? ($payment->amount - ($payment->pay ?? 0)) : 0; return $payment; });
        $fees = Fee::select('name', 'id')->whereNotIn('name', ['Aportes'])->get();
        return view('livewire.procedures.procedure-component', compact('procedures', 'fees'));
    }
    public function store()
    {
        $this->authorize('Crear procedimientos');
        $this->validate();
        $this->form->storeFees($this->pay, $this->discountAmount);
        $this->clear();
        $this->dispatch('notify', text: 'El registro fue almacenado correctamente', title: 'Tramite realizado', icon: 'success');
    }
    public function edit(Payment $payment)
    {
        $this->form->setPayment($payment);
        $this->dispatch('update', $this->form->affiliate_id);
        $this->type = $payment->fee->type;
        $this->form->amount = $payment->amount;
        $this->dispatch('show-modal');
    }
    public function update()
    {
        $this->authorize('Editar procedimientos');
        $this->validate();
        $this->form->updateFees($this->pay, $this->discountAmount);
        $this->clear();
        $this->dispatch('notify', text: 'El registro fue actualizado correctamente', title: 'Tramite actualizado', icon: 'success');
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('Eliminar procedimientos');
        Payment::find($id)->delete();
        $this->dispatch('notify', text: 'El registro fue eliminado correctamente', title: 'Tramite eliminado', icon: 'success');
    }
    public function clear()
    {
        $this->pay = 0;
        $this->discountAmount = 0;
        $this->form->reset();
        $this->dispatch('update', $this->form->affiliate_id);
        $this->resetValidation();
        $this->dispatch('close-modal');
    }
    #[On('check')]
    public function check($id)
    {
        $this->authorize('Realizar pago');
        $payment = Payment::with(['fee', 'plans'])
            ->withSum('plans', 'amount')
            ->findOrFail($id);

        $debt = $payment->amount - ($payment->plans_sum_amount ?? 0);

        if ($debt > 0) {
            $payment->plans()->create([
                'amount' => $debt,
            ]);

            $payment->status = 'Pagado';
            $payment->save();

            $this->dispatch(
                'notify',
                text: "El pago del {$payment->fee->name} fue cancelado exitosamente",
                title: 'El saldo fue registrado',
                icon: 'success',
            );
        } else {
            $this->dispatch(
                'notify',
                text: 'El trámite ya está completamente pagado.',
                title: 'Sin deuda',
                icon: 'info',
            );
        }
    }

    public function selected($fee)
    {
        $select = Fee::find($fee);
        $this->type = $select->type;
        $this->form->amount = $select->amount;
        $this->discountAmount = $select->discounts()
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->first()?->discount_value ?? 0;
    }
    public function updatedFormFeeId($value)
    {
        $this->selected($value);
    }
    public function updatedSsearch()
    {
        $this->resetPage();
    }
}
