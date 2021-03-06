@extends('base')

@section('content')

<div class="row">
    <div class="col-10 offset-1 mt-3">
        <a href="{{ route('user.create') }}" class="btn btn-outline-dark float-right">
            <i class="fa fa-plus" aria-hidden="true"></i>Tambah
        </a>
        <h5 style="margin-top: 9px;">Data Pengguna</h5>
    </div>

    <div class="col-10 offset-1">
        <div class="card mt-3">
            <table class="table table-striped table-bordered text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Pengguna</th>
                        <th>Status Pengguna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->level }}</td>
                        <td>
                            <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-outline-success btn-sm" >
                                <i class="fa fa-pencil-alt" aria-hidden="true"></i> Ubah
                            </a>
                            <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_{{ $i }}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="delete_{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus data "{{ $user->name }}" ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $i++ @endphp
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection
