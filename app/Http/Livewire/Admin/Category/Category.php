<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\{Categories, Schools, Course};
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    public $heading = 'Category';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';

    public $name;
    public $status;
    public $isOpen = 0;
    public $isedit = 0;
    public $categoryId;
    public $School;
    public $courses;
    public $universities,$dependency;

    public function mount()
    {
        $this->School = Schools::all();
        $this->courses = Course::all();
        $this->name = '';
        $this->status = "1";

    }
    public function clearFilters()
    {
        $this->searchTerm = null;

        $this->applyFilters();
    }

    public function applyFilters()
    {
        $query = Categories::query();
        if ($this->searchTerm) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }
        $query->orderBy($this->orderColumn, $this->sortOrder);
        $this->universities = $query->get();
    }



    public function create()
    {
        $this->openModal();
    }
     
    public function openModal()
    {
        $this->isOpen = true;
        $this->resetValidation();
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }


    public function store()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required',

        ]);

        Categories::create([
            'name' => $this->name,
            'dependency'=>$this->dependency,
            'status' => $this->status,
        ]);
        $this->dispatch('toastSuccess', $this->heading . ' create successfully .');

        $this->closeModal();
        $this->reset('name','dependency','status');
    }


    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->dependency = $category->dependency;
        $this->status = $category->status;
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($this->categoryId) {
            $categories = Categories::findOrFail($this->categoryId);
            $categories->update([
                'name' => $this->name,
                'dependency'=>$this->dependency,
                'status' => $this->status,
        
            ]);

            $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
            $this->closeModal();
            $this->reset('name','dependency','status','categoryId');
        }
    }

    public function columnSortOrder($columnName = "")
    {
        $caretOrder = "up";
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = "down";
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = "up";
        }
        $this->sortLink = '<i class="sorticon bx bx-caret-' . $caretOrder . '"></i>';
        $this->orderColumn = $columnName;
    }

    public function render()
    {

        $categorie = Categories::orderby($this->orderColumn, $this->sortOrder)
            ->select('id', 'name','status','dependency');
        $searchQuery = '%' . $this->searchTerm . '%';

        if (!empty($this->searchTerm)) {
            $categorie->orWhere('name', 'like', $searchQuery);
            $categorie->orWhere('status', 'like', $searchQuery);
            $categorie->orWhere('dependency', 'like', $searchQuery);
          
            
        }
        $categories = $categorie->paginate(10);


        return view('livewire.admin.category.category', compact('categories'));
    }


    public function delete($categoryId)
    {
        $category = Categories::findOrFail($categoryId);
        $category->delete();

        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
    public function status_update($categoryId)
    {
        $category = Categories::find($categoryId);

        if ($category->status == 0) {
            $category->status = 1;
            $category->save();
            $this->dispatch('toastSuccess', 'status successfully deleted.');
        } else {
            $category->status = 0;
            $category->save();
            session()->flash('success', 'status deactivated successfully.');
        }
        return $this->redirect(route('admin.categorys'), navigate: true);
    }

    public function dependency_update($categoryId)
    {
        $category = Categories::find($categoryId);

        if ($category->dependency == 0) {
            $category->dependency = 1;
            $category->save();
            $this->dispatch('toastSuccess', 'dependency successfully deleted.');
        } else {
            $category->dependency = 0;
            $category->save();
            session()->flash('success', 'dependency deactivated successfully.');
        }
        return $this->redirect(route('admin.categorys'), navigate: true);
    }


 
}
