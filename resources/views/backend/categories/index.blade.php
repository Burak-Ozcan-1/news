@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kategori Ekle</h3>
                {{--                <div align="right">--}}
                {{--                    <a href="{{route('blog.create')}}"><button class="btn btn-success">Ekle</button></a>--}}
                {{--                </div>--}}
            </div>
            <div style="width: 20%; margin-left: 30%;"  class="box-header with-border">
            <p align="center"><b> Mevcut Kategoriler </b></p>
                <ul class="list-group">
                    {{-- databaseden gelecek --}}
                    @foreach($data as $veriler)
                        <li class="list-group-item">{{$veriler->description}}</li>
                    @endforeach
                </ul>
                <form method="post" action="{{route('categories.store')}}">
                @csrf
                <p align="center"><b> Kategori </b></p>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" name="categori">
                    </div>
                </div>

                <div align="center" class="box-footer">
                    <button type="submit" class="btn btn-success">Kategori Ekle</button>
                </div>
               </form>
            </div>

        </div>
    </section>

@endsection
@section('css')@endsection
@section('js')@endsection
