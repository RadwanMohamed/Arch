@extends('website.buildings.all')
@section('buildings')
<div class="buildings">
    <div class="col-lg-9 pull-right">
        @include('layouts.errors')
        <div class="row request" style="display:block;">
            @if(count($buildings) > 0)
                @foreach($buildings as $key => $building)
                    @if($key%3 ==0 && $key !=0 )
                        <div class="clearfix"></div>

                    @endif
                    <div class="col-sm-4">
                        <article class="col-item">
                            <div class="photo">

                                <a href="#">

                                    <img src="{{Request::root()}}/{{images($building->id)}}" class="img-responsive"
                                                  alt="{{$building->name}}"  style="max-width: 289px; max-height: 173.39px"/>
                                </a>
                            </div>

                            <div class="info">
                                <div class="row">
                                    <div class="price-details col-md-12">
                                        <p class="details">
                                            {{mb_substr($building->desc,0,45)}}...
                                        </p>
                                        <h1>{{$building->name}} </h1>
                                        <span class="price-new">${{$building->price}}</span>
                                    </div>
                                </div>

                                <div class="separator clear-left">
                                    @if($building->status == 1)
                                    <p>
                                        <a href="/buildings/{{$building->id}}" class="hidden-sm"> اظهر التفاصيل </a>
                                    </p>
                                    @else
                                        <p>
                                            <button  class="btn btn-danger disabled pull-left"> فى انتظار التفعيل  </button>
                                        </p>
                                        <p>
                                            <a href="/buildings/{{$building->id}}/edit" class="btn btn-success pull-right"> تعديل العقار </a>
                                        </p>
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </article>
                    </div>
                @endforeach

            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-template">
                            <h1>
                                !Oops</h1>

                            <div class="error-details">
                                نأسف لاخبارك ان هذا المنتج غير متاح حاليا!
                            </div>

                        </div>
                    </div>
                </div>

            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="center-block">

            {{$buildings->appends(Request::input())->links()}}
        </div>

    </div>
</div>
@endsection
