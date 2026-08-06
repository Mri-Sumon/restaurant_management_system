@extends('web_master')
@section('title', 'Uk Restaurant')
@section('main_content')

<div class="container-fluid top-menu-section"
    style="background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{asset('frontend/img/cocktail.jpg')}}')">
</div>
<div class="page-blend">
    <div class="container-fluid top-section" style="background-image: url('img/revbg.html')">

    </div>
    <section class="static">
        <div class="container-fluid px-md-5">
            <h3>Cocktails Menu</h3>
            <hr>


            <div class="">
                @foreach ($CocktailCategory as $cate)
                <section class="">
                    <h2 class="">{{$cate->name}}</h2>
                    <div class="row">
                        @foreach ($cate->cocktails as $cock)
                        <div class="col-md-3">
                            <div class="foodcard p-4">
                                <h6>{{$cock->subtitle}}</h6>
                                <h5>{{$cock->title}}</h5>
                                @if ($cock->cl == null)
                                <h6 class="price">£{{$cock->price}}</h6>
                                @elseif ($cock->price == null)
                                <h6 class="price">{{$cock->cl}}cl</h6>
                                @elseif ($cock->price != null && $cock->cl != null)
                                <h6 class="price">{{$cock->cl}}cl - £{{$cock->price}}</h6>
                                @endif
                            
                                <p>{{$cock->description}}</p>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                </section>
                @endforeach
                
            </div>


        </div>
    </section>
</div>
@endsection