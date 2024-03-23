@extends('layout.app')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data sepatu
        </h4>
        <h6 class="card-title">
            pendataan data sepatu
        </h6>
    </div>
    <div class="card-body">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="shoe-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Jasa</th>
                        <th>Jasa Utama</th>
                        <th>Jasa Tambahan</th>
                        <th>Nama Sepatu</th>
                        <th>Nama Pemilik</th>
                        <th>Alamat</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Ukuran</th>
                        <th>Warna</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($shoesWithKodeUnik as $shoe)
                    <tr>
                        <td>{{ $shoe->id }}</td>
                        <td>{{ $shoe->kode_unik }}</td>
                        <td>{{ $shoe->treatments->nama_treatment }}</td>
                        <td>{{ $shoe->subtreatments->nama_subtreatment }}</td>
                        <td>{{ $shoe->nama_sepatu }}</td>
                        <td>{{ $shoe->nama_pemilik }}</td>
                        <td>{{ $shoe->alamat }}</td>
                        <td>{{ $shoe->deskripsi }}</td>
                        <td><img src="{{ asset('uploads/') }}/{{ $shoe->gambar }}" alt="Gambar Sepatu" width="100"></td>
                        <td>{{ $shoe->ukuran }}</td>
                        <td>{{ $shoe->warna }}</td>
                        <td>{{ $shoe->total }}</td>
                        <td>
                            <a data-toggle="modal" href="#modal-form2" data-id="{{ $shoe->id }}" class="btn btn-warning modal-ubah">Edit</a>
                            <a href="#" data-id="{{ $shoe->id }}" class="btn btn-danger btn-hapus">Hapus</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
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
                        <form class="form-shoe" method="POST" action="{{ url('/shoe/update/') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Kode Unik</label>
                                <input type="text" class="form-control" id="kode_unik" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Main Service</label>
                                <select name="id_treatment" id="id_treatment" class="form-control">
                                    <option value="#">Pilih Jasa Utama</option>
                                    @foreach ($treatments as $treat)
                                        <option value="{{ $treat->id }}">{{ $treat->nama_treatment }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="">Optional Service</label>
                                <select name="id_subtreatment" id="id_subtreatment" class="form-control">
                                    <option value="#">Pilih Jasa Tambahan</option>
                                    @foreach ($subtreatments as $subtreat)
                                        <option value="{{ $subtreat->id }}">{{ $subtreat->nama_subtreatment }}</option>
                                    @endforeach
                                    <option value="0">Tidak menggunakan jasa tambahan</option> <!-- Opsi "tidak menggunakan jasa tambahan" -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Sepatu</label>
                                <input type="text" class="form-control" id="nama_sepatu" name="nama_sepatu" placeholder="Nama Sepatu" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" id="nama_pemilik" class="form-control" name="nama_pemilik" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" placeholder="Alamat Lengkap" class="form-control" id="alamat" cols="30" rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" id="deskripsi" class="form-control" name="deskripsi" placeholder="deskripsi" required>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <div class="form-group">
                                <label for="ukuran">Ukuran</label>
                                <select class="form-control" name="ukuran" id="ukuran" required>
                                    <option value="#">---Pilih Ukuran Sepatu---</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <!-- Tambahkan lebih banyak opsi sesuai kebutuhan -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Warna</label>
                                <input type="text" class="form-control" id="warna" name="warna" placeholder="Warna Sepatu" required>
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

            $(document).on('click', '.btn-hapus', function() {
            // Ambil ID data yang akan dihapus dari atribut data-id
            var id = $(this).data('id');
            
            // Konfirmasi penghapusan
            var confirm_dialog = confirm('Apakah Anda yakin untuk menghapus data ini?');
            
            // Jika pengguna mengonfirmasi penghapusan
            if (confirm_dialog) {
                // Kirim permintaan DELETE ke endpoint penghapusan
                $.ajax({
                    url: '/api/shoes/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Jangan lupa untuk menyertakan CSRF token
                    },
                    success: function(data) {
                        // Jika penghapusan berhasil
                        if (data.message === 'success') {
                            alert('Data berhasil dihapus');
                            // Muat ulang halaman setelah penghapusan
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan jika permintaan penghapusan gagal
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat menghapus data');
                    }
                });
            }
        });

            $(document).on('click', '.modal-ubah', function(){
                $('#modal-form2').modal('show');

                var id = $(this).data('id');
                $.ajax({
                        url : '/shoe/edit/' + id,
                        type : "GET",
                        headers : {
                            "Authorization" : "" + localStorage.getItem('token')
                        },
                        success : function(data){
                            $('#id_treatment').val(data.id_treatment);
                            $('#kode_unik').val(data.kode_unik);
                            $('#id_subtreatment').val(data.id_subtreatment);
                            $('#nama_sepatu').val(data.nama_sepatu);
                            $('#nama_pemilik').val(data.nama_pemilik);
                            $('#alamat').val(data.alamat);
                            $('#deskripsi').val(data.deskripsi);
                            $('#ukuran').val(data.ukuran);
                            $('#warna').val(data.warna);
                            console.log(data);
                        }
                });
            });
        });

    </script>

@endpush
