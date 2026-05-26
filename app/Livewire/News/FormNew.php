<?php

namespace App\Livewire\News;

use App\Models\Information;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;
use Storage;

class FormNew extends Component
{
    use WithFileUploads;
    public $title, $id = 0, $image, $description, $photo, $file;
    public function rules()
    {
        return [
            'title' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:10|max:255',
            'photo' => $this->id ? 'nullable|image|mimes:jpg,jpeg,png|max:2048'
                : 'required|image|mimes:jpg,jpeg,png|max:2048',
            'file' => $this->file ? 'required|file|mimes:pdf,doc,docx'
                : 'nullable|file|mimes:pdf,doc,docx'
        ];
    }
    public function mount($id = 0)
    {
        if (! (Auth::user()->can('Crear noticias') || Auth::user()->can('Editar noticias'))) {
            abort(403, 'No tienes permiso');
        }
        $this->id = $id;

        if ($id <= 0) {
            return;
        }

        $new = Information::find($id);
        if (!$new) return;
        $this->title = $new->title;
        $this->image = $new->image_view;
        $this->description = $new->description;
    }
    public function render()
    {
        return view('livewire.news.form-new');
    }
    public function store()
    {
        $this->authorize('Crear noticias');
        $this->validate();

        if ($this->photo) {
            $custome_name = uniqid() . '.jpg';
            $this->photo->storeAs('news', $custome_name, 'public');
            $custome_name_view = explode('.', $custome_name)[0] . '.webp';
            $storagePath  = storage_path('app/public/news/' . $custome_name_view);
            Image::read($this->photo->getRealPath())
                ->toWebp(quality: 60)
                ->save($storagePath);

            $this->image = explode('.', $custome_name)[0];
        }
        $filePreview = null;
        if ($this->file) {
            $filePreview = uniqid() . '.' . $this->file->extension();
            $this->file->storeAs('news/files', $filePreview, 'public');
        }
        Information::create([
            'title' => $this->title,
            'file' => $filePreview,
            'image' => $this->image,
            'description' => $this->description,
        ]);
        return redirect()->route('news');
    }
    public function update()
    {
        $this->authorize('Editar noticias');
        $this->validate();
        $new = Information::find($this->id);
        $fileview=$new->file;
        if ($this->photo) {
            $custome_name = uniqid() . '.jpg';
            $this->photo->storeAs('news/', $custome_name, 'public');
            $custome_name_view = explode('.', $custome_name)[0] . '.webp';
            $storagePath  = storage_path('app/public/news/' . $custome_name_view);
            Image::read($this->photo->getRealPath())
                ->toWebp(quality: 60)
                ->save($storagePath);
            if ($new->image) {
                if (file_exists(public_path('storage/news/' . $new->image . '.webp'))) {
                    unlink(public_path('storage/news/' . $new->image . '.jpg'));
                    unlink(public_path('storage/news/' . $new->image . '.webp'));
                }
            }
            $this->image = explode('.', $custome_name)[0];
        } else {
            $this->image = $new->image;
        }
       
         if ($this->file) {
            $fileName = uniqid() . '.' . $this->file->extension();
            $this->file->storeAs('news/files', $fileName, 'public');

            if ($new->file && file_exists(public_path('storage/news/files/' . $new->file))) {
                unlink(public_path('storage/news/files/' . $new->file));
            }

            $filePreview = $fileName;
        } else {
            $filePreview = $new->file;
        }
        $new->update([
            'title' => $this->title,
            'file' => $filePreview,
            'image' => $this->image,
            'description' => $this->description,
        ]);
        return redirect()->route('news');
    }
}
