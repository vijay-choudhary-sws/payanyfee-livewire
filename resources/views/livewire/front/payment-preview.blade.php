<div>
    <div class="text-center py-4  bg-dark border-bottom mb-3">
        <div class="container">
            <div class='logo'>
                <img src="{{ asset('assets/images/payanyfee_logo.png') }}" class="img-fluid" style="height:30px">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-150 align-items-center middle_part" style="text-align: left;">
            <div class="col-md-10">
                <div class="card">
                    <div class="feeheading">
                        <h4 class="px-3 border-bottom py-3 mb-0 bg-dark text-white">Payment Preview</h4>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-7">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Label</th>
                                            <th scope="col">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Name</td>
                                            <td>{{ $payments->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Email</td>
                                            <td>{{ $payments->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>phone</td>
                                            <td>{{ $payments->phone }}</td>
                                        </tr>

                                        @php
                                            $i = 4;
                                        @endphp
                                        @foreach ($input_data as $d)
                                            @foreach ($payments->paymentMeta as $item)
                                                @if ($d->id == $item->meta_name)
                                                    @if (count($item->paymentMetaMultiple) > 0)
                                                        <tr>
                                                            <th scope="row">{{ $i++ }}</th>
                                                            <td>{{ $d->label }}</td>
                                                            <td>
                                                                <ul class="list-unstyled">
                                                                    @foreach ($item->paymentMetaMultiple as $val)
                                                                        <li>{{ $val->meta_value }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <th scope="row">{{ $i++ }}</th>
                                                            <td>{{ $d->label }}</td>
                                                            <td>{{ $item->meta_value }}</td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                        <tr>
                                            <th></th>
                                            <td>Amount</td>
                                            <td>{{ $payments->amount }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-5">
                                @if (count($paymentGateways) > 0    )
                                <form class="form-signin form" id="paymethod" wire:submit="paynow" method="post">
                                    {{ csrf_field() }}

                                    @foreach ($paymentGateways as $paymentGateway)
                                        <div class="row pl-4">
                                            <div class="col-md-6 align-self-center">
                                                <input type="radio" wire:model="paymethod" id="paymethod-{{$paymentGateway->id}}"
                                                    value="{{$paymentGateway->id}}" class="form-control-check" >
                                                <label for="paymethod-{{$paymentGateway->id}}" class="form-check-label">{{$paymentGateway->name}}</label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="paymethod-{{$paymentGateway->id}}">
                                                    <img src="{{ asset($paymentGateway->photo) }}"
                                                        height="50" alt="cvv" class="img">
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    @error('paymethod') <span class="text-danger">{{ $message }}</span>@enderror
                                    <div class="row mt-5">
                                        <div class="col-md-4">
                                            
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">
                                                Pay Now
                                                <i wire:loading wire:target="submitForm"
                                                    class="st_loader spinner-border spinner-border-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @else
                                    Payment Gateways are not activated.<br>
                                    Please talk to administrator.
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 mx-5 my-3">
                            <button wire:click="edit" class="btn btn-primary mt-2 mt-lg-0 ">
                                Edit Form
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($showEditModal)
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="fixed inset-0 flex items-center justify-center z-50">
                        <div class="absolute inset-0 bg-black opacity-50"></div>
                        <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                            <h2 class="text-2xl font-bold mb-4">Edit Form</h2>
                            <div class="row">
                                <div class="col-12">
                                    <form class="form-signin form" id="myform" wire:submit="update" method="post">
                                        {{ csrf_field() }}

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-body" id="feepay">
                                                        <div class="pb-3 rounded">
                                                            <div class="p-2">
                                                                <div class="row align-items-center">
                                                                    @foreach ($input_data as $d)
                                                                        @foreach ($payments->paymentMeta as $item)
                                                                            @if ($d->id == $item->meta_name)
                                                                                <livewire:is :component="'front.common.' .
                                                                                    $d->inputType->tag_name"
                                                                                    livewire:common. :in_data="$d"
                                                                                    wire:key="{{ $item->id }}"
                                                                                    wire:model="formdata.{{ $item->id }}" />
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach

                                                                    <div class="col-md-12 mt-3" id="amountChangelable">

                                                                        <div class="form-group ">
                                                                            <label
                                                                                class="form-label float-left">Amount</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1">
                                                                                        @if ($geolocation == 'IN')
                                                                                            INR
                                                                                        @else
                                                                                            $
                                                                                        @endif
                                                                                    </span>
                                                                                </div>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    id="amount" wire:model="amount"
                                                                                    value="0" required
                                                                                    autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="flex justify-end">
                                                                            <button wire:click="update" type="submit"
                                                                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Update
                                                                                <i wire:loading
                                                                                    wire:target="submitForm"
                                                                                    class="st_loader spinner-border spinner-border-sm"></i></button>
                                                                            <button type="button"
                                                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                                                                wire:click="close">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
