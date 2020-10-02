@extends('base')

@section('content')

<div class="row">
    <div class="col-10 offset-1 mt-3">
        <a href="{{ route('order.create') }}" class="btn btn-outline-dark float-right">
            <i class="fa fa-plus" aria-hidden="true"></i>Tambah
        </a>
        <h5 style="margin-top: 9px;">Data Pesanan</h5>
    </div>

    <div class="col-10 offset-1">
        <div class="card mt-3 shadow">
            <table class="table table-striped table-bordered text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Total</th>
                        <th>Catatan</th>
                        <th>Meja</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($orders as $order)
                    <tr>
                        <td scope="row">{{ $i }}</td>
                        <td>{{ $order->name }}</td>
                        <td>Rp. {{ number_format($order->price,0,',','.') }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>Rp. {{ number_format($order->total,0,',','.') }}</td>
                        <td>{{ $order->notes }}</td>
                        <td>Meja {{ $tables[$i-1]->number }}</td>
                        <td class="text-center">
                            @if($order->status == "selesai")
                            <div class="bg-success rounded mr-3 w-100 text-light text-center">
                                selesai
                            </div>
                            @else
                            <div class="bg-info rounded mr-3 w-100 text-light text-center">
                                proses
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
