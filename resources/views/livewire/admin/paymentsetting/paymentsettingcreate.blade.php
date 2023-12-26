<section>
   <div class="page-wrapper">
   <div class="page-content">
     <div class="card">
        <div class="card-body">
            <div class="ms-auto ">
               <div class="row">
                 <div class='col-6 mt-2' style="font-size:20px">
                    <h5 class="mb-0">Payment Setting Detail</h5>
                  </div>
                  <div class="ms-auto text-end col-3">
                    <div class="btn-group AddbtnPadding">
                        <button wire:click="create" class="btn btn-primary mt-2 mt-lg-0 mb-">
                            Add Field
                        </button>
                    </div>
                </div> 
            </div>

        </div>
    </div>
    </div>

   @if($showAddFieldModal)
  <!-- Edit your modal content here -->
  <!-- Edit your form or other content here -->
  <div class="modal-body">
  <div class="fixed inset-0 flex items-center justify-center z-50">
     <div class="absolute inset-0 bg-black opacity-50"></div>
     <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
        <!-- Modal content goes here -->
        <h2 class="text-2xl font-bold mb-4">Add Field</h2>
         
        <div class="mb-4">
           <label for="edit-label" class="block text-gray-700 font-bold mb-2">Label</label>
           <input type="text" wire:model="label" id="edit-label" class="form-control" placeholder="Enter Name">
           @error('label') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-4">
           <label for="edit-label" class="block text-gray-700 font-bold mb-2">Type</label>
           <select id="edit-label" class="form-control single-select" wire:model="select_type" wire:change="gettagtype">
              <option value="">--Select Tag--</option>
              @foreach($fields as $item) 
              <option value="{{ $item->tag_name }}" >{{ $item->tag_name }}</option>
              @endforeach            
           </select>
           @error('select_type') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        @if ($inputType)
            
        <div class="mb-4">
           <label for="edit-label" class="block text-gray-700 font-bold mb-2">Type</label>
           <select id="edit-label" class="form-control single-select" >
              <option value="">--Select Type--</option>
              @foreach($fields as $item) 
              <option value="{{ $item->type }}" >{{ $item->type }}</option>
              @endforeach            
            </select>
            @error('select_type') <span class="text-danger">{{ $message }}</span>@enderror
         </div>
         @endif
        <div class="flex justify-end">
           <button wire:click="store" type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Save</button>
           <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" wire:click="close">Cancel</button>
        </div>
     </div>
  </div>
  @endif
    <div class="card">
      <div class="card-body">
         <form wire:submit.prevent="save()">
            @csrf
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="exampleFormControlInput1">Title</label>
                     <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" wire:model.defer="title">
                     @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                  
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="frmInputGroup">
                    {{-- <div class="bootstrap-tagsinput"> --}}
                     <label for="form-label">Email</label>
                     <input type="email"  class="form-control" id="exampleFormControlInput1"  placeholder="Enter Email" wire:model.defer="email">
                     @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                  {{-- </div> --}}
               </div>
              </div>
           </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group my-3">
                     <label for="exampleFormControlInput1">CC Email</label>
                     <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter CC Email" wire:model.defer="cc_email">
                     @error('cc_email') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group  my-3 mb-5">
                     <label for="exampleFormControlInput1">BCC Email</label>
                     <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter BCC Email" wire:model.defer="bcc_email">
                     @error('bcc_email') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
               </div>

               @foreach($Fields as $field)
                  @if($field->select_type == 'select')
                  <div class="col-md-5">
                   <div class="form-group my-3">
                    <label class="form-label">{{$field->label}}</label>
                    <input type="hidden" wire:model="input_fields_select_key[]" value="{{$field->label}}">
                    <input type="hidden" wire:model="input_fields_select_type[]" value="{{$field->label}}">
                    
                      <select name="paymentsel" class="{{$class}} basicUsageSelect" wire:model="input_fileds_select[]">
                        <option value="">--Select--</option>
                        @foreach($Inputselectdata as $Inputselect)
                        <option value="{{$Inputselect->id}}">{{$Inputselect->selectTitle}}</option>
                        @endforeach 
                     </select>
                   </div>
                  
                 </div>
                 <div class="col-1 py-5">
                    <div class="btn btn-danger"><button wire:click="Inputdelete('{{ $field->label }}', '{{ $field->select_type }}')" type="button" style="margin:0px !important" class="pull-left">X</button>
                    </div>
                </div>
                 @elseif($field->select_type == 'Text Area')
                 <div class="col-md-5">
                    <div class="form-group my-3">
                      <label class="form-label">{{$field->label}}</label>
                       <input type="hidden" wire:model="input_fields_key[]" value="{{$field->label}}">
                       <input type="hidden" wire:model="input_fields_type[]" value="{{$field->select_type}}">
                        <textarea class="{{$class}}" id="exampleFormControlTextarea4" rows="2" name="input_fileds[]"></textarea>
                    </div>
                   </div>
                   <div class="col-1 py-5">
                    <div class="btn btn-danger"><button wire:click="Inputdelete('{{ $field->label }}', '{{ $field->select_type }}')" type="button" style="margin:0px !important" class="pull-left">X</button>
                    </div>
                </div>
                  @elseif($field->select_type == 'Check Boxes')
                 <div class="col-md-5">
                    <div class="form-group my-3">
                      <label class="form-label d-block">{{$field->label}}</label>
                       <input type="hidden" wire:model="input_fields_key[]" value="{{$field->label}}">
                        <input type="hidden" wire:model="input_fields_type[]" value="{{$field->select_type}}">
                       <input type="checkbox" class="" id="exampleFormControlInput1" placeholder="">
                    </div>
                   </div>
                   <div class="col-1 py-5">
                    <div class="btn btn-danger"><button wire:click="Inputdelete('{{ $field->label }}', '{{ $field->select_type }}')" type="button" style="margin:0px !important" class="pull-left">X</button>
                    </div>
                </div>
                  @else
                   <div class="col-md-5">
                    <div class="form-group my-3">
                       <label class="form-label " >{{$field->label}}</label>
                         <input type="hidden" wire:model="input_fields_key[]" value="{{$field->label}}">
                         <input type="hidden" wire:model="input_fields_type[]" value="{{$field->select_type}}">
                         <input type="{{$field->select_type}}" class="{{$class}}" id="exampleFormControlInput1" placeholder="">
                    
                    </div>
                 </div>
                 <div class="col-1 py-5">
                    <div class="btn btn-danger"><button wire:click="Inputdelete('{{ $field->label }}', '{{ $field->select_type }}')" type="button" style="margin:0px !important" class="pull-left">X</button>
                    </div>
                </div>
                @endif
                @endforeach
              </div>
          

            {{-- <hr class="frmHoriz"> --}}
         
            <div class="row">
               
               <div class="col-md-6">
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
               <div class="row">
                  <div class="col-md-6">
                     <div class="my-4">
                        <button class="btn  bg-red-500 text-white" type="submit" >Save
                        <span class="spinner-border spinner-border-sm" wire:loading wire:target="save" role="status" aria-hidden="true"></span>
                        </button>
                        <a href="{{route('admin.paymentsettings')}}" wire:navigate class="btn btn-secondary">Cancel</a>
                     </div>
                  </div>
               </div>
         </form>
         </div>
      </div>
   </div>
  </div>
</section>

