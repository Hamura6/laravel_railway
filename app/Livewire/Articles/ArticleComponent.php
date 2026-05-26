<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Livewire\Attributes\On;
use Livewire\Component;

class ArticleComponent extends Component
{
    public $search;
    public function mount()
    {

        $this->authorize('Ver artículos');
    }
    public function render()
    {
        $articles = Article::where('title', 'like', "%$this->search%")
        ->orderBy('id','desc')
        ->paginate(9);
        return view('livewire.articles.article-component', compact('articles'));
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('Eliminar artículos');
        $article = Article::find($id);
        if ($article->preview) {
            if (file_exists(public_path('storage/articles/images/' . $article->preview))) {
                unlink(public_path('storage/articles/images/' . $article->preview));
            }
        }
        if ($article->file) {
            if (file_exists(public_path('storage/articles/files/' . $article->file))) {
                unlink(public_path('storage/articles/files/' . $article->file));
            }
        }
        $article->delete();
        $this->dispatch('notify', text: 'El registro fue eliminado correctamente', title: 'Registro eliminado', icon: 'success');
    }
}
