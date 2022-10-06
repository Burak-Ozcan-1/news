@extends('frontend.layout')
@section('content')

    <!-- Page Content -->
    <div class="container">
        <br>
        <div class="row">
            <div style="width: 70%; height: 100%;" id="carousel1" class="carousel slide" data-ride="carousel">
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

            <div style="margin-left: 1%; width: 29%;" id="carousel2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide One - Set the background image for this slide in the line below -->
                    @php($count=0)
                    @foreach($data2 as $veri)
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

                <a class="carousel-control-prev" href="#carousel2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div style="width: 100%; height: 200px;" id="recipeCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @php($count=0)
                        <div class="carousel-item @if ($count++==0) active @endif">
                                @foreach($data3 as $veri)
                                <?php
                                $deger = \App\Models\Categories::where('id',$veri->categori_id)->first();
                                $resim = \App\Models\Images::where('id',$veri->image_id)->first();
                            ?>
                                    <div style="margin-right: 10px;" class="float-left">
                                        <a href="@if (strlen($veri->url)>0) {{route('haberler.detail',$veri->url)}} @else javascript:void(0) @endif">
                                            <img src="{{url('/images/news/'.$resim->image1)}}" style="height: 160px; width:218px;">
                                        </a>
                                        <div style="text-align: center">
                                            {{Str::substr($veri->title, 0, 25)}}...
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                            @isset($data4)
                            @php($count=0)
                            @php($resimsayisi=0)
                            <div class="carousel-item @if ($count++==0) @endif">
                            @foreach($data4 as $veri)
                                    <?php
                                    $deger = \App\Models\Categories::where('id',$veri->categori_id)->first();
                                    $resim = \App\Models\Images::where('id',$veri->image_id)->first();
                                    ?>
                                    <div style="margin-right: 10px;" class="float-left">
                                        @if($resimsayisi<5)
                                        <a href="@if (strlen($veri->url)>0) {{route('haberler.detail',$veri->url)}} @else javascript:void(0) @endif">
                                            <img src="{{url('/images/news/'.$resim->image1)}}" style="height: 160px; width:218px;">
                                        <?php $resimsayisi = $resimsayisi+1 ?>
                                        </a>
                                        <div style="text-align: center">
                                            {{Str::substr($veri->title, 0, 25)}}...
                                        </div>
                                        @else
                                        <?php
                                            $arr[] = $veri->url;
                                        ?>
                                        @endif
                                    </div>
                            @endforeach
                            </div>
                        @endisset
                        @isset($arr)
                        @php($count=0)
                        @php($resimsayisi=0)
                        <div class="carousel-item @if ($count++==0) @endif">
                            @foreach($arr as $ddd)
                                    <?php
                                    $bul1 = \App\Models\News::where('url',$ddd)->first();
                                    $deger = \App\Models\Categories::where('id',$veri->categori_id)->first();
                                    $resim = \App\Models\Images::where('id',$bul1->image_id)->first();
                                    ?>
                                    @isset($bul1)
                                    <div style="margin-right: 10px;" class="float-left">
                                        @if($resimsayisi<5)
                                        <a href="@if (strlen($veri->url)>0) {{route('haberler.detail',$ddd)}} @else javascript:void(0) @endif">
                                            <img src="{{url('/images/news/',$resim->image1)}}" style="height: 160px; width:218px;">
                                            <?php $resimsayisi = $resimsayisi+1 ?>
                                        </a>
                                        <div style="text-align: center">
                                            {{Str::substr($bul1->title, 0, 25)}}...
                                        </div>
                                        @else
                                        <?php
                                            $bbb[] = $ddd
                                        ?>
                                        @endif
                                    </div>
                                    @endisset
                            @endforeach
                        </div>
                        @endisset
                        @isset($bbb)
                        @php($resimsayisi=0)
                        <div class="carousel-item @if ($count++==0) @endif">
                            @foreach($bbb as $dd)
                                    <?php
                                    $bul2 = \App\Models\News::where('url',$dd)->first();
                                    $deger = \App\Models\Categories::where('id',$veri->categori_id)->first();
                                    $resim = \App\Models\Images::where('id',$bul2->image_id)->first();
                                    ?>
                                    @isset($bul2)
                                    <div style="margin-right: 10px;" class="float-left">
                                        @if($resimsayisi<5)
                                            <a href="@if (strlen($veri->url)>0) {{route('haberler.detail',$dd)}} @else javascript:void(0) @endif">
                                                <img src="{{url('/images/news/'.$resim->image1)}}" style="height: 160px; width:218px;">
                                                <?php $resimsayisi = $resimsayisi+1 ?>
                                            </a>
                                            <div style="text-align: center">
                                                {{Str::substr($bul2->title, 0, 25)}}...
                                            </div>
                                        @else
                                            <?php
                                            $cc[] = $dd
                                            ?>
                                        @endif
                                    </div>
                                    @endisset
                            @endforeach
                        </div>
                        @endisset
                    <a style="height: 160px; width: 60px;" class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a style="height: 160px; width: 60px;" class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
            </div>
            </div>
        <div class="row">
            @foreach($data5 as $veri)
            <div class="col-lg-4 mb-4">
                <div class="card h-100" style="height: 200px; width:300px;">
                    <?php
                        $deger = \App\Models\Categories::where('id',$veri->categori_id)->first();
                        $resim = \App\Models\Images::where('id',$veri->image_id)->first();
                    ?>
                        <a href="@if (strlen($veri->url)>0) {{route('haberler.detail',$veri->url)}} @else javascript:void(0) @endif">
                            <img src="{{url('/images/news/'.$resim->image1)}}" style="height: 200px; width:300px;">
                        </a>
                    <div class="card-footer">
                        <a href="@if (strlen($veri->url)>0) {{route('haberler.detail',$veri->url)}} @else javascript:void(0) @endif">
                            <h5 style="color: black; height: 70px;">{{$veri->title}}</h5></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <hr>

        <!-- Call to Action Section -->
{{--        <div class="row mb-4">--}}
{{--            <div class="col-md-8">--}}
{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
@section('css')@endsection
@section('js')@endsection


