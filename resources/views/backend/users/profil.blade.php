@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Profil</h3>
            </div>
            <div class="box-body">
                <form action="" method="post"  enctype="multipart/form-data">
                    @foreach($data as $user)
                    @csrf
                    {{-- Route::resource yapısında post metoduna izin vermediği için karşıya put olarak göndermek için--}}
                    {{-- Route::resource sadece put veya patch metodlarına izin verir.--}}
                    {{-- post u put a çevirir.--}}
                    @method('PUT')
                    @isset($user->user_file)
                        <div class="form-group">
                            <label>Görsel</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <img width="100" src="/images/users/{{$user->user_file}}">
                                </div>
                            </div>
                        </div>
                    @endisset

                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <div class="row">
                            <div class="col-xs-12">
                                {{$user->name}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Durum</label>
                        <div class="row">
                            <div class="col-xs-12">
                                {{$user->status=="1" ? "Aktif" : "Pasif"}}
                            </div>
                        </div>
                        <br>

                        <label>Rolü</label>
                        <div class="row">
                            <div class="col-xs-12">
                                {{$user->role=="admin" ? "Admin" : "User"}}
                            </div>
                        </div>

                        <input type="hidden" name="old_file" value="{{$user->user_file}}">
                    </div>
                    @endforeach
                </form>
            </div>
        </div>
    </section>
@endsection
@section('css')@endsection
@section('js')@endsection
