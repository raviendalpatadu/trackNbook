<?php $this->view("./includes/header") ?>
<?php $this->view("./includes/load-js") ?>

<head>

</head>


<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>

        <main>
            <div class="container">
                <div class="row ml-20 mr-20 mt-20">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="trains-available">
                                        <h3>Available Users</h3>
                                    </div>
                                    <br>
                                    <hr style="color: gray">
                                    <br><br>
                                    <div class="filter-container mb-20">
                                        <label for="typeFilter" class="mr-20">Filter by Type </label>
                                        <select id="typeFilter">
                                            <option value="">All</option>
                                            <option value="admin">Admin</option>
                                            <option value="passenger">Passenger</option>
                                            <option value="station_master">Station Master</option>
                                            <option value="staff_general">Staff General</option>
                                            <option value="staff_ticket">Staff Ticket</option>
                                            <option value="train_driver">Train Driver</option>
                                        </select>
                                    </div>
                                    <table class="if-table stripe hover" id="userTable" style:width=100%>
                                        <thead>
                                            <tr>
                                                <th class="col-3 align-items-center ">
                                                    <!-- Add 'text-left' class for left alignment -->
                                                    Name
                                                </th>
                                                <th class="col-1 "> <!-- Add 'text-left' class for left alignment -->
                                                    Type
                                                </th>
                                                <th class="col-2 "> <!-- Add 'text-left' class for left alignment -->
                                                    Phone
                                                </th>
                                                <th class="col-3 "> <!-- Add 'text-left' class for left alignment -->
                                                    Email
                                                </th>
                                                <th class="col-2 "> <!-- Add 'text-left' class for left alignment -->
                                                    NIC
                                                </th>
                                                <th class="col-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['users'] as $user): ?>
                                                <tr class="row ">
                                                    <td class="col-3 d-flex align-items-center">
                                                        <?= $user->user_first_name ?>
                                                    </td>
                                                    <td class="col-1 d-flex align-items-center lightgray-font ">
                                                        <?= $user->user_type ?>
                                                    </td>
                                                    <td class="col-2 d-flex align-items-center">
                                                        <?= $user->user_phone_number ?>
                                                    </td>
                                                    <td class="col-3 d-flex align-items-center">
                                                        <?= $user->user_email ?>
                                                    </td>
                                                    <td class="col-2 d-flex align-items-center">
                                                        <div class="d-flex .flex-row g-5 mr-5">
                                                            <?= $user->user_nic ?>
                                                        </div>
                                                    </td>
                                                    <td class="col-1 d-flex align-items-center g-5">
                                                        <a class="blue"
                                                            href="<?= ROOT ?>admin/updateUser/<?= $user->user_id ?>">
                                                            <div class="badge-base bg-Selected-Blue align-items-center">
                                                                <div class="dot">
                                                                    <div class="dot4 "></div>
                                                                </div>
                                                                <div class="text blue">View</div>
                                                            </div>
                                                        </a>

                                                        <div class="badge-base bg-Selected-red"
                                                            onclick="alert('Are you sure you want to delete record')">
                                                            <a class="blue d-flex  g-2 align-items-center"
                                                                href="<?= ROOT ?>admin/deleteUser/<?= $user->user_id ?>">
                                                                <div class="dot">
                                                                    <div class="dot4  bg-Banner-red"></div>
                                                                </div>
                                                                <div class="text red">Delete</div>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
    <script>
        $(document).ready(function () {
            let table = new DataTable("#userTable", {
                ajax: {
                    url: "<?= ROOT ?>ajax/getUsers",
                    dataSrc: ""
                },
                columns: [
                    {
                        title: 'Name',
                        data: 'user_first_name',
                        width: '20%' // Set the width for the first column
                    },
                    {
                        title: 'Type',
                        data: 'user_type'
                    },
                    {
                        title: 'Phone',
                        data: 'user_phone_number'
                    },
                    {
                        title: 'Email',
                        data: 'user_email'
                    },
                    {
                        title: 'NIC',
                        data: 'user_nic'
                    },
                    {
                        title: 'Actions',
                        data: null,
                        width: '15%',
                        render: function (data, type, row) {
                            return `
                            

                            <div class="row">
                            <a class="blue" href="<?= ROOT ?>admin/updateUser/${data.user_id}">
                                <div class="badge-base bg-Selected-Blue">
                                    <div class="dot">
                                        <div class="dot4"></div>
                                    </div>
                                    <div class="text blue">View</div>
                                </div>
                            </a>
                            <div class="g-5"></div> <!-- Add a small gap -->
                            <div class="badge-base bg-Selected-red" onclick="alert('Are you sure you want to delete user')">
                                <a class="blue d-flex flex-row g-2 align-items-center" href="<?= ROOT ?>admin/deleteUser/${data.user_id}">
                                    <div class="dot">
                                        <div class="dot4 bg-Banner-red"></div>
                                    </div>
                                    <div class="text red">Delete</div>
                                </a>
                            </div>
                        `;
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 0, // Target the first column
                        className: 'dt-body-left' // Left-align the content in the first column
                    }
                ]
            });

            // Apply the filter
            $('#typeFilter').on('change', function () {
                let type = $(this).val();
                table.column(1).search(type).draw();
            });
        });
    </script>

</body>

</html>