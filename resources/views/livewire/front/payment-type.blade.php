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
                  <h4 class="px-3 border-bottom py-3 mb-0 bg-dark text-white">{{$paymentsetting->title}} Edit</h4>
               </div>
               <div class="card-body">
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

                                                   <livewire:is :component="'front.common.' . $d->inputType->tag_name"
                                                      livewire:common. :in_data="$d" wire:key="{{$item->id}}"
                                                      wire:model="formdata.{{$item->id}}" />
                                                @endif
                                             @endforeach
                                          @endforeach

                                          <div class="col-md-12 mt-3" id="amountChangelable">

                                             <div class="form-group">
                                                <label class="form-label">Amount</label>
                                                <div class="input-group mb-3">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text" id="basic-addon1">
                                                         @if ($geolocation == 'IN')
                                                         INR
                                                         @else
                                                         $
                                                         @endif
                                                      </span>
                                                   </div>
                                                   <input type="number" class="form-control" id="amount"
                                                      wire:model="amount" value="0" required autocomplete="off">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12">
                                             <button type="submit" class="btn btn-dark btn-block w-100">
                                                Update
                                                <i wire:loading wire:target="submitForm"
                                                   class="st_loader spinner-border spinner-border-sm"></i>
                                             </button>
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