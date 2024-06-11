const ctx1 = document.getElementById("lineChart");
const  ROOT = "http://localhost/tracknbook/public/"; 

$.ajax({
  url: ROOT + "ajax/countReservationFromAndTo",
  method: "POST",
  data: {
    start: '2024-04-20',
    end: moment().format("YYYY-MM-DD"),
  },
  success: function (data) {
    var dataB = JSON.parse(data);
    // response came as [{"reservation_date":"2024-04-28","total_reservations":4},{"reservation_date":"2024-04-29","total_reservations":2},{"reservation_date":"2024-04-30","total_reservations":2}]
    // console.log(dataB);
    var labels = [];
    var data = [];
    dataB.forEach((element) => {
      labels.push(element.reservation_date);
      data.push(element.total_reservations);
    });

    // format lablels acordind to get the day of the week
    labels = labels.map((label) => {
      return moment(label).format("dddd");
    });

    const data1 = {
      labels: labels,
      datasets: [
        {
          label: "Reservations",
          data: data,
          fill: false,
          borderColor: "rgb(75, 192, 192)",
          tension: 0.1,
        },
      ],
    };

    new Chart(ctx1, {
      type: "bar",
      data: data1,

      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
      // add color to the bars
      plugins: [
        {
          beforeInit: function (chart) {
            var time = moment();
            var dataset = chart.data.datasets[0];
            var bars = dataset.data.length;
            var colors = [];
            for (var i = 0; i < bars; i++) {
              colors.push("rgba(54, 162, 235, 0.2)");
            }
            dataset.backgroundColor = colors;
          },
        },
      ],
      


    });

    //  update the pie chart

  },
  error: function (err) {
    console.log(err);
  },
});


// const ctx2 = document.getElementById("bookingpie");
// const data2 = {
//   datasets: [
//     {
//       label: "Total reservations",
//       data: [300, 50, 100],
//       backgroundColor: [
//         "rgb(255, 99, 132)",
//         "rgb(54, 162, 235)",
//         "rgb(255, 205, 86)",
//       ],
//       hoverOffset: 4,
//     },
//   ],
// };
// const pie = new Chart(ctx2, {
//   type: "doughnut",
//   data: data2,
// });

// f3


// resize();

// get persentage of warrant reservations and normal reservations

$.ajax({
  url: ROOT + "ajax/reservationCountByReservationType",
  method: "POST",
  data: {
    start: moment().format("YYYY-MM-DD"),
    end: moment().add(10, 'day').format("YYYY-MM-DD"),
  },
  // result as data
  success: function (data) {
    var dataB = JSON.parse(data);
    // response came as [{"reservation_type":"normal","total_reservations":4},{"reservation_type":"warrant","total_reservations":2}]
    console.log(dataB);
    var labels = [];
    var dataChart = [];
    dataB.forEach((element) => {
      labels.push(element.reservation_type);
      dataChart.push(element.total_reservations);
    });

    const ctx2 = document.getElementById("bookingpie");
    const data2 = {
      datasets: [
        {
          label: "Total reservations",
          data: dataChart,
          backgroundColor: [
            "rgb(255, 99, 132)",
            "rgb(54, 162, 235)",
          ],
          hoverOffset: 4,
        },
      ],
      labels: labels,
    };
    const pie = new Chart(ctx2, {
      type: "doughnut",
      data: data2,
    });
  }
});
