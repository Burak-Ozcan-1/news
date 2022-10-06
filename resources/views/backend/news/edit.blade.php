@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Haber Düzenle</h3>
            </div>
            <div class="box-body">
                <form action="{{route('news.update',$news->id)}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Başlık</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="title" value="{{$news->title}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>İçerik</label>
                        <div class="row">
                            <div class="col-xs-12">
                                    <textarea class="form-control" id="editor"
                                              name="content">{{$news->content}}</textarea>
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
                                        <option selected value="{{$categories->id}}">{{$categories->description}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- isset varsa getirir yoksa getirmez. --}}
                    @isset($news->image_id)
                        <div class="form-group">
                            <label>Yüklü Haber Resimleri</label>
                                <body>
                                <ul id="sortable">
                                    @isset($images->image1)
                                    <li id="item-{{$images->image1}}">
                                        <a href="{{route('news.delete',$images->image1)}}"><i id="@php echo $images->image1 @endphp" class="fa fa-trash-o"></i>
                                            <img class="sortable" width="150" height="150" src="/images/news/{{$images->image1 == null ? 0 : $images->image1}}">
                                        </a>
                                    </li>
                                    </br>
                                    @endisset
                                    @isset($images->image2)
                                    <li id="item-{{$images->image2}}">
                                        <a href="{{route('news.delete',$images->image2)}}"><i id="@php echo $images->image2 @endphp" class="fa fa-trash-o"></i>
                                            <img class="sortable" width="150" height="150" src="/images/news/{{$images->image2 == null ? 0 : $images->image2}}">
                                        </a>
                                    </li>
                                    </br>
                                    @endisset
                                    @isset($images->image3)
                                    <li id="item-{{$images->image3}}">
                                        <a href="{{route('news.delete',$images->image3)}}"><i id="@php echo $images->image3 @endphp" class="fa fa-trash-o"></i>
                                            <img class="sortable" width="150" height="150" src="/images/news/{{$images->image3 == null ? 0 : $images->image3}}">
                                        </a>
                                    </li>
                                    </br>
                                    @endisset
                                    @isset($images->image4)
                                    <li id="item-{{$images->image4}}">
                                        <a href="{{route('news.delete',$images->image4)}}"><i id="@php echo $images->image4 @endphp" class="fa fa-trash-o"></i>
                                            <img class="sortable" width="150" height="150" src="/images/news/{{$images->image4 == null ? 0 : $images->image4}}">
                                        </a>
                                    </li>
                                    @endisset
                                </ul>

                                </body>
                        </div>
                    @endisset

                    <div class="form-group">
                        <label>Resim Yükle</label>
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

                    @isset($news->video)
                        <div class="form-group">
                            <label>Yüklü Video</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <video controls autoplay width="120" src="/videos/news/{{$news->video}}"/>
                                </div>
                            </div>
                        </div>
                    @endisset

                    <div class="form-group">
                        <label>Video Yükle</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="video" type="file">
                            </div>
                        </div>
                    </div>

                        <label>Durum</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="durum" class="form-control">
                                    <option {{$news->durum=="1" ? "selected=''" : ""}} value="1">Yayında</option>
                                    <option {{$news->durum=="0" ? "selected=''" : ""}} value="0">Yayından Kaldır</option>
                                </select>
                            </div>
                        </div>

                        <br>
                        <label>Konum</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="konum" class="form-control">
                                    <option {{$news->konum=="1" ? "selected=''" : ""}} value="1">1. Frame</option>
                                    <option {{$news->konum=="2" ? "selected=''" : ""}} value="2">2. Frame</option>
                                    <option {{$news->konum=="3" ? "selected=''" : ""}} value="3">3. Frame</option>
                                    <option {{$news->konum=="4" ? "selected=''" : ""}} value="4">4. Frame</option>
                                </select>
                            </div>
                        </div>

                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Haber Güncelle</button>
                        </div>
                </form>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(function(){
            $.ajaxSetup({
               headers:{
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });
            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event,ui){
                    //var data = $(this).sortable('toArray', {attribute : "id"}).toString();
                    var data = $(this).sortable('serialize');
                    console.log(data);
                    $.ajax({
                        type:"POST",
                        data: data,
                        url:"{{route('news.Sortable',$news->image_id)}}",
                        success: function (msg){
                            //console.log(msg);
                            if(msg){
                                alert("İşlem Başarılı.");
                            }
                            else{
                                alert("İşlem Başarısız.");
                            }
                        }
                    });
                },
            });
            $('#sortable').disableSelection();
        });
    </script>
@endsection
@section('css')@endsection
@section('js')@endsection
