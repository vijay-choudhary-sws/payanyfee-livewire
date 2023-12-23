<div>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                           
                              <div class="page-breadcrumb d-none d-sm-flex align-items-center py-3">
                      
                                 <div class="px-2">
                                    <input wire:model="searchTerm" type="search" class="form-control filt3" placeholder="Start typing to search">
                                 </div>
                                 <div class="px-2">
                                    <input wire:click="applyFilters" class="btn btn-sm bg-primary text-white" type="submit" value="Apply">
                                 </div>
                                 <div class="px-2">
                                    @if(!empty($searchTerm))
                                    <button wire:click.prevent="clearFilters" type="button" class="btn btn-sm bg-info text-white">Clear</button>
                                    @endif
                                 </div>
                           
                           </div>
                        </div>
                    <div class="col-4">
                    <div class="ms-auto text-end">
                        <div class="btn-group AddbtnPadding">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click="create">Create {{$heading}}</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3">
                            {{-- <input type="text" class="form-control mb-2" placeholder="Search Title"
                                style="width: 188px;" wire:model.live="searchTerm"> --}}
 
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <!-- Table headers -->
                            <thead>
                                <tr>
                                    <th class="sort" wire:click="columnSortOrder('id')">S.No {!! $sortLink !!}</th>
                                    <th class="sort" wire:click="columnSortOrder('name')">Name {!! $sortLink !!}
                                    </th>
                                   
                                    </th>
                                    <th>Action</th>
 
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                @if ($spcs->count())
                                    @foreach ($spcs as $spc)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $spc->name }} </td>
                                            <td>
                                               <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;" 
                                                class="btn btn-secondary"
                                                  
                                            wire:click="edit({{ $spc->id }})"  title="Edit {{ $heading }}"><i class="bx bx-edit"></i></button>
 
 
                                                <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;" class="btn  bg-red-500 text-white" type="button"
                                                    wire:click="delete({{ $spc->id }})"
                                                    wire:confirm="Are you sure you want to delete this {{ $heading }}?">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No record found</td>
                                    </tr>
 
                                @endif
 
                            </tbody>
                        </table>
                        <!-- Pagination navigation links -->
                        {{ $spcs->links() }}
                    </div>
                    @if($isOpen)
                
                 <div class="fixed inset-0 flex items-center justify-center z-50">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                        <!-- Modal content goes here -->
                        <svg wire:click.prevent="$set('isOpen', false)"
                        class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                       <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                   </svg>
                    
                   
                        <h2 class="text-2xl font-bold mb-4">{{ $spcId ? 'Edit' : 'Create' }} {{$heading}}</h2>
                        <form  wire:submit.prevent="{{ $spcId ? 'update' : 'store' }}">
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                                <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter Name">
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="flex justify-end">
 
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Save</button>
                                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" wire:click="closeModal">Cancel</button>
                            </div>
                        </form>
 
                    </div>
                </div>            
                @endif               
                </div>
            </div>
 
        </div>
    </div>
   </div>
 