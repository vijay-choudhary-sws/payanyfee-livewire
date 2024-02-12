<?php

namespace App\Http\Livewire\Admin\Post;

use Livewire\Component;
use App\Models\{Posts, Categories};
use Livewire\WithPagination;

class Post extends Component
{
    use WithPagination;
    public $heading = 'Post';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';
    public $title;

    public $category_id;
    public $amount;
    public $status;
    public $isOpen = 0;
    public $isedit = 0;
    public $PostId;

    public $universities,$dependency_category,$dependency_category_id;

    public function mount()
    {
        $this->universities = Categories::all();
        $this->title = '';
        $this->category_id = '';
        $this->status = '1';
        $this->dependency_category = Categories::get();
        
    }

    public function clearFilters()
    {
        $this->searchTerm = null;

        $this->applyFilters();
    }

    public function applyFilters()
    {
        $query = Posts::query();

        if ($this->searchTerm) {
            $query->where('title', 'like', '%' . $this->searchTerm . '%');
        }

        $query->orderBy($this->orderColumn, $this->sortOrder);

        $this->universities = $query->get();
    }

    public function create()
    {
        $this->reset('title','amount','category_id','status','PostId');
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
            'title' => 'required',
            'amount'=>'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);
        
        Posts::create([
            'title' => $this->title,
            'amount'=> $this->amount,
            'category_id' => $this->category_id,
            'dependency_category_id' => $this->dependency_category_id,
          
            'status' => $this->status,
        ]);
        $this->dispatch('toastSuccess', $this->heading . ' create successfully .');

        $this->closeModal();
        $this->reset('title','amount','category_id', 'status');
    }


    public function edit($id)
    {
        $post = Posts::findOrFail($id);
        $this->PostId = $id;
        $this->title = $post->title;
        $this->amount =$post->amount;
        $this->category_id = $post->category_id;
        $this->dependency_category_id = $post->dependency_category_id;

        $this->status = $post->status;
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'amount'=>'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        if ($this->PostId) {
            $post = Posts::findOrFail($this->PostId);
            $post->update([
                'title' => $this->title,
                'amount'=>$this->amount,
                'category_id' => $this->category_id,
                'dependency_category_id' => $this->dependency_category_id,
                'status' => $this->status,
            ]);

            $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
            $this->closeModal();
            $this->reset('title','amount', 'category_id', 'status', 'PostId');
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

        $post = Posts::with('category')->orderby($this->orderColumn, $this->sortOrder)
            ->select('id', 'title','amount','category_id', 'status');
        $searchQuery = '%' . $this->searchTerm . '%';

        if (!empty($this->searchTerm)) {
            $post->orWhere('title', 'like', $searchQuery);
            $post->orWhere('amount', 'like', $searchQuery);
            $post->orWhere('category_id', 'like', $searchQuery);
            $post->orWhere('status', 'like', $searchQuery);
        }
        $posts = $post->paginate(10);


        return view('livewire.admin.post.post', compact('posts'));
    }


    public function delete($PostId)
    {
        $post = Posts::findOrFail($PostId);
        $post->delete();

        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }

    public function status_update($PostId)
    {
        $post = Posts::find($PostId);

        if ($post->status == 0) {
            $post->status = 1;
            $post->save();
            $this->dispatch('toastSuccess', 'status successfully deleted.');
        } else {
            $post->status = 0;
            $post->save();
            session()->flash('success', 'status deactivated successfully.');
        }

        return $this->redirect(route('admin.posts'), navigate: true);
    }
}
