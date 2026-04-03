@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center px-4">
        <div class="w-full max-w-xl bg-white shadow-xl rounded-2xl p-8">

            <!-- Header -->
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-indigo-600">
                    Welcome to LocationBD
                </h1>
                <p class="mt-3 text-gray-600">
                    Your home page is working and rendered from HomeController@index.
                </p>
                <p class="mt-1 text-sm text-gray-400">
                    Current time: {{ now()->toDayDateTimeString() }}
                </p>
            </div>

            <!-- Form Section -->
            <div class="mt-8 space-y-5">

                <!-- Division -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Division
                    </label>
                    <select id="division"
                        class="w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="">Select Division</option>
                    </select>
                </div>

                <!-- District -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        District
                    </label>
                    <select id="district"
                        class="w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="">Select District</option>
                    </select>
                </div>
                <!-- Thana -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Thana
                    </label>
                    <select id="thana"
                        class="w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="">Select Thana</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script>
        let allData = [];

        // 🔹 Load all data first
        fetch('/locations-data')
            .then(res => res.json())
            .then(data => {
                allData = data;

                let divisionSelect = document.getElementById('division');

                data.forEach(div => {
                    divisionSelect.innerHTML += `<option value="${div.id}">${div.name_en} (${div.name_bn})</option>`;
                });
            });


        // 🔹 Division change → load districts
        document.getElementById('division').addEventListener('change', function () {
            let divisionId = this.value;

            let districtSelect = document.getElementById('district');
            let thanaSelect = document.getElementById('thana');

            districtSelect.innerHTML = '<option>Select District</option>';
            thanaSelect.innerHTML = '<option>Select Thana</option>';

            let division = allData.find(d => d.id == divisionId);

            if (division) {
                division.districts.forEach(dist => {
                    districtSelect.innerHTML += `<option value="${dist.id}">${dist.name_en} (${dist.name_bn})</option>`;
                });
            }
        });


        // 🔹 District change → load thanas
        document.getElementById('district').addEventListener('change', function () {
            let divisionId = document.getElementById('division').value;
            let districtId = this.value;

            let thanaSelect = document.getElementById('thana');
            thanaSelect.innerHTML = '<option>Select Thana</option>';

            let division = allData.find(d => d.id == divisionId);

            if (division) {
                let district = division.districts.find(d => d.id == districtId);

                if (district) {
                    district.thanas.forEach(thana => {
                        thanaSelect.innerHTML += `<option value="${thana.id}">${thana.name_en} (${thana.name_bn})</option>`;
                    });
                }
            }
        });
    </script>
@endsection