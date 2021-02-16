@php
    $invo=\App\Models\InvoiceSale::take(6)->orderBy('id','desc')->get();
@endphp
<div class="row">
    <div class="col-sm-12 col-lg-8">
        <div class="card">
            <div class="card-body p-b-0">
                <h4 class="card-title">اخر الفواتير</h4>
                <div class="table-responsive">
                    <table class="table v-middle">
                        <thead>
                        <tr>
                            <th class="border-top-0">رقم الفاتورة</th>
                            <th class="border-top-0">سام العميل</th>
                            <th class="border-top-0">السعر الكلي</th>
                            <th class="border-top-0">اسم العميل</th>
                            <th class="border-top-0">التاريخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invo as $row)
                        <tr>
                            <td>
                            <td>{{$row->id}}</td>
                            <td>{{$row->client->name}}</td>

                            <td>{{$row->total_price}}</td>
                            <td>{{$row->created_at}}</td>
                        </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="card bg-light">
            <div class="card-body">
                <h4 class="card-title">Temp Guide</h4>
                <div class="d-flex align-items-center flex-row m-t-30">
                    <div class="display-5 text-info">
                        <i class="wi wi-day-showers"></i>
                        <span>73
                                            <sup>°</sup>
                                        </span>
                    </div>
                    <div class="m-l-10">
                        <h3 class="m-b-0">Saturday</h3>
                        <small>Ahmedabad, India</small>
                    </div>
                </div>
                <table class="table no-border mini-table m-t-20">
                    <tbody>
                    <tr>
                        <td class="text-muted">Wind</td>
                        <td class="font-medium">ESE 17 mph</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Humidity</td>
                        <td class="font-medium">83%</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pressure</td>
                        <td class="font-medium">28.56 in</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Cloud Cover</td>
                        <td class="font-medium">78%</td>
                    </tr>
                    </tbody>
                </table>
                <ul class="row list-style-none text-center m-t-30">
                    <li class="col-3">
                        <h4 class="text-info">
                            <i class="wi wi-day-sunny"></i>
                        </h4>
                        <span class="d-block text-muted">09:30</span>
                        <h3 class="m-t-5">70
                            <sup>°</sup>
                        </h3>
                    </li>
                    <li class="col-3">
                        <h4 class="text-info">
                            <i class="wi wi-day-cloudy"></i>
                        </h4>
                        <span class="d-block text-muted">11:30</span>
                        <h3 class="m-t-5">72
                            <sup>°</sup>
                        </h3>
                    </li>
                    <li class="col-3">
                        <h4 class="text-info">
                            <i class="wi wi-day-hail"></i>
                        </h4>
                        <span class="d-block text-muted">13:30</span>
                        <h3 class="m-t-5">75
                            <sup>°</sup>
                        </h3>
                    </li>
                    <li class="col-3">
                        <h4 class="text-info">
                            <i class="wi wi-day-sprinkle"></i>
                        </h4>
                        <span class="d-block text-muted">15:30</span>
                        <h3 class="m-t-5">76
                            <sup>°</sup>
                        </h3>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
