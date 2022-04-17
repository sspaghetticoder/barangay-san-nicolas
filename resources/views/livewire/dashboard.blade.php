<div wire:poll.60000ms>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl grid grid-cols-12 gap-4 mx-auto">
            <div class="bg-white col-span-8 p-4">
                <canvas id="residents"></canvas>
            </div>

            <div class="bg-white col-span-4 p-4">
                <p class="text-xs text-center">Requested Documents</p>
                <canvas id="documents"></canvas>
            </div>

            <div class="grid grid-cols-8 gap-4 col-span-8">
                <div class="grid grid-cols-4 gap-4 col-span-8">
                    <div class="bg-white flex items-center justify-between col-span-2 p-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 text-indigo-700 w-fit p-4 rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                            </div>

                            <div class="mx-2">
                                <p class="text-gray-500 font-bold text-lg">Residents</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-black font-bold text-2xl">{{ $residents }}</p>
                        </div>
                    </div>
                    <div class="bg-white flex items-center justify-between col-span-2 p-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 text-indigo-700 w-fit p-4 rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 11l2 2l4 -4"></path>
                                </svg>
                            </div>

                            <div class="mx-2">
                                <p class="text-gray-500 font-bold text-lg">Users</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-black font-bold text-2xl">{{ $users }}</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4 col-span-8">
                    <div class="bg-white flex items-center justify-between col-span-2 p-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 text-indigo-700 w-fit p-4 rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                                </svg>
                            </div>

                            <div class="mx-2">
                                <p class="text-gray-500 font-bold text-lg">Activities</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-black font-bold text-2xl">{{ $activities }}</p>
                        </div>
                    </div>
                    <div class="bg-white flex items-center justify-between col-span-2 p-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 text-indigo-700 w-fit p-4 rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                    </path>
                                </svg>
                            </div>

                            <div class="mx-2">
                                <p class="text-gray-500 font-bold text-lg">Documents</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-black font-bold text-2xl">{{ $documents }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white col-span-4 p-4">
                <canvas id="activity-logs"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/chart.min.js') }}"></script>
        <script>
            const activityLogs = document.getElementById('activity-logs');
            const activityLogBarChart = new Chart(activityLogs, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Activity Logs (This Week)',
                        data: @json($week),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 559, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 559, 64, 1)'
                        ],
                        borderWidth: 1,
                        barThickness: 10,
                        borderRadius: 50,
                        barPercentage: 0.5,
                        minBarLength: 2,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                }
            });

            const residents = document.getElementById('residents');
            const residentLineChart = new Chart(residents, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Registered Residents (This Year)',
                        data: @json($months),
                        fill: false,
                        borderColor: 'rgb(99, 102, 241)',
                        tension: 0.1
                    }]
                },
                options: {
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                }
            });

            let data = @json($requestedDocuments);
            let documentChartKeys = [];
            let documentChartValues = [];

            for (key in data) {
                documentChartKeys.push(key);
                documentChartValues.push(data[key]);
            }

            const documents = document.getElementById('documents');
            const documentDoughnutChart = new Chart(documents, {
                type: 'doughnut',
                data: {
                    labels: documentChartKeys,
                    datasets: [{
                        data: documentChartValues,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        </script>
    @endpush
</div>
