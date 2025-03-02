document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    const toggleBtn = document.getElementById('toggleBtn');

    toggleBtn.addEventListener('click', function() {
        navbar.classList.toggle('expanded');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    let monthlyChart; 

    function fetchAndRenderChart() {
        fetch('monthly.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error fetching data:', data.error);
                    alert('Error: ' + data.error);
                    return;
                }

                console.log(data);

                const labels = data.map(entry => entry.month);
                const totals = data.map(entry => entry.total_spent);

                const ctx = document.getElementById('monthlyChart').getContext('2d');
                if (monthlyChart) {
                    monthlyChart.destroy(); 
                }
                monthlyChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: `Spendings for ${new Date().getFullYear()}`,
                            data: totals,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Month'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Total Spendings'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return `${tooltipItem.label}: $${tooltipItem.raw}`;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                alert('Error fetching data: ' + error.message);
            });
    }

    
    fetchAndRenderChart();
});
