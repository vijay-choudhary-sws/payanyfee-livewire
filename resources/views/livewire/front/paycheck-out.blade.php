<div>
    <div class="container">
        <div class="row justify-content-center mt-150">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="text-center m-4"> Fee Checkout </h5>
                    <h6 class="text-center mb-1"><small><b style="color: #0500ec;">International Credit Cards are not
                                accepted for
                                INR Payments. If you have an International card please choose $ payment option to make
                                the
                                payment.</b></small></h6>
                    <form id="" class="p-3" method="post" wire:submit="paynow">
                        {{ csrf_field() }}
                        <table class="display table table-bordered table-striped" id="managefeemastertbl">
                            <thead>
                                <tr>
                                    <th class="text-start">Payment Mode</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Bank charges</th>
                                    <th class="text-center">You Pay</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentMode as $mode)
                                    <tr>
                                        <td class="text-start">
                                            <label for="paymode-{{ $mode->id }}" class="inline-label">
                                                <input type="radio" name="radio_demo" wire:model="paymode"
                                                    id="paymode-{{ $mode->id }}" value="{{ $mode->id }}"
                                                    class="payment_option" />
                                                {{ $mode->paymentMode->name }}</label>
                                        </td>
                                        <td class="text-end">{{ $payment->amount }}</td>
                                        <td class="text-end">{{ $mode->amount }} {{$mode->is_percent ? '%' : ''}}</td>
                                        <td class="text-end">
                                            @if ($mode->is_percent)
                                                {{ $payment->amount + ($payment->amount * $mode->amount) / 100 }}
                                            @else
                                                {{ $payment->amount + $mode->amount }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @error('paymode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="uk-width-medium-1-1" style="text-align: right;">
                            <a href="#" style="margin-right: 10px;" wire:click="cancle"
                                class="btn btn-default cancelpayment">Cancel </a>
                            <button type="submit" class="btn  bg-blue-500 text-white">PAY NOW</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
