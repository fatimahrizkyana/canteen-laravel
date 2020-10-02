@extends('base')

@section('content')
    <div class="row">
        <div class="col-1 text-right">
            <a href="{{ route('user.index') }}" class="btn btn-dark mb-3">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        <div class="col-10">
            <div class="card">
                <div class="card-header bg-dark text-white">Ubah Pengguna</div>
                <div class="card-body">
                    <form action="{{ route('user.update', ['user' => $user->id]) }}" method="post">
                    @method('PUT') 
                    @csrf
                        <div class="form-group col-md-10 offset-1">
                            <label for="username">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ $user->name }}" autocomplete="off" autofocus>
                            @error('nama_lengkap') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-10 offset-1">
                            <label for="username">Nama Pengguna</label>
                            <input type="text" class="form-control" name="nama_pengguna" value="{{ $user->username }}">
                            @error('nama_pengguna') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-10 offset-1">
                            <label>Kata Sandi<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="kata_sandi" placeholder="" value="" autocomplete="off">
                            @error('kata_sandi') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-10 offset-1">
                            <label for="inputState">Status Pengguna</label>
                            <select id="inputState" class="form-control" name="level">
                                <option value="NULL">Pilih Status...</option>
                                <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pelayan" {{ $user->level == 'pelayan' ? 'selected' : '' }}>Pelayan</option>
                                <option value="kasir" {{ $user->level == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="pemilik" {{ $user->level == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                            </select>
                            @error('level') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-10 offset-1 text-right">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection