@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Haber Ekle</h3>
            </div>
            <div class="box-body">
                <form action="{{route('news.store')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="files" class="form-label mt-4">Başlık</label>
                        <div class="row">
                            <div class="col-xs-12">
{{--                                <input class="form-control" type="text" name="title">--}}
                                <input
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror "
                                    name="title"
                                >
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label>İçerik</label>
                        <div class="row">
                            <div class="col-xs-12">
                                    <textarea class="form-control" id="editor"
                                              name="content" ></textarea>
                                <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#editor' ) )
                                        .then( editor => {
                                            console.log( editor );
                                        } )
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="categori" class="form-control">
                                    @foreach($data as $veriler)
                                        <option value="{{$veriler->id}}">{{$veriler->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label>Resim</label>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-xs-12">--}}
{{--                                <input class="form-control" name="picture" type="file">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <label>Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input
                                    type="file"
                                    name="images[]"
                                    class="form-control"
                                    accept="image/*"
                                    multiple
                                >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Video</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="video" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Durum</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="status" class="form-control">
                                    <option value="1">Yayınla</option>
                                    <option value="0">Yayından Kaldır</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <label>Konum</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="konum" class="form-control">
                                    <option value="1">1. Frame</option>
                                    <option value="2">2. Frame</option>
                                    <option value="3">3. Frame</option>
                                    <option value="4">4. Frame</option>
                                </select>
                            </div>
                        </div>

                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Haber Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('css')@endsection
@section('js')@endsection
