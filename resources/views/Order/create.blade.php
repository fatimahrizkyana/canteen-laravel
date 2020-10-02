@extends('base')

@section('content')
    <div class="row">
        <div class="col-1 text-right">
            <a href="{{ route('order.index') }}" class="btn btn-dark mb-3">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        <div class="col-5">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">Tambah</div>
                <div class="card-body row">
                    <div class="form-group col-5">
                        <label for="">Nomor meja</label>
                        <select name="meja" id="meja" class="form-control"></select>
                    </div>
                    <div class="col-6"></div>
                    <div class="form-group col-5">
                        <label for="">Menu</label>
                        <select name="menu" id="menu" class="form-control"></select>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Kuantitas</label>
                        <input type="number" name="kuantitas" id="kuantitas" class="form-control" value="1">
                    </div>
                    <div class="form-group col-4">
                        <label for="">Catatan</label>
                        <input type="text" name="catatan" id="catatan" class="form-control">
                    </div>
                    <div class="col-12 text-right">
                        <button class="btn btn-outline-info" id="btn_refresh"><i class="fas fa-sync"></i></button>
                        <button class="btn btn-outline-primary" id="btn_tambah">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">Pesanan</div>
                <div class="card-body">
                    <table class="table text-center" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Kuantitas</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="order_table"></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
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

        function canteen_menu_data(){
            $('#menu').html('<option value="NULL">Loading...</option>');
            $.get("{{ route('canteen-menu.data') }}", function(data, status){
                var tag = '<option value="NULL">Pilih Menu</option>';
                data.forEach(d => {
                    tag += '<option value="'+ d.id +'">'+ d.name +'</option>';
                });
                $('#menu').html(tag);
            });
        }

        table_data();
        canteen_menu_data();

        $('#btn_refresh').click(function () { 
            table_data();
            canteen_menu_data();
            $('#order_table').html('');
        });

        $('#btn_tambah').click(function () { 
            var meja = $('#meja').val();
            var menu = $('#menu').val();
            var catatan = $('#catatan').val();
            var kuantitas = $('#kuantitas').val();

            if (meja != "NULL" && menu != "NULL" && kuantitas != "" && kuantitas > 0) {
                var data = {meja: meja, menu: menu, catatan: catatan, kuantitas: kuantitas};
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post("{{ route('order.store') }}", data, function(data, status){
                    console.log(data);
                    order_table_data($('#meja').val());
                });
            }else{
                alert('Isikan form dengan benar.');
            }
        });

        function order_table_data(meja){
            $('#order_table').html('<tr><td colspan="5" class="text-center">Loading...</td></tr>');
            $.get("{{ route('order.data') }}", {meja: meja}, function(data, status){
                var tag = '';
                if (data.length > 0) {
                    data.forEach(d => {
                        tag += '<tr>';
                        tag += '<td>'+ d.name +'</td>';
                        tag += '<td>'+ d.quantity +'</td>';
                        tag += '<td>'+ d.notes +'</td>';
                        tag += '<td>'+ d.status +'</td>';
                        tag += '<td>';
                        if (d.status == 'proses') {
                            tag += '<button class="btn btn-success btn-sm btn-done" title="Selesai" value="'+ d.id +'"><i class="fa fa-check"></i></button>';
                        }
                        tag += '<button class="btn btn-danger btn-sm btn-cancel" title="Batal" value="'+ d.id +'"><i class="fa fa-times"></i></button>';
                        tag += '</td>';
                        tag += '</tr>';
                    });                    
                }else{
                    tag = '<tr><td colspan="5" class="text-center">Belum ada pesanan (meja '+ meja +')</td></tr>';
                }
                $('#order_table').html(tag);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.btn-done').click(function () { 
                    $.post("{{ route('order.done') }}", {id: $(this).val()}, function(data, status){
                        order_table_data($('#meja').val());
                    });
                });
                $('.btn-cancel').click(function () { 
                    $.post("{{ route('order.cancel') }}", {id: $(this).val()}, function(data, status){
                        order_table_data($('#meja').val());
                    });
                });
            });
        }

        $('#meja').change(function () { 
            if ($(this).val() != "NULL") {
                order_table_data($(this).val());
            }else{
                $('#order_table').html('');
            }
        });
    </script>

@endsection