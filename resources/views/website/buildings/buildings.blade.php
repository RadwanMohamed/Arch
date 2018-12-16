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
                            <a href="#"> <img src="https://unsplash.it/500/300?image=0" class="img-responsive"
                                              alt="Product Image"/> </a>
                        </div>

                        <div class="info">
                            <div class="row">
                                <div class="price-details col-md-12">
                                    <p class="details">
                                        {{$building->desc}}
                                    </p>
                                    <h1>{{$building->name}} </h1>
                                    <span class="price-new">${{$building->price}}</span>
                                </div>
                            </div>

                            <div class="separator clear-left">
                                <p>
                                    <a href="#" class="hidden-sm"> اظهر التفاصيل </a>
                                </p>

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
