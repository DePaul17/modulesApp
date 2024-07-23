document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.querySelector('canvas');
    const labels = JSON.parse(canvas.getAttribute('data-labels'));
    const values = JSON.parse(canvas.getAttribute('data-values'));

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de données envoyés',
                data: values,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
