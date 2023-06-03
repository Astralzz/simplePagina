function updateCheckboxValue(checkbox) {
    if (checkbox.checked) {
        checkbox.value = "1";
    } else {
        checkbox.value = "0";
    }
}

// Obtén el contexto del lienzo de la gráfica
const ctx = document.getElementById('graficaVentas').getContext('2d');

// Genera datos aleatorios para las ventas y fechas
const ventas = generarDatosAleatorios(12, 100, 200);
const fechas = generarFechas(12);

// Crea la gráfica utilizando Chart.js
const graficaVentas = new Chart(ctx, {
    type: 'line',
    data: {
        labels: fechas,
        datasets: [{
            label: 'Ventas',
            data: ventas,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            fill: false
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        animation: {
            duration: 2000, // Duración de la animación (2 segundos)
            easing: 'easeInOutQuart' // Efecto de la animación
        }
    }
});

// Genera datos aleatorios para las ventas
function generarDatosAleatorios(cantidad, minimo, maximo) {
    var datos = [];
    for (var i = 0; i < cantidad; i++) {
        var venta = Math.floor(Math.random() * (maximo - minimo + 1) + minimo);
        datos.push(venta);
    }
    return datos;
}

// Genera fechas mensuales
function generarFechas(cantidad) {
    var fechas = [];
    var fechaActual = new Date();
    for (var i = 0; i < cantidad; i++) {
        var fecha = new Date(fechaActual.getFullYear(), fechaActual.getMonth() - i, 1);
        var mes = fecha.toLocaleString('es', {
            month: 'long'
        });
        var año = fecha.getFullYear();
        fechas.push(mes + ' ' + año);
    }
    return fechas.reverse();
}