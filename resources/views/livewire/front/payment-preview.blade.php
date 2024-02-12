<div>
    <div class="text-center py-4  bg-dark border-bottom mb-3">
        <div class="container">
            <div class='logo'>
                <a href="{{ route('front.payment-view') }}">
                    <img src="{{ asset('assets/images/payanyfee_logo.png') }}" class="img-fluid" style="height:30px">
                </a>
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
                                        {{-- @php
                                        echo"
                                        <pre>";print_r($item->toArray());die;
                                            @endphp --}}
                                                @if ($d->id == $item->meta_name)
                                              
                                                {{-- @if($d->is_multiple_required == 1){
                                                    {{'dg'}}
                                                } --}}
                                             
                                                    @if (count($item->paymentMetaMultiple) > 0)
                                                     @if($d->is_multiple_required == 1)
                                                     <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $d->label }}</td>
                                                        <td>
                                                           {{$item->freeho->title}}
                                                        </td>
                                                    </tr>
                                                     @else

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
                                                        @endif
                                                    @else
                                                        <tr>
                                                            <th scope="row">{{ $i++ }}</th>
                                                            <td>{{ $d->label }}</td>
                                                            <td>{{ $item->meta_value }}</td>
                                                        </tr>
                                                    @endif
                                                   
                                                @endif
                                                @if($d->is_multiple_required ==1)
                                                    @foreach ($item->paymentMetaMultiple as $key => $val)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $d->multioption[$key]->multioptionlabel }}</td>
                                                        <td>{{ $val->post->title ?? $val->meta_value}}</td>
                                                    </tr>
                                                    @endforeach
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
                                @if (count($paygetway) > 0)
                                    <form class="form-signin form" id="paymethod" wire:submit="paynow" method="post">
                                        {{ csrf_field() }}

                                        @foreach ($paygetway as $paymentGateway)
                                            @if ($paymentGateway->getway->status == 1)
                                                <div class="row pl-4">
                                                    <div class="col-md-6 align-self-center">
                                                        <input type="radio" wire:model="paymethod"
                                                            id="paymethod-{{ $paymentGateway->getway->id }}"
                                                            value="{{ $paymentGateway->getway->id }}"
                                                            class="form-control-check">
                                                        <label for="paymethod-{{ $paymentGateway->getway->id }}"
                                                            class="form-check-label">{{ $paymentGateway->getway->name }}</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="paymethod-{{ $paymentGateway->getway->id }}">
                                                            <img src="{{ asset($paymentGateway->getway->photo) }}"
                                                                height="50" alt="cvv" class="img">
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @error('paymethod')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                    {{-- <form class="form-signin form" id="myform" wire:submit="update" method="post">
                                        {{ csrf_field() }} --}}

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-body" id="feepay">
                                                    <div class="pb-3 rounded">
                                                        <div class="p-2">
                                                            <div class="row align-items-center">
                                                                <div class="col-12">
                                                                    <label for="name"
                                                                        class="mb-2 float-left">Name</label>
                                                                    <input wire:model="name" type="text"
                                                                        class="form-control" id="name"
                                                                        value="{{ $name }}"
                                                                        placeholder="Enter your full name">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="email"
                                                                        class="mb-2 float-left">Email</label>
                                                                    <input wire:model="email" type="email"
                                                                        class="form-control" id="email"
                                                                        value="{{ $email }}"
                                                                        placeholder="Enter your email">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="phone"
                                                                        class="mb-2 float-left">phone</label>
                                                                    <input wire:model="phone" type="number"
                                                                        class="form-control" id="phone"
                                                                        value="{{ $phone }}"
                                                                        placeholder="Enter your number">
                                                                </div>
                                                                @foreach ($input_data as $d)
                                                              
                                                                    @foreach ($payments->paymentMeta as $item)
                                                                        @if ($d->id == $item->meta_name)
                                                                            <div class="col-6">
                                                                                @if ($d->input_select_data)
                                                                                    <livewire:is :component="'front.common.ExistingSelect'"
                                                                                        livewire:common.
                                                                                        :in_data="$d"
                                                                                        wire:key="{{ $item->id }}"
                                                                                        wire:model="formdata.{{ $item->id }}" />
                                                                                        @if ($d->is_multiple_required == 1)
                                                                                        @foreach ($mutiioption as $item)
                                                                                        
                                                                                       @foreach ($item->multioption as $key => $option)
                                                                                      
                                                                                       <div class="col-12 mb-2">
                                                                                           <label for="mul" class="block text-gray-700 font-bold mb-2">{{$option->multioptionlabel}}</label>
                                                                                     
                                                                                           <select class="form-control single-select" wire:model="muloptions.{{ $item->id }}.{{ $key }}" @if (!$loop->last)
                                                                                              wire:change="mi('{{ $item->id }}','{{ $key }}')"
                                                                                           @endif  >
                                                                                              <option value="" selected>--select--</option>
                                                                                              @if (isset($muloptionss[$key]))
                                                                                                   @foreach ($muloptionss[$key] as $mulOption)
                                                                                                       <option value="{{ $mulOption->id  }}">{{ $mulOption->title  }}</option>
                                                                                                   @endforeach
                                                                                              @endif
                                                                                               </select>
                                                                                               @error('muloptions.' . $key)
                                                                                                   <span class="text-danger">{{ $message }}</span>
                                                                                               @enderror
                                                                                       </div>
                                                                                       
                                                                                   @endforeach
                                                                                        @endforeach
                                                                                        @endif
                                                                                @else
                                                                                    <livewire:is :component="'front.common.' .
                                                                                        $d->inputType->tag_name"
                                                                                        livewire:common.
                                                                                        :in_data="$d"
                                                                                        wire:key="{{ $item->id }}"
                                                                                        wire:model="formdata.{{ $item->id }}" />
                                                                                @endif
                                                                            </div>
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
                                                                            <input type="number" class="form-control"
                                                                                id="amount" wire:model="amount"
                                                                                value="0" required
                                                                                autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="flex justify-end">
                                                                            <button wire:click="update"
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
                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @endif
</div>