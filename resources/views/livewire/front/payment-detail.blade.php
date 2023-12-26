<div>
    <div>


        <div class="text-center py-4  bg-dark border-bottom">
            <div class="container">
                <?php
                
                // use Illuminate\Support\Facades\Auth;
                // $logo_file_logo = App\Models\Admin::where('id',1)->first();
                // $logo_data_logo = App\Models\UploadImage::where('id',$logo_file_logo->file_id)->first();
                // if($logo_data_logo){
                ?>
                {{-- <div class='logo'>
                <img src="{{ asset('') . $logo_data_logo['file'] }}" class="img-fluid" style="height:30px">
            </div> --}}
                <?php
                // }else{
                ?>
                <div class='logo'>
                    <img src="{{ asset('assets/images/payanyfee_logo.png') }}" class="img-fluid" style="height:30px">
                </div>
                <?php
                // }
                //  $logo_file_id = App\Models\SiteSettings::where('meta_key','logo_file_id')->first();
                
                //  $logo_data = App\Models\UploadImage::where('id',$logo_file_id->meta_value)->first();
                //  echo "<pre>";print_r($logo_data);die;
                //  if ($logo_data) {
                ?>
                <!--<div class="brand_logo">-->
                <!--<img src="assets/images/md_profile.jpg" class="img-fluid"  style="height:30px">-->
                <!--</div>-->
                <?php
                // }
                ?>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-150 align-items-center middle_part">
                <div class="col-md-10">
                    <div class="card">
                        <div class="feeheading">
                            <h4 class="px-3 border-bottom py-3 mb-0 bg-dark text-white">{{ $paymentsetting->title }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <form class="form-signin form" id="myform" wire:submit="selectpayment" 
                                method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="paymentType" value="{{ $paymentsetting->id }}">
                                <input type="hidden" name="paymentsetting" value="{{ $paymentsetting->title }}">

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-body" id="feepay">
                                                <div class="pb-3 rounded">
                                                    <div class="p-2">
                                                        <div class="row align-items-center">
                                                            @foreach ($paymentMetas as $paymentMeta)
                                                                <div class="col-md-6 my-2">
                                                                    <div class="common_section">
                                                                        <div class="form-group">
                                                                            <label for=""
                                                                                class="mb-2">{{ $paymentMeta['meta_key'] }}</label>
                                                                            @php
                                                                                $metaType = $paymentMeta['metaType'];
                                                                            @endphp
                                                                            @if ($metaType == 'input')
                                                                                <input type="text"
                                                                                    class="form-control" id=""
                                                                                    placeholder="">
                                                                            @elseif($metaType == 'number')
                                                                                <input type="number"
                                                                                    class="form-control" id=""
                                                                                    placeholder="">
                                                                            @elseif($metaType == 'email')
                                                                                <input type="email"
                                                                                    class="form-control" id=""
                                                                                    placeholder="">
                                                                            @elseif($metaType == 'select')
                                                                                @php
                                                                                    $selectval = $paymentMeta['meta_value'];
                                                                                @endphp
                                                                                @isset($paymentMeta['meta_value'])
                                                                                    <select name="" id=""
                                                                                        class="form-select">
                                                                                        <option value="" selected>
                                                                                            --Select {{ $selectval }}--
                                                                                        </option>
                                                                                        @foreach ($$selectval as $item)
                                                                                            <option
                                                                                                value="{{ $item->name }}">
                                                                                                {{ $item->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                @endisset
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <div class="col-md-12" id="amountChangelable">
                                                                <?php echo 'This Form is ' . ucwords($paymentsetting->title) . '  Form.'; ?>
                                                                <div class="form-group">
                                                                    <label class="form-label">Amount</label>
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
                                                                            id="amount" name="amount" value="0"
                                                                            required autocomplete="off">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <button type="submit"
                                                                    class="btn btn-dark btn-block w-100">Submit<i
                                                                        class="st_loader spinner-border spinner-border-sm"
                                                                        style="display:none;"></i></button>
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
