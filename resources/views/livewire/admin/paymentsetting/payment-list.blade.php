<div>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <div class="ms-auto ">
                        <div class="row">
                            <div class='col-3 mt-2' style="font-size:20px">
                                <h5 class="mb-0">{{ $heading }}</h5>
                            </div>
                            <div class="col-9">
                                <form wire:submit.prevent="applyFilter">
                                    <div class="page-breadcrumb d-none d-sm-flex align-items-center "
                                        style="background:#fff">

                                        <div class="px-2">
                                            <select wire:model="selectedtitle"
                                                class="resizeselect filt1 form-control form-select"
                                                style="width:150px !important">
                                                <option value="">Payment Setting All</option>
                                                @foreach ($PaymentsettingAll as $Paymentset)
                                                <option value="{{ $Paymentset->id }}">
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
                                                <option value="success">Success</option>
                                                <option value="pending">Pending</option>
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
                                    <th class="sort" wire:click="columnSortOrder('paymentsetting_id')">Payment Setting
                                        {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('name')">Name {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('email')">Email
                                        {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('phone')">Phone
                                        {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('amount')">Amount
                                        {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('status')">Status
                                        {!! $sortLink !!}
                                    </th>
                                    <th class="sort" wire:click="columnSortOrder('created_at')">Date
                                        {!! $sortLink !!}
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                @if ($payments->count())
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->paymentsetting->title }} </td>
                                    <td>{{ $payment->name }} </td>
                                    <td>{{ $payment->email }} </td>
                                    <td>{{ $payment->phone }} </td>
                                    <td>{{ $payment->amount }} </td>
                                    <td>
                                        @if($payment->transaction_status == 1)
                                        <span class="badge bg-gradient-quepal text-white shadow-sm w-100">success</span>
                                         
                                        @elseif($payment->transaction_status == 0)
                                        <span class="badge bg-gradient-bloody text-white shadow-sm w-100">failed</span>
                                         
                                        @else
                                        // handle other cases if needed
                                        @endif
                                    </td>

                                    <td>{{ date("d-m-Y", strtotime($payment->created_at)) }} </td>
                                    <td>
                                        <a style="font-size: 8px;padding-left: 5px; padding-right: 0px;"
                                            href="{{ route('admin.paymentsettings.paymentpreview',$payment->id) }}"
                                            wire:navigate class="btn btn-secondary" class="btn btn-secondary"
                                            title="View {{ $heading }}"><i class="fa fa-eye"></i></a>
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
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>