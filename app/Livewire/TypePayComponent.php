<?php

namespace App\Livewire;

use App\Models\Affiliate;
use Livewire\Component;
use Livewire\WithPagination;

class TypePayComponent extends Component
{
    use WithPagination;
    public $search, $selected;
    public function render()
    {
        $selected = $this->selected;
        $search = $this->search;
        $affiliates = Affiliate::select('affiliates.*', 'users.name', 'users.last_name', 'users.status')
            ->join('users', 'affiliates.user_id', '=', 'users.id')
            ->when($selected, function ($query) use ($selected) {
                // Aquí puedes usar '=' si buscas coincidencia exacta
                $query->where('users.status', $selected);
            })
            ->where(function ($query) use ($search) {
                $query->where('affiliates.id', 'like', "%{$search}%")
                    ->orWhere('users.name', 'like', "%{$search}%")
                    ->orWhere('users.last_name', 'like', "%{$search}%")
                    ->orWhere('users.ci', 'like', "%{$search}%");
            })
            ->paginate(10);
        return view('livewire.type_pay.type-pay-component', compact('affiliates'));
    }
    public function toPay(Affiliate $affiliate)
    {
        $payments = $affiliate->payments()->where('status', 'Por pagar')->get();
        foreach ($payments as $payment) {
            $payment->plans()->create([
                'amount' => $payment->debt,
                'date' => now()
            ]);
            $payment->status = 'Pagado';
            $payment->save();
        }
    }
}
