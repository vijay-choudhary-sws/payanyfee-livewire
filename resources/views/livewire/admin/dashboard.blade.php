<div class="page-wrapper">
    <div class="page-content">
        <div class="row ">
            <div class="col-3">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Payment Total Amount</p>
                                <h4 class="my-1 text-danger " style="font-size: 16px;">{{$payment}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                    class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Payment today Total Amount</p>
                                <h4 class="my-1 text-success " style="font-size: 16px;">{{$todaysAmount}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                    class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <a href="{{ route('admin.paymentsettings') }}" wire:navigate>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Payment Setting</p>
                                    <h4 class="my-1 text-info " style="font-size: 16px;">{{ $paymentsetting }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                        class='bx bxs-bar-chart-alt-2'></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <a href="{{ route('admin.paymentgetways') }}" wire:navigate>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Payment GetWay</p>
                                    <h4 class="my-1 text-warning " style="font-size: 16px;">{{$paymentgetway}}</h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                                        class='bx bxs-bar-chart-alt-2'></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Payment Setting Today Amount</h6>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Today Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $loop = 0;
                            foreach ($paymentsettingcg as $item) {
                                // echo"<pre>";print_r($value->toArray());die;
                                $loop++
                       ?>


                            <tr>
                                <td>{{$loop}}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{$this->amountsum[$item->id]}}</td>
                            </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


        - <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Payment Get Way Today Total Amount</h6>
                    </div>
                </div>

            </div>
            <div class="card-body">
              
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Today Amount</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                     $loop = 0;
                            foreach($paymentgetways as $gateway){
 
                                    $loop++;

                               
                    ?>
                            <tr>
                                <td>{{ $loop }}</td>
                                <td>{{ $gateway->name }}</td>
                                <td>{{$amountgetsum[$gateway->id]}}</td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-6 col-lg-4 col-xl-4">
                <div class="card radius-10">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0" style="font-size: 18px">Payment Get Way</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                        <div>
                            <canvas id="getchart" width="50px" height="280px"></canvas>

                        </div>
                    </div>
                </div>

                <!--end row-->

            </div>
            <div class="col-6 col-lg-4 col-xl-4">
                <div class="card radius-10">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0" style="font-size: 18px">Payment Setting </h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                        <div>
                            <canvas id="chart" width="50px" height="280px"></canvas>

                        </div>
                    </div>
                </div>

                <!--end row-->

            </div>

        </div>


        <script>
          

            window.addEventListener('DOMContentLoaded', (event) => {
        renderChart("chart", @json($chartData));
        renderChart("getchart", @json($gaywaychartData));
    });

    window.addEventListener('renderChart', ({ detail }) => {
        renderChart(detail.chartId, detail.data);
    }, false);

    const renderChart = (chartId, chartData) => {
        const data = chartData.map(item => item.total_amount);
        let labels;

        if (chartId === "chart") {
            labels = chartData.map(item => item.paymentsetting.title);
        } else {
            labels = chartData.map(item => item.payment_getway.name);
        }

        const chart = new Chart(document.querySelector(`#${chartId}`), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#66ff66', '#9966ff'],
                }],
            },
        });
    }
        </script>