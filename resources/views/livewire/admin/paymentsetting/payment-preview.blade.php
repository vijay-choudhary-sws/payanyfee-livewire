<div>
    <div class="page-wrapper">
        <div class="page-content">
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
                            @php
                            $i = 1;
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