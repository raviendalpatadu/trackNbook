<?php $this->view("./includes/header"); ?>

<?php

echo "<pre>";
// print_r($data);
// print_r($_SESSION);
echo "</pre>";

if (isset($data['reservations']) && $data['reservations'] != 0) {

    $seat_count = array_reduce($data['reservations'], function ($ticket_counts, $item) {
        $ticket = $item->reservation_ticket_id;
        $ticket_counts[$ticket] = (isset($ticket_counts[$ticket]) ? $ticket_counts[$ticket] : 0) + 1;
        return $ticket_counts;
    }, []);
}

if (isset($data['cancelled_reservations']) && $data['cancelled_reservations'] != 0) {

    $cancelled_seat_count = array_reduce($data['cancelled_reservations'], function ($ticket_counts, $item) {
        $ticket = $item->reservation_ticket_id;
        $ticket_counts[$ticket] = (isset($ticket_counts[$ticket]) ? $ticket_counts[$ticket] : 0) + 1;
        return $ticket_counts;
    }, []);
}
?>

<body class="flex-column mobile-d-flex">
    <?php // $this->view('includes/loader');
    ?>
    <div class="d-flex flex-column flex-grow justify-content-between">
        <?php $this->view("./includes/navbar") ?>
        <main class="d-flex flex-column flex-grow">

            <div class="row flex-grow">
                <div class="col-4 d-flex flex-column mobile-col-12" id="resevationList">

                    <!-- modify search -->
                    <!-- <div class=""> -->
                    <form action="" method="post" class="bg-Lightgray p-10 d-flex flex-column g-5">
                        <div class="d-flex flex-row g-10">
                            <div class="text-inputs max-width-none flex-grow">
                                <div class="input-text-label">Date</div>
                                <div class="input-field">
                                    <div class="text">
                                        <input type="text" name="from_date" class="type-here" placeholder="Type here">
                                    </div>
                                    <svg class="vector" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.504 13.994C17.107 13.994 16.7262 13.8363 16.4455 13.5555C16.1647 13.2748 16.007 12.894 16.007 12.497C16.007 12.1 16.1647 11.7192 16.4455 11.4385C16.7262 11.1577 17.107 11 17.504 11C17.901 11 18.2818 11.1577 18.5625 11.4385C18.8433 11.7192 19.001 12.1 19.001 12.497C19.001 12.894 18.8433 13.2748 18.5625 13.5555C18.2818 13.8363 17.901 13.994 17.504 13.994ZM16.006 17.498C16.006 17.895 16.1637 18.2758 16.4445 18.5565C16.7252 18.8373 17.106 18.995 17.503 18.995C17.9 18.995 18.2808 18.8373 18.5615 18.5565C18.8423 18.2758 19 17.895 19 17.498C19 17.101 18.8423 16.7202 18.5615 16.4395C18.2808 16.1587 17.9 16.001 17.503 16.001C17.106 16.001 16.7252 16.1587 16.4445 16.4395C16.1637 16.7202 16.006 17.101 16.006 17.498ZM12 13.992C11.6032 13.992 11.2227 13.8344 10.9422 13.5538C10.6616 13.2733 10.504 12.8928 10.504 12.496C10.504 12.0992 10.6616 11.7187 10.9422 11.4382C11.2227 11.1576 11.6032 11 12 11C12.397 11 12.7778 11.1577 13.0585 11.4385C13.3393 11.7192 13.497 12.1 13.497 12.497C13.497 12.894 13.3393 13.2748 13.0585 13.5555C12.7778 13.8363 12.397 13.992 12 13.992ZM10.502 17.496C10.502 17.893 10.6597 18.2738 10.9405 18.5545C11.2212 18.8353 11.602 18.993 11.999 18.993C12.396 18.993 12.7768 18.8353 13.0575 18.5545C13.3383 18.2738 13.496 17.893 13.496 17.496C13.496 17.099 13.3383 16.7182 13.0575 16.4375C12.7768 16.1567 12.396 15.999 11.999 15.999C11.602 15.999 11.2212 16.1567 10.9405 16.4375C10.6597 16.7182 10.502 17.099 10.502 17.496ZM6.502 13.992C6.10497 13.992 5.7242 13.8343 5.44346 13.5535C5.16272 13.2728 5.005 12.892 5.005 12.495C5.005 12.098 5.16272 11.7172 5.44346 11.4365C5.7242 11.1557 6.10497 10.998 6.502 10.998C6.89903 10.998 7.2798 11.1557 7.56054 11.4365C7.84128 11.7172 7.999 12.098 7.999 12.495C7.999 12.892 7.84128 13.2728 7.56054 13.5535C7.2798 13.8343 6.89903 13.992 6.502 13.992ZM0 5C0 3.67392 0.526784 2.40215 1.46447 1.46447C2.40215 0.526784 3.67392 0 5 0H19C20.3261 0 21.5979 0.526784 22.5355 1.46447C23.4732 2.40215 24 3.67392 24 5V19C24 20.3261 23.4732 21.5979 22.5355 22.5355C21.5979 23.4732 20.3261 24 19 24H5C3.67392 24 2.40215 23.4732 1.46447 22.5355C0.526784 21.5979 0 20.3261 0 19V5ZM22 8H2V19C2 19.7956 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H19C19.7956 22 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7956 22 19V8ZM19 2H5C4.20435 2 3.44129 2.31607 2.87868 2.87868C2.31607 3.44129 2 4.20435 2 5V6H22V5C22 4.20435 21.6839 3.44129 21.1213 2.87868C20.5587 2.31607 19.7956 2 19 2Z" fill="#344054"></path>
                                    </svg>
                                </div>
                                <div class="assistive-text display-none"></div>
                            </div>
                            <div class="d-flex flex-column align-self-end">
                                <button type="submit" class="btn btn-primary p-8 bg-blue border-none border-radius-6" id="searchDate">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 512 512" style="width: 15px; height: 15px;">
                                        <title>ionicons-v5-f</title>
                                        <path d="M221.09,64A157.09,157.09,0,1,0,378.18,221.09,157.1,157.1,0,0,0,221.09,64Z" style="fill:none;stroke: #fff;stroke-miterlimit:10;stroke-width:32px"></path>
                                        <line x1="338.29" y1="338.29" x2="448" y2="448" style="fill:none;stroke: #fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- reservations and cancellation tabs -->
                    <div class="d-flex flex-row justify-content-center" id="reservation_type_tab">
                        <div class="p-10 flex-grow text-align-center" id="res_tab_btn">Reservations</div>
                        <div class="p-10 flex-grow text-align-center" id="cancelled_tab_btn">Cancelled Reservations</div>
                        <div class="p-10 flex-grow text-align-center" id="waiting_list_tab_btn">Waiting List</div>
                    </div>

                    <div class="reservations d-flex flex-column flex-grow g-16 p-5" id="reservations">
                        <?php
                        $count = 1;
                        ?>
                        <?php if ($data['reservations'] != 0) : ?>
                            <?php foreach ($data['reservations'] as $reservation_key => $reservation) : ?>
                                <?php
                                // get previous object
                                if ($reservation_key > 0) {
                                    $previous = $data['reservations'][$reservation_key - 1];
                                }
                                // check if previous object exists
                                if (isset($previous)) {
                                    // check if previous objects ticket_number is equal to current objects ticket_number
                                    if ($previous->reservation_ticket_id == $reservation->reservation_ticket_id) {
                                        // if true then continue to next iteration
                                        continue;
                                    }
                                }

                                ?>

                                <div class="d-flex p-5 reservation-card width-fill" data-reservationdate="<?= $reservation->reservation_date ?>">
                                    <div class="d-flex flex-column flex-grow g-10 p-10">
                                        <div class="d-flex justify-content-between">
                                            <h1 class="fs-16 fw-400"><?= $reservation->reservation_ticket_id ?> </h1>
                                            <span class="fs-14"><?= $reservation->reservation_date ?></span>
                                            <?php if (strtolower($reservation->reservation_type) == 'normal') : ?>
                                                <img class="ticket-icon-res" src="<?= ASSETS ?>images/ticket-icon.png" alt="">
                                            <?php else : ?>
                                                <img class="ticket-icon-res" src="<?= ASSETS ?>images/warrant-icon.png" alt="">
                                            <?php endif; ?>
                                        </div>
                                        <!-- from station ,time with a arrow svg and to station and time -->
                                        <div class="d-flex g-20 justify-content-between align-items-center">
                                            <div class="d-flex justify-content-around align-items-center flex-grow">
                                                <div class="d-flex flex-column g-20 align-items-center">
                                                    <div>
                                                        <p class="fs-14 fw-500"><?= $reservation->reservation_start_station ?></p>
                                                        <p class="fs-12"><?= $reservation->estimated_departure_time ?></p>
                                                    </div>

                                                    <div class="d-flex g-5 align-items-end">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                                            <path fill="none" d="m25.496 10.088l-2.622-2.622V3h2.25v3.534l1.964 1.964z"></path>
                                                            <path fill="currentColor" d="M24 1a6 6 0 1 0 6 6a6.007 6.007 0 0 0-6-6m1.497 9.088l-2.622-2.622V3h2.25v3.534l1.964 1.964Z"></path>
                                                            <path fill="currentColor" d="M6 16v-6h9V8H6.184A2.995 2.995 0 0 1 9 6h6V4H9a5.006 5.006 0 0 0-5 5v12a4.99 4.99 0 0 0 3.582 4.77L5.769 30h2.176l1.714-4h8.682l1.714 4h2.176l-1.813-4.23A4.99 4.99 0 0 0 24 21v-5Zm16 4h-3v2h2.816A2.995 2.995 0 0 1 19 24H9a2.995 2.995 0 0 1-2.816-2H9v-2H6v-2h16Z"></path>
                                                        </svg>

                                                        <!-- time in hours and minutes using php-->
                                                        <p class="fs-12 fw-400"><?php
                                                                                // display time in hours and minutes eg 2h 30m
                                                                                $start = new DateTime($reservation->estimated_arrival_time);
                                                                                $end = new DateTime($reservation->estimated_departure_time);
                                                                                $diff = $start->diff($end);
                                                                                echo $diff->format('%hh %im');
                                                                                ?></p>
                                                    </div>
                                                </div>

                                                <div class="align-items-center arrow-svg d-flex flex-column g-20 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                                                        <path fill="currentColor" d="m16.172 9l-6.071-6.071l1.414-1.414L20 10l-.707.707l-7.778 7.778l-1.414-1.414L16.172 11H0V9z"></path>
                                                    </svg>

                                                    <div class="d-flex g-5 align-items-end">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M12.615 12V5H17v7zm1-1H16V6h-2.385zM17 17H8.615L6 8.058V5h1v3l2.385 8H17zm-8.596 3v-1h8.577v1zm5.211-14H16z"></path>
                                                        </svg>
                                                        <p class="fs-12 fw-400"><?= $reservation->reservation_compartment_type ?></p>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-column g-20 align-items-center">
                                                    <div>
                                                        <p class="fs-14 fw-500"><?= $reservation->reservation_end_station ?></p>
                                                        <p class="fs-12"><?= $reservation->estimated_arrival_time ?></p>
                                                    </div>

                                                    <div class="d-flex g-5 align-items-end">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                                            <path fill="currentColor" d="M10.5 9A3.5 3.5 0 1 1 14 5.5A3.504 3.504 0 0 1 10.5 9m0-5A1.5 1.5 0 1 0 12 5.5A1.502 1.502 0 0 0 10.5 4m11.974 27.313L19.34 24h-7.101a4.007 4.007 0 0 1-3.867-2.97l-1.634-6.127a3.899 3.899 0 0 1 7.535-2.009L15.1 16H21v2h-7.436l-1.223-4.59a1.9 1.9 0 0 0-3.67.978l1.633 6.126A2.005 2.005 0 0 0 12.239 22h8.42l3.654 8.525zM30 6h-4V2h-2v4h-4v2h4v4h2V8h4z"></path>
                                                            <path fill="currentColor" d="M18 28H7.768a2.003 2.003 0 0 1-1.933-1.485L2.033 12.258l1.933-.516L7.768 26H18Z"></path>
                                                        </svg>

                                                        <p class="fs-12 fw-400"><?= $seat_count[$reservation->reservation_ticket_id] ?></p>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-end flex-column g-20">
                                                <!-- more info button -->
                                                <?php
                                                $res_id = '';
                                                if (!empty($reservation->reservation_ticket_id)) {
                                                    $res_id = $reservation->reservation_ticket_id;
                                                } else {
                                                    $res_id = $reservation->reservation_status;
                                                }

                                                ?>
                                                <button class="White align-items-end bg-blue border-none border-radius-6 btn btn-primary d-flex fw-200 g-5 p-8" id="more" data-ticketId="<?= $res_id ?>" data-reservationstatus="<?= $reservation->reservation_status ?>">
                                                    More
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                        <g fill="currentColor">
                                                            <path d="M12 9a2 2 0 1 0 0-4a2 2 0 0 0 0 4m2 3a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 7a2 2 0 1 0 0-4a2 2 0 0 0 0 4"></path>
                                                            <path fill-rule="evenodd" d="M24 12c0 6.627-5.373 12-12 12S0 18.627 0 12S5.373 0 12 0s12 5.373 12 12m-2 0c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" clip-rule="evenodd"></path>
                                                        </g>
                                                    </svg>
                                                </button>

                                                <div class="d-flex g-5 align-items-end">
                                                    <p class="fs-14 fw-500"><?= $reservation->reservation_status ?></p>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="reservations d-flex flex-column flex-grow g-16 p-5 display-none" id="cancelledReservations">
                        <?php
                        $count = 1;
                        ?>
                        <?php if ($data['cancelled_reservations'] != 0) : ?>
                            <?php foreach ($data['cancelled_reservations'] as $cancel_reservation_key => $cancel_reservation) : ?>
                                <?php
                                // get previous object
                                if ($cancel_reservation_key > 0) {
                                    $previous = $data['cancelled_reservations'][$cancel_reservation_key - 1];
                                }
                                // check if previous object exists
                                if (isset($previous)) {
                                    // check if previous objects ticket_number is equal to current objects ticket_number
                                    if ($previous->reservation_ticket_id == $cancel_reservation->reservation_ticket_id) {
                                        // if true then continue to next iteration
                                        continue;
                                    }
                                }

                                ?>

                                <div class="d-flex p-5 reservation-card width-fill" data-reservationdate="<?= $cancel_reservation->reservation_date ?>">
                                    <div class="d-flex flex-column flex-grow g-10 p-10">
                                        <div class="d-flex justify-content-between">
                                            <h1 class="fs-16 fw-400"><?= $cancel_reservation->reservation_ticket_id ?> </h1>
                                            <span class="fs-14"><?= $cancel_reservation->reservation_date ?></span>
                                            <?php if (strtolower($cancel_reservation->reservation_type) == 'normal') : ?>
                                                <img class="ticket-icon-res" src="<?= ASSETS ?>images/ticket-icon.png" alt="">
                                            <?php else : ?>
                                                <img class="ticket-icon-res" src="<?= ASSETS ?>images/warrant-icon.png" alt="">
                                            <?php endif; ?>
                                        </div>
                                        <!-- from station ,time with a arrow svg and to station and time -->
                                        <div class="d-flex g-20 justify-content-between align-items-center">
                                            <div class="d-flex justify-content-around align-items-center flex-grow">
                                                <div class="d-flex flex-column g-20 align-items-center">
                                                    <div>
                                                        <p class="fs-14 fw-500"><?= $cancel_reservation->reservation_start_station ?></p>
                                                        <p class="fs-12"><?= $cancel_reservation->estimated_departure_time ?></p>
                                                    </div>

                                                    <div class="d-flex g-5 align-items-end">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                                            <path fill="none" d="m25.496 10.088l-2.622-2.622V3h2.25v3.534l1.964 1.964z"></path>
                                                            <path fill="currentColor" d="M24 1a6 6 0 1 0 6 6a6.007 6.007 0 0 0-6-6m1.497 9.088l-2.622-2.622V3h2.25v3.534l1.964 1.964Z"></path>
                                                            <path fill="currentColor" d="M6 16v-6h9V8H6.184A2.995 2.995 0 0 1 9 6h6V4H9a5.006 5.006 0 0 0-5 5v12a4.99 4.99 0 0 0 3.582 4.77L5.769 30h2.176l1.714-4h8.682l1.714 4h2.176l-1.813-4.23A4.99 4.99 0 0 0 24 21v-5Zm16 4h-3v2h2.816A2.995 2.995 0 0 1 19 24H9a2.995 2.995 0 0 1-2.816-2H9v-2H6v-2h16Z"></path>
                                                        </svg>

                                                        <!-- time in hours and minutes using php-->
                                                        <p class="fs-12 fw-400"><?php
                                                                                // display time in hours and minutes eg 2h 30m
                                                                                $start = new DateTime($cancel_reservation->estimated_arrival_time);
                                                                                $end = new DateTime($cancel_reservation->estimated_departure_time);
                                                                                $diff = $start->diff($end);
                                                                                echo $diff->format('%hh %im');
                                                                                ?></p>
                                                    </div>
                                                </div>

                                                <div class="align-items-center arrow-svg d-flex flex-column g-20 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                                                        <path fill="currentColor" d="m16.172 9l-6.071-6.071l1.414-1.414L20 10l-.707.707l-7.778 7.778l-1.414-1.414L16.172 11H0V9z"></path>
                                                    </svg>

                                                    <div class="d-flex g-5 align-items-end">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M12.615 12V5H17v7zm1-1H16V6h-2.385zM17 17H8.615L6 8.058V5h1v3l2.385 8H17zm-8.596 3v-1h8.577v1zm5.211-14H16z"></path>
                                                        </svg>
                                                        <p class="fs-12 fw-400"><?= $cancel_reservation->reservation_compartment_type ?></p>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-column g-20 align-items-center">
                                                    <div>
                                                        <p class="fs-14 fw-500"><?= $cancel_reservation->reservation_end_station ?></p>
                                                        <p class="fs-12"><?= $cancel_reservation->estimated_arrival_time ?></p>
                                                    </div>

                                                    <div class="d-flex g-5 align-items-end">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                                            <path fill="currentColor" d="M10.5 9A3.5 3.5 0 1 1 14 5.5A3.504 3.504 0 0 1 10.5 9m0-5A1.5 1.5 0 1 0 12 5.5A1.502 1.502 0 0 0 10.5 4m11.974 27.313L19.34 24h-7.101a4.007 4.007 0 0 1-3.867-2.97l-1.634-6.127a3.899 3.899 0 0 1 7.535-2.009L15.1 16H21v2h-7.436l-1.223-4.59a1.9 1.9 0 0 0-3.67.978l1.633 6.126A2.005 2.005 0 0 0 12.239 22h8.42l3.654 8.525zM30 6h-4V2h-2v4h-4v2h4v4h2V8h4z"></path>
                                                            <path fill="currentColor" d="M18 28H7.768a2.003 2.003 0 0 1-1.933-1.485L2.033 12.258l1.933-.516L7.768 26H18Z"></path>
                                                        </svg>

                                                        <p class="fs-12 fw-400"><?= $cancelled_seat_count[$cancel_reservation->reservation_ticket_id] ?></p>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-end flex-column g-20">
                                                <!-- more info button -->
                                                <?php
                                                $res_id = '';
                                                if (!empty($cancel_reservation->reservation_ticket_id)) {
                                                    $res_id = $cancel_reservation->reservation_ticket_id;
                                                } else {
                                                    $res_id = $cancel_reservation->reservation_status;
                                                }

                                                ?>
                                                <button class="White align-items-end bg-blue border-none border-radius-6 btn btn-primary d-flex fw-200 g-5 p-8" id="more" data-ticketId="<?= $res_id ?>" data-reservationstatus="<?= $cancel_reservation->reservation_status ?>">
                                                    More
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                        <g fill="currentColor">
                                                            <path d="M12 9a2 2 0 1 0 0-4a2 2 0 0 0 0 4m2 3a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 7a2 2 0 1 0 0-4a2 2 0 0 0 0 4"></path>
                                                            <path fill-rule="evenodd" d="M24 12c0 6.627-5.373 12-12 12S0 18.627 0 12S5.373 0 12 0s12 5.373 12 12m-2 0c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" clip-rule="evenodd"></path>
                                                        </g>
                                                    </svg>
                                                </button>

                                                <div class="d-flex g-5 align-items-end">
                                                    <p class="fs-14 fw-500"><?= $cancel_reservation->reservation_status ?></p>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>


                    <div class="reservations d-flex flex-column flex-grow g-16 p-5 display-none" id="waitingListReservations">

                        <?php foreach ($data['waiting_list_reservations'] as $waiting_list_reservation_key => $waiting_list_reservation) : ?>


                            <div class="d-flex p-5 reservation-card width-fill" data-reservationdate="<?= $waiting_list_reservation->waiting_list_reservation_date ?>">
                                <div class="d-flex flex-column flex-grow g-10 p-10">
                                    <div class="d-flex justify-content-between">
                                        <h1 class="fs-16 fw-600"><?= $waiting_list_reservation->train_name ?> </h1>
                                        <span class="fs-16 fw-500">Queue No</span>
                                    </div>
                                    <!-- from station ,time with a arrow svg and to station and time -->
                                    <div class="d-flex g-20 justify-content-between align-items-center">
                                        <div class="d-flex justify-content-around align-items-center flex-grow">
                                            <div class="d-flex flex-column g-20 align-items-center">
                                                <div>
                                                    <p class="fs-14 fw-500"><?= $waiting_list_reservation->start_station_name ?></p>
                                                    <p class="fs-12"><?= $waiting_list_reservation->estimated_start_time ?></p>
                                                </div>

                                                <div class="d-flex g-5 align-items-end">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                                        <path fill="none" d="m25.496 10.088l-2.622-2.622V3h2.25v3.534l1.964 1.964z"></path>
                                                        <path fill="currentColor" d="M24 1a6 6 0 1 0 6 6a6.007 6.007 0 0 0-6-6m1.497 9.088l-2.622-2.622V3h2.25v3.534l1.964 1.964Z"></path>
                                                        <path fill="currentColor" d="M6 16v-6h9V8H6.184A2.995 2.995 0 0 1 9 6h6V4H9a5.006 5.006 0 0 0-5 5v12a4.99 4.99 0 0 0 3.582 4.77L5.769 30h2.176l1.714-4h8.682l1.714 4h2.176l-1.813-4.23A4.99 4.99 0 0 0 24 21v-5Zm16 4h-3v2h2.816A2.995 2.995 0 0 1 19 24H9a2.995 2.995 0 0 1-2.816-2H9v-2H6v-2h16Z"></path>
                                                    </svg>

                                                    <!-- time in hours and minutes using php-->
                                                    <p class="fs-12 fw-400"><?php
                                                                            // display time in hours and minutes eg 2h 30m
                                                                            $start = new DateTime($waiting_list_reservation->estimated_start_time);
                                                                            $end = new DateTime($waiting_list_reservation->estimated_end_time);
                                                                            $diff = $start->diff($end);
                                                                            echo $diff->format('%hh %im');
                                                                            ?></p>
                                                </div>
                                            </div>

                                            <div class="align-items-center arrow-svg d-flex flex-column g-20 ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
                                                    <path fill="currentColor" d="m16.172 9l-6.071-6.071l1.414-1.414L20 10l-.707.707l-7.778 7.778l-1.414-1.414L16.172 11H0V9z"></path>
                                                </svg>

                                                <div class="d-flex g-5 align-items-end">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M12.615 12V5H17v7zm1-1H16V6h-2.385zM17 17H8.615L6 8.058V5h1v3l2.385 8H17zm-8.596 3v-1h8.577v1zm5.211-14H16z"></path>
                                                    </svg>
                                                    <p class="fs-12 fw-400"><?= $waiting_list_reservation->compartment_class_type ?></p>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column g-20 align-items-center">
                                                <div>
                                                    <p class="fs-14 fw-500"><?= $waiting_list_reservation->end_station_name ?></p>
                                                    <p class="fs-12"><?= $waiting_list_reservation->estimated_end_time ?></p>
                                                </div>

                                                <div class="d-flex g-5 align-items-end">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                                        <path fill="currentColor" d="M10.5 9A3.5 3.5 0 1 1 14 5.5A3.504 3.504 0 0 1 10.5 9m0-5A1.5 1.5 0 1 0 12 5.5A1.502 1.502 0 0 0 10.5 4m11.974 27.313L19.34 24h-7.101a4.007 4.007 0 0 1-3.867-2.97l-1.634-6.127a3.899 3.899 0 0 1 7.535-2.009L15.1 16H21v2h-7.436l-1.223-4.59a1.9 1.9 0 0 0-3.67.978l1.633 6.126A2.005 2.005 0 0 0 12.239 22h8.42l3.654 8.525zM30 6h-4V2h-2v4h-4v2h4v4h2V8h4z"></path>
                                                        <path fill="currentColor" d="M18 28H7.768a2.003 2.003 0 0 1-1.933-1.485L2.033 12.258l1.933-.516L7.768 26H18Z"></path>
                                                    </svg>

                                                    <!-- <p class="fs-12 fw-400"></p> -->
                                                    <!-- </p> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-end flex-column g-20">
                                            <!-- more info button -->

                                            <div class="White align-items-end bg-blue border-none border-radius-6 btn btn-primary d-flex fw-200 g-5 p-8">
                                                <?= str_pad($waiting_list_reservation->priority_number, 2, "0", STR_PAD_LEFT) ?>
                                            </div>

                                            <div class="d-flex g-5 align-items-end">
                                                <p class="fs-14"><?= $waiting_list_reservation->waiting_list_reservation_date ?></p>
                                                </p>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>


                </div>

                <div class="col-8 d-flex flex-column justify-content-center mobile-display-none" id="reservationDataContainer">
                    <div class="d-flex flex-grow">
                        <div class="align-items-center align-self-center d-flex flex-auto flex-column" id="selectResevation">
                            <img width="80" height="80" src="https://img.icons8.com/dotty/80/ticket.png" alt="ticket">
                            <p>Select reservation </p>
                        </div>

                        <div class="d-flex flex-column flex-grow g-10 p-10 display-none" id="reservationData">
                            <div id="closeCross" class="display-none mobile-display-block ">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.2575 3.84056C13.3515 3.74111 13.4249 3.62412 13.4737 3.49628C13.5225 3.36844 13.5456 3.23224 13.5417 3.09547C13.5378 2.9587 13.5071 2.82403 13.4511 2.69915C13.3952 2.57426 13.3153 2.46162 13.2158 2.36764C13.1164 2.27367 12.9994 2.2002 12.8715 2.15143C12.7437 2.10266 12.6075 2.07956 12.4707 2.08342C12.334 2.08729 12.1993 2.11806 12.0744 2.17398C11.9495 2.22989 11.8369 2.30986 11.7429 2.40931L2.88874 11.7843C2.70589 11.9777 2.604 12.2338 2.604 12.4999C2.604 12.7661 2.70589 13.0222 2.88874 13.2156L11.7429 22.5916C11.8363 22.6932 11.9489 22.7753 12.0742 22.833C12.1996 22.8908 12.3351 22.923 12.473 22.9279C12.6109 22.9328 12.7485 22.9103 12.8776 22.8616C13.0067 22.8129 13.1249 22.739 13.2252 22.6443C13.3255 22.5495 13.406 22.4358 13.462 22.3097C13.518 22.1835 13.5484 22.0475 13.5514 21.9096C13.5544 21.7716 13.53 21.6344 13.4795 21.506C13.4291 21.3775 13.3536 21.2604 13.2575 21.1614L5.07832 12.4999L13.2575 3.84056Z" fill="black" />
                                </svg>

                            </div>

                            <!-- map -->
                            <div id="map" class="reservation-map-view mobile-display-none">

                            </div>

                            <!-- data -->
                            <div class="bg-background-colour-nav d-flex flex-grow" id="reaservationData">

                                <div class="d-flex flex-grow mobile-flex-column" id="ticketSummary">

                                    <div class="d-flex flex-grow flex-column g-10 p-10" id="ticketDataDown">
                                        <div class="border-bottom d-flex g-100 mobile-flex-column-reverse mobile-g-20 width-fill">
                                            <!-- train details and qr code -->
                                            <div class="d-flex flex-column flex-grow g-5 ticket-summary-train-data">
                                                <p class="fs-14 fw-500" id="refNo">Ref No: None</p>
                                                <div class="d-flex flex-column flex-grow fs-12 g-5 ticket-summary-train-data-details">
                                                    <!-- <div class="ticket-summary-train-data-details flex-grow"> -->
                                                    <div class="d-flex">
                                                        <p class="width-fill heading">Price</p>
                                                        <p class="width-fill" id="price">None</p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="width-fill heading">Train No</p>
                                                        <p class="width-fill" id="trainNo">None</p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="width-fill heading">Train Type</p>
                                                        <p class="width-fill" id="trainType">None</p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="width-fill heading">Train Name</p>
                                                        <p class="width-fill" id="trainName">None</p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="width-fill heading">Reservation Date</p>
                                                        <p class="width-fill" id="reservationDate">None</p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="width-fill heading">Start Station</p>
                                                        <p class="width-fill" id="startStation">None</p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="width-fill heading">End Station</p>
                                                        <p class="width-fill" id="endStation">None</p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="width-fill heading">Arrival Time</p>
                                                        <p class="width-fill" id="arraivalTime">None</p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p class="width-fill heading">No of Passengers</p>
                                                        <p class="width-fill" id="noOfPassengers">None</p>
                                                    </div>
                                                    <!-- </div> -->
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column g-10 justify-content-center align-items-center">
                                                <div id="qr_code"></div>
                                                <div class="fs-20 fw-500" id="resStatus">Cancelled</div>
                                            </div>
                                        </div>
                                        <div class="align-items-start d-flex flex-column g-10">
                                            <p class="fs-14">Passenger and Compartment Details</p>
                                            <table class="ticket-summary-passenger-compartment-details text-align-center" id="compartmentDetails">

                                            </table>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column g-10 align-items-center justify-content-center px-10">
                                        <!-- download ticket btn -->
                                        <button id="downloadTicket" class=" width-fill btn btn-primary white bg-blue border-none border-radius-6 p-8 fw-300">Download Ticket</button>

                                        <!-- canel reservation btn -->
                                        <button id='cancelReservation' class="width-fill btn btn-primary bg-red border-none border-radius-6 p-8 white fw-300">Cancel Reservation</button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php $this->view('includes/footer'); ?>
    </div>


