@extends('frontend.layout')
@section('content')
    <div class="container">

        <h1 class="mt-4 mb-3"></h1>
        @foreach($news as $veri)
        <?php
          $resim = \App\Models\Images::where('id',$veri->image_id)->first();
        ?>
        @if($veri->konum == 1 )
        @isset($resim->image1)
        <div class="row">
            <img style='width: 80%; height: 500px;' src="{{url('/images/news/'.$resim->image1)}}">
        </div>
        @endisset
        @else
        @isset($resim->image1)
        <div >
            <img style='width: 50%; height: 400px;' src="{{url('/images/news/'.$resim->image1)}}">
        </div>
        @endisset
        @endif
        <br>
        <div class="row">
            <b>Yayınlanma Tarihi: {{ date('d-m-Y', strtotime($veri->created_at)) }}</b>
        </div>
        @isset($veri->updated_at)
        <div class="row">
            <b>Son Güncelleme Tarihi: {{ date('d-m-Y', strtotime($veri->updated_at)) }}</b>
        </div>
        @endisset
            <br>
        <div class="row">

            <b>{{$veri->title}}</b>
        </div>

        <div class="row">
            <br>
            {!! $veri->content !!}
        </div>
        @isset($veri->video)
        <div align="center">
        <br>
            <video controls autoplay width="50%" src="/videos/news/{{$veri->video}}"/>
        <br>
        </div>
        @endisset
        <div class="row">
            <br>
            @isset($resim->image2)
                <img style="width: 45%; margin-right: 10%;" src="{{url('/images/news/'.$resim->image2)}}">
            @endisset
            @isset($resim->image3)
                <img style="width: 45%;" src="{{url('/images/news/'.$resim->image3)}}">
            @endisset
        </div>
        @isset($resim->image4)
        <div align="center">
            <br>
            <img style="width: 45%;" src="{{url('/images/news/'.$resim->image4)}}">
        </div>
        @endisset
        @endforeach
    </div>
@endsection
@section('css')@endsection
@section('js')@endsection
