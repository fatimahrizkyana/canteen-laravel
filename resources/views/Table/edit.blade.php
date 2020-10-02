@extends('base')

@section('content')
    <div class="row">
        <div class="col-4 text-right">
            <a href="{{ route('table.index') }}" class="btn btn-dark mb-3">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        <div class="col-4">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">Ubah Meja</div>
                <div class="card-body">
                    <form action="{{ route('table.update', ['table' => $table->id]) }}" method="post">
                    @method('PUT')
                    @csrf
                        <div class="form-group col-md-10 offset-1 p-0">
                            <label>Nomor Meja</label>
                            <input type="number" class="form-control" name="nomor_meja" value="{{ $table->number }}">
                            @error('nomor_meja') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
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