</body>

</html>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="<?='https://maps.googleapis.com/maps/api/js?key='.MAP_API_KEY.'&callback=initMap&v=weekly'?>" defer></script>

<script>
    function initMap() {
        function calculateAndDisplayRoute(directionsService, directionsRenderer, originLatLng, destinationLatLng) {
            directionsService
                .route({
                    origin: {
                        lat: originLatLng.lat,
                        lng: originLatLng.lng
                    },
                    destination: {
                        lat: destinationLatLng.lat,
                        lng: destinationLatLng.lng
                    },
                    travelMode: google.maps.TravelMode.TRANSIT,
                    transitOptions: {
                        modes: [google.maps.TransitMode.TRAIN]
                    }
                })
                .then((response) => {
                    // const route = response.routes[0].overview_polyline;
                    directionsRenderer.setDirections(response);
                })
                .catch((e) => window.alert("Directions request failed due to " + status));
        }


        async function findPlaces(stationName, callback) {
            const {
                Place
            } = await google.maps.importLibrary("places");
            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");
            const request = {
                textQuery: stationName,
                fields: ["displayName", "location"],
                includedType: "train_station"
            };
            //@ts-ignore
            const {
                places
            } = await Place.searchByText(request);

            if (places.length) {
                callback(places);
            } else {
                console.log("No results");
            }
        }

        function drawMap(startStationMap, endStationMap) {

            findPlaces(startStationMap + ' railway station', function(res) {
                var startStation = res[0].Fg.location
                findPlaces(endStationMap + ' railway station', function(resp) {
                    var endStation = resp[0].Fg.location
                    calculateAndDisplayRoute(directionsService, directionsRenderer, startStation, endStation);
                });
            });

            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: {
                    lat: 6.9337010999999995,
                    lng: 79.85003019999999
                }
            });

            directionsRenderer.setMap(map);
        }



        // window.initMap = initMap;

        // $(document).ready(function() {
        // stop default popup in date input
        $('input[name="from_date"]').on('focus', function(e) {
            e.preventDefault();
            $('input[name="from_date"]').daterangepicker({
                "minYear": 2024,
                "autoApply": true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Comming Week': [moment(), moment().add(6, 'days')],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "alwaysShowCalendars": true,
            }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
        });

        $('input[name="from_date"]').change(function(e) {
            e.preventDefault();

            sortReservations();
        })

        function sortReservations() {
            var date = $('input[name = "from_date"]').val();

            var startDate = moment(date.split(' - ')[0]).format('YYYY-MM-DD');

            var endDate = moment(date.split(' - ')[1]).format('YYYY-MM-DD');

            $('#reservations').find('.reservation-card').each(function(index, element) {
                var reservationDate = $(element).data('reservationdate');
                console.log(reservationDate);

                if (reservationDate < startDate || reservationDate > endDate) {
                    $(element).addClass('display-none');
                } else {
                    $(element).removeClass('display-none');
                }
            });

            $('#cancelledReservations').find('.reservation-card').each(function(index, element) {
                var reservationDate = $(element).data('reservationdate');
                console.log(reservationDate);

                if (reservationDate < startDate || reservationDate > endDate) {
                    $(element).addClass('display-none');
                } else {
                    $(element).removeClass('display-none');
                }
            });

            $('#waitingListReservations').find('.reservation-card').each(function(index, element) {
                var reservationDate = $(element).data('reservationdate');
                console.log(reservationDate);

                if (reservationDate < startDate || reservationDate > endDate) {
                    $(element).addClass('display-none');
                } else {
                    $(element).removeClass('display-none');
                }
            });
        }

        $('#closeCross').click(function() {
            $('#resevationList').removeClass('mobile-display-none');
            $('#reservationDataContainer').addClass('mobile-display-none');
        });



        $('button#more').click(function(event) {

            var ticketId = $(this).data('ticketid')
            // console.log(ticketId);

            var reservationStatus = $(this).data('reservationstatus');
            // console.log(reservationStatus);

            // if in mobile view
            if ($(window).width() < 768) {
                $('#resevationList').addClass('mobile-display-none');

                $('#reservationDataContainer').removeClass('mobile-display-none');
            }

            $('#selectResevation').addClass('display-none');
            // $('#loader').removeClass('display-none');
            $('#reservationData').removeClass('display-none');
            // $('#reservationData').hide();

            // check is the ticket id has the the 1st 3 letters as 'WRT'
            var regex = new RegExp('TMP', 'i');

            if (reservationStatus != "Cancelled") {
                reservationStatus = '';
            }

            // warrant reservation data
            if (regex.test(ticketId)) {

                $.ajax({
                    url: '<?= ROOT ?>ajax/getReservationData/' + ticketId + '/' + reservationStatus,
                    type: 'POST',

                    success: function(data, response) {
                        // console.log(data);
                        var data = JSON.parse(data);
                        // console.log(data);

                        var ticketDataDown = $('#ticketDataDown');

                        // add data to the ticket summary
                        ticketDataDown.find('#refNo').text('Ref No: ' + data[0].reservation_ticket_id);
                        ticketDataDown.find('#price').text(data[0].reservation_amount);
                        ticketDataDown.find('#trainNo').text(data[0].train_no);
                        ticketDataDown.find('#trainType').text(data[0].train_type);
                        ticketDataDown.find('#trainName').text(data[0].reservation_train_name);
                        ticketDataDown.find('#reservationDate').text(data[0].reservation_date);
                        ticketDataDown.find('#startStation').text(data[0].reservation_start_station);
                        ticketDataDown.find('#endStation').text(data[0].reservation_end_station);
                        ticketDataDown.find('#arraivalTime').text(data[0].estimated_arrival_time);
                        ticketDataDown.find('#noOfPassengers').text(data.length)
                        ticketDataDown.find('#cancelReservation').data('ticketid', data[0].reservation_ticket_id);

                        // add data to the compartment details
                        var compartmentDeatails = $('#compartmentDetails');
                        compartmentDeatails.empty();

                        var thead = ['NIC', 'Gender', 'Seat No']

                        thead.forEach(function(heading) {
                            var tr = $('<tr id="heading" data-heading="' + heading + '"/>');
                            tr.append('<th>' + heading + '</th>');

                            data.forEach(function(passenger) {
                                if (heading == 'NIC') {
                                    tr.append('<td  data-label="NIC">' + passenger.reservation_passenger_nic + '</td>');
                                } else if (heading == 'Gender') {
                                    tr.append('<td  data-label="Genger">' + passenger.reservation_passenger_gender + '</td>');
                                } else if (heading == 'Seat No') {
                                    tr.append('<td  data-label="Seat No">' + passenger.reservation_seat + '</td>');
                                }
                            });
                            compartmentDeatails.append(tr);
                        });

                        // 
                        var reservation_status = $('<div></div>').text(data[0].reservation_status);
                        reservation_status.addClass('fs-18 fw-800');

                        //    chanege the reservation color according to the status
                        if (data[0].reservation_status == 'Pending' || data[0].reservation_status == 'Approval Pending') {
                            reservation_status.addClass('yellow');
                        } else if (data[0].reservation_status == 'Reserved') {
                            reservation_status.addClass('green');
                        } else if (data[0].reservation_status == 'Cancelled' || data[0].reservation_status == 'Rejected') {
                            reservation_status.addClass('red');
                        } else if (data[0].reservation_status == 'Reserved') {
                            reservation_status.addClass('Border-blue');
                        }

                        $('#qr_code').empty();
                        $('#resStatus').empty();
                        $('#resStatus').append(reservation_status);

                        //remove download ticket button
                        $('#downloadTicket').hide();

                        // change cancel reservation button text
                        $('#cancelReservation').text('Cancel Warrant');

                        startStationMap = data[0].reservation_start_station;
                        endStationMap = data[0].reservation_end_station;

                        drawMap(startStationMap, endStationMap);

                    }

                });
            }
            // normal reservation data
            else {
                $.ajax({
                    url: '<?= ROOT ?>ajax/getReservationData/' + ticketId + '/' + reservationStatus,
                    type: 'POST',

                    success: function(data, response) {
                        // console.log(data);
                        var data = JSON.parse(data);
                        // console.log(data);

                        var ticketDataDown = $('#ticketDataDown');

                        // add data to the ticket summary
                        ticketDataDown.find('#refNo').text('Ref No: ' + data[0].reservation_ticket_id);
                        ticketDataDown.find('#price').text(data[0].reservation_price);
                        ticketDataDown.find('#trainNo').text(data[0].reservation_train_id);
                        ticketDataDown.find('#trainName').text(data[0].reservation_train_name);
                        ticketDataDown.find('#reservationDate').text(data[0].reservation_date);
                        ticketDataDown.find('#startStation').text(data[0].reservation_start_station);
                        ticketDataDown.find('#endStation').text(data[0].reservation_end_station);
                        ticketDataDown.find('#arraivalTime').text(data[0].estimated_arrival_time);
                        ticketDataDown.find('#noOfPassengers').text(data.length)
                        ticketDataDown.find('#cancelReservation').data('ticketid', data[0].reservation_ticket_id);


                        // add data to the compartment details
                        var compartmentDeatails = $('#compartmentDetails');
                        compartmentDeatails.empty();

                        var thead = ['NIC', 'Gender', 'Seat No']

                        thead.forEach(function(heading) {
                            var tr = $('<tr id="heading" data-heading="' + heading + '"/>');
                            tr.append('<th>' + heading + '</th>');

                            data.forEach(function(passenger) {
                                if (heading == 'NIC') {
                                    tr.append('<td  data-label="NIC">' + passenger.reservation_passenger_nic + '</td>');
                                } else if (heading == 'Gender') {
                                    tr.append('<td  data-label="Genger">' + passenger.reservation_passenger_gender + '</td>');
                                } else if (heading == 'Seat No') {
                                    tr.append('<td  data-label="Seat No">' + passenger.reservation_seat + '</td>');
                                }
                            });
                            compartmentDeatails.append(tr);
                        });

                        // add qr code
                        makeTicketQrCode(data[0].reservation_ticket_id , 'qr_code');


                        var reservation_status = $('<div></div>').text(data[0].reservation_status);
                        reservation_status.addClass('fs-18 fw-800');

                        if (data[0].reservation_status == 'Pending' || data[0].reservation_status == 'Approval Pending') {
                            reservation_status.addClass('yellow');
                        } else if (data[0].reservation_status == 'Reserved') {
                            reservation_status.addClass('green');
                        } else if (data[0].reservation_status == 'Cancelled' || data[0].reservation_status == 'Rejected') {
                            reservation_status.addClass('red');
                        } else if (data[0].reservation_status == 'Reserved') {
                            reservation_status.addClass('Border-blue');
                        }

                        $('#resStatus').empty();
                        $('#resStatus').append(reservation_status);

                        $('#cancelReservation').text('Cancel Reservation');
                        startStationMap = data[0].reservation_start_station;
                        endStationMap = data[0].reservation_end_station;

                        drawMap(startStationMap, endStationMap);

                    }

                });
            }

            if (reservationStatus == 'Cancelled') {
                $('#cancelReservation').hide();
                $('#downloadTicket').hide();
            } else {
                $('#downloadTicket').show();
                $('#cancelReservation').show();
            }

            if (regex.test(ticketId)) {
                // show a draffted messege on to of #ticketSummary
                $('#ticketSummary').append('<div class="draft-ticket">Draft</div>');

            }






        });


        $('#cancelled_tab_btn').click(function() {

            $('#selectResevation').removeClass('display-none');
            $('#reservationData').addClass('display-none');

            $('#cancelledReservations').removeClass('display-none');
            $('#reservations').addClass('display-none');
            $('#waitingListReservations').addClass('display-none');

            //add active class to the tab
            $('#cancelled_tab_btn').addClass('active');
            $('#res_tab_btn').removeClass('active');
            $('#waiting_list_tab_btn').removeClass('active');

        });

        $('#res_tab_btn').click(function() {
            $('#selectResevation').removeClass('display-none');
            $('#reservationData').addClass('display-none');

            $('#reservations').removeClass('display-none');
            $('#cancelledReservations').addClass('display-none');
            $('#waitingListReservations').addClass('display-none');


            //add active class to the tab
            $('#res_tab_btn').addClass('active');
            $('#cancelled_tab_btn').removeClass('active');
            $('#waiting_list_tab_btn').removeClass('active');
        });

        $('#waiting_list_tab_btn').click(function() {
            $('#selectResevation').removeClass('display-none');
            $('#reservationData').addClass('display-none');

            $('#waitingListReservations').removeClass('display-none');
            $('#cancelledReservations').addClass('display-none');
            $('#reservations').addClass('display-none');

            //add active class to the tab
            $('#waiting_list_tab_btn').addClass('active');
            $('#res_tab_btn').removeClass('active');
            $('#cancelled_tab_btn').removeClass('active');
        });

        // poup alert to confirm cancelation
        $('#cancelReservation').click(function() {
            var ticketId = $('#refNo').text().split(' ')[2];
            // console.log(ticketId);
            processefundAndPopup(ticketId);
            

        });

        $("#downloadTicket").click(function() {
            var element = $('#ticketDataDown');
            console.log(element);
            var name = "TKT<?= Auth::getreservation_ticket_id() ?>";
            var pdf = new jsPDF();


            pdf.addHTML(element, function() {
                pdf.save(name + '.pdf');
            })
        });
        // });
    }

    function getRefund(ticketId, callback) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '<?= ROOT ?>ajax/getRefund/',
                type: 'POST',

                data: {
                    ticket_id: ticketId
                },

                success: function(data, response) {
                    console.log(data);
                    var data = JSON.parse(data);
                    console.log(data);
                    resolve(data);
                },
                error: function(error) {
                    console.error("AJAX error: " + error);
                    reject(error);
                }
            });
        });
    }

    async function processefundAndPopup(ticketId){
        try{
            var refund = await getRefund(ticketId);
            console.log(refund);
            
            // make a custom confirm box
            var tiile = 'Confirm Cancelation';
            var desc = 'You are having a refund of Rs.' + refund + '. Are you sure you want to cancel this reservation?';
            var btnTxt = 'Cancel Reservation';
            var img = 'https://img.icons8.com/ios/50/000000/question-mark.png';

            makePopupBox(tiile, desc, btnTxt, img, function(res) {
                if (res) {
                    $('.loader__main').fadeIn();

                    $.ajax({
                        url: '<?= ROOT ?>ajax/cancelReservation/' + ticketId,
                        type: 'GET',

                        success: function(data, response) {
                            console.log(data);
                            var data = JSON.parse(data);
                            console.log(data);
                            if (data.length == 0) {
                                // alert('Reservation has been canceled');
                                makePopupBox('Reservation Cancelled', 'Reservation has been canceled', 'OK', 'https://img.icons8.com/ios/50/000000/checked-2.png', function(res) {
                                    if (res) {
                                        location.reload();
                                    }
                                });
                            } else {
                                console.log(data);
                                console.log('Failed to cancel reservation');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("AJAX error: " + textStatus + ' : ' + errorThrown);
                        },
                        // Hide the loading screen when the AJAX request is complete
                        complete: function() {
                            $('.loader__main').fadeOut();
                        }

                    });
                }
            });
        } catch (error) {
            console.error(error);
        }
    }


</script>