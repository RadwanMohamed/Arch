@extends('admin.layouts.app')

@section("content")
        <!-- Info boxes -->
        <div class="row" >
            <div class="col-md-3 col-sm-6 col-xs-12"style="margin-top: 20px">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">عدد انواع العقارات</span>
                        <span class="info-box-number">{{$types}}<small>انواع</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12"style="margin-top: 20px">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">عدد الرسائل</span>
                        <span class="info-box-number"> {{$messages}} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"style="margin-top: 20px"></div>

            <div class="col-md-3 col-sm-6 col-xs-12"style="margin-top: 20px">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">عدد العقارات </span>
                        <span class="info-box-number">{{count($buildings)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12"style="margin-top: 20px">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> عدد الاعضاء </span>
                        <span class="info-box-number">{{$users}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row" style="margin-top: -250px">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">تقرير عن نشاط العقارات فى الموقع  خلال شهر </h3>


                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <strong>
                                        العقارات  :
                                     1 يناير  {{date("Y")}}
-
                                        30 ديسمبر  {{date('Y')}}
                                    </strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->

                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->

            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">موقع جميع العقارات</h3>



                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                                <div class="pad">
                                    <!-- Map will be created here -->
                                    <div id="world-map-markers" style="height: 325px;"></div>
                                </div>
                            </div>

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-8">
                <!-- MAP & BOX PANE -->

                <!-- /.box -->
                <div class="row">

                    <!-- /.col -->

                    <div class="col-md-12">
                        <!-- USERS LIST -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title pull-left">Latest Members</h3>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <ul class="users-list clearfix">
                                    @foreach($latestusers as $user)
                                    <li>

                                        <a class="users-list-name" href="/admin-panel/users/{{$user->id}}/edit">{{$user->name}}</a>
                                        <span class="users-list-date">{{$user->created_at->diffForHumans()}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <a href="/admin-panel/users" class="uppercase">عرض جميع الاعضاء</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!--/.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">اخر العقارات المضافة</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>

                                <tr>
                                    <th>رقم العقار</th>
                                    <th>اسم العقار</th>
                                    <th>حالة العقار</th>
                                    <th>نوع العقار</th>
                                    <th>الملكية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($latestbuildings as $building)
                                <tr>
                                    <td><a href="/admin-panel/buildings/{{$building->id}}/edit">{{$building->id}}</a></td>
                                    <td>{{$building->name}}</td>
                                    <td><span class="label label-default">{{$building->status==1? 'متاح' :  'غيرمتاح' }}</span></td>
                                    <td><span class="label label-info">{{$building->type->name}}</span></td>
                                    <td><span class="label label-success">{{$building->property==0? 'ايجار '  :    ' تمليك  '}}</span></td>

                                </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="/admin-panel/buildings/create" class="btn btn-sm btn-info btn-flat pull-left">اضف عقار جديد</a>
                        <a href="/admin-panel/buildings" class="btn btn-sm btn-default btn-flat pull-right">عرض جميع العقارات</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <!-- Info Boxes Style 2 -->

                <!-- /.info-box -->
                <!-- /.info-box -->
                <!-- /.info-box -->
                <!-- /.info-box -->

                <!-- /.box -->

                <!-- PRODUCT LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">اخر الرسائل المرسلة</h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            @foreach($latestmessages as $mess)
                            <li class="item">

                                <div class="product-info">
                                    <a href="/admin-panel/contacts/{{$mess->id}}/show" class="product-title">{{$mess->subject}}
                                        <span class="label label-warning pull-right">{{$mess->view==0? 'جديدة' : 'قديمة'}}</span></a>
                                    <span class="product-description">
                         {{$mess->message}}
                        </span>
                                </div>
                            </li>
                                @endforeach

                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="/admin-panel/contacts" class="uppercase">عرض كل الرسائل</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
@endsection
@section('footer')
<script>
    $('#world-map-markers').vectorMap({
        map              : 'world_mill_en',
        normalizeFunction: 'polynomial',
        hoverOpacity     : 0.7,
        hoverColor       : false,
        backgroundColor  : 'transparent',
        regionStyle      : {
            initial      : {
                fill            : 'rgba(210, 214, 222, 1)',
                'fill-opacity'  : 1,
                stroke          : 'none',
                'stroke-width'  : 0,
                'stroke-opacity': 1
            },
            hover        : {
                'fill-opacity': 0.7,
                cursor        : 'pointer'
            },
            selected     : {
                fill: 'yellow'
            },
            selectedHover: {}
        },
        markerStyle      : {
            initial: {
                fill  : '#00a65a',
                stroke: '#111'
            }
        },
        markers          : [
            @foreach($buildings as $building)

            { latLng: [ {{$building->address->latitude}},{{$building->address->longitude}}], name: '{{$building->address->name}}' },

            @endforeach


        ]
    });
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
    // This will get the first returned node in the jQuery collection.
    var salesChart       = new Chart(salesChartCanvas);

    var salesChartData = {
        labels  : ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو','اغسطس','سبتمبر','اكتوبر','نوفمبر','ديسمبر'],
        datasets: [

            {
                label               : 'Digital Goods',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [
                    @foreach($buar as $month)
                    {{$month}},
                    @endforeach
                ]
            }
        ]
    };
</script>
@endsection
