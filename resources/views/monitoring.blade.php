<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FlamePilot | Device Monitoring</title>
    <link rel="icon" href="{{ asset('favicon/logo.ico') }}" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        /* custom.css */
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
        }

        aside {
            background-color: #070201;
        }

        .shadow-lg {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        #status.normal {
            color: green;
        }

        #status.tidak-aman {
            color: red;
        }

        /* Custom color scheme */
        .primary-color {
            color: #146FF5;
        }

        .bg-primary {
            background-color: #146FF5;
        }

        .text-muted {
            color: #6B7280;
        }

        .bg-card {
            background-color: #FFFFFF;
        }

        *** Navbar Start ***/

        /* Navbar Container */
        .navbar-light {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            background-color: var(--bs-light);
            border-bottom: 1px dotted var(--bs-dark);
            z-index: 999;
        }

        /* Navbar Links - Bold Font */
        .navbar-light .navbar-nav .nav-link {
            position: relative;
            margin-right: 25px;
            padding: 35px 0;
            color: var(--bs-dark);
            font-size: 17px;
            font-weight: 700;
            /* Changed to 700 for bold font */
            transition: color 0.3s;
            /* Adjust transition for color only */
        }

        /* Active and Hover States for Links */
        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link.active {
            color: var(--bs-primary);
            font-weight: 700;
            /* Ensure bold on hover and active */
        }

        /* Dropdown Menu on Hover */
        .navbar .nav-item:hover .dropdown-menu {
            transform: rotateX(0deg);
            visibility: visible;
            opacity: 1;
            background: var(--bs-light);
            transition: opacity 0.3s;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .navbar.navbar-expand-lg .navbar-toggler {
                padding: 10px 20px;
                border: 1px solid var(--bs-primary);
                color: var(--bs-primary);
            }

            .navbar-light .navbar-collapse {
                margin-top: 15px;
                border-top: 1px solid rgba(0, 0, 0, 0.08);
            }

            /* Adjust Navbar Links for Mobile */
            .navbar-light .navbar-nav .nav-link {
                padding: 10px 0;
                margin-left: 0;
                color: var(--bs-dark);
                font-weight: 700;
                /* Ensure bold on mobile as well */
            }

            /* Navbar Brand Image for Mobile */
            .navbar-light .navbar-brand img {
                max-height: 45px;
            }

            /* Chart container adjustments */
            #chart-container {
                max-height: 300px;
                /* Reduce chart height */
                overflow: hidden;
            }
        }

        /*** Navbar End ***/
    </style>
</head>

