<div>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <div class="ms-auto text-end">
                        <div class="row">
                            <div class="col-8">
                                <form wire:submit.prevent="applyFilter">
                                    <div class="page-breadcrumb d-none d-sm-flex align-items-center py-3"
                                        style="background:#fff">

                                        <div class="px-2">
                                            <select wire:model="selectedtitle"
                                                class="resizeselect filt1 form-control form-select"
                                                style="width:150px !important">
                                                <option value="">Payment Get Way</option>
                                                @foreach ($paymentgetway as $Paymentset)
                                                    <option value="{{ $Paymentset->name }}">
                                                        {{ $Paymentset->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="px-2">
                                            <select wire:model="status"
                                                class="resizeselect filt2 form-control form-select"
                                                style="width:150px !important">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="px-2">
                                            <input wire:model="search" type="text" name="search"
                                                class="form-control filt3" placeholder="Start Typing To Search">
                                        </div>
                                        <div class="px-2">
                                            <button type="submit"
                                                class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold">Apply</button>
                                        </div>
                                        @if ($filterApplied)
                                            <div class="px-2">
                                                <button type="button" wire:click="clearFilter"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Clear</button>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>

                            <div class="col-4">
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
                            <a href="javascript:void(0);" class="btn ExportReporttoExcel" wire:click="exportToExcel"
                                style="font-size: 9px;">
                                <svg class="svg-inline--fa fa-file-export fa-w-18" aria-hidden="true" focusable="false"
                                    data-prefix="fa" data-icon="file-export" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                    <!-- SVG path for the export icon -->
                                    <path fill="currentColor"
                                        d="M384 121.9c0-6.3-2.5-12.4-7-16.9L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128zM571 308l-95.7-96.4c-10.1-10.1-27.4-3-27.4 11.3V288h-64v64h64v65.2c0 14.3 17.3 21.4 27.4 11.3L571 332c6.6-6.6 6.6-17.4 0-24zm-379 28v-32c0-8.8 7.2-16 16-16h176V160H248c-13.2 0-24-10.8-24-24V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V352H208c-8.8 0-16-7.2-16-16z">
                                    </path>
                                </svg>
                                Export
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <!-- Table headers -->
                            <thead>
                                <tr>
                                    <th class="sort" wire:click="columnSortOrder('id')">S.No {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('name')">Name {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('logo')"> Logo{!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('Status')">
                                        Status{!! $sortLink !!}</th>
                                    <th>Payment Mode</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                @if ($paymentgateways->count())
                                    @foreach ($paymentgateways as $ptc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ptc->name }} </td>
                                            <td>
                                                <img src="{{ asset($ptc->photo) }}" class="img-fluid" width="50px"
                                                    height="50px">
                                            </td>
                                            <td>
                                                <button style="font-size: 12px;"
                                                    wire:click="status_update({{ $ptc->id }})"
                                                    class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold "
                                                    onclick="return confirm('Are you sure you want to change this course status?');">
                                                    @if ($ptc->status == 1)
                                                        Inactive
                                                    @else
                                                        Active
                                                    @endif
                                                </button>
                                            </td>
                                            <td><button style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                                    class="btn btn-secondary" wire:click="payedit({{ $ptc->id }})"
                                                    title="Edit {{ $heading }}"><i class="bx bx-edit"></i></button>
                                            </td>
                                            <td>
                                                <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                                    class="btn btn-secondary" wire:click="edit({{ $ptc->id }})"
                                                    title="Edit {{ $heading }}"><i
                                                        class="bx bx-edit"></i></button>


                                                <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                                    class="btn  bg-red-500 text-white" type="button"
                                                    wire:click="delete({{ $ptc->id }})"
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
                        {{ $paymentgateways->links() }}

                    </div>
                    @if ($isOpen)

                        <div class="fixed inset-0 flex items-center justify-center z-50">
                            <div class="absolute inset-0 bg-black opacity-50"></div>
                            <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                                <!-- Modal content goes here -->
                                <svg wire:click.prevent="$set('isOpen', false)"
                                    class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                                </svg>



                                @if ($paymodeedit)
                                    <h2 class="text-2xl font-bold mb-4">Payment Mode</h2>
                                    <form wire:submit.prevent="editPaymentMode">
                                    @else
                                        <h2 class="text-2xl font-bold mb-4">{{ $pgwId ? 'Edit' : 'Create' }}
                                            {{ $heading }}</h2>
                                        <form wire:submit.prevent="{{ $pgwId ? 'update' : 'store' }}">
                                @endif
                                <div class="row">
                                    @if ($paymodeedit == false)
                                        <div class="col-md-6 mb-4">
                                            <label for="name"
                                                class="block text-gray-700 font-bold mb-2">Name</label>
                                            <input type="text" wire:model="name" id="name"
                                                class="form-control" placeholder="Enter Name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Select Payment Country<sup
                                                    class="text-danger">*</sup></label>
                                            <select wire:model="selectpaymentcountry" class="form-control">
                                                <option value="">Select</option>
                                                <option value="0">both</option>
                                                <option value="1">India</option>
                                                <option value="2">Out Side India</option>
                                            </select>
                                            @error('selectpaymentcountry')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label class="form-label" for="status">Status</label>
                                            <select wire:model.defer="status" id="status" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Active</option>
                                                <option value="0">In-Active</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8 mb-4">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="logo"
                                                        class="block text-gray-700 font-bold mb-2">Logo</label>
                                                    <input type="file" wire:model="photo" id="photo"
                                                        class="form-control">
                                                    @error('photo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-4 align-self-center">
                                                    @if ($photo && is_string($photo))
                                                        <img src="{{ asset($photo) }}" class="img-fluid"
                                                            width="50px" height="50px">
                                                    @elseif ($photo && is_object($photo))
                                                        <img src="{{ $photo->temporaryUrl() }}" class="img-fluid"
                                                            width="50px" height="50px">
                                                    @else
                                                        <p>No image available</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($gatewayCreat || $paymodeedit)
                                        <div class="col-12">
                                            <h3 class="fw-bold">Payment Mode</h3>
                                            <table class="table-sm w-100 table-striped border">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">Name</th>
                                                        <th scope="col" class="text-center">Amount</th>
                                                        <th scope="col" class="text-center">Is Percent</th>
                                                        <th scope="col" class="text-center">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($paymentMode as $mode)
                                                        <tr>
                                                            <td scope="row" class="text-center">
                                                                {{ $mode->name }}</td>
                                                            <td class="text-center"><input type="number"
                                                                    wire:model="amount.{{ $mode->id }}"
                                                                    class="form-control-sm"></td>
                                                            <td class="text-center"><input type="checkbox"
                                                                    wire:model="percent.{{ $mode->id }}"
                                                                    class="form-check-input"></td>
                                                            <td class="text-center"><input type="checkbox"
                                                                    wire:model="modestatus.{{ $mode->id }}"
                                                                    class="form-check-input"></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

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
