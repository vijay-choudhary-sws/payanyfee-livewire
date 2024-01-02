<div>
  <div class="container">
    <div class="row justify-content-center mt-150">
      <div class="col-md-6">
        <div class="card">
          <h5 class="text-center m-4"> Fee Checkout </h5>
          <h6 class="text-center mb-1"><small><b style="color: #0500ec;">International Credit Cards are not accepted for
                INR Payments. If you have an International card please choose $ payment option to make the
                payment.</b></small></h6>
          <form role="form" id="" class="p-3" method="post" action="{{url('payment/paymentfee_paytm')}}">
            {{ csrf_field() }}

           
            <table class="display table table-bordered table-striped" id="managefeemastertbl">
              <thead>
                <tr>
                  <th>Payment Mode</th>
                  <th class="text-center">Amount</th>
                  <th class="text-center">Bank charges</th>
                  <th class="text-center">You Pay</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <label for="debit_card" class="inline-label"><input checked type="radio" name="radio_demo"
                        onchange="reset_button()" id="debit_card" value="debit_card" class="payment_option"
                        data-md-icheck />
                      Debit Card</label>
                  </td>
                  <td class="text-end">400</td>
                  <td class="text-end">40</td>
                  <td class="text-end">413</td>
                </tr>
                <tr>
                  <td>
                    <label for="credit_card" class="inline-label"><input type="radio" name="radio_demo"
                        onchange="reset_button()" id="credit_card" value="credit_card" class="payment_option"
                        data-md-icheck />
                      Credit Card</label>
                  </td>
                 
                  <td class="text-end">788</td>
                  <td class="text-end">55</td>
                  <td class="text-end">574</td>
                </tr>
                {{-- <tr>
                  <td>
                    <label for="netbanking" class="inline-label"><input type="radio" onchange="reset_button()"
                        name="radio_demo" id="netbanking" value="netbanking" class="payment_option" data-md-icheck />
                      Net Banking</label>
                  </td>
                 
                  <td class="text-end">{{$tot_amount}}</td>
                  <td class="text-end">{{$netbanking}}</td>
                  <td class="text-end">{{number_format((float)$tot_amount+$netbanking, 2, '.', '')}}</td>
                </tr>
                <tr>
                  <td>
                    <label for="upi" class="inline-label"><input type="radio" name="radio_demo" id="upi" value="upi"
                        class="payment_option" data-md-icheck />
                      UPI</label>
                  </td>

                  <td class="text-end">{{$tot_amount}}</td>
                  <td class="text-end">{{$upi}}</td>
                  <td class="text-end">{{number_format((float)$tot_amount+$upi, 2, '.', '')}}</td>
                </tr>
                <tr>
                  <td>
                    <label for="wallet" class="inline-label"><input type="radio" onchange="reset_button()"
                        name="radio_demo" id="wallet" value="wallet" class="payment_option" data-md-icheck />
                      Wallet</label>
                  </td>

                  <td class="text-end">{{$tot_amount}}</td>
                  <td class="text-end">{{$wallet}}</td>
                  <td class="text-end"> {{number_format((float)$tot_amount+$wallet, 2, '.', '')}}</td>
                </tr>

                <tr>
                  <td>
                    <label for="emi_option" class="inline-label"><input type="radio" name="radio_demo" id="emi_option"
                        onchange="set_button()" class="payment_option" data-md-icheck />
                      EMI</label>
                  </td>

                  <td class="text-end">{{$tot_amount}}</td>
                  <td class="text-end">{{$credit}}</td>
                  <td class="text-end">{{number_format((float)$tot_amount+$credit, 2, '.', '')}}</td>
                </tr>

                <tr style="display:none;">
                  <td>
                    <label for="emi" class="inline-label"><input type="radio" name="radio_demo" id="emi" value="emi"
                        class="payment_option" data-md-icheck />
                      EMI</label>
                  </td>

                  <td class="text-end">{{$emi_total}}</td>
                  <td class="text-end">{{$emi}}</td>
                  <td class="text-end">{{number_format((float)$emi_total+$emi, 2, '.', '')}}</td>
                </tr>

                <tr>
                  <td>
                    <label for="incredit_card" class="inline-label"><input type="radio" name="radio_demo"
                        id="incredit_card" onchange="reset_button()" value="incredit_card" class="payment_option"
                        data-md-icheck />
                      International Payment</label>
                  </td>

                  <td>{{'$tot_amount'}}</td>
                  <td>{{'$incredit'}}</td>
                  <td>{{'number_format((float)$tot_amount+$incredit, 2, '.', '')'}}</td>
                </tr> --}}

              </tbody>
            </table>
            
            <div class="uk-width-medium-1-1" style="text-align: right;">

              <a href="#" style="margin-right: 10px;" wire:click="cancle" class="btn btn-default cancelpayment">Cancel </a>

              <input type="submit" class="btn btn-success" id="pay_now" value="PAY NOW">
             

            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  {{-- <div class="modal" id="emiModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <h5 class="text-center mb-3"><small><b style="color: #ff0000;">Note: </b><b style="color: #0500ec;">We are
                offering an upfront discount on your fee to balance out the interest rate charged by the
                bank.</b></small></h5>
          <table class="display table table-bordered table-striped" id="managefeemastertbl">
            <thead>
              <tr>
                <th>Payment Mode</th>
                <th class="text-center">Fee Amount (@if($geolocation=='IN'){{'INR'}}@else{{'$'}} @endif)</th>
                <th class="text-center">Discount (@if($geolocation=='IN'){{'INR'}}@else{{'$'}} @endif)</th>
                <th class="text-center">Amount (@if($geolocation=='IN'){{'INR'}}@else{{'$'}} @endif)</th>
                <th class="text-center">Bank charges (@if($geolocation=='IN'){{'INR'}}@else{{'$'}} @endif)</th>
                <th class="text-center">You Pay (@if($geolocation=='IN'){{'INR'}}@else{{'$'}} @endif)</th>
              </tr>
            </thead>
            <tbody>
              @if($geolocation=='IN')


              <tr>
                <td>
                  <label for="emi" class="inline-label">EMI</label>
                </td>

                <td class="text-end">{{$tot_amount}}</td>
                <td class="text-end">13%</td>
                <td class="text-end">{{$emi_total}}</td>
                <td class="text-end">{{$emi}}</td>
                <td class="text-end">{{number_format((float)$emi_total+$emi, 2, '.', '')}}</td>
              </tr>

              @endif
            </tbody>
          </table>
        </div>

       
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger float-start" onclick="claseModal()">Close</button>
          <button type="button" class="btn btn-success" onclick="confirmEmi()">Confirm</button>

        </div>

      </div>
    </div>
  </div> --}}
</div>