<?php

namespace App\Livewire\EventsPhoto;

use App\Models\Event;
use App\Models\EventPhoto;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PhotosComponent extends Component
{
    use WithPagination;
    public $id,$title='',$date='';
    public function mount($id)
    {
        if (!$id)
            return;
        $event=Event::find($id);
        $this->title=$event->title;
        $this->date=$event->date;
        $this->id = $id;
    }
    public function render()
    {
        $photos = EventPhoto::where('event_id', $this->id)->paginate(9);
        return view('livewire.events-photo.photos-component', compact('photos'));
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('events.delete');
        $photo = EventPhoto::find($id);
        if ($photo->name) {
            if (file_exists(public_path('storage/event_photos/' . $photo->name))) {
                unlink(public_path('storage/event_photos/' . $photo->name));
            }
        }
        $photo->delete();
        $this->dispatch('notify',text:'La fotografia fue eliminada correctamente',title:'Fotografia eliminada',icon:'success');
    }
}
