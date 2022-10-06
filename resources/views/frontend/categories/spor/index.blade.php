@extends('frontend.layout')
@section('content')
    <div class="container">
        <br>
        <div align="center" >
            <div style="width: 70%; height: 100%;"  id="carousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide One - Set the background image for this slide in the line below -->
                    @php($count=0)
                    @foreach($data1 as $veri)
                        <div class="carousel-item @if ($count++==0) active @endif">
                            <?php
                            $deger = \App\Models\Categories::where('id',$veri->categori_id)->first();
                            $resim = \App\Models\Images::where('id',$veri->image_id)->first();
                            ?>
                            {{-- '/'.$deger->description.'/'.$veri->url   --}}
                            <a href="@if (strlen($veri->url)>0) {{route('haberler.detail',$veri->url)}} @else javascript:void(0) @endif">
                                <img style="width: 100%; height: 98%;" src="{{url('/images/news/'.$resim->image1)}}">
                            </a>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="row">
            @isset($data2)
            @foreach($data2 as $veri)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <?php
                        $deger = \App\Models\Categories::where('id',$veri->categori_id)->first();
                        $resim = \App\Models\Images::where('id',$veri->image_id)->first();
                        ?>
                            <a href="@if (strlen($veri->url)>0) {{route('haberler.detail',$veri->url)}} @else javascript:void(0) @endif">
                                <img src="{{url('/images/news/'.$resim->image1)}}" style="height: 200px; width:349px;">
                            </a>
                            <div class="card-footer">
                                <a href="@if (strlen($veri->url)>0) {{route('haberler.detail',$veri->url)}} @else javascript:void(0) @endif">
                                    <h5 style="color: black">{{$veri->title}}</h5></a>
                            </div>
                    </div>
                </div>
            @endforeach
            @endisset
        </div>
    </div>
@endsection
@section('css')@endsection
@section('js')@endsection
