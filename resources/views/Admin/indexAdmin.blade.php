@extends('Admin.AdminPage')
@section ('title','Trang chủ Admin')
@section ('sidebar')
@parent

@endsection
@section('admin-content')

    <style>
        .small-box {
            border-radius: 5px !important;
        }
        .small-box .inner {
            padding: 10px;
        }
        .small-box-footer {
            background-color: rgba(0, 0, 0, .1);
            color: rgba(255, 255, 255, .8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
            transition: .5s;
        }
        .small-box-footer:hover {
            color: black !important;
        }
        .fa-arrow-circle-right {
            margin-left: 5px;
        }
        .admin-icon {
            font-size: 50px;
            position: absolute;
            right: 27px;
            top: 20px;
            color: rgba(0, 0, 0, .15);
            transition: .75s ease;
        }
        .small-box:hover>.admin-icon {
            font-size: 60px;
        }
        .inner p {
            z-index: 100;
        }
    </style>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <div class="user-control">
        {{-- <h1 class="my-font">welcom to admin page</h1> --}}
        <div class="my-form">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box my-box bg-info">
                        <div class="inner">
                            <h3>{{ $countPurchase }}</h3>

                            <p>Đơn hàng</p>
                        </div>
                        <div class="admin-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <a href="{{ URL::to('/view-purchase') }}" class="small-box-footer">Xem chi tiết<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box my-box bg-success">
                        <div class="inner">
                            <h3>{{ $countCategory }}</h3>

                            <p>Loại mặt hàng</p>
                        </div>
                        <div class="admin-icon">
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <a href="{{ URL::to('/view-product') }}" class="small-box-footer">Xem chi tiết<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box my-box bg-warning">
                        <div class="inner">
                            <h3>{{ $countUser }}</h3>

                            <p>Người dùng</p>
                        </div>
                        <div class="admin-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="{{ URL::to('/view-customer') }}" class="small-box-footer">Xem chi tiết<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box my-box bg-danger">
                        <div class="inner">
                            <h3>{{ $countProduct }}</h3>

                            <p>Sản phẩm</p>
                        </div>
                        <div class="admin-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="{{ URL::to('/view-product') }}" class="small-box-footer">Xem chi tiết<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>

        <div id="myfirstchart" style="height: 250px; margin-top: 50px;"></div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            load_data();
        });
        function load_data() {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $.ajax({
                method: 'POST',
                url: "{{ url('/thongke') }}",
                data: {"_token": "{{ csrf_token() }}"},
                success: function(data) {
                    _data = JSON.parse(data);
                    console.log(_data);
                    chart.setData(_data);
                }
            });
        }
        let chart = new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            // data: [{
            //         year: '2008',
            //         value: 20
            //     },
            //     {
            //         year: '2009',
            //         value: 10
            //     },
            //     {
            //         year: '2010',
            //         value: 15
            //     },
            //     {
            //         year: '2011',
            //         value: 5
            //     },
            //     {
            //         year: '2012',
            //         value: 20
            //     }
            // ],
            // The name of the data record attribute that contains x-values.
            xkey: 'day',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value'],
            xLabelFormat: function(d) {
                    return d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear();
                    },

        });
    </script>
@endsection
