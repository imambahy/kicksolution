<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KICKS | A Shoe Treatment</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- main stylesheet -->
    <link rel="stylesheet" href="/kicksFront/css/main.css">
    
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  
</head>
<body>
    
    <!-- Header Start -->
    <header class="header p-3 position-absolute start-0 top-0 end-0">
        <div class="d-flex justify-content-between align-items-center">
            <a href="/" class="text-decoration-none text-white fs-5 fw-bold">KICKSOLUTION</a>
            <div>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    Cek Status <i class="bi bi-arrow-right-short"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- flyout-navigation-start -->
        <nav class="collapse navbar-collapse dropdown-nav" id="navbar">
            @yield('flyout')
        </nav> 
    <!-- flyout-navigation-end -->
        
    <!-- hero start -->
    <section class="hero">

        <div class="hero__overlay"></div>
        </div>

        <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" loading="lazy" class="hero__video">
            <source src="/kicksFront/img/cinematic2.mp4" type="video/mp4" >
        </video>

        <div class="hero__content h-100 container-custom position-relative">
            <div class="d-flex h-100 align-items-center hero__content-width">
                <div class="text-white">
                    <h1 class="hero__heading fw-bold mb-4">It's a wash day!</h1>
                    <p class="lead mb-4">We provide the best quality treatment for your favorite shoes.</p>
                    <!-- <a id="bookNowBtn" href="https://wa.me/6281283646611?text=Hello%20I%20want%20to%20book%20now" class="mt-2 btn btn-lg btn-outline-light" role="button">Book Now</a>
                   -->
                   @yield('bookNow')
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Registrasi Pemesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-shoe" method="POST" action="{{ route('home_regist') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Pastikan untuk menambahkan ID treatment, ID subtreatment, dan Nama pemilik -->
                                    <input type="hidden" value="">
                                    <div class="form-group">
                                        <label for="">Jasa Utama</label>
                                        <select name="id_treatment" id="id_treatment" class="form-control">
                                            <option value="#">Pilih Jasa Utama</option>
                                            @foreach ($treatments as $treat)
                                            <option value="{{ $treat->id }}" data-harga="{{ $treat->harga }}">{{ $treat->nama_treatment }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jasa Tambahan</label>
                                        <select name="id_subtreatment" id="id_subtreatment" class="form-control">
                                            <option value="#">Pilih Jasa Tambahan</option>
                                            @foreach ($subtreatments as $subtreat)
                                            <option value="{{ $subtreat->id }}">{{ $subtreat->nama_subtreatment }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Sepatu</label>
                                        <input type="text" class="form-control" name="nama_sepatu" placeholder="Nama Sepatu" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="Nama Lengkap" required>
                                    </div>
                                    <!-- Akhir bagian formulir -->
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" placeholder="alamat" class="form-control" id="alamat" cols="30" rows="10" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Deskripsi</label>
                                        <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gambar</label>
                                        <input type="file" class="form-control" name="gambar" required>
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
                                        <button id="submitBtn" type="submit" class="btn btn-light btn-block">Submit</button>
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


        <a href="#scroll-down" class="hero__scroll-btn">
            Let's Take a Look! <i class="bi bi-arrow-down-short"></i>
        </a>
    </section>
    <!-- hero end -->

    <a id="scroll-down"></a>
    
    <!-- section one start -->
    <section class="steps container-custom">
        <div class="row">
            <div id="deepclean" class="carousel slide col-12 col-sm-6 d-md-flex justify-content-md-center" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#deepclean" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#deepclean" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#deepclean" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#deepclean" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#deepclean" data-bs-slide-to="4"></button>
                    <button type="button" data-bs-target="#deepclean" data-bs-slide-to="5"></button>
                  </div>
                
                  <!-- The slideshow/carousel -->
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="/kicksFront/img/bdawal.jpg" alt="Los Angeles" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                      <img src="/kicksFront/img/bd2.jpg" alt="Chicago" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                      <img src="/kicksFront/img/bd3.jpg" alt="New York" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="/kicksFront/img/ad1.jpg" alt="New York" class="d-block w-100">
                      </div>
                      <div class="carousel-item">
                        <img src="/kicksFront/img/ad2.jpg" alt="New York" class="d-block w-100">
                      </div>
                      <div class="carousel-item">
                        <img src="/kicksFront/img/ad3.jpg" alt="New York" class="d-block w-100">
                      </div>
                  </div>
                
                  <!-- Left and right controls/icons -->
                  <button class="carousel-control-prev" type="button" data-bs-target="#deepclean" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#deepclean" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                  </button>
            </div>
            <div class="col-12 col-sm-6 align-self-center justify-content-md-center">
                <div class="steps__content-width">
                    <span>01</span>
                    <h1 class="h2 mb-4">Deep Clean</h1>
                    <p class="mb-4">
                        In this section, we introduce the 'Deep Clean' treatment, an essential process in shoe care that involves a thorough cleaning of the shoes. This method is designed to remove deep-seated dirt, stains, and contaminants from the material. Using specialized cleaning agents and techniques, the deep clean treatment ensures a comprehensive cleansing of the shoes, contributing to their overall hygiene and extending their longevity. Whether it's removing stubborn marks or revitalizing the overall cleanliness, the deep clean treatment is a crucial step in maintaining the quality and appearance of your favorite shoes.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- section one end -->
    
    <!-- section two start -->
    <section class="steps steps--background">
        <div class="container-custom">
            <div class="row">
                <div id="unyellowing" class="carousel slide col-12 col-sm-6 d-md-flex justify-content-md-center order-sm-1" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#unyellowing" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#unyellowing" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#unyellowing" data-bs-slide-to="2"></button>
                      </div>
                    
                      <!-- The slideshow/carousel -->
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="/kicksFront/img/ba1.jpg" alt="Los Angeles" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                          <img src="/kicksFront/img/by1.jpg" alt="Chicago" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                          <img src="/kicksFront/img/ay1.jpg" alt="New York" class="d-block w-100">
                        </div>
                      </div>
                    
                      <!-- Left and right controls/icons -->
                      <button class="carousel-control-prev" type="button" data-bs-target="#unyellowing" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#unyellowing" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                      </button>
                </div>
                <div class="col-12 col-sm-6 align-self-center justify-content-md-center">
                    <div class="steps__content-width">
                        <span>02</span>
                        <h1 class="h2 mb-4">Unyellowing</h1>
                        <p class="mb-4">
                        In this section, we provide a brief overview of the 'unyellowing' treatment, a specialized process in shoe care designed to address yellowing effects on the material. This phenomenon commonly occurs in white or light-colored shoes due to exposure to sunlight or prolonged use. The unyellowing treatment involves the use of specific solutions or materials crafted to eliminate or reduce the yellowing effect, with the goal of restoring the shoe's original color and making it appear fresher and cleaner.
                    </p>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section two end -->

    <!-- section three start -->
    <section class="steps container-custom">
        <div class="row">
            <div id="justForHer" class="carousel slide col-12 col-sm-6 d-md-flex justify-content-md-center" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#justForHer" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#justForHer" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#justForHer" data-bs-slide-to="2"></button>
                  </div>
                
                  <!-- The slideshow/carousel -->
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="/kicksFront/img/baj.jpg" alt="Los Angeles" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                      <img src="/kicksFront/img/bj1.jpg" alt="Chicago" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                      <img src="/kicksFront/img/aj1.jpg" alt="New York" class="d-block w-100">
                    </div>
                  </div>
                
                  <!-- Left and right controls/icons -->
                  <button class="carousel-control-prev" type="button" data-bs-target="#justForHer" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#justForHer" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                  </button>
            </div>
            <div class="col-12 col-sm-6 align-self-center justify-content-md-center">
                <div class="steps__content-width">
                    <span>03</span>
                    <h1 class="h2 mb-4">Just For Her</h1>
                    <p class="mb-4">
                        This section introduces the 'Just For Her' treatment, a specialized care process tailored for women's shoes. 'Just For Her' focuses on enhancing the unique features and design elements specific to women's footwear. Whether it involves delicate materials, intricate embellishments, or specific color palettes, this treatment is designed to preserve and highlight the distinct qualities of women's shoes. The process may include targeted cleaning, conditioning, and protection measures to ensure the longevity and beauty of the shoes, providing a dedicated care routine for footwear that complements the feminine style.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- section three end -->

    <!-- Footer Start -->
    <footer class="text-white p-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <p class="mb-0">&copy; 2024 KICKSOLUTION. All rights reserved. Designed by <a href="https://github.com/imambahy" class="text-white">__hipox</a></p>
                </div>
                <div class="col-lg-6 mx-auto">
                    <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
                    <a href="https://www.instagram.com/kickssolution.id/" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    // Fungsi untuk membuka pop-up modal
    function openModal() {
        $('#modal-form').modal('show');
    }

    // Fungsi untuk menghitung total harga secara otomatis
    function calculateTotal() {
        var mainServicePrice = parseFloat($('#id_treatment option:selected').data('harga')) || 0;
        var additionalServicePrice = parseFloat($('#id_subtreatment option:selected').data('harga')) || 0;
        var total = mainServicePrice + additionalServicePrice;
        $('#total-price').val(total.toFixed(2));
    }

    // Panggil fungsi calculateTotal saat jasa utama atau jasa tambahan berubah
    $('#id_treatment, #id_subtreatment').change(function() {
        calculateTotal();
    });

    
    // Function to submit the form
    function submitForm(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        
        // Validasi input angka pada nama pemilik dan warna
        var namaPemilik = $('#nama_pemilik').val();
        var warnaSepatu = $('#warna').val();

        if(containsNumber(namaPemilik&&warnaSepatu)){
            alert("Nama Lengkap dan Warna tidak dapat diisi oleh angka.");
            return;
        }
        
        if (containsNumber(namaPemilik)) {
            // Jika terdapat angka pada nama pemilik, tampilkan alert
            alert("Nama Lengkap tidak dapat diisi oleh angka.");
            return; // Hentikan proses submit jika terdapat angka pada input
        }

        if (containsNumber(warnaSepatu)) {
            // Jika terdapat angka pada warna, tampilkan alert
            alert("Warna tidak dapat diisi oleh angka.");
            return; // Hentikan proses submit jika terdapat angka pada input
        }
        
        var formData = new FormData($('.form-shoe')[0]); // Use FormData for file uploads
        
        $.ajax({
        type: 'POST',
        url: $('.form-shoe').attr('action'),
        data: formData,
        processData: false, // Don't process the data
        contentType: false, // Don't set contentType
        success: function(response) {
        // Get the unique code from the response
        var uniqueCode = response.kode_unik;

        // Prepare the WhatsApp message
        var treatmentName = $('#id_treatment option:selected').text();
        var subtreatmentName = $('#id_subtreatment option:selected').text();
        var nama_pemilik = $('#nama_pemilik').val();
        var alamat = $('#alamat').val();
        var message = "Hi, saya " + nama_pemilik + " ingin memesan jasa " + treatmentName + " dan " + subtreatmentName + " dengan nomor unik: " + uniqueCode + " dan alamat saya di " + alamat;

        // Redirect to WhatsApp with the message
        var phoneNumber = "6287786456696";
        var url = "https://wa.me/" + phoneNumber + "?text=" + encodeURIComponent(message);
        window.location.href = url;
        },
        error: function(xhr, status, error) {
        console.error(xhr.responseText);
        alert("Error occurred. Please try again.");
        }
    });
    }
    
    function containsNumber(inputString) {
        return /\d/.test(inputString);
    }

        $('.form-shoe').submit(function(event) {
        submitForm(event);
    });
</script>

<script>
    $('.modal-header .close, .modal-footer button[data-dismiss="modal"]').on('click', function() {
        $('#modal-form').modal('hide');
    });
</script>

</html>