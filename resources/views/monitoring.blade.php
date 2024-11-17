<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FlamePilot - Monitoring</title>
    <link rel="icon" href="{{ asset('favicon/logo.ico') }}" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    {{-- <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" /> --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Additional custom styles */
        body {
            font-family: "Montserrat", sans-serif;
        }

        aside {
            background-color: #070201;
        }

        .shadow-lg {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
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
    </style>
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}"> --}}

</head>

<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-[#070201] text-bla shadow-md px-4 px-lg-5 py-3 py-lg-0">
        <h1 class="navbar-brand d-flex align-items-center text-primary fw-bold" style="font-size: 1.3rem;">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Flame Pilot Logo" class="me-3"
                style="width: 50px; height: auto;">
            FlamePilot
        </h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto py-0" x-data="{ currentPath: window.location.pathname }">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link fw-bold"
                        :class="{ 'text-primary': currentPath === '/' }"
                        @mouseenter="$el.classList.add('text-primary')"
                        @mouseleave="$el.classList.remove('text-primary', currentPath !== '/')">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('monitoring') }}" class="nav-link fw-bold"
                        :class="{ 'text-primary': currentPath === '/monitoring' }"
                        @mouseenter="$el.classList.add('text-primary')"
                        @mouseleave="$el.classList.remove('text-primary', currentPath !== '/monitoring')">
                        Monitoring
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('faq') }}" class="nav-link fw-bold"
                        :class="{ 'text-primary': currentPath === '/faq' }"
                        @mouseenter="$el.classList.add('text-primary')"
                        @mouseleave="$el.classList.remove('text-primary', currentPath !== '/faq')">
                        FAQ
                    </a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link mx-1 fw-bold" href="{{ route('logout') }}"
                            @mouseenter="$el.classList.add('text-primary')"
                            @mouseleave="$el.classList.remove('text-primary')"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
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
                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Ruangan: <span
                            id="room-name">{{ $devices->first()->name ?? '-' }}</span></h3>
                    <p class="text-black">Lokasi: <span
                            id="room-location">{{ $devices->first()->location ?? '-' }}</span></p>
                </div>
                <!-- Additional Cards for Device Data -->
                <!-- Temperature -->
                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Suhu Ruangan</h3>
                    <p class="text-2xl font-bold primary-color" id="temperature">
                        {{ $devices->first()->latestLog->temperature ?? '-' }}°C</p>
                </div>
                <!-- Battery -->
                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Baterai</h3>
                    <p class="text-2xl font-bold primary-color" id="battery">
                        {{ $devices->first()->latestLog->battery_level ?? '-' }}%</p>
                </div>
                <!-- Water Level -->
                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Water Level</h3>
                    <p class="text-2xl font-bold primary-color" id="water-level">
                        {{ $devices->first()->latestLog->water_level ?? '-' }}%</p>
                </div>
                <!-- Smoke Level -->
                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Smoke Level</h3>
                    <p class="text-2xl font-bold text-red-500" id="smoke-level">
                        {{ $devices->first()->latestLog->smoke_level ?? '-' }}%</p>
                </div>
                <!-- Status -->
                <div class="bg-card p-5 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2 text-muted">Status</h3>
                    <p id="status"
                        class="text-2xl font-bold {{ $devices->first()->latestLog->status == 'normal' ? 'text-green-500' : 'text-red-500' }}">
                        {{ $devices->first()->latestLog->status ?? '-' }}</p>
                </div>
            </div>

            <!-- Chart and Table Section -->
            <!-- Chart and Table Section -->
            <!-- Chart and Table Section -->
            <div class="flex flex-col lg:flex-row gap-4 mt-6 items-stretch">
                <!-- Chart Section -->
                <div id="chart-container"
                    class="bg-card p-4 rounded-lg shadow-lg w-full lg:w-1/2 mx-auto lg:mx-0 flex-grow">
                    <h3 class="text-xl font-semibold mb-4 text-muted">Temperature & Smoke Level Trend</h3>
                    <canvas id="tempSmokeChart" class="w-full h-48 sm:h-64 lg:h-80"></canvas>
                </div>

                <!-- Table Section -->
                <div
                    class="bg-card p-4 rounded-lg shadow-lg w-full lg:w-1/2 mx-auto lg:mx-0 overflow-x-auto overflow-y-auto flex-grow">
                    <h3 class="text-xl font-semibold mb-4 text-muted">Log Data</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No.</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Temp (°C)
                                </th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Smoke (%)
                                </th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Battery (%)
                                </th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Water (%)
                                </th>
                            </tr>
                        </thead>
                        <tbody id="log-table-body" class="bg-white divide-y divide-gray-200 text-center">
                            <!-- Log data rows will be added dynamically -->
                        </tbody>
                    </table>
                    <!-- Pagination controls with Tailwind CSS -->
                    <nav class="mt-4">
                        <ul class="flex justify-center space-x-1">
                            <!-- Previous Button -->
                            <li>
                                <button
                                    class="px-3 py-1 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-[#136FF5] hover:text-blue-600 disabled:bg-gray-200"
                                    id="prev-page" disabled>Previous</button>
                            </li>
                            <!-- Dynamically add numbered page items here -->
                            <span id="pagination-numbers" class="flex space-x-1"></span>
                            <!-- Next Button -->
                            <li>
                                <button
                                    class="px-3 py-1 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-[#136FF5] hover:text-blue-600 disabled:bg-gray-200"
                                    id="next-page">Next</button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </main>
    </div>


    <!-- Bootstrap JS (required for navbar collapse functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function generateLogs() {
            fetch('/generate-logs')
                .then(response => response.json())
                .then(data => console.log(data.message))
                .catch(error => console.error('Error:', error));
        }

        // Memanggil fungsi generateLogs setiap 1 menit (60000 ms)
        setInterval(generateLogs, 60000);
    </script>
    <script>
        // Set up variables for pagination
        let currentPage = 1;
        const rowsPerPage = 6;
        let logsData = [];

        // Fetch log data and update table with pagination
        function fetchLogs(deviceId) {
            fetch(`/monitoring/${deviceId}/logs-table`)
                .then(response => response.json())
                .then(data => {
                    logsData = data;
                    updateTable();
                })
                .catch(error => console.error('Error fetching logs:', error));
        }


        // Update table to display logs with pagination
        function updateTable() {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = logsData.slice(start, end);

            // Clear existing table rows
            document.getElementById("log-table-body").innerHTML = '';

            // Populate table with paginated data
            paginatedData.forEach((log, index) => { // Add index as a second parameter
                const row = `
                <tr>
                    <td>${start + index + 1}</td> <!-- Adding row number correctly -->
                    <td>${log.time_full || '-'}</td>
                    <td>${log.temperature ? `${log.temperature}°C` : '-'}</td>
                    <td>${log.smoke_level ? `${log.smoke_level}%` : '0%'}</td>
                    <td>${log.battery_level ? `${log.battery_level}%` : '0%'}</td>
                    <td>${log.water_level ? `${log.water_level}%` : '0%'}</td>
                </tr>
        `;
                document.getElementById("log-table-body").insertAdjacentHTML('beforeend', row);
            });

            // Enable/disable pagination buttons
            document.getElementById("prev-page").disabled = currentPage === 1;
            document.getElementById("next-page").disabled = end >= logsData.length;
        }

        // Pagination button listeners
        document.getElementById("prev-page").addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                updateTable();
            }
        });

        document.getElementById("next-page").addEventListener("click", () => {
            if ((currentPage * rowsPerPage) < logsData.length) {
                currentPage++;
                updateTable();
            }
        });
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
            fetch(`/monitoring/${selectedDeviceId}/logs-chart`)
                .then(response => response.json())
                .then(data => {
                    const temperatures = data.map(log => log.temperature);
                    const smokeLevels = data.map(log => log.smoke_level);
                    const timeLabels = data.map(log => log.time); // Use short format for chart

                    tempSmokeChart.data.labels = timeLabels;
                    tempSmokeChart.data.datasets[0].data = temperatures;
                    tempSmokeChart.data.datasets[1].data = smokeLevels;
                    tempSmokeChart.update();
                })
                .catch(error => console.error('Error fetching chart logs:', error));
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
        fetchLogs(initialDeviceId);


        document.getElementById("room-select").addEventListener("change", function() {
            const selectedDeviceId = this.value;
            fetchRoomDetails(selectedDeviceId);
            updateChart(selectedDeviceId);
            currentPage = 1; // Reset pagination
            fetchLogs(selectedDeviceId);
        });
    </script>
</body>

</html>
