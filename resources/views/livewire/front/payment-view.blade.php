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
        <div class="row justify-content-center mt-150 align-items-center middle_part" style="text-align: left;">
            <div class="col-md-10">
                <div class="card">
                    <div class="feeheading">
                        <h4 class="px-3 border-bottom py-3 mb-0 bg-dark text-white">Payments</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-signin form" id="myform" action="{{ url('payment/selectpayment') }}"
                        method="post">
                        {{ csrf_field() }}

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body" id="feepay">
                                        <div class="pb-3 rounded">

                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    @foreach ($payments as $payment)
                                                        <?php
                                                        $str_small = strtolower($payment->title);
                                                        ?>
                                                        <div class="col-md-6 my-2">
                                                            <div class="common_section shadow border">
                                                                <table class="table mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="border-0 align-middle">{{ ucwords($str_small) }}</td>
                                                                            <td class="text-end border-0 align-middle">
                                                                                <a href="{{ url('/payment') . '/paymentdetail/' . $payment->slug }}" class="btn btn-dark btn-sm py-1" wire:navigate.hover>Start Now</a>
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    @endforeach
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
