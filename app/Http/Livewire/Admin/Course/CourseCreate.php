<?php

namespace App\Http\Livewire\Admin\Course;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Course;

class CourseCreate extends Component
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
 
    public $heading = 'Course';

    public function save()
    {
        $this->validate(); 
 
        Course::create(
            $this->only(['course_name', 'course_fee','total_sets','available_sets','description','status'])
        );

        $this->dispatch('toastSuccess',$this->heading.' successfully saved.');
        
        return $this->redirect(route('admin.courses'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.course.coursecreate');
    }

   
}


