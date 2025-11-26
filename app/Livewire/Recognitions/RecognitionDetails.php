<?php

namespace App\Livewire\Recognitions;

use App\Models\Affiliate;
use App\Models\Recognition;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class RecognitionDetails extends Component
{
    public $recognition, $toSearch = '';
    public function mount($id)
    {
        $this->authorize('recognitions.view');
        $this->recognition = Recognition::find($id);
    }
    public function render()
    {
        $toSearch = $this->toSearch;

        $fechaLimite = Carbon::parse($this->recognition->date)
            ->subYears(intval($this->recognition->type));


        $affiliatesConfirm = $this->recognition
            ->affiliates()
            ->with(['user:id,name,last_name,gender', 'user.phones:id,user_id,number'])
            ->simplePaginate(10, pageName: 'confirm');


        $confirmedIds = $this->recognition->affiliates()->pluck('affiliates.id')->toArray();

        /* $affiliates = Affiliate::query()
            ->select('id', 'user_id', 'created_at', 'status')
            ->where(function ($query) use ($toSearch) {
                $query->where('id', 'like', "%$toSearch%")
                    ->orWhereHas('user', function ($q) use ($toSearch) {
                        $q->where(DB::raw("CONCAT(name, ' ', last_name)"), 'like', "%$toSearch%")
                            ->orWhere('ci', 'like', "%$toSearch%");
                    });
            })
            ->with([
                'user:id,name,last_name,gender',
                'user.phones:id,user_id,number',
            ])
            ->whereHas('user.roles', fn($q) => $q->where('name', 'Afiliado'))
            ->where('status', 'Activo')
            ->whereDate('created_at', '<=', $fechaLimite)
            ->whereNotIn('id', $confirmedIds)

            ->when($this->recognition->type != 'Canaston', function ($query) {
                $query->whereDoesntHave('recognitions', function ($q) {
                    $q->where('type', $this->recognition->type);
                });
            })
            ->when($this->recognition->type == 'Canaston', function ($query) {
                $query->whereDoesntHave('payments', function ($q) {
                    $q->where('fee_id', 1)
                        ->where('status', 'Por pagar');
                });
            })
            ->withCount([
                'payments as pending_payments_count' => function ($q) {
                    $q->where('fee_id', 1)
                        ->where('status', 'Por pagar');
                },
            ])
            ->withCasts(['created_at' => 'date:Y-m-d'])
            ->orderBy('created_at', 'asc')
            ->simplePaginate(4);
 */




          $affiliates = Affiliate::query()
    ->select('id', 'user_id', 'created_at', 'status')
    ->where(function ($query) use ($toSearch) {
        $query->where('id', 'like', "%$toSearch%")
            ->orWhereHas('user', function ($q) use ($toSearch) {
                $q->where(DB::raw("CONCAT(name, ' ', last_name)"), 'like', "%$toSearch%")
                    ->orWhere('ci', 'like', "%$toSearch%");
            });
    })
    ->with([
        'user:id,name,last_name,gender',
        'user.phones:id,user_id,number',
    ])
    ->whereHas('user.roles', fn($q) => $q->where('name', 'Afiliado'))
    ->whereDate('created_at', '<=', $fechaLimite)
            ->whereNotIn('id', $confirmedIds)

    ->when($this->recognition->type == 'Canaston', function ($query) {
        // Para Canastón: excluir afiliados que deben POR LO MENOS 1 cuota del año pasado
        $query->whereDoesntHave('payments', function ($q) {
            $q->where('fee_id', 1)
                ->where('status', 'Por pagar')
                ->whereYear('date', now()->subYear()->year); // Deudas del año pasado
        });
    }, function ($query) {
        // Para otros tipos: solo afiliados activos o inactivos
        $query->whereIn('status', ['Activo', 'Inactivo'])
            ->whereDoesntHave('recognitions', function ($q) {
                $q->where('type', $this->recognition->type);
            });
    })
    
    ->withCount([
        'payments as pending_payments_count' => function ($q) {
            $q->where('fee_id', 1)
                ->where('status', 'Por pagar');
        },
    ])
    ->withCasts(['created_at' => 'date:Y-m-d'])
    ->orderBy('id', 'desc')
    ->simplePaginate(4);
        return view('livewire.recognitions.recognition-details', compact('affiliates', 'affiliatesConfirm'));
    }
    #[On('AddAffiliate')]
    public function AddAffiliate($id)
    {
        $this->authorize('recognitions.edit');
        $this->recognition->affiliates()->syncWithoutDetaching([$id]);
    }
    #[On('removeAffiliate')]
    public function removeAffiliate($id)
    {
        $this->authorize('recognitions.edit');
        $this->recognition->affiliates()->detach($id);
    }
}
