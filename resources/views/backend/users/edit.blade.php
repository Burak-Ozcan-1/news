@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">User Düzenleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('users.update',$user->id)}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    {{-- Route::resource yapısında post metoduna izin vermediği için karşıya put olarak göndermek için--}}
                    {{-- Route::resource sadece put veya patch metodlarına izin verir.--}}
                    {{-- post u put a çevirir.--}}
                    @method('PUT')
                    @isset($user->user_file)
                        <div class="form-group">
                            <label>Yüklü Görsel</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <img width="100" src="/images/users/{{$user->user_file}}">
                                </div>
                            </div>
                        </div>
                    @endisset
                    <div class="form-group">
                        <label>Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="user_file"  type="file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="name" value="{{$user->name}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kullanıcı Adı (Email)</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" name="email" value="{{$user->email}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Şifre</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password">
                                <small>Şifreyi değiştirmek istemiyorsanız boş bırakın!</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Durum</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="status" class="form-control">
                                    <option {{$user->status=="1" ? "selected=''" : ""}} value="1">Aktif</option>
                                    <option {{$user->status=="0" ? "selected=''" : ""}} value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <br>

                        <label>Rolü</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="role" class="form-control">
                                    <option {{$user->role=="admin" ? "selected=''" : ""}} value="admin">Admin</option>
                                    <option {{$user->role=="user" ? "selected=''" : ""}} value="user">User</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="old_file" value="{{$user->user_file}}">

                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('css')@endsection
@section('js')@endsection
