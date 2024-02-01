// In public/js/monthly-order-chart.js
document.addEventListener('DOMContentLoaded', function () {
    axios.get('/monthly-order-analysis')
        .then(response => {
            const data = response.data.monthlyOrders;
            const months = data.map(entry => entry.month);
            const totalOrders = data.map(entry => entry.total_orders);

            const ctx = document.getElementById('monthlyOrderChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Total Orders',
                        data: totalOrders,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
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
        })
        .catch(error => {
            console.error('Error fetching monthly order data', error);
        });
});
