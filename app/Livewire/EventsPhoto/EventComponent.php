<?php

namespace App\Livewire\EventsPhoto;

use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\Laravel\Facades\Image;

class EventComponent extends Component
{
    use WithFileUploads, WithPagination;
    public $id, $title, $description, $photos = [], $date;
    public function mount(){
        $this->authorize('Ver eventos');
    }
    public function rules()
    {
        return [
            'title' => 'required|string|min:5|max:200',
            'description' => 'nullable|min:5|max:250',
            'date' => 'required|date|before_or_equal:today',
            'photos' => 'required',
            'photos.*' => 'image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
    public function render()
    {
        $events = Event::with(['firstPhoto'])->orderBy('id', 'desc')->paginate(10);

        return view('livewire.events-photo.event-component', compact('events'));
    }
    public function store()
    {
        $this->authorize('Crear eventos');
        $this->validate();
        $event = Event::create([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
        ]);
        foreach ($this->photos as $photo) {
            $filename = uniqid();
            $photo->storeAs('event_photos', $filename.'.jpg', 'public');
            $storagePath  = storage_path('app/public/event_photos/' . $filename.'.webp');
            Image::read($photo->getRealPath())
                ->toWebp(quality: 60)
                ->save($storagePath);
            $event->photos()->create([
                'name' => $filename,
            ]);
        }
        $this->clear();
        $this->dispatch('notify', text: 'Se registro el evento correctamente', title: 'Evento registrado', icon: 'success');
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('Eliminar eventos');
        $event = Event::with(['photos'])->find($id);
        foreach ($event->photos as $photo) {
            if ($photo->name) {
                if (file_exists(public_path('storage/event_photos/' . $photo->name.'.web'))) {
                    unlink(public_path('storage/event_photos/' . $photo->name.'.web'));
                    unlink(public_path('storage/event_photos/' . $photo->name.'jpg'));
                }
            }
        }
        $event->delete();
        $this->dispatch('notify',text:'Se pudo eliminar correctamente el evento y las fotografias',title:'Registro eliminado',icon:'success');
    }
    public function clear()
    {
        $this->resetValidation();
        $this->id=0; 
        $this->title=''; 
        $this->description=''; 
        $this->photos = []; 
        $this->date='';
        $this->dispatch('close-modal');
    }
}
