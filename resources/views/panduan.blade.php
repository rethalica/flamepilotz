@extends('includes.header')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown font-bold" data-wow-delay="0.1s">
                Panduan Alat
            </h4>
        </div>
    </div>
    <!-- Header End -->

    <!-- Service Start -->
    <div class="container py-5">
        <div class="row gx-4 gy-4">
            <!-- Card 1 -->
            <div class="col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="card h-100 bg-white shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="service-btn me-3">
                                <i class="fas fa-hand-holding-water text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-0">Cara Kerja Alat</h5>
                        </div>
                        <p class="card-text flex-grow-1">
                            Beroperasi dengan mendeteksi tanda-tanda kebakaran menggunakan sensor, memproses informasi
                            tersebut melalui mikrokontroler, dan kemudian menyemprotkan air secara manual dengan remote
                            kontrol. Alat ini dirancang untuk merespons cepat terhadap potensi kebakaran.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay="0.3s">
                <div class="card h-100 bg-white shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="service-btn me-3">
                                <i class="fas fa-dumpster-fire text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-0">Fungsi Alat</h5>
                        </div>
                        <p class="card-text flex-grow-1">
                            Alat ini dapat menjangkau area yang lebih luas saat menyemprotkan air dengan rotasi 180°.
                            Dapat dikendalikan dari jarak jauh melalui remote kontrol yang terhubung ke bluetooth.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay="0.4s">
                <div class="card h-100 bg-white shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="service-btn me-3">
                                <i class="fas fa-filter text-white fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-0">Cara Menggunakan Alat</h5>
                        </div>
                        <p class="card-text flex-grow-1">
                            Pastikan alat berada di permukaan yang datar dan stabil serta semua komponen terhubung dengan
                            baik (sensor, pompa, dan mikrokontroler). Pastikan juga tangki air terisi cukup. Nyalakan
                            alat dan pastikan lampu indikator menyala, menunjukkan bahwa alat siap digunakan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
@endsection
