<section>
    <div class="page-wrapper">
    <div class="page-content">
      <div class="card">
         <div class="card-body">
            <div class="ms-auto ">
               <div class="row">
                  <div class='col-6 mt-2' style="font-size:20px">
                     <h5 class="mb-0">Edit {{$heading}}</h5>
                  </div>
                  <div class="ms-auto text-end col-3">
                     <div class="btn-group AddbtnPadding">
                        <button wire:click="create" class="btn btn-primary mt-2 mt-lg-0 mb-">
                        Edit Field
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @if($showEditModal)
      <div class="modal-body">
      <div class="fixed inset-0 flex items-center justify-center z-50">
         <div class="absolute inset-0 bg-black opacity-50"></div>
         <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
            <!-- Modal content goes here -->
            <h2 class="text-2xl font-bold mb-4">Edit </h2>
            <div class="mb-4">
               <label for="edit-label" class="block text-gray-700 font-bold mb-2">Label</label>
               <input type="text" wire:model="editedLabel" id="edit-label" class="form-control" placeholder="Enter Name">
               @error('editedLabel') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
               <label for="edit-label" class="block text-gray-700 font-bold mb-2">Type</label>
               <select id="edit-label" class="form-control single-select" name="edit-select" wire:model="editedSelect">
                   <option value="">--Select Field--</option>
                   @foreach($Editfields as $item)
                       <option value="{{ $item->text }}">{{ $item->text }}</option>
                   @endforeach
               </select>
               @error('editedSelect') <span class="text-danger">{{ $message }}</span>@enderror
           </div>
            <div class="flex justify-end">
               <button wire:click="create" type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Save</button>
               <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" wire:click="close">Cancel</button>
            </div>
         </div>
      </div>
      @endif

       <div class="card-body">
         <form wire:submit="update()">
            @csrf
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                 
                     <label for="exampleFormControlInput1">Title</label>
                     <input type="text"  class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" wire:model="title">
                     @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                  
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="frmInputGroup">
                    {{-- <div class="bootstrap-tagsinput"> --}}
                     <label for="form-label">Email</label>
                     <input type="email"  class="form-control" id="exampleFormControlInput1"  placeholder="Enter Email" wire:model="email">
                     @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                  {{-- </div> --}}
               </div>
              </div>
           </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group my-3">
                     <label for="exampleFormControlInput1">CC Email</label>
                     <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter CC Email" wire:model="cc_email">
                     @error('cc_email') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group  my-3 mb-5">
                     <label for="exampleFormControlInput1">BCC Email</label>
                     <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter BCC Email" wire:model="bcc_email">
                     @error('bcc_email') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
               </div>
            </div>
            {{-- <hr class="frmHoriz"> --}}
         
            <div class="row">
               
               <div class="col-md-6">
                  <div class="form-group mb-3">
                     <label class="form-label" for="status">Status</label>
                     <select wire:model="status" id="status" class="form-control">
                        <option value="">Select</option>
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                     </select>
                     @error('status')<span class="text-danger"
                        role="alert">{{ $message }}</span>@enderror
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="my-4">
                        <button class="btn  bg-red-500 text-white" type="submit" >Update
                        <span class="spinner-border spinner-border-sm" wire:loading wire:target="save" role="status" aria-hidden="true"></span>
                        </button>
                        <a href="{{route('admin.paymentsettings')}}" wire:navigate class="btn btn-secondary">Cancel</a>
                     </div>
                  </div>
               </div>
         </form>
         </div>

    </div>
 </section>

