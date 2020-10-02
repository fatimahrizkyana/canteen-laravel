@extends('base')

@section('content')
    <div class="row">
        <div class="col-1 text-right">
            <a href="{{ route('transaction.index') }}" class="btn btn-dark mb-3">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        <div class="col-7">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">Transaksi</div>
                <div class="card-body row">
                    <div class="form-group col-5">
                        <label for="">Nomor meja</label>
                        <select name="meja" id="meja" class="form-control"></select>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-12">
                        <hr class="bg-dark">
                        <span class="h5">Rincian Pesanan</span>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="transaction_table"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">Pembayaran</div>
                <div class="card-body">
                    <button class="btn btn-outline-info btn-sm" id="btn_refresh">
                        <i class="fas fa-sync"></i> Refresh
                    </button>
                    <table class="table mt-3" style="width: 100%;">
                        <tr>
                            <th>Total</th>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-text p-0 pl-2 pr-2">Rp.</div>
                                    <input type="text" class="form-control form-control-sm bg-light" id="total" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Uang</th>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-text p-0 pl-2 pr-2">Rp.</div>
                                    <input type="number" class="form-control form-control-sm" id="cash">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Kembali</th>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-text p-0 pl-2 pr-2">Rp.</div>
                                    <input type="text" class="form-control form-control-sm bg-light" id="change" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-outline-primary w-100" id="btn_bayar">Bayar</button>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $('#cash').focus(function () { $(this).val() == 0 ? $(this).val('') : false;});
        $('#cash').blur(function () { $(this).val() == "" ? $(this).val('0') : false;});

        function table_data(){
            $('#meja').html('<option value="NULL">Loading...</option>');
            $.get("{{ route('table.data') }}", function(data, status){
                var tag = '<option value="NULL">Pilih Meja</option>';
                data.forEach(d => {
                    tag += '<option value="'+ d.id +'">Meja '+ d.number +'</option>';
                });
                $('#meja').html(tag);
            });
        }

        function detail_data(meja){
            $('#change, #cash, #total').val('0');
            $('#transaction_table').html('<td colspan="4" class="text-center text-light bg-dark">Loading...</td>');
            if (meja != "NULL") {
                $.get("{{ route('transaction.data') }}", {meja: meja}, function(data, status){
                    var tag = '';
                    if (data.length != 0) {
                        data.forEach(d => {
                            tag += '<tr>';
                            tag += '<td>'+ d.name +'</td>';
                            tag += '<td>Rp. '+ d.price +'</td>';
                            tag += '<td>'+ d.quantity +'</td>';
                            tag += '<td>Rp. '+ (d.price * d.quantity) +'</td>';
                            tag += '</tr>';

                            $('#total').val(d.total);
                        });
                    }else{
                        $('#total').val('0');
                        tag += '<td colspan="4" class="text-center text-light bg-dark">Belum ada pesanan untuk meja '+ meja +'</td>';
                    }
                    $('#transaction_table').html(tag);
                });
            }else{
                refresh();
            }
        }

        function refresh(){
            $('#change, #cash, #total').val('0');
            $('#transaction_table').html('<td colspan="4" class="text-center text-light bg-dark">Pilih meja untuk menampilkan rincian</td>');
            table_data();
        };

        $('#meja').change(function () { 
            detail_data($(this).val());
        });

        $('#cash').keyup(function () { 
            var total = $('#total').val();
            var uang = $(this).val();
            if (total > 0) {
                $('#change').val(uang - total);
            }
        });

        $('#btn_refresh').click(function () { 
            refresh();
        });

        $('#btn_bayar').click(function () { 
            var total = $('#total').val();
            var uang = $('#cash').val();
            var kembali = $('#change').val();
            var meja = $('#meja').val();
            if (total != 0 && uang >= total) {
                var data = {
                    meja: meja,
                    total: total,
                    cash: uang,
                    change: kembali,
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post("{{ route('transaction.store') }}", data, function(data, status){
                    if (status == "success") {
                        alert('Berhasil melakukan pembayaran');
                        refresh();
                    }else{
                        alert('Gagal melakukan pembayaran');
                    }
                })
            }else{
                alert('Pilih meja terlebih dahulu / Uang yang dibayarkan masih kurang.');
            }
        });

        refresh();

    </script>
@endsection