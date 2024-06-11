<?php $this->view("./includes/header"); ?>
<?php $this->view("./includes/load-js"); ?>


<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>

        <main class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="if-txt-wrapper">Hello,
                            <?= ucfirst(Auth::user()) ?>
                        </div>

                    </div>
                </div>
            </div>

            <!-- cards -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-row justify-content-between g-50">
                            <div class="col-4">
                                <div
                                    class="dashboard-card-admin d-flex align-items-center bg-light-blue Primary-Gray g-50">
                                    <a class="blue">
                                        <div class="d-flex flex-column g-10">
                                            <p1 class="mb-4 align-items-start ">Number of Trains <br>Onboard</p1>
                                            <p2> <?= $data['trainsCount'] ?></p2>
                                        </div>
                                    </a>
                                    <div class="d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" height="55" width="55"
                                            version="1.1" id="_x32_" viewBox="0 0 512.00 512.00" xml:space="preserve"
                                            fill="rgb(89 169 224)">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round" />

                                            <g id="SVGRepo_iconCarrier">
                                                <style type="text/css">
                                                    .st0 {
                                                        fill: rgb(89 169 224);
                                                    }
                                                </style>
                                                <g>
                                                    <path class="st0"
                                                        d="M431.665,356.848V147.207c0-48.019-38.916-86.944-86.943-86.944h-40.363l4.812-42.824h8.813 c9.435,0,17.508,5.74,20.965,13.898l16.06-6.779V24.55C348.929,10.124,334.641,0.018,317.984,0L193.999,0.009 c-16.639,0.009-30.928,10.116-37.016,24.541l16.06,6.796c3.466-8.166,11.539-13.906,20.956-13.897h8.823l4.81,42.815h-40.354 c-48.01,0-86.942,38.924-86.942,86.944v209.641c0,36.403,26.483,66.736,61.208,72.773L87.011,512h48.488l22.378-33.823h196.264 L376.519,512h48.47l-54.516-82.379C405.182,423.576,431.665,393.252,431.665,356.848z M291.621,17.44l-4.803,42.824h-61.635 l-4.819-42.815L291.621,17.44z M180.715,99.299h150.57v25.095h-150.57V99.299z M135.413,180.409 c0-10.917,8.839-19.773,19.756-19.773h201.664c10.916,0,19.773,8.856,19.773,19.773v65.96c0,10.917-8.857,19.764-19.773,19.764 H155.168c-10.916,0-19.756-8.847-19.756-19.764V180.409z M154.232,378.495c-12.739,0-23.06-10.321-23.06-23.043 c0-12.739,10.321-23.052,23.06-23.052c12.722,0,23.043,10.313,23.043,23.052C177.275,368.174,166.954,378.495,154.232,378.495z M172.421,456.19l16.844-25.461h133.471l16.844,25.461H172.421z M357.768,378.495c-12.722,0-23.043-10.321-23.043-23.043 c0-12.739,10.321-23.052,23.043-23.052c12.739,0,23.06,10.313,23.06,23.052C380.828,368.174,370.507,378.495,357.768,378.495z" />
                                                </g>
                                            </g>

                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div
                                    class="dashboard-card-admin d-flex align-items-center bg-light-blue Primary-Gray g-50">
                                    <a class="blue">
                                        <div class="d-flex flex-column g-10">
                                            <p1 class="mb-4">Inquiries</p1>
                                            <p2>35</p2>
                                        </div>
                                    </a>
                                    <div class="d-flex ml-40 ">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60"
                                            viewBox="-30.72 -30.72 573.44 573.44" version="1.1" fill="#000000">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                                stroke="#CCCCCC" stroke-width="7.168000000000001" />

                                            <g id="SVGRepo_iconCarrier">
                                                <title>inquiry</title>
                                                <g id="Page-1" stroke-width="0.00512" fill="none" fill-rule="evenodd">
                                                    <g id="Path" fill="rgba(89, 169, 224, 1)"
                                                        transform="translate(64.000000, 85.333333)">
                                                        <path
                                                            d="M384,1.42108547e-14 L384,298.666667 L277.333333,298.666667 L277.333333,384 L147.2,298.666667 L1.42108547e-14,298.666667 L1.42108547e-14,1.42108547e-14 L384,1.42108547e-14 Z M341.333333,42.6666667 L42.6666667,42.6666667 L42.6666667,256 L159.941531,256 L234.666667,305.002667 L234.666667,256 L341.333333,256 L341.333333,42.6666667 Z M192.935,201.066667 C199.768368,201.066667 205.414144,203.316644 209.8725,207.816667 C214.330856,212.316689 216.56,217.983299 216.56,224.816667 C216.56,231.5667 214.330856,237.191644 209.8725,241.691667 C205.414144,246.191689 199.768368,248.441667 192.935,248.441667 C185.934965,248.441667 180.226689,246.191689 175.81,241.691667 C171.393311,237.191644 169.185,231.441702 169.185,224.441667 C169.185,217.774967 171.434978,212.212522 175.935,207.754167 C180.435023,203.295811 186.101632,201.066667 192.935,201.066667 Z M202.185,65.0666667 C221.185095,65.0666667 235.643284,69.5666217 245.56,78.5666667 C254.310044,86.6500404 258.685,97.1499354 258.685,110.066667 C258.685,118.81671 256.560021,126.295802 252.31,132.504167 C248.591231,137.936485 242.320454,143.767492 233.497515,149.997322 L229.56,152.691667 C221.226667,158.275028 216.101676,162.545819 214.185,165.504167 C212.268324,168.462515 211.31,173.733295 211.31,181.316667 L211.31,186.441667 L174.435,186.441667 L174.435,175.441667 C174.435,164.85828 175.518323,157.483354 177.685,153.316667 C178.935006,150.899988 180.601656,148.754176 182.685,146.879167 L185.011529,144.940391 C185.967309,144.18359 187.103359,143.316246 188.419684,142.338357 L201.829549,132.738531 C207.493614,128.58228 211.34124,125.316679 213.3725,122.941667 C216.080847,119.774984 217.435,116.066688 217.435,111.816667 C217.435,106.483307 215.539186,102.254182 211.7475,99.1291667 C207.955814,96.004151 202.810033,94.4416667 196.31,94.4416667 C185.64328,94.4416667 172.768409,98.7332904 157.685,107.316667 L146.56,79.5666667 C165.060093,69.8999517 183.601574,65.0666667 202.185,65.0666667 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>

                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div
                                    class="dashboard-card-admin d-flex align-items-center bg-light-blue Primary-Gray g-50">
                                    <a class="blue">
                                        <div class="d-flex flex-column g-10">
                                            <p1 class="mb-4">Staffs On Duty</p1>
                                            <p2> <?= $data['usersCount'] ?></p2>
                                        </div>
                                    </a>
                                    <div class="d-flex  ">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" fill="rgb(89 169 224)"
                                            version="1.1" id="Capa_1" width="60" height="60" viewBox="0 0 39.66 39.66"
                                            xml:space="preserve">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round" />

                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g id="_x31__143_">
                                                        <g>
                                                            <path
                                                                d="M4.619,15.479c0.888,3.39,3.752,6.513,7.382,6.513c3.684,0,6.594-3.109,7.504-6.49c0.346-0.039,0.632-0.303,0.663-0.663 l0.115-1.336c0.029-0.348-0.189-0.646-0.506-0.756c-0.006-0.08-0.008-0.161-0.017-0.24c-0.068-3.062-0.6-5.534-3.01-6.556 c-2.544-1.078-4.786-1.093-6.432-0.453C10.21,5.541,9.931,5.912,9.822,5.979C9.713,6.046,9.136,5.856,8.917,5.907 c-3.61,0.516-4.801,3.917-4.538,6.569C4.371,12.55,4.366,12.625,4.36,12.7c-0.349,0.087-0.599,0.404-0.567,0.774l0.114,1.336 C3.94,15.188,4.25,15.462,4.619,15.479z M5.388,12.833c1.581-0.579,4.622-1.79,4.952-2.426c1.383,1.437,6.267,2.244,8.411,2.513 c0.009,0.139,0.021,0.274,0.021,0.414c0,3.525-2.958,7.623-6.771,7.623c-3.799,0-6.638-4.024-6.638-7.623 C5.362,13.165,5.375,13,5.388,12.833z" />
                                                            <path
                                                                d="M17.818,20.777c-0.19-0.029-0.376,0.014-0.498,0.063l-3.041,4.113l-2.307-1.84l-0.014,0.012v0.013l-0.003-0.003 l-2.307,1.84l-3.041-4.113c-0.121-0.05-0.308-0.093-0.498-0.064C0.364,21.608,0,34.584,0,34.584l11.969,0.008v-0.021 l11.958-0.008C23.928,34.563,23.562,21.587,17.818,20.777z" />
                                                            <path
                                                                d="M23.997,15.302c0.72,2.75,3.044,5.281,5.987,5.281c2.988,0,5.349-2.521,6.087-5.264c0.28-0.032,0.513-0.245,0.538-0.537 l0.093-1.083c0.024-0.283-0.154-0.525-0.411-0.614c-0.004-0.063-0.007-0.13-0.014-0.193c-0.055-2.483-0.486-4.49-2.44-5.318 c-2.063-0.874-3.882-0.887-5.217-0.368c-0.087,0.035-0.313,0.336-0.401,0.392c-0.09,0.055-0.557-0.101-0.734-0.059 c-2.928,0.418-3.895,3.177-3.682,5.328c-0.007,0.061-0.01,0.121-0.015,0.182c-0.283,0.071-0.485,0.328-0.459,0.627l0.092,1.083 C23.446,15.065,23.698,15.288,23.997,15.302z M24.62,13.155c1.282-0.47,3.75-1.452,4.017-1.968 c1.123,1.164,5.084,1.818,6.822,2.039c0.008,0.11,0.018,0.222,0.018,0.335c0,2.858-2.398,6.183-5.492,6.183 c-3.082,0-5.385-3.264-5.385-6.183C24.6,13.425,24.609,13.29,24.62,13.155z" />
                                                            <path
                                                                d="M34.703,19.6c-0.154-0.024-0.305,0.011-0.402,0.05l-2.468,3.337l-1.871-1.492l-0.011,0.009v0.011l-0.003-0.002 l-1.871,1.492l-2.468-3.337c-0.098-0.04-0.25-0.073-0.402-0.05c-1.521,0.214-2.574,1.482-3.307,3.089 c0.433,0.669,1.043,1.736,1.56,3.14c0.515,1.395,0.856,3.295,1.078,4.958l5.422,0.003v-0.018l9.7-0.006 C39.659,30.781,39.363,20.254,34.703,19.6z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>

                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div
                                    class="dashboard-card-admin d-flex align-items-center bg-light-blue Primary-Gray g-50">
                                    <div class="d-flex flex-column g-10">
                                        <p1 class="mb-4">Cancelled Trains</p1>
                                        <p2 class="blue">2</p2>
                                    </div>
                                    <div class="d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                            viewBox="0 0 24 24" style="fill: rgba(89, 169, 224, 1);">
                                            <path
                                                d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V7h16l.001 12H4z">
                                            </path>
                                            <path
                                                d="m15.707 10.707-1.414-1.414L12 11.586 9.707 9.293l-1.414 1.414L10.586 13l-2.293 2.293 1.414 1.414L12 14.414l2.293 2.293 1.414-1.414L13.414 13z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <br><br>

            <div class='container'>
                <div class='row'>
                    <div class='col-6 pr-10'>
                        <div class="chart-card">
                            <canvas id="myChart" width="100%" height="60%"></canvas>
                        </div>
                    </div>
                    <div class='col-6 chart-card'>
                        <p2 class="blue" style="font-weight: bold; font-size: 18px;">Disable Trains</p2>
                        <table class="if-table stripe hover" id="userTable" style:width=80%>
                            <thead>
                                <tr>
                                    <th class=" ">
                                        Train Name
                                    </th>
                                    <th class=" ">
                                        Train No
                                    </th>
                                    <th class=" ">
                                        Train Type
                                    </th>
                                    <th class=" ">
                                        Disable Period
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['trains'] as $train): ?>
                                    <tr class="p-20">
                                        <td class="">
                                            <?= $train->train_name ?>
                                        </td>
                                        <td class="">
                                            <?= $train->train_id?>
                                        </td>
                                        <td class="">
                                            <?= $train->train_type ?>
                                        </td>
                                        <td class="">
                                            <?= $train->disable_period_start_date . " -" . $train->disable_period_end_date ?>
                                        </td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>






    </div>

    </main>
    </div>


</body>

</html>
<script>
      $(document).ready(function() {
            new DataTable('#userTable', {
                // fixedHeight: true
            });
        });
</script>
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
                var uniqueDates = [...new Set(reservations.map(reservation => reservation.reservation_date.split(' ')[0]))];

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