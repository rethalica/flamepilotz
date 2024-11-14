@extends ('includes.header')

@section('content')
    <!-- Carousel Start -->
    <div class="carousel-header">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/img/bg-1.jpg') }}" class="img-fluid w-100" alt="Carousel Image 1">
                    <div class="carousel-caption-1">
                        <div class="carousel-caption-1-content" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4 fadeInLeft animated">FlamePilot</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4 fadeInLeft animated">Selamat Datang
                                di FlamePilot</h1>

                            <div class="carousel-caption-1-content-btn fadeInLeft animated">
                                <a class="btn btn-primary rounded-pill flex-shrink-0 py-3 px-5 me-2"
                                    href="{{ route('login') }}">Login</a>
                                <a class="btn btn-secondary rounded-pill flex-shrink-0 py-3 px-5 ms-2"
                                    href="{{ route('monitoring') }}">Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Feature Start -->
    <div class="container-fluid feature bg-light py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp">
                <h4 class="text-uppercase text-primary">Haloo!!!!!</h4>
                <h1 class="display-3 text-capitalize mb-3">Penasaran? Kenali Fitur Unggulan Kami!</h1>
            </div>
            <div class="row g-4 justify-content-center text-center">
                <div class="col-md-6 col-lg-4 wow fadeInUp">
                    <div class="feature-item p-4 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-hand-holding-water text-white fa-3x"></i>
                        </div>
                        <a href="#" class="h4 mb-3">Pemantauan Alat</a>
                        <p class="mb-3">Monitoring Baterai, Kapasitas Air, dan Suhu secara Real Time!</p>
                        <a href="{{ route('monitoring') }}" class="btn text-secondary">Klik untuk lebih lanjut <i
                                class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp">
                    <div class="feature-item p-4 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-filter text-white fa-3x"></i>
                        </div>
                        <a href="#" class="h4 mb-3">Panduan Alat</a>
                        <p class="mb-3">Ayo tambah wawasan kamu, yuk belajar!</p>
                        <a href="service.html" class="btn text-secondary">Klik untuk lebih lanjut <i
                                class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp">
                    <div class="feature-item p-4 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-recycle text-white fa-3x"></i>
                        </div>
                        <a href="#" class="h4 mb-3">Pusat Bantuan</a>
                        <p class="mb-3">Masih bingung? tanyakan pada admin sekarang</p>
                        <a href="bantuan.html" class="btn text-secondary">Klik untuk lebih lanjut <i
                                class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- TIM KAMI -->
    <div class="container-fluid team pb-5">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp">
                <h1 class="display-3 text-capitalize mb-3">Tim Kami</h1>
            </div>
            <div class="team-container">
                <div class="team-item">
                    <h4>Rafa Maritza</h4>
                </div>
                <div class="team-item">
                    <h4>Rania Najla Abdillah</h4>
                </div>
                <div class="team-item">
                    <h4>Ravindra Yardan Mukti</h4>
                </div>
                <div class="team-item">
                    <h4>Shafa Nada Putri</h4>
                </div>
                <div class="team-item">
                    <h4>Selsi Liztia Harahap</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- end TIM KAMI -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-body"><a href="#" class="border-bottom text-white">
                            <i class="fas fa-copyright text-light me-2"></i>Attack ON RPL | 2024</a>
                    </span>
                </div>
                <div class="col-md-6 text-center text-md-end text-body">
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
@endsection
