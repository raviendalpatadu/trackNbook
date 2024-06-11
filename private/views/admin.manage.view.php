<?php $this->view("./includes/header") ?>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>

        <main style="background-color:#EFF8FF;">

            <div class="container">
                <div class="row if-c-center">
                    <div class="col-8 center-col">
                        <a href="../user/register">
                            <button class="if-manage-button" role="button">Add User</button>
                        </a>
                    </div>
                    <div class="col-8 center-col mt-50">
                        <a href="../user/search">
                            <button class="if-manage-button" role="button">Search User</button>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- <button class="button-34" role="button">Button 34</button> -->


        </main>
    </div>


</body>

</html>