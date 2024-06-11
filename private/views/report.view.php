<?php $this->view("./includes/header") ?>
<?php $this->view("./includes/load-js") ?>

<html>

<body>
    <div class="col-12 text-align-center">
        <div class="if-txt-wrapper">Reservation Analytics</div>
    </div>
    <br>
    <div class="chart-card">
        <canvas id="myChart" width="auto" height="60%"></canvas>
    </div>

</body>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '<?= ROOT ?>ajax/getAllReservations',
            type: 'GET',
            success: function (dataR, response) {
                console.log(dataR);
                var reservations = JSON.parse(dataR);
                console.log(reservations);

                // Get unique reservation dates
                var uniqueDates = [new Set(reservations.map(reservation => reservation.reservation_date.split(' ')[0]))];

                // Sort dates in ascending order
                uniqueDates.sort((a, b) => new Date(a) - new Date(b));

                var dataN = [];
                uniqueDates.forEach(dateStr => {
                    var count = reservations.filter(reservation => reservation.reservation_date.split(' ')[0] == dateStr).length;
                    dataN.push(count);
                });

                console.log(dataN);
                //setup Block
                const data = {
                    labels: uniqueDates,
                    datasets: [{
                        label: 'No of Reservations',
                        data: dataN,
                        borderWidth: 2,
                    }]
                };

                const config = {
                    type: 'bar',
                    data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };

                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            }
        });
    });
</script>

</html>