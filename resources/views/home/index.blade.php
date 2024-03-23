@extends('layout.home')

@section('flyout')
    <div class="dropdown-nav__container container-xxl d-flex align-items-center justify-content-center">
        <div class="col">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('errors'))
            <div class="alert alert-danger">
                {{ session('errors') }}
            </div>
            @endif

            <br />
            <form id="checkOrderForm" method="POST" action="{{ route('check.order') }}">
                @csrf
                <div class="mb-3">
                    <label for="kodeUnik" class="form-label">Masukkan Kode Unik Anda:</label>
                    <input type="text" class="form-control" id="kodeUnik" name="kode_unik" placeholder="Kode Unik" required>
                </div>
                <button type="submit" class="btn btn-primary">Cek Status Pesanan</button>
            </form>
            <br />
            @if(session('nama_pemilik') && session('status_pesanan'))
                <div class="lead mb-4">
                    <p>Hi {{ session('nama_pemilik') }} dengan kode {{ session('kode_unik')}}, status pesanan Anda "{{ session('status_pesanan') }}"</p>
                </div>
            @endif

            <!-- Menampilkan tahap pesanan -->
            <div class="text-end">
                <ul class="list-unstyled">
                    <li><i class="bi bi-check-circle-fill {{ session('status_pesanan') == 'Baru' ? 'text-success' : 'text-muted' }}"></i> Tahap 1 -> Baru</li>
                    <li><i class="bi bi-check-circle-fill {{ session('status_pesanan') == 'Dikonfirmasi' ? 'text-success' : 'text-muted' }}"></i> Tahap 2 -> Dikonfirmasi</li>
                    <li><i class="bi bi-check-circle-fill {{ session('status_pesanan') == 'Dicuci' ? 'text-success' : 'text-muted' }}"></i> Tahap 3 -> Dicuci</li>
                    <li><i class="bi bi-check-circle-fill {{ session('status_pesanan') == 'Dikirim' ? 'text-success' : 'text-muted' }}"></i> Tahap 4 -> Dikirim</li>
                    <li><i class="bi bi-check-circle-fill {{ session('status_pesanan') == 'Diterima' ? 'text-success' : 'text-muted' }}"></i> Tahap 5 -> Diterima</li>
                    <li><i class="bi bi-check-circle-fill {{ session('status_pesanan') == 'Selesai' ? 'text-success' : 'text-muted' }}"></i> Tahap 6 -> Selesai</li>
                </ul>
            </div>
        </div>

        <button class="navbar-toggler dropdown-nav__closeNavBtn" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
        </button>
    </div>

@endsection


@section('bookNow')
<a href="#" class="mt-2 btn btn-lg btn-outline-light bookNowBtn" role="button" onclick="openModal()">Book Now</a>
@endsection
