<section>
    <div class="page-wrapper">
    <div class="page-content">
    <div class="card">
       <div class="card-header">
          <h5 class="text-primary">
             Edit {{$heading}}
             <span class="float-end mr-2">
             </span>
          </h5>
       </div>
       <div class="card-body">
          <form wire:submit="update()">
             @csrf
             <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleFormControlInput1">Course Name</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Course Name" wire:model.defer="course_name">
                      @error('course_name') <span class="text-danger">{{ $message }}</span>@enderror
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleFormControlInput1">Course Fee</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Course Fee" wire:model.defer="course_fee">
                      @error('course_fee') <span class="text-danger">{{ $message }}</span>@enderror
                   </div>
                </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                   <div class="form-group my-3">
                      <label for="exampleFormControlInput1">Total Sets</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Total Sets" wire:model.defer="total_sets">
                      @error('total_sets') <span class="text-danger">{{ $message }}</span>@enderror
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group  my-3">
                      <label for="exampleFormControlInput1">Available Sets</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Available Sets" wire:model.defer="available_sets">
                      @error('available_sets') <span class="text-danger">{{ $message }}</span>@enderror
                   </div>
                </div>
             </div>
             <hr class="border-t border-gray-300 my-4">

             <div class="projectHead border-0">
                 <h4 class="text-2xl font-bold">About</h4>
             </div>
             
             <div class="flex">
                <div class="w-1/2">
                   <div class="form-group my-3">
                      <label for="exampleFormControlTextarea1">Course Description</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" wire:model.defer="description"></textarea>
                      @error('description') <span class="text-danger">{{ $message }}</span>@enderror
                   </div>
                </div>
                <div class="w-1/2">
                   <div class="form-group mb-3">
                      <label class="form-label" for="status">Status</label>
                      <select wire:model.defer="status" id="status" class="form-control">
                         <option value="">Select</option>
                         <option value="1">Active</option>
                         <option value="0">In-Active</option>
                      </select>
                      @error('status')<span class="text-danger"
                         role="alert">{{ $message }}</span>@enderror
                   </div>
                </div>
             </div>
                <div class="row">
                   <div class="col-md-6">
                      <div class="my-4">
                         <button class="btn bg-red-500 text-white" type="submit" >Update
                         <span class="spinner-border spinner-border-sm" wire:loading wire:target="update" role="status" aria-hidden="true"></span>
                         </button>
                         <a href="{{route('admin.courses')}}" wire:navigate class="btn btn-secondary">Cancel</a>
                      </div>
                   </div>
                </div>
          </form>
          </div>
       </div>
    </div>
 </section>

