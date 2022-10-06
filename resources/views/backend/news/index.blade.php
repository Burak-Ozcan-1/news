@extends('backend.layout')
@section('content')
<section class="content-header">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Haberler</h3>
            <div align="right">
                <a href="{{route('news.create')}}"><button class="btn btn-success">Haber Ekle</button></a>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>İçerik</th>
                        <th>Kategori</th>
                        <th>Durum</th>
                    </tr>
                    <tbody id="sortable">
                    @foreach($data as $veri)
                        <?php $deger = \App\Models\Categories::where('id',$veri->categori_id)->first() ?>
                        <?php $ilkresim = \App\Models\Images::where('id',$veri->image_id)->first() ?>
                        {{-- $data = Categories::all();//News::all();  --}}
                        <tr id="item-{{$veri->id}}">
                            @isset($ilkresim->image1)
                                <td class="sortable" width="150"><img width="150" src="/images/news/{{$ilkresim->image1 == null ? 0 : $ilkresim->image1}}"></td>
                            @endisset
                            <td class="sortable">{{$veri->title}}</td>
                            <td class="sortable">{!! Str::substr($veri->content,0,100) !!}</td>
                            <td class="sortable">{{ $deger->description }}</td>
                            <td class="sortable">{{$veri->durum=="1" ? "YAYINDA" : "YAYINDA DEĞİL"}}</td>
                            <td width="5"><a href="{{route('news.edit',$veri->id)}}"><i class="fa fa-pencil-square"></i></a></td>
                            <td width="5">
                                <a href="javascript:void(0)"><i id="@php echo $veri->id @endphp" class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#sortable').sortable({
            revert: true,
            handle: ".sortable",
            stop: function (event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "{{route('news.store')}}",
                    success: function (msg) {
                        // console.log(msg);
                        if (msg) {
                            alertify.success("İşlem Başarılı");
                        } else {
                            alertify.error("İşlem Başarısız");
                        }
                    }
                });

            }
        });
        $('#sortable').disableSelection();

    });

    $(".fa-trash-o").click(function () {
        destroy_id = $(this).attr('id');

        alertify.confirm('Silme işlemini onaylayın!', 'Bu işlem geri alınamaz',
            function () {

                $.ajax({
                    type:"DELETE",
                    url:"news/"+destroy_id,
                    success: function (msg) {
                        if (msg)
                        {
                            $("#item-"+destroy_id).remove();
                            alertify.success("Silme İşlemi Başarılı");

                        } else {
                            alertify.error("İşlem Tamamlanamadı");
                        }
                    }
                });

            },
            function () {
                alertify.error('Silme işlemi iptal edildi')
            }
        )

    });
</script>
@endsection
@section('css')@endsection
@section('js')@endsection
