<?php $this->view("./includes/header") ?>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>

        <main style="background-color:#EFF8FF; padding:20px;">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-4 center_form1">
                    <form class="update-schedule">
                        <div class="top-head-updatetrain">Update Schedule</div>
                        <div class="head-box">
                            Train Details
                        </div>
                        <div class="form-group">
                            <label for="tamilNumberName">Train Number and Name</label>
                            <select class="text-field" id="tamilNumberName">
                                <option value="option1">YAL NILA - 1095</option>
                                <option value="option2">UTHTHARA DEVI - 1021</option>
                                <option value="option3">YAL DEVI - 1025</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="departure">Departure</label>
                            <select class="text-field" id="departure">
                                <option value="option1">Colombo</option>
                                <option value="option2">Anuradhapura</option>
                                <option value="option3">Jaffna</option>
                                <option value="option3">Vavuniya</option>
                                <option value="option3">Kodikamam</option>
                                <option value="option3">Kankesanthurai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="departureTime">Departure Time</label>
                            <input class="text-field-box" placeholder="Ex : 05.30" />
                        </div>
                        <div class="form-group">
                            <label for="departure">Arrival</label>
                            <select class="text-field" id="departure">
                                <option value="option1">Colombo</option>
                                <option value="option2">Anuradhapura</option>
                                <option value="option3">Jaffna</option>
                                <option value="option3">Vavuniya</option>
                                <option value="option3">Kodikamam</option>
                                <option value="option3">Kankesanthurai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="departureTime">Arrival Time</label>
                            <input class="text-field-box" placeholder="Ex : 13.30" />
                        </div>
                        <label for="departureTime">Seat count</label>
                        <div class="box-3">
                            <div class="box">
                                <label class="lab-small">1st Class Reserved</label>
                                <input class="inputs" placeholder="Ex : 100" />
                            </div>
                            <div class="box">
                                <label class="lab-small">2nd Class Reserved</label>
                                <input class="inputs" placeholder="Ex : 80" />
                            </div>
                            <div class="box">
                                <label class="lab-small">3rd Class Reserved</label>
                                <input class="inputs" placeholder="Ex : 60" />
                            </div>
                        </div>
                        <label for="departureTime">Ticket price</label>
                        <div class="box-3">
                            <div class="box">
                                <label class="lab-small">1st Class Reserved</label>
                                <input class="inputs" placeholder="Ex : 3000.00" />
                            </div>
                            <div class="box">
                                <label class="lab-small">2nd Class Reserved</label>
                                <input class="inputs" placeholder="Ex : 2000.00" />
                            </div>
                            <div class="box">
                                <label class="lab-small">3rd Class Reserved</label>
                                <input class="inputs" placeholder="Ex : 1000.00" />

                                <form class="add-schedule p-50 shadow" style="background-color: white;">
                                    <div class="top-head-addtrain">Update Train</div>



                                    <div class="form-group">
                                        <div class="box-3">
                                            <div class="form-group">
                                                <label for="departureTime">Train Name</label>
                                                <input class="text-field-box" placeholder="Ex : 2" />
                                            </div>

                                            <div class="form-group">
                                                <label for="departure">Train Route</label>
                                                <select class="text-field" id="departure">
                                                    <option value="option1"> Main</option>
                                                    <option value="option2">North</option>
                                                    <option value="option3">Main</option>

                                                </select>
                                            </div>

                                        </div>
                                        <div class="box-3">
                                            <div class="form-group">
                                                <label for="departure">Start Station</label>
                                                <select class="text-field" id="departure">
                                                    <option value="option1">Colombo</option>
                                                    <option value="option2">Anuradhapura</option>
                                                    <option value="option3">Jaffna</option>
                                                    <option value="option3">Vavuniya</option>
                                                    <option value="option3">Kodikamam</option>
                                                    <option value="option3">Kankesanthurai</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="departureTime">Start Time</label>
                                                <input class="text-field-box" placeholder="Ex : 13.30" />
                                            </div>
                                        </div>
                                        <div class="box-3">
                                            <div class="form-group">
                                                <label for="departure">End Station</label>
                                                <select class="text-field" id="departure">
                                                    <option value="option1"> Colombo</option>
                                                    <option value="option2">Anuradhapura</option>
                                                    <option value="option3">Jaffna</option>
                                                    <option value="option3">Vavuniya</option>
                                                    <option value="option3">Kodikamam</option>
                                                    <option value="option3">Kankesanthurai</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="departureTime">End Time</label>
                                                <input class="text-field-box" placeholder="Ex : 13.30" />
                                            </div>
                                        </div>
                                        <div class="box-3">
                                            <div class="form-group">
                                                <label for="departure">Train Type</label>
                                                <select class="text-field" id="departure">
                                                    <option value="option1"> Express</option>
                                                    <option value="option2">Mail</option>
                                                    <option value="option3">Intercity</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="departureTime">No of Compartments</label>
                                                <input class="text-field-box" placeholder="Ex : 2" />
                                            </div>
                                        </div>
                                        <div class="activation-field">
                                            <a href="http://localhost/trackNbook/public/StaffGeneral/manageSchedule"> <button class="button-white"> Back</button></a>
                                            <button class="button-blue"> Update</button>
                                        </div>
                                </form>


                            </div>
                            <div class="col-4"></div>





                    </form>
                </div>


                <div class="col-4"></div>

            </div>
        </main>
    </div>

    <style>
        .activation-field {
            display: flex;
            justify-content: flex-end;
            width: calc(103% - 10px);
            gap: 0px;
        }


        .button-blue {
            display: inline-flex;
            padding: 16px;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            border: 2px solid #FFF;
            background: #2185D5;
            cursor: pointer;
            color: white;
            width: 15%;
            margin-left: 50px;

            margin-top: 20px;
            /* Set the text color to white */
            /* You can add additional styling here, such as padding, border, etc. */
        }

        .button-white {
            display: inline-flex;
            padding: 16px;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            border: 2px solid #2185D5;
            background: var(--W-Background, #FFF);
            margin-right: 311px;
            width: 18%;
            cursor: pointer;
            margin-top: 20px;

        }

        .input2 {
            width: 200px;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #CCC;
            background: var(--W-Background, #FFF);
            margin-right: 20px;
        }

        .activation-field {
            display: flex;
            justify-content: flex-end;
            width: calc(410% - 10px);
            gap: 0px;
        }


        .button-blue {
            display: inline-flex;
            padding: 16px;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            border: 2px solid #FFF;
            background: #2185D5;
            cursor: pointer;
            color: white;
            width: 15%;
            margin-left: 50px;

            margin-top: 20px;
            /* Set the text color to white */
            /* You can add additional styling here, such as padding, border, etc. */
        }

        .update-schedule {
            margin-top: 20%;
            display: flex;
            width: 500px;
            height: auto;
            padding: 50px;
            padding-bottom: 30px;
            flex-direction: column;
            align-items: flex-start;
            background: #FAFAFA;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
            width: 100%;
        }

        label {
            color: #666;
            font-family: Noto Sans;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: 18px;
            margin-bottom: 18px;
            /* 112.5% */
        }

        .head-box {
            position: relative;
            display: flex;
            width: 83%;
            height: 36px;
            padding: 1px 42px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
            border-radius: 2px;
            background: rgba(102, 102, 102, 0.94);
            color: #FFF;
            font-family: Inter;
            font-size: 16px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
            margin-bottom: 20px;
        }

        .add-schedule {
            margin-top: 8%;
            display: flex;
            width: 900px;
            height: auto;
            padding: 50px;
            padding-bottom: 30px;
            flex-direction: column;
            align-items: flex-start;
            background: #FFFFFF;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .box-3 {
            display: flex;
            gap: 50px;
            margin-bottom: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
            width: 100%;
        }

        label {
            color: #666;
            font-family: Noto Sans;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: 18px;
            margin-bottom: 10px;

            /* 112.5% */
        }

        .text-field {
            display: flex;
            width: 100%;
            padding: 16px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            border-radius: 8px;
            border: 1px solid #CCC;
            background: var(--W-Background, #FFF);
        }

        .text-field-box {
            display: flex;
            width: 93%;
            padding: 16px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            border-radius: 8px;
            border: 1px solid #CCC;
            background: var(--W-Background, #FFF);
        }

        .box-3 {
            display: flex;
            gap: 21px;
            margin-bottom: -7px;


        }

        .box-4 {
            display: flex;
            gap: 59px;
        }

        .box {
            width: calc(25% - 0px);
        }

        .inputs1 {
            width: 114%;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #CCC;
            background: var(--W-Background, #FFF);

        }

        .inputs2 {
            width: 137%;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #CCC;
            background: var(--W-Background, #FFF);
        }

        .input1 {
            width: 90%;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #CCC;
            background: var(--W-Background, #FFF);
        }





        .lab-small {
            color: #666;
            font-family: Noto Sans;
            font-size: 13px;
            font-style: normal;
            font-weight: 400;
            line-height: 18px;
            margin-top: 10px;
            /* 138.462% */
        }
    </style>
</body>

</html>