@extends('base')

@section('content')
    <div class="row">
        <div class="col-3 text-right">
            <a href="" class="btn btn-dark mb-3">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header bg-dark text-white">Tambah Pengguna</div>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post">
                    @csrf
                        <div class="form-group col-md-10 offset-1">
                            <label for="username">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" autocomplete="off" autofocus>
                            @error('nama_lengkap') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-10 offset-1">
                            <label for="username">Nama Pengguna</label>
                            <input type="text" class="form-control" name="nama_pengguna" value="{{ old('nama_pengguna') }}">
                            @error('nama_pengguna') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-10 offset-1">
                            <label>Kata Sandi<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="kata_sandi" placeholder="" value="{{ old('kata_sandi') }}" autocomplete="off">
                            @error('kata_sandi') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-10 offset-1">
                            <label for="inputState">Status Pengguna</label>
                            <select id="inputState" class="form-control" name="level">
                                <option value="NULL">Pilih Status...</option>
                                <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pelayan" {{ old('level') == 'pelayan' ? 'selected' : '' }}>Pelayan</option>
                                <option value="kasir" {{ old('level') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="pemilik" {{ old('level') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                            </select>
                            @error('level') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-10 offset-1 text-right">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection