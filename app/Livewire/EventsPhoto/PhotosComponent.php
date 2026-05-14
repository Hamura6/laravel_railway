<?php

namespace App\Livewire\EventsPhoto;

use App\Models\Event;
use App\Models\EventPhoto;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\Laravel\Facades\Image;

class PhotosComponent extends Component
{
    use WithPagination,WithFileUploads;
    public $id, $title = '', $date = '';
    public $images=[];
    public function mount($id)
    {
        if (!$id)
            return;
        $event = Event::find($id);
        $this->title = $event->title;
        $this->date = $event->date;
        $this->id = $id;
    }
    public function rules()
    {
        return [
            'images' => 'required',
            'images.*' => 'image|mimes:png,jpg,jpeg,webp',
        ];
    }
    public function render()
    {
        $photos = EventPhoto::where('event_id', $this->id)
        ->select('name','id','event_id')
        ->orderBy('id', 'desc')
        ->paginate(9);
        return view('livewire.events-photo.photos-component', compact('photos'));
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('Eliminar eventos');
        $photo = EventPhoto::find($id);
        if ($photo->name) {
            if (file_exists(public_path('storage/event_photos/' . $photo->name . '.webp'))) {
                unlink(public_path('storage/event_photos/' . $photo->name . '.webp'));
                unlink(public_path('storage/event_photos/' . $photo->name . '.jpg'));
            }
        }
        $photo->delete();
        $this->dispatch('notify', text: 'La fotografia fue eliminada correctamente', title: 'Fotografia eliminada', icon: 'success');
    }
    public function update()
    {
        $this->authorize('Crear eventos');
        $this->validate();
        $event=Event::find($this->id);
        $dir = storage_path('app/public/event_photos');
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        ini_set('memory_limit', '512M');

        foreach ($this->images as $photo) {
            $filename = uniqid();

            $image = Image::read($photo->getRealPath())->scaleDown(width: 1920);

            $image->toWebp(quality: 75)->save("{$dir}/{$filename}.webp");
            $image->toJpeg(quality: 90)->save("{$dir}/{$filename}.jpg");

            $event->photos()->create(['name' => $filename]);
        }

        $this->clear();
        $this->dispatch('notify', text: 'Las images fueron almacendas correctamente', title: 'Images almacenadas', icon: 'success');
    }
     public function clear()
    {
        $this->resetValidation();
        $this->images = [];
        $this->dispatch('close-modal');
    }
}
