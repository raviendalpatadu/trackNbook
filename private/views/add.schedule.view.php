<?php $this->view("./includes/header") ?>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>

        <main style="background-color:#EFF8FF; padding:20px;">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-4 center_form1">
                    <form class="add-schedule">
                        <div class="top-head-adsc">Add schedule</div>
                        <div class="head-box-adsc">
                            Train Details
                        </div>
                        <div class="form-group-adsc">

                            <div class="box-3-adsc">
                                <div class="box-adsc">
                                    <label class="departureTime">Train No</label>
                                    <input class="input1-adsc" placeholder="Ex : 1201" />
                                </div>
                                <div class="box-adsc">
                                    <label class="departureTime">Train Name</label>
                                    <input class="input2-adsc" placeholder="Ex : YAL DEVI" />
                                </div>
                            </div>
                            <div class="form-group-adsc">
                                <label for="departure">Departure</label>
                                <select class="text-field-adsc" id="departure">
                                    <option value="option1">Colombo</option>
                                    <option value="option2">Anuradhapura</option>
                                    <option value="option3">Jaffna</option>
                                    <option value="option3">Vavuniya</option>
                                    <option value="option3">Kodikamam</option>
                                    <option value="option3">Kankesanthurai</option>
                                </select>
                            </div>
                            <div class="form-group-adsc">
                                <label for="departureTime">Departure Time</label>
                                <input class="text-field-box-adsc" placeholder="Ex : 13.30" />
                            </div>
                            <div class="form-group-adsc">
                                <label for="departure">Arrival</label>
                                <select class="text-field-adsc" id="departure">
                                    <option value="option1"> Colombo</option>
                                    <option value="option2">Anuradhapura</option>
                                    <option value="option3">Jaffna</option>
                                    <option value="option3">Vavuniya</option>
                                    <option value="option3">Kodikamam</option>
                                    <option value="option3">Kankesanthurai</option>
                                </select>
                            </div>
                            <div class="form-group-adsc">
                                <label for="departureTime">Arrival Time</label>
                                <input class="text-field-box-adsc" placeholder="Ex : 13.30" />
                            </div>
                            <label for="departureTime">Seat count</label>
                            <div class="box-3-adsc">
                                <div class="box-adsc">
                                    <label class="lab-small-adsc">First Class Reserved</label>
                                    <input class="inputs-adsc" placeholder="Ex : 100" />
                                </div>
                                <div class="box-adsc">
                                    <label class="lab-small-adsc">2nd Class Reserved</label>
                                    <input class="inputs-adsc" placeholder="Ex : 80" />
                                </div>
                                <div class="box-adsc">
                                    <label class="lab-small-adsc">3rd Class Reserved</label>
                                    <input class="inputs-adsc" placeholder="Ex : 60" />
                                </div>
                            </div>
                            <label for="departureTime">Ticket price</label>
                            <div class="box-3-adsc">
                                <div class="box-adsc">
                                    <label class="lab-small-adsc">1st Class Reserved</label>
                                    <input class="inputs-adsc" placeholder="Ex : 3000.00" />
                                </div>
                                <div class="box-adsc">
                                    <label class="lab-small-adsc">2nd Class Reserved</label>
                                    <input class="inputs-adsc" placeholder="Ex : 2000.00" />
                                </div>
                                <div class="box-adsc">
                                    <label class="lab-small-adsc">3rd Class Reserved</label>
                                    <input class="inputs-adsc" placeholder="Ex : 1000.00" />
                                    <div class="endline-adsc"></div>
                                </div>
                            </div>
                            <div class="box-adsc">
                                <div class="activation-field-adsc">
                                    <a href="http://localhost/trackNbook/public/StaffGeneral/manageSchedule"> <button
                                            class="button-white-adsc"> Back</button></a>


                                    <button class="button-blue-adsc"> Add</button>

                                </div>
                            </div>
                    </form>
                </div>


                <div class="col-4"></div>

            </div>
        </main>
    </div>


</body>

</html>