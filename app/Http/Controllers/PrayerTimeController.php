<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PrayerTimeController extends Controller
{
    public function index(Request $request)
    {
        // List of major cities in Bangladesh
        $cities = [
            "Dhaka", "Chittagong", "Khulna", "Rajshahi", "Sylhet",
            "Barisal", "Rangpur", "Mymensingh", "Comilla", "Narayanganj",
            "Gazipur", "Cox's Bazar", "Jessore", "Bogura", "Savar"
        ];

        // Get selected city or default to Dhaka
        $city = $request->query('city', 'Dhaka');

        // Get selected date or default to today
        $selectedDate = $request->query('date', now()->toDateString()); // Defaults to today's date if no date is selected

        // Define latitude & longitude for major cities in Bangladesh
        $cityCoordinates = [
            "Dhaka" => ["lat" => 23.8103, "lng" => 90.4125],
            "Chittagong" => ["lat" => 22.3569, "lng" => 91.7832],
            "Khulna" => ["lat" => 22.8456, "lng" => 89.5403],
            "Rajshahi" => ["lat" => 24.3636, "lng" => 88.6241],
            "Sylhet" => ["lat" => 24.8949, "lng" => 91.8687],
            "Barisal" => ["lat" => 22.7010, "lng" => 90.3535],
            "Rangpur" => ["lat" => 25.7460, "lng" => 89.2500],
            "Mymensingh" => ["lat" => 24.7471, "lng" => 90.4203],
            "Comilla" => ["lat" => 23.4607, "lng" => 91.1809],
            "Narayanganj" => ["lat" => 23.6238, "lng" => 90.5000],
            "Gazipur" => ["lat" => 23.9999, "lng" => 90.4203],
            "Cox's Bazar" => ["lat" => 21.4272, "lng" => 92.0058],
            "Jessore" => ["lat" => 23.1706, "lng" => 89.2137],
            "Bogura" => ["lat" => 24.8481, "lng" => 89.3728],
            "Savar" => ["lat" => 23.8380, "lng" => 90.2565]
        ];

// Get selected city coordinates
        $latitude = $cityCoordinates[$city]['lat'] ?? 23.8103;  // Default to Dhaka
        $longitude = $cityCoordinates[$city]['lng'] ?? 90.4125;
        $formattedDate = date('d-m-Y', strtotime($selectedDate)); // Convert to correct format
        // Fetch prayer times using latitude and longitude
        $response = Http::get("https://api.aladhan.com/v1/timings/{$formattedDate}", [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'method' => 1, // UISK - University of Islamic Sciences, Karachi
        ]);


        // Convert API response
        $data = $response->json();

        if ($response->successful() && isset($data['data']['timings'])) {
            $timings = $data['data']['timings'];
            return view('landing', [
                'cities' => $cities,
                'selectedCity' => $city,
                'selectedDate' => $selectedDate,
                'sehri' => $timings['Fajr'],
                'iftar' => $timings['Maghrib'],
                'date' => $data['data']['date']['readable']
            ]);
        } else {
            return view('landing', [
                'cities' => $cities,
                'selectedCity' => $city,
                'selectedDate' => $selectedDate,
                'error' => 'Could not fetch prayer times.'
            ]);
        }
    }
}


