@extends('Admin.AdminPage')
@section ('title','Thống kê')
@section ('sidebar')
@parent

@endsection
@section('admin-content')
<style>
    .col-sm-3 {
        max-width: 100% !important;
        margin-bottom: 20px !important;
        :
    }

    .btn-export--excel:hover {
        index: 100;
        color: #4CCEE8;
    }

    .btn-export--excel:active {
        index: 100;
        color: #fff;
    }

    .dashed-loading {
        position: relative;
        height: 50px;
    }

    .dashed-loading:after,
    .dashed-loading:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 50%;
        width: 30px;
        height: 30px;
    }

    .dashed-loading:before {
        z-index: 5;
        border: 3px dashed #fff;
        border-left: 3px solid transparent;
        border-bottom: 3px solid transparent;
        -webkit-animation: dashed 1s linear infinite;
        animation: dashed 1s linear infinite;
    }

    .dashed-loading:after {
        z-index: 10;
        border: 3px solid #fff;
        border-left: 3px solid transparent;
        border-bottom: 3px solid transparent;
        -webkit-animation: dashed 1s ease infinite;
        animation: dashed 1s ease infinite;
    }

    @keyframes dashed {
        to {
            transform: rotate(360deg);
        }
    }

    .loading {
        display: flex;

    }

    #statusFind {
        margin-left: 40px;
        margin-top: 10px;
    }
</style>

<div class="user-control">
    <nav class="nav-admin">
        <div class="admin-nav">
            <div class="admin-nav--item grid-item--left">
                <div class="content-item-left">
                    <i class="far fa-list-alt "></i>
                    <div class="text-header"> THỐNG KÊ DOANH THU</div>
                </div>
            </div>

            <div class="admin-nav--item grid-item--right">
                <div class="content-item-right btn-export--excel" id="download-data" title="Tải tài liệu xuống" data-toggle="tooltip">
                    <a><i class="fas fa-download "></i></a>
                </div>
            </div>
        </div>
    </nav>


    <div class="content-usercontrol">
        <div class="display-grid">
            <div class="uc-content grid-left">
                <div class="header-option">
                    Tiêu chí thống kê
                </div>

                <div class="checkbox-option">
                    <input type="checkbox" id="date" name="date" class="switch-input" />
                    <label for="date" class="switch"></label>
                    <label for="date" class="text-checkbox"></label>Theo ngày</label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" id="month" name="date" class="switch-input" />
                    <label for="month" class="switch"></label>
                    <label for="month" class="text-checkbox"></label>Theo tháng</label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" id="quarter" name="date" class="switch-input" />
                    <label for="quarter" class="switch"></label>
                    <label for="quarter" class="text-checkbox"></label>Theo quý</label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" id="year" name="date" class="switch-input" />
                    <label for="year" class="switch"></label>
                    <label for="year" class="text-checkbox"></label>Theo năm</label>
                </div>

                <div class="my-datepicker chose-date col-sm-3" id="input-day" hidden="true">
                    <input id="datepicker" name="day" class="my-background" />

                </div>
                <div class="chose-month" id="input-month" hidden="true">

                    <div class="col-sm-3">
                        <select class="form-control my-background" id="selectMonth">
                            <option selected>Chọn tháng</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>

                    <div class="col-sm-3">
                        <input type="number" name="m-year" class="form-control my-background" id="enterYearOfMonth" placeholder="Nhập năm" min="1900">
                    </div>

                </div>

                <div class="chose-quarter" id="input-quarter" hidden="true">
                    <div class="col-sm-3">
                        <select class="form-control my-background" id="selectQuarter">
                            <option selected>Chọn quý</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="number" name="q-year" class="form-control my-background" id="enterYearOfQuarter" placeholder="Nhập năm" min="1900">
                    </div>
                </div>

                <div class="chose-year" id="input-year" hidden="true">
                    <div class="col-sm-3">
                        <input type="number" name="y-year" class="form-control my-background" id="enterYearOfYear" placeholder="Nhập năm" min="1900">
                    </div>
                </div>
                <div class="btn-statisic">
                    <button class="btn btn-secondary my-background" href="#" role="button" id="tk">Thống kê</button>
                </div>
            </div>

            <div class="grid-right">
                <table class="table table-image table-dark table-hover" id="data">
                    <thead>
                        <tr>
                            <th scope="col" class="font-weight-bold">Mã đơn hàng</th>
                            <th scope="col" class="font-weight-bold">Email khách hàng</th>
                            <th scope="col" class="font-weight-bold">Địa chỉ</th>
                            <th scope="col" class="font-weight-bold">Tổng tiền</th>
                            <th scope="col" class="font-weight-bold">Ngày đặt</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="loading">
                    <div class="dashed-loading" id="loadingAnimate" hidden="true"></div>
                    <div id="statusFind" hidden="true"></div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- you need to include the shieldui css and js assets in order for the components to work -->