<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-[#070201] shadow-md px-4 px-lg-5 py-3 py-lg-0">
        <h1 class="navbar-brand d-flex align-items-center text-primary fw-bold" style="font-size: 1.75rem;">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Flame Pilot Logo" class="me-3"
                style="width: 50px; height: auto;">
            FlamePilot
        </h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto py-0">
                <li class="nav-item">
                    <a href="index.html" class="nav-link fw-bold primary-color">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('monitoring') }}" class="nav-item nav-link fw-bold">Monitoring</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link mx-1 fw-bold" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link mx-1 fw-bold" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex flex-col lg:flex-row main-content-wrapper">
        <!-- Sidebar -->
        <aside class="w-full lg:w-1/5 bg-[#070201] lg:min-h-screen p-5 text-white sidebar-wrapper">
            <h1 class="text-2xl font-bold mb-8 primary-color">FlamePilot</h1>
            <nav>
                <h2 class="text-lg font-semibold mb-4 text-light">Pilih Ruangan</h2>
                <select id="room-select" class="w-full p-2 rounded bg-gray-800 text-white focus:outline-none">
                    @foreach ($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->name }}</option>
                    @endforeach
                </select>
            </nav>
        </aside>

        <!-- Main Content wrap -->
        <main class="flex-1 p-6">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold mb-4 sm:mb-0 primary-color">Device Monitoring</h2>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Template for each Card -->
                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">
                        Ruangan: <span id="room-name">{{ $devices->first()->name ?? '-' }}</span>
                    </h3>
                    <p class="text-muted">Lokasi: <span
                            id="room-location">{{ $devices->first()->location ?? '-' }}</span></p>
                </div>

                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Suhu Ruangan</h3>
                    <p class="text-2xl font-bold primary-color" id="temperature">
                        {{ $devices->first()->latestLog->temperature ?? '-' }}°C</p>
                </div>

                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Baterai</h3>
                    <p class="text-2xl font-bold primary-color" id="battery">
                        {{ $devices->first()->latestLog->battery_level ?? '-' }}%</p>
                </div>

                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Water Level</h3>
                    <p class="text-2xl font-bold primary-color" id="water-level">
                        {{ $devices->first()->latestLog->water_level ?? '-' }}%</p>
                </div>

                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Smoke Level</h3>
                    <p class="text-2xl font-bold text-red-500" id="smoke-level">
                        {{ $devices->first()->latestLog->smoke_level ?? '-' }}%</p>
                </div>

                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Status</h3>
                    <p id="status"
                        class="text-2xl font-bold {{ $devices->first()->latestLog->status == 'normal' ? 'text-green-500' : 'text-red-500' }}">
                        {{ $devices->first()->latestLog->status ?? '-' }}</p>
                </div>
            </div>

            <!-- Graph Section -->
            <!-- Graph Section -->
            <div id="chart-container" class="mt-6 bg-card p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-4 text-muted">Temperature & Smoke Level trend</h3>
                <canvas id="tempSmokeChart" class="w-full"></canvas>
            </div>
        </main>
    </div>


    <!-- Bootstrap JS (required for navbar collapse functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Update Room Details
        //Fetch room details based on selected device ID

        function fetchRoomDetails(deviceId) {
            fetch(`/monitoring/${deviceId}/details`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("room-name").textContent = data.name;
                    document.getElementById("room-location").textContent = data.location;
                    document.getElementById("temperature").textContent = `${data.temperature}°C`;
                    document.getElementById("battery").textContent = `${data.battery_level}%`;
                    document.getElementById("water-level").textContent = `${data.water_level}%`;
                    document.getElementById("smoke-level").textContent = `${data.smoke_level}%`;

                    // Update status color based on status value
                    document.getElementById("status").textContent = data.status;
                    document.getElementById("status").className = "text-2xl font-bold " +
                        (data.status.toLowerCase() === 'normal' ? 'text-green-500' : 'text-red-500');
                })
                .catch(error => console.error('Error fetching room details:', error));
        }

        function updateChart(selectedDeviceId) {
            fetch(`/monitoring/${selectedDeviceId}/logs`)
                .then(response => response.json())
                .then(data => {
                    const temperatures = data.map(log => log.temperature);
                    const smokeLevels = data.map(log => log.smoke_level);
                    const timeLabels = data.map(log => log.time);

                    tempSmokeChart.data.labels = timeLabels;
                    tempSmokeChart.data.datasets[0].data = temperatures;
                    tempSmokeChart.data.datasets[1].data = smokeLevels;
                    tempSmokeChart.update();
                });
        }


        const ctx = document.getElementById("tempSmokeChart").getContext("2d");
        const tempSmokeChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                        label: "Temperature (°C)",
                        data: [],
                        borderColor: "#146FF5",
                        backgroundColor: "rgba(20, 111, 245, 0.2)",
                        fill: true,
                    },
                    {
                        label: "Smoke Level (%)",
                        data: [],
                        borderColor: "rgba(255, 99, 132, 1)",
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        fill: true,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        const initialDeviceId = document.getElementById("room-select").value;
        fetchRoomDetails(initialDeviceId);
        updateChart(initialDeviceId);

        document.getElementById("room-select").addEventListener("change", function() {
            const selectedDeviceId = this.value;
            fetchRoomDetails(selectedDeviceId);
            updateChart(selectedDeviceId);
        });
    </script>
</body>

</html>
