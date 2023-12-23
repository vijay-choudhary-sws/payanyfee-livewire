<?php

namespace App\Http\Livewire\Admin\Course;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Course;

class CourseEdit extends Component
{
    #[Validate('required')] 
    public $course_name = '';
 
    #[Validate('required')] 
    public $course_fee = '';

    #[Validate('required')] 
    public $total_sets = '';

    #[Validate('required')] 
    public $available_sets = '';

    #[Validate('required')] 
    public $description = '';

    #[Validate('required')] 
    public $status = '';
 
    public $course ;
    public $heading = 'Course';

    public function mount(Course $course)
    {
        $this->course_name = $course->course_name;
        $this->course_fee = $course->course_fee;
        $this->total_sets = $course->total_sets;
        $this->available_sets = $course->available_sets;
        $this->description = $course->description;
        $this->status = $course->status;
        $this->course = $course;
       
    }

    public function update()
    {
        $this->validate(); 
        $this->course->fill(
            $this->only(['course_name', 'course_fee','total_sets','available_sets','description','status'])
        )->save();

        $this->dispatch('toastSuccess',$this->heading.' successfully updated.');
        
        return $this->redirect(route('admin.courses'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.course.courseedit');
    }

   
}

