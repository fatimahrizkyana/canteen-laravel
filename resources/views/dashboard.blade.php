@extends ('base')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-12">
            <div class="card-deck">
                <div class="card w-75 border-primary">
                    <div class="card-body ">
                        <h5 class="card-title">
                            <i class="fas fa-user-friends logo-card"></i><a href="{{ route('user.index') }}">Total Pengguna</a>
                        </h5>
                        <h3 class="card-text">{{ $users->count() }}</h3>
                    </div>
                </div>
                <div class="card w-75 border-primary">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-book logo-card"></i><a href="{{ route('canteen-menu.index') }}">Total Menu</a>
                        </h5>
                        <h3 class="card-text">{{ $menus->count() }}</h3>
                    </div>
                </div>
                <div class="card w-75 border-primary">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-shopping-basket logo-card"></i><a href="{{ route('order.index') }}">Total Pesanan</a>
                        </h5>
                        <h3 class="card-text">{{ $orders->count() }}</h3>
                    </div>
                </div>
                <div class="card w-75 border-primary">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-money-check-alt logo-card"></i><a href="{{ route('transaction.index') }}">Total Transaksi</a>
                        </h5>
                        <h3 class="card-text">{{ $transactions->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 mt-5">
            <table class="table text-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Hari Operasional</th>
                        <th scope="col">Jam Operasional</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Senin</td>
                        <td>06.00 - 16.30</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Selasa</td>
                        <td>06.00 - 16.00</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Rabu</td>
                        <td>06.00 - 16.00</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Kamis</td>
                        <td>06.00 - 16.00</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Jumat</td>
                        <td>06.00 - 15.30</td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Sabtu</td>
                        <td>06.30 - 16.30</td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>Minggu</td>
                        <td style="color: red;">Tutup</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection