
@extends('admin.layouts.app')


@section('title')
    التحكم فى العقارات
@endsection



@section('header')
    <!-- DataTables -->
    {!! Html::style('admin/plugins/datatables/dataTables.bootstrap.css') !!}
@endsection



@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>
            <li><a href="{{url('admin-panel/buildings/create')}}"> اضافة عقار جديد </a></li>
            <li class="active"> جدول العقارات </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">عرض جميع العقارات </h3>
                    </div>

                    {{--'name', 'price', 'square', 'type', 'desc', 'meta', 'langtude', 'latitude', 'description', 'status', 'user_id'--}}

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th> رقم العقار </th>
                                <th> اسم العقار </th>
                                <th> السعر </th>
                                <th> المساحة </th>
                                <th> نوع الملكية </th>
                                <th> النوع </th>
                                <th> اسم المالك </th>
                                <th> الحالة </th>
                                <th> تاريخ الانشاء </th>
                                <th> اجراء تعديل </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($buildings as $building)
                            <tr>
                                <td>{{$building->id}}</td>
                                <td>{{$building->name}}</td>
                                <td>{{$building->price}}</td>
                                <td>{{$building->square}}</td>
                                <td>{{($building->property) ==0 ? ' ايجار '  : " ملك "}}</td>
                                <td>{{$building->type->name}}</td>
                                <td>{{$building->user->name}}</td>
                                <td>{{($building->property) ==0 ? ' متاح '  : " غير متاح "}}</td>
                                <td>{{$building->created_at}}</td>


                                <td>
                                    <a class="btn btn-primary" href="buildings/{{$building->id}}/edit"> تعديل </a>
                                    <form action="/admin-panel/buildings/{{$building->id}}" method="post">
                                        {{ method_field("delete")}}
                                        @csrf
                                        <button class="btn btn-danger delete">  حذف </button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection



@section('footer')

@endsection


