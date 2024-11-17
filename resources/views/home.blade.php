@extends ('includes.header')

@section('content')
    <!-- Landing Hero Section (Mengganti Carousel) -->
    <div class="container-fluid landing-hero pt-5 mt-5" id="landing-hero">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column (Text) -->
                <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold text-white mb-4">Selamat Datang di Website FlamePilot</h1>
                    <hr class="bg-white w-50 mb-4">
                    <p class="lead text-white mb-4">
                        Flame Pilot hadir sebagai pendamping tepercaya bagi tim pemadam kebakaran. Kami menyediakan
                        teknologi terkini untuk memantau kapasitas air secara real-time, serta panduan lengkap mengenai
                        alat-alat yang digunakan. Dengan fitur intuitif, admin maupun karyawan dapat berbagi informasi,
                        memberikan laporan kondisi lapangan, dan meningkatkan efisiensi dalam setiap tugas pemadaman.
                    </p>
                    <a href="#kenali-fitur" class="btn btn-outline-light py-3 px-5">Pelajari Lebih Lanjut</a>
                </div>
                <!-- Right Column (Image of Tool) -->
                <div class="col-lg-6 col-md-12 text-center">
                    <img src="{{ asset('assets/img/alat.png') }}" class="img-fluid rounded" alt="Gambar Alat">
                </div>
            </div>
        </div>
    </div>
    <!-- Landing Hero Section End -->

    <!-- Feature Start -->
    <div class="container-fluid feature py-5" id="kenali-fitur">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp">
                <h1 class="display-5 text-capitalize mb-3 fw-semibold text-white">Penasaran? Kenali Fitur Unggulan Kami!
                </h1>
            </div>
            <div class="row g-4 justify-content-center text-center">
                <div class="col-12 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="feature-item p-4 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-fire-extinguisher text-white fa-3x"></i>
                        </div>
                        <a href="{{ route('monitoring') }}" class="h4 mb-3 fw-semibold ">Pemantauan Alat</a>
                        <p class="mb-3">Monitoring Baterai, Kapasitas Air, dan Suhu secara Real Time!</p>
                        <a href="{{ route('monitoring') }}" class="btn text-secondary">Klik untuk lebih lanjut <i
                                class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="feature-item p-4 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-book text-white fa-3x"></i>
                        </div>
                        <a href="{{ route('panduan') }}" class="h4 mb-3 fw-semibold">Panduan Alat</a>
                        <p class="mb-3">Ayo tambah wawasan kamu, yuk belajar!</p>
                        <a href="{{ route('panduan') }}" class="btn text-secondary">Klik untuk lebih lanjut <i
                                class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="feature-item p-4 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-question text-white fa-3x"></i>
                        </div>
                        <a href="{{ route('faq') }}" class="h4 mb-3 fw-semibold">FAQ</a>
                        <p class="mb-3">Masih bingung? tanyakan pada admin sekarang</p>
                        <a href="{{ route('faq') }}" class="btn text-secondary">Klik untuk lebih lanjut <i
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
                <h1 class="display-5 text-capitalize mb-3 fw-semibold text-white">Tim Kami</h1>
            </div>
            <div class="row g-4 justify-content-center text-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm team-card">
                        <div class="card-body">
                            <h5 class="card-title">Rafa Maritza</h5>
                            <p class="card-text">UI/UX Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm team-card">

                        <div class="card-body">
                            <h5 class="card-title">Rania Najla Abdillah</h5>
                            <p class="card-text">Quality Assurance</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm team-card">

                        <div class="card-body">
                            <h5 class="card-title">Ravindra Yardan Mukti</h5>
                            <p class="card-text">Project Manager & Backend</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm team-card">
                        <div class="card-body">
                            <h5 class="card-title">Shafa Nada</h5>
                            <p class="card-text">Kanban Flow Manager</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm team-card">
                        <div class="card-body">
                            <h5 class="card-title">Selsi Liztia Harahap</h5>
                            <p class="card-text">Frontend Developer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end TIM KAMI -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
@endsection
