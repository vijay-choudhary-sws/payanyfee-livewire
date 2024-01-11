<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Categories;
use App\Models\Category;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Course;
use App\Models\Post;
use App\Models\Posts;

class CourseCreate extends Component
{
    #[Validate('required')] 
    public $title = '';
 
    #[Validate('required')] 
    public $category_id = '';

    #[Validate('required')] 
    public $status = '';
 
    public $heading = 'Posts',$category;

    public function mount(){
        $this->category = Categories::all();
    }

    public function save()
    {
        $this->validate(); 
 
        Posts::create(
           ['title'=>$this->title, 'category_id'=>$this->category_id, 'status'=>$this->status]
        );

        $this->dispatch('toastSuccess',$this->heading.' successfully saved.');
        
        return $this->redirect(route('admin.courses'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.course.coursecreate');
    }

   
}


