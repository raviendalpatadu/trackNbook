<?php $this->view("./includes/header") ?>
<?php $this->view("./includes/load-js") ?>

<body>

    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>

        <main style='background-color:#EFF8FF;'>

            <div class="container">
                <div class="date-selection">
                    <input type="text" id="dateRange" name="dateRange" placeholder="Select date range">
                    <select id="reservationType" name="reservationType" class="custom-select">
                        <option value="all">All</option>
                        <option value="warrant">Warrant</option>
                        <option value="normal">Normal</option>
                    </select>
                    <button class="fancy-button" onclick="generatePDF()">Generate report</button>
                </div>

            </div>

        </main>
    </div>

</body>

</html>

<script>
    $(document).ready(function () {
        $('#dateRange').daterangepicker({
            opens: 'left',
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });

    function generatePDF() {
        const dateRange = $('#dateRange').val().split(' - ');
        const reservationType = $('#reservationType').val();

        $.ajax({
            url: '<?= ROOT ?>ajax/getReservationReport',
            method: 'POST',
            data: { startDate: dateRange[0], endDate: dateRange[1], reservationType: reservationType },
            success: function (response) {
                const res = JSON.parse(response);
                const reservations = res.reservations;

                let total = 0;
                let normalReservationCount = 0; // Count of normal reservations
                const data_length = reservations.length;

                for (let i = 0; i < data_length; i++) {
                    total += parseFloat(reservations[i]['total_amount']);
                    if (reservations[i]['reservation_type'] === 'Normal') {
                        normalReservationCount += reservations[i]['total_reservations'];
                    }
                }

                const averageRevenue = (total / normalReservationCount).toFixed(2);

                const props = {
                    outputType: jsPDFInvoiceTemplate.OutputType.save,
                    returnJsPDFDocObject: true,
                    fileName: "Reservation Report",
                    orientationLandscape: false,
                    compress: true,
                    logo: {
                        src: "<?= ASSETS ?>/images/logo-image.png",
                        type: 'png',
                        width: 15,
                        height: 25,
                        margin: {
                            top: 0,
                            left: 0
                        }
                    },
                    business: {
                        name: "TrackNBook",
                        address: "Sri Lanka",
                        phone: "0771234567",
                        email: "Admin@mail.com",
                        website: "www.tracknbook.com",
                    },
                    contact: {
                        label: "Report Generated By:",
                        name: "<?=Auth::getUser_first_name()?>",
                        email: " ",

                        otherInfo: `From: ${dateRange[0]} To: ${dateRange[1]}`,
                    },
                    invoice: {
                        label: " ",
                        headerBorder: false,
                        tableBodyBorder: false,
                        header: [
                            {
                                title: "No",
                                style: {
                                    width: 20,
                                    height: 40,
                                    backgroundColor: '#f2f2f2',
                                    textAlign: 'center',
                                    fontWeight: 'bold',
                                    fontSize: 12
                                }
                            },
                            {
                                title: "Reservation Date",
                                style: {
                                    width: 50,
                                    height: 40,
                                    backgroundColor: '#f2f2f2',
                                    textAlign: 'center',
                                    fontWeight: 'bold'
                                }
                            },
                            {
                                title: "Reservation Type",
                                style: {
                                    width: 50,
                                    height: 40,
                                    backgroundColor: '#f2f2f2',
                                    textAlign: 'center',
                                    fontWeight: 'bold',
                                    fontSize: 12
                                }
                            },
                            {
                                title: "Total Reservations",
                                style: {
                                    width: 45,
                                    height: 40,
                                    backgroundColor: '#f2f2f2',
                                    textAlign: 'center',
                                    fontWeight: 'bold',
                                    fontSize: 12
                                }
                            },
                            {
                                title: "Total Amount",
                                style: {
                                    width: 10,
                                    height: 40,
                                    backgroundColor: '#f2f2f2',
                                    textAlign: 'center',
                                    fontWeight: 'bold',
                                    fontSize: 12
                                }
                            },
                        ],
                        table: Array.from(Array(data_length), (item, index) => ([
                            index + 1,
                            reservations[index]['reservation_date'],
                            reservations[index]['reservation_type'], // Added reservation type
                            reservations[index]['total_reservations'],
                            reservations[index]['total_amount'],
                        ])),
                        additionalRows: [
                            {
                                col1: 'Total Amount :',
                                col2: total.toString(),
                                style: {
                                    fontSize: 14
                                }
                            }
                            // {
                            //     col1: 'Average Revenue :',
                            //     col2: averageRevenue.toString(),
                            //     style: {
                            //         fontSize: 12
                            //     }
                            // },
                            // {
                            //     col1: '*(Calculated based on the normal reservations count)',
                            //     col2: ' ',
                            //     style: {
                            //         fontSize: 8
                            //     }
                            // }
                        ],
                    },
                    footer: {
                        text: "The report is created on a computer and is valid without the signature and stamp.",
                    },
                    pageEnable: true,
                    pageLabel: "Page ",
                };

                const pdfObject = jsPDFInvoiceTemplate.default(props);
                console.log("Object generated: ", pdfObject);
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", xhr.responseText);
            }
        });
    }
</script>