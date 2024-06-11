<?php $this->view("./includes/header"); ?>
<html>

<body>
    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main style="background-color:#EFF8FF; padding:20px;">
            <div class="container d-flex flex-column justify-content-center align-self-center ">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4 center_form1 ">
                        <div class="card-contact">
                            <h1>Contact us</h1><br>
                            <div class="text-inputs ">
                                <div class="input-text-label w-10">Email id</div>
                                <div class="input-field">
                                    <div class="text">
                                        <input type="text" name="" class="type-here" placeholder="Ex : ach@gmail.com">
                                    </div>
                                </div>
                            </div>

                            <div class="text-inputs ">
                                <div class="input-text-label">Name</div>
                                <div class="input-field">
                                    <div class="text">
                                        <input type="text" name="" class="type-here" placeholder="Ex : Achchuthan">
                                    </div>
                                </div>
                            </div>
                            <div class="text-inputs ">
                                <div class="input-text-label">Mobile No</div>
                                <div class="input-field">
                                    <div class="text">
                                        <input type="text" name="" class="type-here" placeholder="Ex : 077123456">
                                    </div>
                                </div>
                            </div>
                            <div class="input-text-label text lightgray-font">
                                <label for="departure">Subject</label>
                                <select class="input-field dropdown" id="departure">
                                    <option value="option1">Select Subject</option>
                                    <option value="option2">Complaint</option>
                                    <option value="option3">Compliment</option>
                                    <option value="option3">Other</option>
                                </select>
                            </div>
                            <div class="text-inputs ">
                                <div class="input-text-label">Message</div>
                                <div class="input-field">
                                    <div class="text">
                                        <input type="text" name="" class="type-here" placeholder="Type here">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-10">
                                <button class="button ">
                                    <div class="button-base mx-30">
                                        <input type="reset" value="Reset">
                                    </div>
                                </button>
                                <button class="button ">
                                    <div class="button-base mx-20 px-20">
                                        <input type="submit" value="Send" name="submit">
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
        </main>
        <?php $this->view('includes/load-js'); ?>
    </div>
</body>

</html>