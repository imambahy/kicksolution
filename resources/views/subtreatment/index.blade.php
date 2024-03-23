@extends('layout.app')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data subtreatment
        </h4>
        <h6 class="card-title">
            Pendataan Jasa Tambahan
        </h6>
    </div>
    <div class="card-body">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <div class="d-flex justify-content-end mb-4">
            <a href="#modal-form" class="btn btn-primary modal-tambah">Tambah Data</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jasa Tambahan</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Form subtreatment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-subtreatment" method="POST" action="{{ url('subtreatment/store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="">Nama Jasa Tambahan</label>
                            <input type="text" class="form-control" name="nama_subtreatment" id="nama_subtreatments" placeholder="Nama Service" required>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" id="" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" class="form-control" name="harga" placeholder="Harga" required>
                        </div>  
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<!-- modal update -->
<div class="modal fade" id="modal-form2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Update Data Jasa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-subtreatment" method="POST" action="{{ url('subtreatment/update/') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Jasa Tambahan</label>
                                <input type="text" class="form-control" name="nama_subtreatment" id="nama_subtreatment" placeholder="Nama Service" required>
                                <input type="hidden" name="id_subtreatment" id="id_subtreatment">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" id="deskripsi" cols="30" rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga" placeholder="harga" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

    <script>
        $(function(){

            $(window).on('load', function() {
                $('#nama_subtreatments').on('input', function() {
                    var input = $(this).val();
                    if (/\d/.test(input)) {
                        alert("Nama Jasa Utama tidak dapat diisi dengan angka");
                        $(this).val('');
                    }
                });
            });

            $.ajax({
                url : '/api/subtreatments',
                success : function ({data}) {

                    let row;
                    data.map(function(val, index){
                        row += `
                            <tr>
                                <td>${index+1}</td>  
                                <td>${val.nama_subtreatment}</td>    
                                <td>${val.deskripsi}</td>    
                                <td>${val.harga}</td>
                                <td>
                                    <a data-toggle="modal" href="#modal-form2" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>    
                                    <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">Hapus</a>    
                                </td>    
                            </tr>
                        `;
                    });
                $('tbody').append(row);
                }
            });

            $(document).on('click', '.btn-hapus',function(){
                const id = $(this).data('id');
                const token = localStorage.getItem('token');

                confirm_dialog = confirm('Apakah Anda yakin untuk menghapus data ini?');

                if(confirm_dialog){
                    $.ajax({
                        url : '/api/subtreatments/' + id,
                        type : "DELETE",
                        headers : {
                            "Authorization" : "" + localStorage.getItem('token')
                        },
                        success : function(data){
                            if(data.message == 'success'){
                                alert('Data Berhasil Dihapus');
                                location.reload();
                            }
                        }
                    });
                }
            });

            $('.modal-tambah').click(function(){
                $('#modal-form').modal('show');
            });

            $(document).on('click', '.modal-ubah', function(){
                $('#modal-form2').modal('show');

                var id = $(this).data('id');
                $.ajax({
                        url : '/subtreatment/edit/' + id,
                        type : "GET",
                        headers : {
                            "Authorization" : "" + localStorage.getItem('token')
                        },
                        success : function(data){
                            $('#id_subtreatment').val(data.id);
                            $('#deskripsi').val(data.deskripsi);
                            $('#nama_subtreatment').val(data.nama_subtreatment);
                            $('#harga').val(data.harga);
                            console.log(data);
                        }
                });
            });
        });
    </script>

@endpush
