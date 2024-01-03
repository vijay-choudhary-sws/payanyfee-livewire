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
                            <div class="ms-auto text-end col-3">
                                <div class="btn-group AddbtnPadding">
                                    <a wire:navigate href="{{ route('admin.paymentsettings.paymentList',0) }}"
                                        class="btn btn-primary mt-2 mt-lg-0 mb-">
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
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
                                <td>{{$payments->name}}</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Email</td>
                                <td>{{$payments->email}}</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>phone</td>
                                <td>{{$payments->phone}}</td>
                            </tr>

                            @php
                            $i = 4;
                            @endphp
                            @foreach ($input_data as $d)
                            @foreach ($payments->paymentMeta as $item)
                            @if ($d->id == $item->meta_name)
                            @if (count($item->paymentMetaMultiple) > 0)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$d->label}}</td>
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach ($item->paymentMetaMultiple as $val)
                                        <li>{{$val->meta_value}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$d->label}}</td>
                                <td>{{$item->meta_value}}</td>
                            </tr>
                            @endif

                            @endif
                            @endforeach
                            @endforeach
                            <tr>
                                <th></th>
                                <td>Amount</td>
                                <td>{{$payments->amount}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>