function updateTime() {
    const now = new Date();

    document.getElementById("datetime").innerHTML =
        now.toLocaleDateString() + " | " + now.toLocaleTimeString();
}

setInterval(updateTime, 1000);

updateTime();

const ctx = document.getElementById('trafficChart');

if (ctx) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
            datasets: [{
                label: 'Network Traffic (Mbps)',
                data: [25, 40, 35, 55, 70, 60, 80],
                borderWidth: 3,
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });
}