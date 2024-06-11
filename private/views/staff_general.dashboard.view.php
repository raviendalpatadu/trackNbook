<?php $this->view("./includes/header") ?>
<?php
// Count of trains
if (isset($data['trains']) && $data['trains'] != 0) {
    $trainCount = count($data['trains']);
} else {
    $trainCount = 0;
}

// Count of waiting list items
if (isset($data['waitinglist']) && $data['waitinglist'] != 0) {
    $count = count($data['waitinglist']);
} else {
    $waitingListCount = 0;
}
?>



<html>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="ach-txt-wrapper">Hello,
                            <?= ucfirst(Auth::user()) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="ach-widgets">
                            <div class="card-dashboard-sg">
                                <div class="div"><svg xmlns="http://www.w3.org/2000/svg" width="31" height="37"
                                        viewBox="0 0 31 37" fill="none">
                                        <path
                                            d="M30.2465 8.88366L22.3889 15.5693V34.4356C22.3889 35.1378 22.0929 35.7407 21.5009 36.2444C20.9089 36.7481 20.2002 37 19.375 37C18.5498 37 17.8411 36.7481 17.2491 36.2444C16.6571 35.7407 16.3611 35.1378 16.3611 34.4356V25.6436H14.6389V34.4356C14.6389 35.1378 14.3429 35.7407 13.7509 36.2444C13.1589 36.7481 12.4502 37 11.625 37C10.7998 37 10.0911 36.7481 9.49913 36.2444C8.90712 35.7407 8.61111 35.1378 8.61111 34.4356V15.5693L0.753472 8.88366C0.251157 8.45627 0 7.93729 0 7.32673C0 6.71617 0.251157 6.1972 0.753472 5.7698C1.27373 5.34241 1.88817 5.12871 2.59679 5.12871C3.30541 5.12871 3.91088 5.34241 4.41319 5.7698L10.5486 10.9901H20.4514L26.5868 5.7698C27.0891 5.34241 27.6991 5.12871 28.4167 5.12871C29.1343 5.12871 29.7442 5.34241 30.2465 5.7698C30.7488 6.21246 31 6.73525 31 7.33818C31 7.94111 30.7488 8.45627 30.2465 8.88366ZM21.5278 5.12871C21.5278 6.54827 20.9402 7.75794 19.7652 8.75774C18.5901 9.75753 17.1684 10.2574 15.5 10.2574C13.8316 10.2574 12.4099 9.75753 11.2348 8.75774C10.0598 7.75794 9.47222 6.54827 9.47222 5.12871C9.47222 3.70916 10.0598 2.49948 11.2348 1.49969C12.4099 0.499897 13.8316 0 15.5 0C17.1684 0 18.5901 0.499897 19.7652 1.49969C20.9402 2.49948 21.5278 3.70916 21.5278 5.12871Z"
                                            fill="black" />
                                    </svg>
                                    <div class="impressions"><a href="<?= ROOT ?>staffgeneral/gettrainlist/">Number
                                            of Trains Onboard</a></div>
                                </div>
                                <div class="number"><a href="<?= ROOT ?>staffgeneral/gettrainlist/">
                                <?php echo $trainCount; ?>
                                    </a></div>
                            </div>
                            <div class="card-dashboard-sg">
                                <div class="div"><svg xmlns="http://www.w3.org/2000/svg" width="31" height="37"
                                        viewBox="0 0 31 37" fill="none">
                                        <path
                                            d="M30.2465 8.88366L22.3889 15.5693V34.4356C22.3889 35.1378 22.0929 35.7407 21.5009 36.2444C20.9089 36.7481 20.2002 37 19.375 37C18.5498 37 17.8411 36.7481 17.2491 36.2444C16.6571 35.7407 16.3611 35.1378 16.3611 34.4356V25.6436H14.6389V34.4356C14.6389 35.1378 14.3429 35.7407 13.7509 36.2444C13.1589 36.7481 12.4502 37 11.625 37C10.7998 37 10.0911 36.7481 9.49913 36.2444C8.90712 35.7407 8.61111 35.1378 8.61111 34.4356V15.5693L0.753472 8.88366C0.251157 8.45627 0 7.93729 0 7.32673C0 6.71617 0.251157 6.1972 0.753472 5.7698C1.27373 5.34241 1.88817 5.12871 2.59679 5.12871C3.30541 5.12871 3.91088 5.34241 4.41319 5.7698L10.5486 10.9901H20.4514L26.5868 5.7698C27.0891 5.34241 27.6991 5.12871 28.4167 5.12871C29.1343 5.12871 29.7442 5.34241 30.2465 5.7698C30.7488 6.21246 31 6.73525 31 7.33818C31 7.94111 30.7488 8.45627 30.2465 8.88366ZM21.5278 5.12871C21.5278 6.54827 20.9402 7.75794 19.7652 8.75774C18.5901 9.75753 17.1684 10.2574 15.5 10.2574C13.8316 10.2574 12.4099 9.75753 11.2348 8.75774C10.0598 7.75794 9.47222 6.54827 9.47222 5.12871C9.47222 3.70916 10.0598 2.49948 11.2348 1.49969C12.4099 0.499897 13.8316 0 15.5 0C17.1684 0 18.5901 0.499897 19.7652 1.49969C20.9402 2.49948 21.5278 3.70916 21.5278 5.12871Z"
                                            fill="black" />
                                    </svg>
                                    <div class="impressions">Number of Delay Requests</div>
                                </div>
                                <div class="number">03</div>
                            </div>
                            <div class="card-dashboard-sg">
                                <div class="div"><svg xmlns="http://www.w3.org/2000/svg" width="31" height="37"
                                        viewBox="0 0 31 37" fill="none">
                                        <path
                                            d="M30.2465 8.88366L22.3889 15.5693V34.4356C22.3889 35.1378 22.0929 35.7407 21.5009 36.2444C20.9089 36.7481 20.2002 37 19.375 37C18.5498 37 17.8411 36.7481 17.2491 36.2444C16.6571 35.7407 16.3611 35.1378 16.3611 34.4356V25.6436H14.6389V34.4356C14.6389 35.1378 14.3429 35.7407 13.7509 36.2444C13.1589 36.7481 12.4502 37 11.625 37C10.7998 37 10.0911 36.7481 9.49913 36.2444C8.90712 35.7407 8.61111 35.1378 8.61111 34.4356V15.5693L0.753472 8.88366C0.251157 8.45627 0 7.93729 0 7.32673C0 6.71617 0.251157 6.1972 0.753472 5.7698C1.27373 5.34241 1.88817 5.12871 2.59679 5.12871C3.30541 5.12871 3.91088 5.34241 4.41319 5.7698L10.5486 10.9901H20.4514L26.5868 5.7698C27.0891 5.34241 27.6991 5.12871 28.4167 5.12871C29.1343 5.12871 29.7442 5.34241 30.2465 5.7698C30.7488 6.21246 31 6.73525 31 7.33818C31 7.94111 30.7488 8.45627 30.2465 8.88366ZM21.5278 5.12871C21.5278 6.54827 20.9402 7.75794 19.7652 8.75774C18.5901 9.75753 17.1684 10.2574 15.5 10.2574C13.8316 10.2574 12.4099 9.75753 11.2348 8.75774C10.0598 7.75794 9.47222 6.54827 9.47222 5.12871C9.47222 3.70916 10.0598 2.49948 11.2348 1.49969C12.4099 0.499897 13.8316 0 15.5 0C17.1684 0 18.5901 0.499897 19.7652 1.49969C20.9402 2.49948 21.5278 3.70916 21.5278 5.12871Z"
                                            fill="black" />
                                    </svg>
                                    <div class="impressions"><a href="<?= ROOT ?>staffgeneral/waitlist/">Wait List</a>
                                    </div>
                                </div>
                                <div class="number"><a href="<?= ROOT ?>staffgeneral/waitlist/"> <?php echo $waitingListCount; ?></a></div>

                            </div>

                            <img src="<?= ASSETS ?>images/SG.png" style="margin-top: -38px" width=" 300" height="180">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mychart">
                                        <div>
                                            <canvas id="myChart" width="6" height="2"></canvas>
                                        </div>
                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                        <script>
                                            const ctx = document.getElementById('myChart');

                                            new Chart(ctx, {
                                                type: 'line',
                                                data: {
                                                    labels: ['5/3/24', '6/3/24y', '6/3/24', '7/3/24l', '8/3/24',
                                                        '9/3/24'
                                                    ],
                                                    datasets: [{
                                                        label: 'Yal Devi',
                                                        data: [12, 19, 3, 5, 2, 3],
                                                        borderWidth: 2
                                                    },
                                                    {
                                                        label: 'Uthara Devi',
                                                        data: [8, 15, 7, 10, 5, 9],
                                                        borderWidth: 2
                                                    },
                                                    {
                                                        label: 'Udarata Menike',
                                                        data: [8, 5, 6, 8, 5, 8],
                                                        borderWidth: 2
                                                    }
                                                    ]
                                                },
                                                options: {
                                                    plugins: {
                                                        legend: {
                                                            position: 'right', // Set legend position to 'right'
                                                            align: 'centre', // Align legend to the start of the chart area
                                                            labels: {
                                                                font: {
                                                                    size: 18, // Adjust the font size of legend labels
                                                                    weight: 'normal' // Make legend labels bold
                                                                }
                                                            }
                                                        }
                                                    },
                                                    layout: {
                                                        padding: {
                                                            right: 5 // Add padding to the right side of the chart area
                                                        }
                                                    },
                                                    scales: {
                                                        x: {
                                                            title: {
                                                                display: true,
                                                                text: 'Date', // Description for the x-axis
                                                                font: {
                                                                    size: 16, // Adjust the font size of the x-axis label
                                                                    weight: 'bold' // Make the x-axis label bold
                                                                }
                                                            }
                                                        },
                                                        y: {
                                                            beginAtZero: true,
                                                            ticks: {
                                                                callback: function (value, index, values) {
                                                                    return value;
                                                                },
                                                                font: {
                                                                    size: 15 // Adjust the font size of the tick labels
                                                                }
                                                            },
                                                            title: {
                                                                display: true,
                                                                text: 'Delay Time (minutes)', // Description for the y-axis
                                                                font: {
                                                                    size: 16, // Adjust the font size of the y-axis label
                                                                    weight: 'bold' // Make the y-axis label bold
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>