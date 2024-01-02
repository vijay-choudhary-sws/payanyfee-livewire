<section>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <div class="ms-auto ">
                        <div class="row">
                            <div class='col-6 mt-2' style="font-size:20px">
                                <h5 class="mb-0">Edit {{ $heading }}</h5>
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
        @if ($showEditModal)
            <div class="modal-body">
                <div class="fixed inset-0 flex items-center justify-center z-50">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                        <!-- Modal content goes here -->
                        <h2 class="text-2xl font-bold mb-4">Add Field</h2>
                        <div class="row">
                            <div class="col-6 mb-1">
                                <label for="label" class="block text-gray-700 font-bold mb-2">Label</label>
                                <input type="text" wire:model="label" id="label" class="form-control"
                                    placeholder="Enter Name">
                                @error('label')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-6 mb-1">
                                <label for="input_type" class="block text-gray-700 font-bold mb-2">Input
                                    Type</label>
                                <select class="form-control single-select" id="input_type" wire:model="input_type"
                                    wire:change="isOption">
                                    <option value="" selected>--Select Type--</option>
                                    @foreach ($inputtype as $item)
                                    <option value="{{ $item->id }}">{{ $item->inputKey }}</option>
                                    @endforeach
                                </select>
                                @error('input_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 mb-1">
                                <label for="input_name" class="block text-gray-700 font-bold mb-2">Input
                                    Name</label>
                                <input type="text" wire:model="input_name" id="input_name" class="form-control"
                                    placeholder="Enter Name">
                                @error('input_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-6">
                                <label for="placeholder" class="block text-gray-700 font-bold mb-2">Placeholder</label>
                                <input type="text" wire:model="placeholder" id="placeholder" class="form-control"
                                    placeholder="Enter Name">
                                @error('placeholder')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label for="is_required" class="block text-gray-700 font-bold mb-2">Required</label>
                                <select class="form-control single-select" id="is_required" wire:model="is_required">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                                @error('is_required')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($is_option)
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th class="text-center">Value</th>
                                        <th class="text-center">Label</th>
                                        <th class="text-center">Is Default</th>
                                        <th class="text-center"><button class="btn text-white btn-info btn-sm"
                                                wire:click.prevent="add({{ $i }})" wire:loading.attr="disabled"
                                                wire:target="add">Add Row</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($option as $key => $value)
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter option value"
                                                    wire:model="optionvalue.{{ $value }}">
                                                @error('optionvalue.' . $value)
                                                <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter option label"
                                                    wire:model="optionlabel.{{ $value }}">
                                                @error('optionlabel.' . $value)
                                                <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group text-center">
                                                <input type="radio" class="form-control-radio"
                                                    placeholder="Enter option label" value='{{ $value }}'
                                                    wire:model="optionradio">
                                                @error('optionradio.' . $value)
                                                <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm"
                                                wire:click.prevent="remove({{ $key }})" wire:loading.attr="disabled"
                                                wire:target="remove">Remove</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            <div class="flex justify-end">
                                <button wire:click="store" type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Save</button>
                                <button type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                    wire:click="close">Cancel</button>
                            </div>

                        </div>
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
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Title" wire:model="title">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="frmInputGroup">
                                {{-- <div class="bootstrap-tagsinput"> --}}
                                    <label for="form-label">Email</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Enter Email" wire:model="email">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {{--
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group my-3">
                                <label for="exampleFormControlInput1">CC Email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter CC Email" wire:model="cc_email">
                                @error('cc_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  my-3 mb-3">
                                <label for="exampleFormControlInput1">BCC Email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter BCC Email" wire:model="bcc_email">
                                @error('bcc_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
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
                    </div>

                    <hr class="hr">

                    <div class="row" wire:sortable="updateInputOreder">

                        @foreach ($input_data as $d)
                        <div class="col-md-12" wire:sortable.item="{{ $d->id }}" wire:key="order-{{ $d->id }}">
                            <livewire:is :component="'common.' . $d->inputType->tag_name" livewire:common. :in_data="$d"
                                :wire:key="$d->id" wire:sortable.handle />
                        </div>

                        @endforeach

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="my-4">

                                <button class="btn  bg-red-500 text-white" type="submit">Update
                                    <span class="spinner-border spinner-border-sm" wire:loading wire:target="save"
                                        role="status" aria-hidden="true"></span>
                                </button>
                                <a href="{{ route('admin.paymentsettings') }}" wire:navigate
                                    class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>