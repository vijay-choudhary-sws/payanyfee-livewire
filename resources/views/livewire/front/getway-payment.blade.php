<div>
    <div>
        <div class="text-center py-4  bg-dark border-bottom">
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
                        <div class="card-header">
                            <ul>
                                <li>Payment Getway : {{$payment->paymentGetway->name}}</li>
                                <li>Payment Mode : {{$payment->paymentMode->name}}</li>
                            </ul>
                                
                        </div>
                        <div class="card-body">

                            @if ($pay)
                                Your payment of Rs.{{$payment->total_amount}} has been completed successfully.
                            @else
                            Rs.{{$payment->total_amount}} <button type="button" wire:click="payamount" class="btn bg-green-500 text-white">PAY</button>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{route('front.payment-view')}}" wire:navigate>Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
