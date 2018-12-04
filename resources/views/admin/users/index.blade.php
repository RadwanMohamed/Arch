
@extends('admin.layouts.app')


@section('title')
    التحكم فى الاعضاء
@endsection



@section('header')
    <!-- DataTables -->
    {!! Html::style('admin/plugins/datatables/dataTables.bootstrap.css') !!}
@endsection



@section('content')

    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>
            <li><a href="{{url('admin-panel/users/create')}}"> اضافة عضو جديد </a></li>
            <li class="active"> جدول الاعضاء </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">عرض جميع الاعضاء</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th> رقم العضو </th>
                                <th> اسم العضو </th>
                                <th> البريد الالكتروني </th>
                                <th> العضوية </th>
                                <th> تاريخ انشاء الحساب </th>
                                <th> اجراء تعديل </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{($user->admin) ==1 ? ' مدير '  : " عضو "}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <a class="btn btn-primary" href="users/{{$user->id}}/edit"> تعديل </a>
                                    <form action="/admin-panel/users/{{$user->id}}" method="post">
                                        {!! method_field('delete') !!}
                                        @csrf
                                        <button class="btn btn-danger delete">  حذف </button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th> رقم العضو </th>
                                <th> اسم العضو </th>
                                <th> البريد الالكتروني </th>
                                <th> العضوية </th>
                                <th> تاريخ انشاء الحساب </th>
                            </tr>
                            </tfoot>
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
    <!-- DataTables -->
    {!! Html::script('admin/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('admin/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script>
        $(function () {
            $("#example2").DataTable();
            $('#example1').DataTable({
                "paging": true,
                "lengthChange":true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>

@endsection
