@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Users</h3>

                <div align="right">
                    <a href="{{route('users.create')}}"><button class="btn btn-success">Ekle</button></a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Ad Soyad</th>
                        <th>Durum</th>
                        <th>Rolü</th>
                    </tr>
                    <tbody id="sortable">
                    @foreach($data['user'] as $user)
                        {{-- class="sortable" taşıma işlemi için user'dan taşıma yapacak --}}
                        <tr id="item-{{$user->id}}">
                            <td class="sortable" width="150"><img width="150" src="/images/users/{{$user->user_file}}"></td>
                            <td class="sortable" width="150">{{$user->name}}</td>
                            <td class="sortable" width="150">@php if($user->status == 1) echo 'Aktif'; else echo 'Pasif' @endphp</td>
                            <td class="sortable" width="150">{{($user->role)}}</td>
                            <td width="5"><a href="{{route('users.edit',$user->id)}}"><i class="fa fa-pencil-square"></i></a></td>
                            <td width="5">
                                <a href="javascript:void(0)"><i id="@php echo $user->id @endphp" class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
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
                        url: "{{route('users.store')}}",
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
                        url:"user/"+destroy_id,
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
