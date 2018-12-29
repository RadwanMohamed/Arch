@extends("layouts.app")
@section('title')
    اضافة عقار
@endsection

@section('header')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    {!! Html::style('customs/addbuilding.css') !!}
@endsection


@section('content')

    <div class="container register">
        <div class="row">
            <div class=" register-left">
                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                <h3>مرحبا بك فى موقعنا</h3>
                <p>انت الان على بعد 30 ثانية من فعل شئ عظيم وكسب  الاموال</p>
            </div>
            <div class="col-md-9 register-right" >

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading"> قم بعرض عقارك الان بابسط المتطلبات </h3>

                        @yield('tab-content')
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
