import {
    Chart,
    BarElement,
    BarController,
    DoughnutController,
    ArcElement,
    CategoryScale,
    LinearScale,
    Tooltip,
    Legend,
} from 'chart.js';

Chart.register(BarElement, BarController, DoughnutController, ArcElement, CategoryScale, LinearScale, Tooltip, Legend);

Chart.defaults.font.family = 'Inter, ui-sans-serif, system-ui, sans-serif';
Chart.defaults.color = '#6b7280';

const PALETTE = ['#6366f1', '#f59e0b', '#8b5cf6', '#10b981', '#f43f5e', '#0ea5e9', '#84cc16', '#fb923c'];

function initPostsByMonth() {
    const el = document.getElementById('chartPostsByMonth');
    if (!el) return;

    new Chart(el, {
        type: 'bar',
        data: {
            labels: JSON.parse(el.dataset.labels),
            datasets: [{
                label: 'Articles publiés',
                data: JSON.parse(el.dataset.values),
                backgroundColor: '#6366f1cc',
                borderColor: '#6366f1',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.y} article${ctx.parsed.y !== 1 ? 's' : ''}`,
                    },
                },
            },
            scales: {
                x: { grid: { display: false } },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 },
                    grid: { color: '#f3f4f6' },
                },
            },
        },
    });
}

function initPostsByCategory() {
    const el = document.getElementById('chartPostsByCategory');
    if (!el) return;

    const labels = JSON.parse(el.dataset.labels);

    new Chart(el, {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data: JSON.parse(el.dataset.values),
                backgroundColor: PALETTE.slice(0, labels.length),
                borderWidth: 0,
                hoverOffset: 8,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 16, boxWidth: 12, boxHeight: 12, borderRadius: 4 },
                },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.label} : ${ctx.parsed} article${ctx.parsed !== 1 ? 's' : ''}`,
                    },
                },
            },
        },
    });
}

function initTagsChart() {
    const el = document.getElementById('chartTags');
    if (!el) return;

    const labels = JSON.parse(el.dataset.labels);

    new Chart(el, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Articles',
                data: JSON.parse(el.dataset.values),
                backgroundColor: PALETTE.slice(0, labels.length),
                borderRadius: 6,
                borderSkipped: false,
            }],
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.x} article${ctx.parsed.x !== 1 ? 's' : ''}`,
                    },
                },
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 },
                    grid: { color: '#f3f4f6' },
                },
                y: { grid: { display: false } },
            },
        },
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initPostsByMonth();
    initPostsByCategory();
    initTagsChart();
});
