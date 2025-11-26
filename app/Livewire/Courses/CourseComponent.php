<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CourseComponent extends Component
{
    use WithPagination;
    public $search;
    public function render()
    {
        $this->authorize('courses.view');
        $courses = Course::where('title', 'like', "%$this->search%")->paginate(10);
        return view('livewire.courses.course-component', compact('courses'));
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('courses.delete');
        $new = Course::find($id);
        if ($new->image) {
            if (file_exists(public_path('storage/courses/' . $new->image))) {
                unlink(public_path('storage/courses/' . $new->image));
            }
        }
        $new->delete();
        $this->dispatch('notify', text: 'El registro fue eliminado correctamente', title: 'Registro eliminado', icon: 'success');
    }
}
