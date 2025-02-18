<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sehri & Iftar Timings 2025 - Bangladesh</title>

    @vite(['resources/js/app.js']) <!-- Load Local JS -->

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/theme-toggle.js') }}" defer></script>

    <!-- Link to External CSS File -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <script>
        tailwind.config = {
            darkMode: 'class' // Ensure Tailwind supports dark mode
        }
    </script>

    <style>
        .mosque-bg {
            background: url('{{ asset('images/mosque.jpg') }}') no-repeat center center;
            background-size: cover;
        }
    </style>
</head>
<body class="mosque-bg h-screen flex items-center justify-center">
<div class="absolute top-4 right-4 z-50">
    <!-- Dark Mode Toggle Switch -->
    <label for="toggle-theme" class="flex items-center cursor-pointer">
        <span class="mr-2 text-gray-800 dark:text-white">🌙</span>
        <div class="relative">
            <input type="checkbox" id="toggle-theme" class="peer hidden" />
            <div class="w-12 h-6 rounded-full bg-gray-300 dark:bg-gray-700 peer-checked:bg-gray-500 transition-all"></div>
            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md transition-all peer-checked:left-7"></div>
        </div>
        <span class="ml-2 text-gray-800 dark:text-white">☀️</span>
    </label>
</div>

<div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg text-center w-full max-w-md transition-all duration-300 dark:bg-gray-800 dark:bg-opacity-90 dark:text-white">
    <!-- Header with Islamic Logo & Title -->
    <div class="flex flex-col items-center">
        <img src="{{ asset('images/mosque-icon.png') }}" alt="Prayer" class="w-16 mb-2">
        <h1 class="text-3xl font-bold text-green-700 dark:text-green-400">Sehri & Iftar Timings</h1>
        <p class="text-gray-500 font-semibold dark:text-gray-300">Ramadan 2025 - Bangladesh</p>
    </div>

    <!-- City & Date Selection Form -->
    <form method="GET" id="prayerForm" class="my-4">
        <!-- City Selection Dropdown -->
        <label class="block font-semibold text-gray-700 mb-1 dark:text-gray-300">Select City:</label>
        <select name="city" class="border p-2 rounded w-full dark:bg-gray-700 dark:text-white" onchange="this.form.submit()">
            @foreach($cities as $city)
                <option value="{{ $city }}" {{ $selectedCity == $city ? 'selected' : '' }}>
                    {{ $city }}
                </option>
            @endforeach
        </select>

        <!-- Date Picker Input -->
        <label class="block font-semibold text-gray-700 mt-4 mb-1 dark:text-gray-300">Select Date:</label>
        <input type="text" id="datepicker" name="date"
               value="{{ request('date', $selectedDate ?? now()->format('Y-m-d')) }}"
               class="border p-2 rounded w-full dark:bg-gray-700 dark:text-white">
    </form>

    <!-- Sehri & Iftar Timings -->
    @if(isset($sehri) && isset($iftar))
        <div class="text-lg font-semibold">
            <p class="mt-2"><strong class="text-blue-600">City:</strong> {{ $selectedCity }}</p>
            <p class="text-gray-600 dark:text-gray-300"><strong>Date:</strong> {{ $date }}</p>
            <p class="text-lg text-blue-500 mt-3"><strong>🌙 Sehri Time:</strong> {{ $sehri }}</p>
            <p class="text-lg text-red-500"><strong>🌅 Iftar Time:</strong> {{ $iftar }}</p>
        </div>
    @else
        <p class="text-red-500 mt-4">Could not fetch prayer times.</p>
    @endif
</div>

<script>
    function showInstructions() {
        document.getElementById('instructionModal').classList.remove('hidden');
    }

    function closeInstructions() {
        document.getElementById('instructionModal').classList.add('hidden');
    }
</script>

<!-- Instruction Button -->
<div class="absolute bottom-4 left-1/2 transform -translate-x-1/2">
    <a href="instructions.html" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition-all">
        📜 Instructions
    </a>
</div>

</body>
</html>