<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>

<script>
    $(document).ready(function() {
        let id;
        let checked;
        $("input:checkbox").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {
                // the name of the box is retrieved using the .attr() method
                // as it is assumed and expected to be immutable
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                // the checked state of the group/box on the other hand will change
                // and the current value is retrieved using .prop() method
                $(group).prop("checked", false);
                $box.prop("checked", true);
                id = $box.attr("id");
                //show ra các input dựa theo id
                show(id);
                checked = true;
            } else {
                $box.prop("checked", false);
                Hidden();
                checked = false;
            }
        })
        $('#tk').click(function() {

            let url;
            let day;
            let month;
            let year;
            let quarter;
            if (checked) {
                showElement("statusFind");
                HiddenNumberPagegin();
                $("#statusFind").css({
                    marginLeft: "40px",
                    marginTop: "10px"
                })
                showElement("loadingAnimate");
                $("#statusFind").html("<span>" + "Đang tải dữ liệu..." + "</span>");
                if (id == "date") {
                    day = $("input[name='day']").val();
                    url = "{{ route('ajax.revenueDay') }}";
                } else if (id == "month") {
                    month = $("#selectMonth").val();
                    year = $("input[name='m-year']").val();
                    url = "{{ route('ajax.revenueMonth') }}";
                } else if (id == "quarter") {
                    quarter = $("#selectQuarter").val();
                    year = $("input[name='q-year']").val();
                    url = "{{ route('ajax.revenueQuarter') }}";
                } else if (id == "year") {
                    year = $("input[name='y-year']").val();
                    url = "{{ route('ajax.revenueYear') }}";
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        day: day,
                        month: month,
                        year: year,
                        quarter: quarter
                    },
                    success: function(response) {
                        $("tbody").empty();
                        $("#nav").empty();
                        $("#loadingAnimate").empty();
                        response.statistics.forEach(item => {
                            $("tbody").append("<tr><td>" +
                                item.id_purchase + "</td><td>" + item.email +
                                "</td><td>" +
                                item.address + "</td><td>" + item.total +
                                "</td><td>" +
                                item.created_at + "</td></tr>");
                        });
                        $("#statusFind").html("<span>" + "Có " + response.total_purchase +
                            " đơn hàng được tìm thấy!" + "</span>");
                        hiddenElement("loadingAnimate");
                        $("#statusFind").css('margin', 0);
                        showElement("statusFind");

                        //phân trang
                        $('#data').after(
                            '<nav id="pageginNum" aria-label="Page navigation example pagination-secondary" style="margin: 0 auto"><ul id="nav" class="pagination"></ul></div>'
                        );
                        var rowsShown = 4;
                        var rowsTotal = $('#data tbody tr').length;
                        var numPages = rowsTotal / rowsShown;
                        if (numPages > 1) {

                            for (i = 0; i < numPages; i++) {
                                var pageNum = i + 1;
                                $('#nav').append(
                                    '<li class="page-item"><a class="page-link" rel="' +
                                    i + '">' + pageNum + '</a></li> ');
                            }
                            $('#data tbody tr').hide();
                            $('#data tbody tr').slice(0, rowsShown).show();
                            $('#nav a:first').addClass('active');
                            $('#nav a').bind('click', function() {
                                $('#nav a').removeClass('active');
                                $(this).addClass('active');
                                var currPage = $(this).attr('rel');
                                var startItem = currPage * rowsShown;
                                var endItem = startItem + rowsShown;
                                $('#data tbody tr').css('opacity', '0.0').hide().slice(
                                    startItem, endItem).
                                css('display', 'table-row').animate({
                                    opacity: 1
                                }, 300);
                            });
                        }
                        //phân trang

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        showElement("statusFind");
                        hiddenElement("loadingAnimate");
                        $("#statusFind").css('margin', 0);
                        $("#statusFind").html("Lỗi...");
                    }
                });
            }
        });
    });

    function show(id) {
        if (id == "date") {
            Hidden();
            document.getElementById("input-day").hidden = false;
        } else if (id == "month") {
            Hidden();
            document.getElementById("input-month").hidden = false;
        } else if (id == "quarter") {
            Hidden();
            document.getElementById("input-quarter").hidden = false;
        } else if (id == "year") {
            Hidden();
            document.getElementById("input-year").hidden = false;
        }
    }

    function showElement(id) {
        document.getElementById(id).hidden = false;
    }

    function hiddenElement(id) {
        document.getElementById(id).hidden = true;
    }

    function HiddenNumberPagegin() {
        var CheckElement = document.getElementById("pageginNum");
        if (CheckElement) {
            document.getElementById("pageginNum").hidden = true;
        }

    }

    function Hidden() {
        document.getElementById("input-day").hidden = true;
        document.getElementById("input-month").hidden = true;
        document.getElementById("input-quarter").hidden = true;
        document.getElementById("input-year").hidden = true;
    }
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4'
    });

    jQuery(function($) {
        $("#download-data").click(function() {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#data",
                schema: {
                    type: "table",
                    fields: {
                        "Mã đơn hàng": {
                            type: Number
                        },
                        "Email khách hàng": {
                            type: String
                        },
                        "Địa chỉ": {
                            type: String
                        },
                        "Tổng tiền": {
                            type: Number
                        },
                        "Ngày đặt": {
                            type: Date
                        }
                    }
                }
            });
            console.log(dataSource);
            // when parsing is done, export the data to Excel
            dataSource.read().then(function(data) {
                var currentTime = new Date();
                var day = currentTime.getDate();
                var month = currentTime.getMonth() + 1;
                var year = currentTime.getFullYear();
                var name = year + '_' + month + '_' + day;
                if (day < 10) {
                    day = "0" + day;
                }

                if (month < 10) {
                    month = "0" + month;
                }
                new shield.exp.OOXMLWorkbook({
                    author: "PrepBootstrap",
                    worksheets: [{
                        name: "PrepBootstrap Table",
                        rows: [{
                            cells: [{
                                    style: {
                                        bold: true
                                    },
                                    type: String,
                                    value: "Mã đơn hàng"
                                },
                                {
                                    style: {
                                        bold: true
                                    },
                                    type: String,
                                    value: "Email khách hàng"
                                },
                                {
                                    style: {
                                        bold: true
                                    },
                                    type: String,
                                    value: "Địa chỉ"
                                },
                                {
                                    style: {
                                        bold: true
                                    },
                                    type: String,
                                    value: "Tổng tiền"
                                },
                                {
                                    style: {
                                        bold: true
                                    },
                                    type: String,
                                    value: "Ngày đặt"
                                }

                            ]
                        }].concat($.map(data, function(item) {
                            return {
                                cells: [{
                                        type: Number,
                                        value: item[
                                            "Mã đơn hàng"]
                                    },
                                    {
                                        type: Number,
                                        value: item[
                                            "Email khách hàng"
                                        ]
                                    },
                                    {
                                        type: String,
                                        value: item["Địa chỉ"]
                                    },
                                    {
                                        type: Number,
                                        value: item["Tổng tiền"]
                                    },
                                    {
                                        type: Date,
                                        value: item["Ngày đặt"]
                                    },
                                ]
                            };
                        }))
                    }]
                }).saveAs({

                    fileName: name
                });
            });
        });
    });
</script>

</div>

@endsection
