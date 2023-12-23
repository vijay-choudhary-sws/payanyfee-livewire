<div>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3">
                            <input type="text" class="form-control mb-2" placeholder="Search Title"
                                style="width: 188px;" wire:model.live="searchTerm">
                        </div>
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
                    
                         <form  wire:submit.prevent='store'>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-bold mb-2">Label</label>
                                <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter Name">
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            {{-- <div class="mb-4">
                                <label for="amount" class="block text-gray-700 font-bold mb-2">Amount</label>
                                <input type="text" wire:model="text" id="amount" class="form-control" placeholder="Enter Amount">
                                @error('text') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="amount" class="block text-gray-700 font-bold mb-2">Amount</label>
                                <input type="text" wire:model="inputKey" id="amount" class="form-control" placeholder="Enter Amount">
                                @error('text') <span class="text-danger">{{ $message }}</span>@enderror
                            </div> --}}
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
 