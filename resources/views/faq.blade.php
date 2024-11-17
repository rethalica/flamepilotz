<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FAQ & Help Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    {{-- <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" /> --}}
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}">

    <style>
        * {
            font-family: "Montserrat", sans-serif;
        }

        .faq-header {
            background-color: transparent;
            padding: 3rem 0;
            text-align: center;
            margin-top: 80px;
            /* Tambahkan margin-top untuk memberi jarak dari navbar */
        }

        .faq-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .faq-search input {
            width: 100%;
            max-width: 500px;
            margin: 1rem auto;
            padding: 0.5rem;
        }

        .faq-item {
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .faq-item:hover {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .faq-item h5 {
            font-weight: 600;
            margin-top: 1rem;
            min-height: 60px;
        }

        .faq-icon {
            background-color: #ffecd1;
            color: #ff5722;
            font-size: 1.5rem;
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto;
        }

        .contact-box {
            background-color: #ffffff;
            padding: 1.5rem;
            text-align: center;
            border-radius: 8px;
            font-size: 1.1rem;
        }

        .btn-outline-primary {
            background: transparent;
            border: 2px solid #ffffff;
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: rgba(0, 123, 255, 0.1);
            border-color: #ffffff;
            color: #ffffff;
        }
    </style>
</head>

@extends ('includes.header')

@section('content')

    <body>
        <!-- Header Section -->
        <section class="faq-header">
            <h1>Ask us anything</h1>
            <p class="lead">Have any questions? We're here to assist you.</p>
            {{-- <div class="faq-search">
                <input type="text" class="form-control" placeholder="Search here" />
            </div> --}}
            <div class="faq-search">
                <a href="{{ route('helpcenter.index') }}" class="btn btn-outline">
                    <i class="bi bi-plus-circle"></i> Ask a Question
                </a>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="container my-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="faq-item h-100">
                        <div class="faq-icon">
                            <i class="bi bi-droplet-half"></i>
                        </div>
                        <h5>Bagaimana cara kerja alat pemadam?</h5>
                        <p>
                            Alat dapat menyemprotkan air dengan kontrol terpusat pada remote.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-item h-100">
                        <div class="faq-icon">
                            <i class="bi bi-water"></i>
                        </div>
                        <h5>Apa fungsi alat ini?</h5>
                        <p>
                            Sebagai langkah preventif dalam penanganan bencana kebakaran dalam
                            suatu gedung.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-item h-100">
                        <div class="faq-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <h5>Bagaimana cara menggunakan alat pemadam?</h5>
                        <p>
                            Pastikan alat mendapatkan daya, gunakan remote untuk mengontrol nozzle dan intensitas air
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-item h-100">
                        <div class="faq-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h5>Apa yang harus dilakukan ketika alat mengalami malfungsi?</h5>
                        <p>
                            Anda dapat melaporkan ke lobi untuk ditindak lanjuti.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-item h-100">
                        <div class="faq-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5>Apakah data pemantauan alat diambil secara real-time?</h5>
                        <p>
                            Ya, data yang digunakan diambil secara real-time dengan interval 5
                            menit.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-item h-100">
                        <div class="faq-icon">
                            <i class="bi bi-battery"></i>
                        </div>
                        <h5>Bagaimana cara mengganti baterai pada Ignis Guard?</h5>
                        <p>
                            Matikan alat dan cabut daya &gt; Buka casing baterai &gt; Lepaskan
                            konektor dan keluarkan baterai lama &gt; Pasang baterai baru &gt;
                            Sambungkan konektor dan tutup kembali casing.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Box Section -->
        <section class="container my-5">
            <div class="contact-box">
                <p>Masih bingung? Jangan ragu untuk menghubungi kami!</p>
                <a href="{{ route('helpcenter.index') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-question-circle me-2"></i>Ajukan Pertanyaan
                </a>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.js"></script>
    </body>

    </html>
@endsection
