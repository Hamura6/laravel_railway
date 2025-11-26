<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormArticle extends Component
{
    use WithFileUploads;
    public $id, $title, $description, $image, $photo, $file, $filePreview;
    public function mount($id = 0)
    {   
        if (! (Auth::user()->can('notice.create') || Auth::user()->can('notice.edit')) ) {
            abort(403, 'No tienes permiso');
            }
        $this->id = $id;

        if ($id <= 0) {
            return;
        }

        $article = Article::find($id);
        if (!$article) return;
        $this->title = $article->title;
        $this->description = $article->description;
        $this->image = $article->image_view;
        $this->filePreview = $article->file;
    }
    public function rules()
    {
        return [
            'title' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:10|max:255',
            'photo' => $this->id ? 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'file' => $this->id ?'nullable|file|mimes:pdf,doc,docx|max:512'
            :'required|file|mimes:pdf,doc,docx|max:512',
        ];
    }
    public function render()
    {
        return view('livewire.articles.form-article');
    }
    public function store()
    {
        $this->authorize('articles.create');
        $this->validate();
        if ($this->photo) {
            $this->image = uniqid() . '.' . $this->photo->extension();
            $this->photo->storeAs('articles/images', $this->image, 'public');
        }
        if ($this->file) {
            $this->filePreview = uniqid() . '.' . $this->file->extension();
            $this->file->storeAs('articles/files', $this->filePreview, 'public');
        }
        Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'preview' => $this->image,
            'file' => $this->filePreview,
        ]);
        return redirect()->route('articles');
    }
    public function update()
    {
        $this->authorize('articles.create');
        $this->validate();
        $article = Article::find($this->id);
        if ($this->photo) {
            $custome_name = uniqid() . '.' . $this->photo->extension();
            $this->photo->storeAs('articles/images', $custome_name, 'public');
            if ($article->preview) {
                if (file_exists(public_path('storage/articles/images/' . $article->preview))) {
                    unlink(public_path('storage/articles/images/' . $article->preview));
                }
            }
            $this->image = $custome_name;
        } else {
            $this->image = $article->preview;
        }


        if ($this->file) {
            $fileName = uniqid() . '.' . $this->file->extension();
            $this->file->storeAs('articles/files', $fileName, 'public');

            if ($article->file && file_exists(public_path('storage/articles/files/' . $article->file))) {
                unlink(public_path('storage/articles/files/' . $article->file));
            }

            $this->filePreview = $fileName;
        } else {
            $this->filePreview = $article->file;
        }
        $article->update([
            'title' => $this->title,
            'description' => $this->description,
            'preview' => $this->image,
            'file' => $this->filePreview,
        ]);
        return redirect()->route('articles');
    }
}
