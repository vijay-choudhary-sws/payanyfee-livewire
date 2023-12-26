<div class="d-flex flex-row bg-dedede" style="align-items:center;height:100vh !important;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="logo text-center">
                    <img src="{{asset('assets/images/payanyfee_logo.png')}}" class="img-fluid"
                        style="height:30px">
                </div>
                <span class="display-3 d-block fw-normal text-center">Welcome </span>
            </div>
        </div>
        <div class="mt-3 text-center">
            <a href="{{route('front.payment-view')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0" wire:navigate.hover >Payment
                View </a>

                {{-- <a style="font-size: 8px;padding-left: 5px; padding-right: 0px;" href="{{ route('admin.courses.courseedit', ['course' => $course]) }}"
                    wire:navigate class="btn btn-secondary"
                    title="Edit {{ $heading }}"><i class="bx bx-edit"></i></a> --}}
        </div>
    </div>
</div>
