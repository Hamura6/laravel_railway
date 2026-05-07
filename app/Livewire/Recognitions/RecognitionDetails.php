<?php

namespace App\Livewire\Recognitions;

use App\Models\Affiliate;
use App\Models\Recognition;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

class RecognitionDetails extends Component
{
    use WithPagination;
    public $recognition, $toSearch = '';
    public function mount($id)
    {
        $this->authorize('ver reconocimientos');
        $this->recognition = Recognition::findOrFail($id);
    }
    public function updatedToSearch(){
        $this->resetPage();
    }
    public function render()
    {

        return view('livewire.recognitions.recognition-details',  [
            'affiliatesConfirm' => $this->getConfirmedAffiliates(),
            'affiliates'        => $this->getEligibleAffiliates(),
        ]);
    }
    private function getConfirmedAffiliates()
    {
        return $this->recognition
            ->affiliates()
            ->with([
                'user:id,name,last_name,gender',
                'user.phones:id,user_id,number',
            ])
            ->simplePaginate(10, pageName: 'confirm');
    }

    private function getEligibleAffiliates()
    {
        $confirmedIds = $this->getConfirmedIds();

        return Affiliate::query()
            ->select('id', 'user_id', 'created_at', 'status')
            ->with([
                'user:id,name,last_name,gender',
                'user.phones:id,user_id,number',
            ])
            ->tap(fn(Builder $q) => $this->applySearchFilter($q))
            ->whereHas('user.roles', fn(Builder $q) => $q->where('name', 'Afiliado'))
            ->whereNotIn('id', $confirmedIds)
            ->tap(fn(Builder $q) => $this->applyTypeFilter($q))
            ->withCount([
                'payments as pending_payments_count' => fn(Builder $q) => $q
                    ->where('fee_id', 1)
                    ->where('status', 'Por pagar'),
            ])
            ->withCasts(['created_at' => 'date:Y-m-d'])
            ->orderByDesc('id')
            ->simplePaginate(4);
    }

   
    private function applySearchFilter(Builder $query): void
    {
        $search = $this->toSearch;

        $query->where(
            fn(Builder $q) => $q
                ->where('id', 'like', "%{$search}%")
                ->orWhereHas(
                    'user',
                    fn(Builder $q) => $q
                        ->where(DB::raw("CONCAT(name, ' ', last_name)"), 'like', "%{$search}%")
                        ->orWhere('ci', 'like', "%{$search}%")
                )
        );
    }

    private function applyTypeFilter(Builder $query): void
    {
        match ($this->recognition->type) {
            'Canaston'            => $this->applyCanastonFilter($query),
            'professional_career' => $this->applyProfessionalCareerFilter($query),
            'Inscripcion'         => $this->applyInscripcionFilter($query),
            default               => $this->applyDefaultFilter($query),
        };
    }


    private function applyCanastonFilter(Builder $query): void
    {
        $query->whereDoesntHave(
            'payments',
            fn(Builder $q) => $q
                ->where('fee_id', 1)
                ->where('status', 'Por pagar')
                ->whereYear('date', now()->subYear()->year)
        );
    }

    
    private function applyProfessionalCareerFilter(Builder $query): void
    {
        $query->whereDate('affiliates.created_at', '<=', now()->subYears(15));
    }

  
    private function applyInscripcionFilter(Builder $query): void
    {
        ['limit' => $fechaLimite] = $this->getDateBoundaries();
        $query
            ->whereIn('status', ['Activo', 'Inactivo'])
            ->whereDate('affiliates.created_at', '>=', $fechaLimite->copy()->subYear()->addDay())
            ->whereDate('affiliates.created_at', '<=', $fechaLimite->copy()->addYear()->subDay())
            ->whereDoesntHave(
                'recognitions',
                fn(Builder $q) => $q->where('type', $this->recognition->type)
            );
    }

  
    private function applyDefaultFilter(Builder $query): void
    {
        ['limit' => $fechaLimite, 'from' => $fechaHasta] = $this->getDateBoundaries();
        $query
            ->whereIn('status', ['Activo', 'Inactivo'])
            ->whereDate('affiliates.created_at', '<=', $fechaLimite->endOfYear())
            ->whereDate('affiliates.created_at', '>=', $fechaHasta->startOfYear())
            ->whereDoesntHave(
                'recognitions',
                fn(Builder $q) => $q->where('type', $this->recognition->type)
            );
    }

    private function getConfirmedIds(): \Illuminate\Support\Collection
    {
        return $this->recognition
            ->affiliates()
            ->pluck('affiliates.id');
    }

    
    private function getDateBoundaries(): array
    {
        $limit = Carbon::parse($this->recognition->date)
            ->subYears((int) $this->recognition->type)
            ->startOfDay();

        return [
            'limit' => $limit,
            'from'  => $limit->copy()->subYears(1)->addDay(),
        ];
    }

    #[On('AddAffiliate')]
    public function AddAffiliate($id)
    {
        $this->authorize('Editar reconocimientos');
        $this->recognition->affiliates()->syncWithoutDetaching([$id]);
        $this->dispatch('notify', text: 'Se agrego a la lista de condecoración a un afiliado', icon: 'success', title: 'Un afiliado fue agregado');
    }
    #[On('removeAffiliate')]
    public function removeAffiliate($id)
    {
        $this->authorize('Editar reconocimientos');
        $this->recognition->affiliates()->detach($id);
        $this->dispatch('notify', text: 'Se descarto de la lista de condecoración a un afiliado', icon: 'success', title: 'Un afiliado fue descartado');
    }
}
