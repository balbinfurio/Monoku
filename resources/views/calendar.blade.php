<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>


    <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mt-5 text-3xl font-semibold text-gray-800">YOUR CALENDAR</h2>
                    <div class="col-md-11 offset-1 mt-5 mb-5"></div>
                        <div id="calendar">

                        </div>
                </div>
            </div>
    </div>

    <script>
        $(document).ready(function() {
            var dailyEmotion = @json($events);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',

                },
                events: dailyEmotion

            })
        });
    </script>
    <div class="container">
        <h2 class="text-center mt-5 text-3xl font-semibold text-gray-800">YOUR CHART</h2>
        <div class="mt-8">
            <div>
                <canvas id="myChart"></canvas>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            
            <script>
                const ctx = document.getElementById('myChart');

                const events = @json($events);
                // console.log(events);

                const emojiToValue = {
                    '😞': 1,
                    '😡': 2,
                    '🙂': 3,
                    '😏': 4,
                    '😀': 5
                };

                const valueToEmoji = {};
                Object.keys(emojiToValue).forEach(emoji => {
                    valueToEmoji[emojiToValue[emoji]] = emoji;
                });

                const labels = events.map(event => {
                    const dateParts = event.start.split(' ')[1].split('-');
                    const monthIndex = parseInt(dateParts[1]) - 1; // Restamos 1 para obtener el índice del mes
                    const month = new Date(0, monthIndex).toLocaleString('default', { month: 'short' }); // Obtén el nombre corto del mes
                    const day = dateParts[2];
                    return `${month} ${day}`; // Combina el nombre del mes y el día del mes
                });

                
                const data = events.map(event => emojiToValue[event.title]);
                
                new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels, // EJE X
                    datasets: [{
                    label: 'Mood Trend Over Time',
                    data: data,
                    borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'STATUS' // TITULO EJE Y
                        },
                        ticks: {
                            callback: value => valueToEmoji[value], // Usa el objeto valueToEmoji para mostrar los emojis
                            font: {
                                size: 50 // Ajusta el tamaño de fuente de los emojis
                            } 
                        }
                    }
                    }
                }
                });
            </script>
        </div>
    </div>
    

<style>
    .emoji-event {
        font-size: 33px; /* Ajusta el tamaño del emoji según tus preferencias */
    }
</style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ 'Contact' }}" class="block p-6 text-gray-900 hover:text-blue-500">
                    {{ __("Contact us ©") }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout> 
