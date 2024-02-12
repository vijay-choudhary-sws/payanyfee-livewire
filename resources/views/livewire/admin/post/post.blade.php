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
                                    <th class="sort" wire:click="columnSortOrder('title')">Title
                                        {!! $sortLink !!}</th>
                                        <th class="sort" wire:click="columnSortOrder('amount')">Amount
                                            {!! $sortLink !!}</th>
                                    <th class="sort" wire:click="columnSortOrder('category_id')">Category
                                        {!! $sortLink !!}</th>
                                    <th class="sort" wire:click="columnSortOrder('status')">Status
                                        {!! $sortLink !!}</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($posts->count())
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->title }} </td>
                                            <td>{{$post->amount}}</td>
                                            <td>{{ $post->category->name }} </td>
                                            <td>
                                                <button style="font-size: 12px;"
                                                    wire:click="status_update({{ $post->id }})"
                                                    class="btn btn-info btn-sm"
                                                    wire:confirm="Are you sure you want to change this Post status?">
                                                    @if ($post->status == 0)
                                                        Inactive
                                                    @else
                                                        Active
                                                    @endif
                                                </button>
                                            </td>
                                            <td>
                                                <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                                    class="btn btn-secondary" wire:click="edit({{ $post->id }})"
                                                    title="Edit {{ $heading }}"><i class="bx bx-edit"></i></button>
                                                <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                                    class="btn  bg-red-500 text-white" type="button"
                                                    wire:click="delete({{ $post->id }})"
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

                        {{ $posts->links() }}
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

                                <h2 class="text-2xl font-bold mb-4">{{ $PostId ? 'Edit' : 'Create' }}
                                    {{ $heading }}
                                </h2>
                                <form wire:submit.prevent="{{ $PostId ? 'update' : 'store' }}">
                                    <div class="row">
                                        <div class="col-md-12 my-2">
                                            <label for="title"
                                                class="form-control-label">Title</label>
                                            <input type="text" wire:model="title" id="title" class="form-control"
                                                placeholder="Enter Title">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 my-2">
                                            <label for="title"
                                                class="form-control-label">Amount</label>
                                            <input type="text" wire:model="amount" id="amount" class="form-control"
                                                placeholder="Enter Amount">
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category_id"
                                                class="form-control-label">Category</label>
                                            <select class="form-control single-select" id="category_id" wire:model="category_id">
                                                <option value="">-- Select --</option>
                                                @foreach ($universities as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category_id"
                                                class="form-control-label">Dependency Category Id</label>
                                            <select class="form-control single-select" id="dependency_category_id" wire:model="dependency_category_id">
                                                <option value="">-- Select --</option>
                                                @foreach ($dependency_category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="status">Status</label>
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
                                    </div>
                                    <div class="flex justify-end mt-5">

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
