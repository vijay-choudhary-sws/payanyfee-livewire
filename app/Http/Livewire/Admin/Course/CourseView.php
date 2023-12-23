<?php 

namespace App\Http\Livewire\Admin\Course;

use Livewire\Component;
use App\Models\Course;

class CourseView extends Component
{
    public $course;

    public function mount($id)
    {
        $this->course = Course::find($id);
    }

    public function render()
    {
        return view('livewire.admin.course.courseview');
    }
}
