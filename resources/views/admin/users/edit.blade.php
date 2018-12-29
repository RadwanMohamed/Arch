@extends('admin.layouts.app')


@section('title')
    تعديل بيانات عضو
@endsection






@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>
            <li><a href="{{url('admin-panel/users')}}"> الاعضاء </a></li>
            <li class="active"> تعديل بيانات عضو </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> التعديل على البيانات </h3>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                     @endif
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! Form::open(['route' =>['users.update',$user->id], 'method' => 'put']) !!}
                            @include('admin.users.form')
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> جميع عقارات    {{$user->name}} </h3>
                    </div>

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
                                <th> المكان </th>
                                <th> اسم المالك </th>
                                <th> الحالة </th>
                                <th> تاريخ الانشاء </th>
                                <th> اجراء تعديل </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->buildings as $building)
                                <tr>
                                    <td>{{$building->id}}</td>
                                    <td>{{$building->name}}</td>
                                    <td>{{$building->price}}</td>
                                    <td>{{$building->square}}</td>
                                    <td>{{($building->property) ==0 ? ' ايجار '  : " ملك "}}</td>
                                    <td>{{$building->type->name}}</td>
                                    <td>{{$building->address->name}}</td>
                                    <td>{{$building->user->name}}</td>
                                    <td>{{($building->property) ==0 ? ' متاح '  : " غير متاح "}}</td>
                                    <td>{{$building->created_at}}</td>


                                    <td>
                                        <a class="btn btn-primary" href="{{route('buildings.edit',['building'=>$building->id])}}"> تعديل </a>
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
        </div>
        <!-- /.row -->
    </section>
@endsection




