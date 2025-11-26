<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormCourse extends Component
{
    use WithFileUploads;
    public $id, $title, $description, $image, $photo, $price,$date;
    public function mount($id = 0)
    {
        if (! (Auth::user()->can('courses.create') || Auth::user()->can('courses.edit')) ) {
            abort(403, 'No tienes permiso');
            }
        $this->id = $id;

        if ($id <= 0) {
            return;
        }

        $course = Course::find($id);
        if (!$course) return;
        $this->title = $course->title;
        $this->image = $course->image_view;
        $this->description = $course->description;
        $this->price = $course->price;
        $this->date = $course->date;
    }
    public function rules()
    {
        return [
            'title' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:10|max:255',
            'price' => 'required|numeric|gte:0',
            'date' => 'required|date|after_or_equal:today',
            'photo' => $this->id ? 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
    public function render()
    {
        return view('livewire.courses.form-course');
    }
    public function store()
    {
        $this->authorize('courses.create');
        $this->validate();
        if ($this->photo) {
            $custome_name = uniqid() . '.' . $this->photo->extension();
            $this->photo->storeAs('courses', $custome_name, 'public');

            $this->image = $custome_name;
        }
        Course::create([
            'title' => $this->title,
            'price' => $this->price,
            'image' => $this->image,
            'date' => $this->date,
            'description' => $this->description,
        ]);
        return redirect()->route('courses');
    }
    public function update()
    {
        $this->authorize('courses.edit');
        $this->validate();
        $new = Course::find($this->id);
        if ($this->photo) {
            $custome_name = uniqid() . '.' . $this->photo->extension();
            $this->photo->storeAs('courses', $custome_name, 'public');
            if ($new->image) {
                if (file_exists(public_path('storage/courses/' . $new->image))) {
                    unlink(public_path('storage/courses/' . $new->image));
                }
            }
            $this->image = $custome_name;
        } else {
            $this->image = $new->image;
        }
        $new->update([
            'title' => $this->title,
            'price' => $this->price,
            'date' => $this->date,
            'image' => $this->image,
            'description' => $this->description,
        ]);
        return redirect()->route('courses');
    }
}
