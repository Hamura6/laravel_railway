<?php

namespace App\Livewire\Finances;

use App\Livewire\Forms\PaymentForm;
use App\Models\Affiliate;
use App\Models\Discount;
use App\Models\Fee;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class DebtsComponent extends Component
{
    use WithPagination;
    public $search, $selected, $amount, $cant,$inputCant, $name, $affiliate_id, $discountAmount = 0,$category='E';
    public PaymentForm $form;
    public function rules()
    {
        return [
            'category'=>'not_in:E',
            'cant'      => $this->category === 'Q' 
            ? 'required|integer|gte:1|lte:99999' 
            : 'nullable',

        'inputCant' => $this->category === 'A' 
            ? 'required|numeric|gte:1|lte:99999' 
            : 'nullable',
            'discountAmount' => 'decimal:0,2|gte:0|lte:99|max:99'
        ];
    }
    public function mount()
    {
        $this->authorize('Ver pagos');
        $this->discountAmount = $this->resolveActiveDiscount();
    }
    public function render()
    {
        /* $selected = $this->selected;
        $search = $this->search;
        $affiliates = Affiliate::select('id', 'created_at', 'user_id', 'status')
            ->whereHas('user.roles', function ($q) {
                $q->where('id', 1); // solo usuarios con rol id = 1
            })
            ->whereNotIn('status', ['Exento', 'Retirada', 'Licencia'])
            ->withSum(['payments as aportes' => function ($query) {
                $query->where('status', 'Por pagar')
                    ->where('fee_id', 1);
            }], 'amount')
            ->withSum(['payments as prest' => function ($query) {
                $query->where('status', 'Por pagar');
            }], 'amount')
            ->withSum(['plans as planes' => function ($query) {
                $query->whereHas(
                    'payment',
                    fn($q) =>
                    $q->where('status', 'Por pagar')
                );
            }], 'amount')
            ->withCount(['payments as aportes_cant' => function ($query) {
                $query->where('status', 'Por pagar')
                    ->where('fee_id', 1);
            }])->addSelect([
                'ultimoPago' => Payment::selectRaw("
                    CASE 
                        WHEN status = 'Por pagar' 
                            THEN DATE_SUB(`date`, INTERVAL 1 MONTH)
                        ELSE `date`
                    END
                ")
                    ->whereColumn('affiliate_id', 'affiliates.id')
                    ->where('fee_id', 1)
                    ->orderByRaw("
                    CASE
                        WHEN status = 'Por pagar' THEN 1
                        ELSE 2
                    END ASC
                ")
                    ->orderByRaw("
                    CASE
                        WHEN status = 'Por pagar' THEN `date`
                        ELSE NULL
                    END ASC
                ")
                    ->orderByRaw("
                    CASE
                        WHEN status != 'Por pagar' THEN `date`
                        ELSE NULL
                    END DESC
                ")
                    ->limit(1)
            ])
            ->where('status', 'like', ($selected ? "{$selected}" : "%{$selected}%"))
            ->when($search, function ($query, $search,) {
                $query->where(function ($q) use ($search) {
                    $q->where('affiliates.id', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($u) use ($search) {
                            $u->where('ci', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                });
            })
            ->with(['user:id,name,last_name,ci'])
            ->orderBy('id', 'desc')
            ->paginate(10); */

        return view('livewire.finances.debts-component', [
            'affiliates' => $this->getAffiliates(),
        ]);
    }
     private function getAffiliates()
    {
        return Affiliate::query()
            ->select('id', 'created_at', 'user_id', 'status')
            // ── Relaciones ────────────────────────────────────
            ->with(['user:id,name,last_name,ci'])
            // ── Filtros base ──────────────────────────────────
            ->whereHas('user.roles', fn (Builder $q) => $q->where('id', 1))
            ->whereNotIn('status', ['Exento', 'Retirada', 'Licencia'])
            ->where(
                'status',
                'like',
                $this->selected ? $this->selected : "%{$this->selected}%"
            )
            ->when($this->search, fn (Builder $q) => $this->applySearch($q))
            ->withSum(
                ['payments as aportes' => fn (Builder $q) => $q
                    ->where('status', 'Por pagar')
                    ->where('fee_id', 1)],
                'amount'
            )
            ->withSum(
                ['payments as prest' => fn (Builder $q) => $q
                    ->where('status', 'Por pagar')],
                'amount'
            )
            ->withSum(
                ['plans as planes' => fn (Builder $q) => $q
                    ->whereHas('payment', fn (Builder $q) => $q->where('status', 'Por pagar'))],
                'amount'
            )
            ->withCount(
                ['payments as aportes_cant' => fn (Builder $q) => $q
                    ->where('status', 'Por pagar')
                    ->where('fee_id', 1)]
            )
            ->addSelect(['ultimoPago' => $this->buildLastPaymentSubquery()])
            ->orderByDesc('id')
            ->paginate(10);
    }
    private function buildLastPaymentSubquery(): Builder
    {
        return Payment::query()
            ->selectRaw("
                CASE
                    WHEN status = 'Por pagar'
                        THEN DATE_SUB(`date`, INTERVAL 1 MONTH)
                    ELSE `date`
                END
            ")
            ->whereColumn('affiliate_id', 'affiliates.id')
            ->where('fee_id', 1)
            ->orderByRaw("CASE WHEN status = 'Por pagar' THEN 1 ELSE 2 END ASC")
            ->orderByRaw("CASE WHEN status = 'Por pagar' THEN `date` ELSE NULL END ASC")
            ->orderByRaw("CASE WHEN status != 'Por pagar' THEN `date` ELSE NULL END DESC")
            ->limit(1);
    }

    private function applySearch(Builder $query): void
    {
        $search = $this->search;

        $query->where(fn (Builder $q) => $q
            ->where('affiliates.id', 'like', "%{$search}%")
            ->orWhereHas('user', fn (Builder $u) => $u
                ->where('ci', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
            )
        );
    }
    private function resolveActiveDiscount(): float
    {
        return (float) (Discount::query()
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->whereHas('fees', fn (Builder $q) => $q->where('fees.id', 1))
            ->orderByDesc('id')
            ->value('discount_value') ?? 0);
    }
    #[On('toPay')]
    public function toPay($id)
    {
        $this->authorize('Realizar pago');
        $affiliate = Affiliate::with(['payments' => fn($q) => $q->where('status', 'Por pagar')])
            ->findOrFail($id);

        $now = now();

        foreach ($affiliate->payments as $payment) {
            $debt = $payment->amount - $payment->plans()->sum('amount');

            if ($debt > 0 && $payment->fee_id != 1) {
                $payment->plans()->create([
                    'amount' => $debt,
                    'date' => $now,
                ]);
            }

            $payment->update(['status' => 'Pagado']);
        }
    }
    public function edit(Affiliate $affiliate, $quantity, $amount)
    {
        $this->name = $affiliate->user->full_name;
        $this->affiliate_id = $affiliate->id;
        $this->form->affiliate_id=$this->affiliate_id;
        $this->form->fee_id = 1;
        $this->form->amount = Fee::find(1)->amount;
        if ($quantity > 0) {
            $this->amount = $amount;
            $this->cant = $quantity;
        } else {
            $fee = Fee::find(1);
            $this->amount = $fee->amount;
            $this->cant = 1;
        }
        $this->dispatch('show-modal');
    }
    public function updatedCant()
    {
        $quantity = $this->cant;
        if ($quantity) {

            $payments = Payment::where('affiliate_id', $this->affiliate_id)->where('fee_id', 1)->where('status', 'Por pagar');
            if ($quantity <= $payments->count()) {
                $this->amount = $payments->orderBy('date')->take($quantity)->get()->sum('amount');
            } else {
                $quantity = $quantity - $payments->get()->count();
                $this->amount = $payments->get()->sum('amount') + ($quantity * Fee::find(1)->amount);
            }
            $this->amount = round($this->amount, 2);
        }
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function store()
    {
        $this->authorize('Realizar pago');  
        $this->validate();
       
        if($this->category=='Q'){
            $this->form->store($this->cant, $this->discountAmount,$this->category);
            
        }else{
            $this->form->store($this->inputCant, $this->discountAmount,$this->category);

        }
        $this->dispatch('notify', text: 'El aporte fue registrado correctamente', title: 'Aporte registrado', icon: 'success');
        $this->clear();
    }
    public function clear()
    {
        $this->form->reset();
        $this->inputCant=0;
        $this->category='E';
        $this->discountAmount = Discount::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->whereHas('fees', fn($q) => $q->where('fees.id', 1))
            ->orderBy('id', 'desc')
            ->value('discount_value') ?? 0;
        $this->resetValidation();
        $this->dispatch('close-modal');
    }
}
