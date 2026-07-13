import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {

    const canvas = document.getElementById('riskChart');

    if (!canvas) return;

    const data = window.riskData || {
        low: 0,
        medium: 0,
        high: 0
    };

    new Chart(canvas, {

        type: 'doughnut',

        data: {

            labels: [
                'Low Risk',
                'Medium Risk',
                'High Risk'
            ],

            datasets: [{

                data: [
                    data.low,
                    data.medium,
                    data.high
                ],

                backgroundColor: [
                    '#22c55e',
                    '#facc15',
                    '#ef4444'
                ],

                borderWidth: 2

            }]

        },

        options: {

            responsive: true,

            plugins: {

                legend: {
                    position: 'bottom'
                }

            }

        }

    });

});