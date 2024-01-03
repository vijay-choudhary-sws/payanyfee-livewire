<div>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <div class="ms-auto text-end">
                        <div class="row">
                            <div class="col-9">
                                <form wire:submit.prevent="applyFilter">
                                    <div class="page-breadcrumb d-none d-sm-flex align-items-center py-3"
                                        style="background:#fff">

                                        <div class="px-2">
                                            <select wire:model="selectedtitle"
                                                class="resizeselect filt1 form-control form-select"
                                                style="width:150px !important">
                                                <option value="">Payment Setting All</option>
                                                @foreach ($PaymentsettingAll as $Paymentset)
                                                    <option value="{{ $Paymentset->title }}">
                                                        {{ $Paymentset->title }}
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
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Apply</button>
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
                            <div class="ms-auto text-end col-3 mt-3">
                                <div class="btn-group AddbtnPadding">
                                    <a wire:navigate href="{{ route('admin.paymentsettings.paymentsettingcreate') }}"
                                        class="btn btn-primary mt-2 mt-lg-0 mb-">
                                        Create {{ $heading }}
                                    </a>
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
                                    <th class="sort" wire:click="columnSortOrder('id')">S.No {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('title')">Title
                                        {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('slug')">Slug {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('cc_email')">CC Email
                                        {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('bcc_email')">BCC Email
                                        {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('status')">Status
                                        {!! $sortLink !!}
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                @if ($Paymentsettings->count())
                                    @foreach ($Paymentsettings as $Paymentsetting)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Paymentsetting->title }} </td>
                                            <td>{{ $Paymentsetting->slug }} </td>
                                            <td>{{ $Paymentsetting->cc_email }} </td>
                                            <td>{{ $Paymentsetting->bcc_email }} </td>
                                            <td>
                                                <button style="font-size: 12px;"
                                                    wire:click="status_update({{ $Paymentsetting->id }})"
                                                    class="btn btn-info btn-sm"
                                                    onclick="return confirm('Are you sure you want to change this Paymentsetting status?');">
                                                    @if ($Paymentsetting->status == 0)
                                                        Inactive
                                                    @else
                                                        Active
                                                    @endif
                                                </button>
                                            </td>
                                            <td>
                                                <a style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                                    href="{{ route('admin.paymentsettings.paymentsettingview', ['id' => $Paymentsetting->id]) }}"
                                                    wire:navigate class="btn btn-secondary" wire:navigate
                                                    class="btn btn-secondary" title="Edit {{ $heading }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                                    href="{{ route('admin.paymentsettings.paymentsettingedit', ['paymentsettings' => $Paymentsetting->id]) }}"
                                                    wire:navigate class="btn btn-secondary"
                                                    title="Edit {{ $heading }}"><i class="bx bx-edit"></i></a>
                                                    <button style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                                    class="btn bg-red-500 text-white" type="button"
                                                    wire:click="delete({{ $Paymentsetting }})"
                                                    wire:confirm="Are you sure you want to delete this {{ $heading }}?">
                                                    <i class="bx bx-trash"></i>
                                                   </button>
                                                   <a style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                                       href="{{ route('admin.paymentsettings.paymentList', $Paymentsetting->id) }}"
                                                       wire:navigate class="btn btn-secondary"
                                                       title="{{ $heading }} History"><i class="fa fa-history" aria-hidden="true"></i></a>
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
                        {{ $Paymentsettings->links() }}
                  </div>
               </div>
            </div>
        </div>
    </div>
</div>
