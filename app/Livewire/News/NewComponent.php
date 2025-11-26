<?php

namespace App\Livewire\News;

use App\Models\Information;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class NewComponent extends Component
{
    use WithPagination;
    public string $search='';
    public function render()
    {
        $this->authorize('notice.view');
        $news=Information::where('title','like',"%$this->search%")->orderBy('id','desc')->paginate(9);
        return view('livewire.news.new-component',compact('news'));
    }
    #[On('delete')]
    public function delete($id){
        $this->authorize('notice.delete');
        $new=Information::find($id);
        if ($new->image) {
                if (file_exists(public_path('storage/news/' . $new->image))) {
                    unlink(public_path('storage/news/' . $new->image));
                }
            }
        $new->delete();
        $this->dispatch('notify',text:'El registro fue eliminado correctamente',title:'Registro eliminado',icon:'success');
    }
}
