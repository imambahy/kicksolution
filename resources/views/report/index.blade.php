@extends('layout.app')

@section('title', 'Data Order Details')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">Data Order Details</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('get_laporan') }}" method="GET">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dari">Dari Tanggal</label>
                        <input type="date" name="dari" id="dari" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sampai">Sampai Tanggal</label>
                        <input type="date" name="sampai" id="sampai" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <table id="dataTable" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Sepatu</th>
                    <th>Nama Pemilik</th>
                    <th>Harga</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $orderDetail->nama_sepatu }}</td>
                        <td>{{ $orderDetail->nama_pemilik }}</td>
                        <td>{{ $orderDetail->harga }}</td>
                        <td>{{ $orderDetail->pendapatan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Include DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Other scripts -->
<script src="/sbadmin2/js/demo/datatables-demo.js"></script> 

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

@endpush
