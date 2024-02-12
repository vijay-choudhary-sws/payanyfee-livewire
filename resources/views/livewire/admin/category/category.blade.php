<div>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">

                            <div class="page-breadcrumb d-none d-sm-flex align-items-center py-3">

                                <div class="px-2">
                                    <input wire:model="searchTerm" type="search" class="form-control filt3"
                                        placeholder="Start typing to search">
                                </div>
                                <div class="px-2">
                                    <input wire:click="applyFilters" class="btn btn-sm bg-primary text-white"
                                        type="submit" value="Apply">
                                </div>
                                <div class="px-2">
                                    @if (!empty($searchTerm))
                                    <button wire:click.prevent="clearFilters" type="button"
                                        class="btn btn-sm bg-info text-white">Clear</button>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="col-3">
                            <div class="ms-auto text-end">
                                <div class="btn-group AddbtnPadding">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                        wire:click="create">Create {{ $heading }}</button>
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
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th class="sort" wire:click="columnSortOrder('id')">S.No {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('name')">Name
                                        {!! $sortLink !!}</th>
                                       
                                    <th class="sort" wire:click="columnSortOrder('status')">Status
                                        {!! $sortLink !!}</th>
                                        <th class="sort" wire:click="columnSortOrder('dependency')">Dependency
                                            {!! $sortLink !!}</th>

                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                @if ($categories->count())
                                @foreach ($categories as $categorie)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $categorie->name }} </td>
                                    <td>
                                        <button style="font-size: 12px;"
                                            wire:click="status_update({{ $categorie->id }})" class="btn btn-info btn-sm"
                                            wire:confirm="Are you sure you want to change this Post status?">
                                            @if ($categorie->status == 0)
                                            Inactive
                                            @else
                                            Active
                                            @endif
                                        </button>
                                    </td>
                                    <td>
                                        <button style="font-size: 12px;"
                                            wire:click="dependency_update({{ $categorie->id }})" class="btn btn-info btn-sm"
                                            wire:confirm="Are you sure you want to change this Post dependency?">
                                            @if ($categorie->dependency == 0)
                                            Inactive
                                            @else
                                            Active
                                            @endif
                                        </button>
                                    </td>

                                    <td>
                                        <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                            class="btn btn-secondary" wire:click="edit({{ $categorie->id }})"
                                            title="Edit {{ $heading }}"><i class="bx bx-edit"></i></button>
                                        <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                            class="btn  bg-red-500 text-white" type="button"
                                            wire:click="delete({{ $categorie->id }})"
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
                        {{ $categories->links() }}
                    </div>
                    @if ($isOpen)

                    <div class="fixed inset-0 flex items-center justify-center z-50">
                        <div class="absolute inset-0 bg-black opacity-50"></div>
                        <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                            <svg wire:click.prevent="$set('isOpen', false)"
                                class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                            </svg>

                            <h2 class="text-2xl font-bold mb-4">{{ $categoryId ? 'Edit' : 'Create' }} {{ $heading }}
                            </h2>
                            <form wire:submit.prevent="{{ $categoryId ? 'update' : 'store' }}">
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                                    <input type="text" wire:model="name" id="name" class="form-control"
                                        placeholder="Enter Name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group my-2 mb-2">
                                        <label class="form-label" for="status">Status</label>

                                        <select wire:model="status" id="status" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">Active</option>
                                            <option value="0">In-Active</option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group my-2 mb-2">
                                        <label class="form-label" for="dependency">Dependency</label>

                                        <select wire:model="dependency" id="dependency" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">Active</option>
                                            <option value="0">In-Active</option>
                                        </select>
                                        @error('dependency')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex justify-end">

                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Save</button>
                                    <button type="button"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                        wire:click="closeModal">Cancel</button>
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