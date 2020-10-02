@extends('base')

@section('content')

<div class="row">
    <div class="col-10 offset-1 mt-3">
        <a href="{{ route('transaction.create') }}" class="btn btn-outline-dark float-right">
            <i class="fa fa-plus" aria-hidden="true"></i>Tambah
        </a>
        <h5 style="margin-top: 9px;">Data Transaksi</h5>
    </div>

    <div class="col-10 offset-1">
        <div class="card mt-3 shadow">
            <table class="table table-striped table-bordered text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Meja</th>
                        <th>Total</th>
                        <th>Uang</th>
                        <th>Kembali</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($transactions as $tr)
                    <tr>
                        <td scope="row">{{ $i }}</td>
                        <td>{{ $tr->date }}</td>
                        <td>{{ $tr->number }}</td>
                        <td>Rp. {{ number_format($tr->total,0,',','.') }}</td>
                        <td>Rp. {{ number_format($tr->cash,0,',','.') }}</td>
                        <td>Rp. {{ number_format($tr->change,0,',','.') }}</td>
                        <td class="text-center">
                            @if($tr->status == "paid")
                            <div class="bg-success rounded mr-3 w-100 text-light text-center">
                                Dibayar
                            </div>
                            @else
                            <div class="bg-info rounded mr-3 w-100 text-light text-center">
                                Belum dibayar
                            </div>
                            @endif
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection