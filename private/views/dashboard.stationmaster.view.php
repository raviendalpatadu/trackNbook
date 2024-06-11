<?php $this->view("./includes/header") ?>
<?php $this->view("./includes/load-js") ?>

<?php
// echo "<pre>";
// print_r($data);
// echo "</pre>";
$trainCount = count($data['trains']);
$inquiryCount = count($data['inquiries']);
?>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-12 p-20">
                        <div class="ach-txt-wrapper mb-30">
                            Welcome to <?= ucfirst(Auth::smStation()->station_name) ?> Railway Station!
                        </div>
                        <div class="d-flex flex-row justify-content-center g-50">
                            <div class="col-4">
                                <div
                                    class="dashboard-card-sm-train  d-flex align-items-center bg-light-blue Primary-Gray g-50">

                                    <div class="d-flex flex-column g-10">
                                        <p1 class="dashboard-card-sm-font1 ">
                                            Number of
                                            Trains <br>by today
                                        </p1>
                                        <p2 class="dashboard-card-sm-font2 "><?= $trainCount ?></p2>
                                    </div>

                                    <div class="d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" height="70" width="70"
                                            version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"
                                            fill="#000000" stroke="#000000" stroke-width="15.36">
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
                                                        d="M349.917,432.716v-0.635H162.472v0.635h-10.544L89.982,512h45.644l13.705-20.233h213.334L376.367,512h45.659 l-61.95-79.284H349.917z M162.558,472.248l13.988-20.648h158.912l13.988,20.648H162.558z" />
                                                    <path class="st0"
                                                        d="M256.002,0C112.749,0,71.397,51.982,71.397,91.663v258.601c0,34.895,28.29,63.216,63.224,63.216h242.765 c34.942,0,63.217-28.321,63.217-63.216V91.663C440.603,51.982,399.259,0,256.002,0z M189.091,56.987h133.815 c8.888,0,16.106,7.21,16.106,16.098c0,8.912-7.218,16.114-16.106,16.114H189.091c-8.889,0-16.098-7.202-16.098-16.114 C172.992,64.197,180.201,56.987,189.091,56.987z M160.275,358.439c-11.093,0-20.084-8.991-20.084-20.084 c0-11.094,8.991-20.084,20.084-20.084c11.093,0,20.084,8.99,20.084,20.084C180.358,349.448,171.368,358.439,160.275,358.439z M241.943,239.278H134.731v-98.064h107.212V239.278z M351.737,358.439c-11.094,0-20.084-8.991-20.084-20.084 c0-11.094,8.99-20.084,20.084-20.084c11.092,0,20.084,8.99,20.084,20.084C371.821,349.448,362.829,358.439,351.737,358.439z M382.047,239.278H270.061v-98.064h111.986V239.278z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div
                                    class="dashboard-card-sm-inquiry d-flex align-items-center bg-light-blue Primary-Gray g-50">

                                    <div class="d-flex flex-column g-10">
                                        <p1 class="dashboard-card-sm-font1"><a href="<?= ROOT ?>stationmaster/getinquiry">Inquiries</a></p1>
                                        <p2 class="dashboard-card-sm-font2"><?= $inquiryCount ?></p2>
                                    </div>

                                    <div class="d-flex ml-40 ">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80"
                                            viewBox="0 0 512.00 512.00" version="1.1" fill="#000000">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round" />

                                            <g id="SVGRepo_iconCarrier">
                                                <title>inquiry-filled</title>
                                                <g id="Page-1" stroke-width="0.00512" fill="none" fill-rule="evenodd">
                                                    <g id="inquiry-" fill="rgb(89, 169, 224)"
                                                        transform="translate(64.000000, 85.333333)">
                                                        <path
                                                            d="M384,1.42108547e-14 L384,298.666667 L277.333333,298.666667 L277.333333,384 L147.2,298.666667 L1.42108547e-14,298.666667 L1.42108547e-14,1.42108547e-14 L384,1.42108547e-14 Z M192.935,201.066667 C186.101632,201.066667 180.435023,203.295811 175.935,207.754167 C171.434978,212.212522 169.185,217.774967 169.185,224.441667 C169.185,231.441702 171.393311,237.191644 175.81,241.691667 C180.226689,246.191689 185.934965,248.441667 192.935,248.441667 C199.768368,248.441667 205.414144,246.191689 209.8725,241.691667 C214.330856,237.191644 216.56,231.5667 216.56,224.816667 C216.56,217.983299 214.330856,212.316689 209.8725,207.816667 C205.414144,203.316644 199.768368,201.066667 192.935,201.066667 Z M202.185,65.0666667 C183.601574,65.0666667 165.060093,69.8999517 146.56,79.5666667 L146.56,79.5666667 L157.685,107.316667 C172.768409,98.7332904 185.64328,94.4416667 196.31,94.4416667 C202.810033,94.4416667 207.955814,96.004151 211.7475,99.1291667 C215.539186,102.254182 217.435,106.483307 217.435,111.816667 C217.435,116.066688 216.080847,119.774984 213.3725,122.941667 C211.34124,125.316679 207.493614,128.58228 201.829549,132.738531 L201.829549,132.738531 L188.419684,142.338357 C187.103359,143.316246 185.967309,144.18359 185.011529,144.940391 L185.011529,144.940391 L182.685,146.879167 C180.601656,148.754176 178.935006,150.899988 177.685,153.316667 C175.518323,157.483354 174.435,164.85828 174.435,175.441667 L174.435,175.441667 L174.435,186.441667 L211.31,186.441667 L211.31,181.316667 C211.31,173.733295 212.268324,168.462515 214.185,165.504167 C216.101676,162.545819 221.226667,158.275028 229.56,152.691667 L229.56,152.691667 L233.497515,149.997322 C242.320454,143.767492 248.591231,137.936485 252.31,132.504167 C256.560021,126.295802 258.685,118.81671 258.685,110.066667 C258.685,97.1499354 254.310044,86.6500404 245.56,78.5666667 C235.643284,69.5666217 221.185095,65.0666667 202.185,65.0666667 Z"
                                                            id="Combined-Shape"> </path>
                                                    </g>
                                                </g>
                                            </g>

                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div
                                    class="dashboard-card-sm-waitlist d-flex align-items-center bg-light-blue Primary-Gray g-50">

                                    <div class="d-flex flex-column g-10">
                                        <p1 class="dashboard-card-sm-font1"> <a href="<?= ROOT ?>stationmaster/waitlist">Waiting List</a></p1>
                                        <p2 class="dashboard-card-sm-font2"><?= $data['waitinglistCount'] ?></p2>
                                    </div>

                                    <div class="d-flex ml-30  ">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" fill="rgb(89, 169, 224)"
                                            height="60" width="80" version="1.1" id="Capa_1" viewBox="0 0 297 297"
                                            xml:space="preserve">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round" />

                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M251.01,277.015h-17.683l-0.002-31.559c0-31.639-17.358-60.726-48.876-81.901c-3.988-2.682-6.466-8.45-6.466-15.055 s2.478-12.373,6.464-15.053c31.52-21.178,48.878-50.264,48.88-81.904V19.985h17.683c5.518,0,9.992-4.475,9.992-9.993 c0-5.518-4.475-9.992-9.992-9.992H45.99c-5.518,0-9.992,4.475-9.992,9.992c0,5.519,4.475,9.993,9.992,9.993h17.683v31.558 c0,31.642,17.357,60.729,48.875,81.903c3.989,2.681,6.467,8.448,6.467,15.054c0,6.605-2.478,12.373-6.466,15.053 c-31.519,21.176-48.876,50.263-48.876,81.903v31.559H45.99c-5.518,0-9.992,4.475-9.992,9.993c0,5.519,4.475,9.992,9.992,9.992 h205.02c5.518,0,9.992-4.474,9.992-9.992C261.002,281.489,256.527,277.015,251.01,277.015z M138.508,110.362 c0-5.518,4.474-9.993,9.992-9.993s9.992,4.475,9.992,9.993v17.664c0,5.519-4.474,9.992-9.992,9.992s-9.992-4.474-9.992-9.992 V110.362z M141.433,173.956c1.858-1.857,4.436-2.927,7.064-2.927c2.628,0,5.206,1.069,7.064,2.927 c1.868,1.859,2.928,4.438,2.928,7.065s-1.06,5.206-2.928,7.064c-1.858,1.858-4.436,2.928-7.064,2.928 c-2.628,0-5.206-1.069-7.064-2.928c-1.859-1.858-2.928-4.437-2.928-7.064S139.573,175.816,141.433,173.956z M86.94,277.112 c8.152-30.906,50.161-64.536,55.405-68.635c3.614-2.826,8.692-2.828,12.309,0c5.244,4.1,47.252,37.729,55.404,68.635H86.94z" />
                                            </g>

                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ml-2">
                        <div class="col-10-ach-d-flex-flex-column">
                            <div class="d-flex flex-column  bg-white g-5 p-10 mb-10 align-items-start mt-50">
                                <div class="row mt-10">
                                    <div class="col-3">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" fill="rgb(89 169 224)"
                                            version="1.1" id="Layer_1" viewBox="0 0 512.00 512.00" xml:space="preserve"
                                            width="100" height="100" stroke="rgb(89 169 224)" stroke-width="0.00512">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                                stroke="#CCCCCC" stroke-width="1.024" />

                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M477.093,250.184l-232.73-0.002v-81.455l151.275,0.002l-46.548-46.548H0V320h512v-34.909L477.093,250.184z M209.455,250.182H34.909v-81.455h174.545V250.182z" />
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <rect y="354.909" width="512" height="34.909" />
                                                    </g>
                                                </g>
                                            </g>

                                        </svg>
                                    </div>
                                    <div class="col-3">
                                        <h2> <br>Trains by Today</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="if-table stripe hover" id="userTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="col-4">Train Name</th>
                                        <th class="col-2">Train Type</th>
                                        <th class="col-4">Start & End Station</th>
                                        <th class="col-2">Estimated Arival Time</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['trains'] as $train): ?>
                                        <tr class="p-20">
                                            <td class="col-4 d-flex align-items-center">
                                                <?= $train->train_name . " - " . $train->train_id ?>
                                            </td>
                                            <td class="col-2">
                                                <?= $train->train_type ?>
                                            </td>
                                            <td class="col-4">
                                                <?= $train->start_station . " - " . $train->end_station ?>
                                            </td>
                                            <td class="col-2 ">
                                                <?= date("H:i", strtotime($train->estimated_arraival_time)) ?>
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
<script>
    $(document).ready(function () {
        $('#userTable').DataTable({
            "columnDefs": [
                { "width": "30%", "targets": 0 }, // Train Name
                { "width": "20%", "targets": 1 }, // Train Type
                { "width": "30%", "targets": 2 }, // Start & End Station
                { "width": "20%", "targets": 3 }  // Estimated Arival Time
            ]
        });
    });

</script>

</html>