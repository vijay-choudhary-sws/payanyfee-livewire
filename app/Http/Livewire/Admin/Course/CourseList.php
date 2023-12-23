<?php

namespace App\Http\Livewire\Admin\Course;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Course;
use Livewire\WithPagination;

class CourseList extends Component
{
    use WithPagination;

    public $heading = 'Course';
    public $searchTerm;
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';
    public $courses;
    public $searchs;
    public $selectedUniversity;
    public $status;
    
    public function mount()
    {
        $this->courses = Course::all();
    }
    
    public function searching()
    { 
        $course = Course::query();
    
        if (!empty($this->searchs)) {
            $course->where('course_name', 'like', '%' . $this->searchs . '%');
        }
    
        if (!empty($this->selectedUniversity)) {
            $course->where('course_name', $this->selectedUniversity);
        }
    
        if (!empty($this->status)) {
            $course->where('status', $this->status);
        }
    
        $this->courses = $course->get();
    }
    public function clearFilters()
{
    $this->searchs = null;
    $this->selectedUniversity = null;
    $this->status = null;

    // Refresh the course list without filters
    $this->searching();
}
    
   

    public function updated(){
         $this->resetPage();
    }
    public function columnSortOrder($columnName=""){
        $caretOrder = "up";
        if($this->sortOrder == 'asc'){
             $this->sortOrder = 'desc';
             $caretOrder = "down";
        }else{
             $this->sortOrder = 'asc';
             $caretOrder = "up";
        } 
        $this->sortLink = '<i class="sorticon bx bx-caret-'.$caretOrder.'"></i>';
        $this->orderColumn = $columnName;

   }
 
    public function render()
    {

        $course = Course::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','course_name','course_fee','total_sets','available_sets');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){

               $course->orWhere('course_name','like',$searchQuery);
               $course->orWhere('course_fee','like',$searchQuery);
               $course->orWhere('total_sets','like',$searchQuery);
               $course->orWhere('available_sets','like',$searchQuery);
          }
          $courses = $course->paginate(10);
        
        return view('livewire.admin.course.courselist',compact('courses'));
    }

    public function delete(Course $course)
    {
        $course->delete();

        $this->dispatch('toastSuccess',$this->heading.' successfully deleted.');

    }

    public function status_update($id)
    {
        $course = Course::find($id);
    
        if ($course->status == 0) {
            $course->status = 1;
            $course->save();
            $this->dispatch('toastSuccess','status successfully deleted.');
        } else {
            $course->status = 0;
            $course->save();
            session()->flash('success', 'status deactivated successfully.');
        }
    
        return redirect()->route('admin.courses');
    }

    public function view($id)
{
    $course = Course::find($id);

    return view('livewire.admin.course.courseview',compact('course'));
}



    
}

