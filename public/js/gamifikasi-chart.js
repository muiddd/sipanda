// public/js/gamifikasi-chart.js
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('learningDurationChart');
    if (!canvas) return;

    // Ambil data dari variabel global (ditetapkan di file blade)
    let chartLabels = window.chartLabels || ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
    let chartData = window.chartData || [0, 0, 0, 0, 0, 0, 0];

    const ctx = canvas.getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 350);
    gradient.addColorStop(0, 'rgba(117, 203, 80, 0.5)');
    gradient.addColorStop(1, 'rgba(117, 203, 80, 0.0)');

    const htmlElement = document.getElementById('main-html') || document.documentElement;
    const isDarkTheme = localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
    const isDark = (htmlElement && htmlElement.classList.contains('dark')) || isDarkTheme;
    
    const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
    const textColor = isDark ? '#94a3b8' : '#64748b';

    const learningChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Lama Belajar',
                data: chartData,
                borderColor: '#75cb50',
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: isDark ? 'rgba(18, 18, 18, 0.8)' : 'rgba(255, 255, 255, 0.9)',
                    titleColor: isDark ? '#fff' : '#0f172a',
                    bodyColor: isDark ? '#fff' : '#0f172a',
                    borderColor: isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1,
                    padding: 10,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' Menit';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: gridColor,
                        drawBorder: false
                    },
                    ticks: {
                        color: textColor,
                        font: {
                            family: "'Inter', sans-serif",
                            size: 11
                        },
                        stepSize: 30
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: textColor,
                        font: {
                            family: "'Inter', sans-serif",
                            size: 12
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });

    if (htmlElement) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'class') {
                    const isDarkNow = htmlElement.classList.contains('dark');
                    learningChart.options.scales.y.grid.color = isDarkNow ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
                    learningChart.options.scales.y.ticks.color = isDarkNow ? '#94a3b8' : '#64748b';
                    learningChart.options.scales.x.ticks.color = isDarkNow ? '#94a3b8' : '#64748b';
                    learningChart.options.plugins.tooltip.backgroundColor = isDarkNow ? 'rgba(18, 18, 18, 0.8)' : 'rgba(255, 255, 255, 0.9)';
                    learningChart.options.plugins.tooltip.titleColor = isDarkNow ? '#fff' : '#0f172a';
                    learningChart.options.plugins.tooltip.bodyColor = isDarkNow ? '#fff' : '#0f172a';
                    learningChart.options.plugins.tooltip.borderColor = isDarkNow ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
                    learningChart.update();
                }
            });
        });
        observer.observe(htmlElement, {
            attributes: true
        });
    }
});
