@extends('base')

@section('content')
    <div class="row">
        <div class="col-3 text-right">
            <a href="{{ route('canteen-menu.index') }}" class="btn btn-dark mb-3">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        <div class="col-6">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">Ubah Menu Kantin</div>
                <div class="card-body">
                    <form action="{{ route('canteen-menu.update', ['canteen_menu' => $menu->id]) }}" method="post">
                    @method('PUT')
                    @csrf
                        <div class="row">
                            <div class="form-group col-md-5 offset-1">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{ $menu->name }}" autocomplete="off" autofocus>
                                @error('nama') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <label for="">Harga</label>
                                <div class="input-group">
                                    <div class="input-group-text">Rp</div>
                                    <input type="number" class="form-control" name="harga" value="{{ $menu->price }}">
                                </div>
                                @error('harga') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-10 offset-1 p-0">
                            <label>Tersedia</label>
                            <select name="tersedia" id="" class="form-control">
                                <option value="NULL">Pilih</option>
                                <option value="available" {{ $menu->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                                <option value="unavailable" {{ $menu->status == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                            </select>
                            @error('tersedia') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-10 offset-1 text-right p-0">
                            <button type="submit" class="btn btn-outline-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection