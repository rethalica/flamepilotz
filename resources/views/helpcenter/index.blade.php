@extends('includes.header')

@section('content')
    <div class="container content-container min-vh-100 py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                @if ($helpCenters->isEmpty())
                    <!-- Jika user belum memiliki bantuan, tampilkan form -->
                    <div class="card border-0 shadow-lg p-4">
                        <div class="card-header bg-transparent text-center">
                            <h3 class="fw-bold text-gradient">Form Pengajuan Bantuan</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('helpcenter.store') }}" method="POST">
                                @csrf
                                <!-- Title Input -->
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">Judul Permintaan:</label>
                                    <input type="text" id="title" name="title" class="form-control border-primary"
                                        placeholder="Masukkan judul permintaan Anda" required>
                                </div>

                                <!-- Description Input -->
                                <div class="mb-3">
                                    <label for="description" class="form-label fw-bold">Deskripsi Permintaan:</label>
                                    <textarea id="description" name="description" rows="4" class="form-control border-primary"
                                        placeholder="Jelaskan kendala yang Anda hadapi secara rinci" required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg fw-bold">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Jika user sudah memiliki bantuan, tampilkan history -->
                    <div class="card border-0 shadow-lg p-4 mb-5">
                        <div class="card-header bg-transparent text-center">
                            <h3 class="fw-bold text-gradient">History Bantuan Anda</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($helpCenters as $help)
                                <div class="history-item border p-4 mb-4 rounded">
                                    <div class="row">
                                        <!-- Nama -->
                                        <div class="col-md-6 mb-3">
                                            <div class="p-3 bg-light border rounded">
                                                <strong>Nama:</strong>
                                                <p>{{ Auth::user()->name }}</p>
                                            </div>
                                        </div>

                                        <!-- Judul Permintaan -->
                                        <div class="col-md-6 mb-3">
                                            <div class="p-3 bg-light border rounded">
                                                <strong>Judul Permintaan:</strong>
                                                <p>{{ $help->title }}</p>
                                            </div>
                                        </div>

                                        <!-- Deskripsi Permintaan -->
                                        <div class="col-md-12 mb-3">
                                            <div class="p-3 bg-light border rounded">
                                                <strong>Deskripsi:</strong>
                                                <p>{{ $help->description }}</p>
                                            </div>
                                        </div>

                                        <!-- Tanggal Diajukan -->
                                        <div class="col-md-6 mb-3">
                                            <div class="p-3 bg-light border rounded">
                                                <strong>Tanggal Diajukan:</strong>
                                                <p>{{ $help->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-6 mb-3">
                                            <div class="p-3 bg-light border rounded">
                                                <strong>Status:</strong>
                                                <p>{{ ucfirst($help->status) }}</p>
                                            </div>
                                        </div>

                                        <!-- Respon Admin -->
                                        <div class="col-md-12 mb-3">
                                            <div class="p-3 bg-light border rounded">
                                                <strong>Respon Admin:</strong>
                                                <p>
                                                    @if ($help->response)
                                                        {{ $help->response }}
                                                    @else
                                                        <span class="text-muted fw-bold">Menunggu respon dari admin</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
