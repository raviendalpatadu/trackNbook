// Select seats using jQuery
var fromSeats = $('[id^="fromSeatNo-"]:not(.reserved)');
//   var seatsOption = $('[id^="seatNoOption-"]');

// Function to handle the click event
function handleEventFrom() {
  //add seletced attribute to the selected seat option
  var seatOption = $(
    "#fromSeatNoOption-" + parseInt($(this).attr("id").split("-")[1])
  );

  //get the count of elements with class selected
  var selectedSeatCount = $("#fromSeatMap").find(
    ".comparment  .selected , #fromSeatMap .comparment .selected-complete"
  ).length;

  // string to int conversion
  // get no of passengers from PHP session variable
  var noOfPassengers = parseInt($("#noOfPassengers").val());

  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
    if ($(this).hasClass("selected-complete")) {
      $(this).removeClass("selected-complete");
    }
    --selectedSeatCount;
    seatOption.removeAttr("selected");
  } else {
    $(this).addClass("selected");
    ++selectedSeatCount;

    seatOption.attr("selected", "selected");
  }

  if (noOfPassengers == selectedSeatCount) {
    $("#fromSeatMap .comparment .selected").addClass("selected-complete");
  }

  if (selectedSeatCount < noOfPassengers) {
    if ($("#fromSeatMap .comparment .selected").hasClass("selected-complete")) {
      $("#fromSeatMap .comparment .selected").removeClass("selected-complete");
      seatOption.removeAttr("selected");
    }
  }

  if (selectedSeatCount > noOfPassengers) {
    seatOption.removeAttr("selected");
    $("#fromSeatMap .comparment .selected").removeClass("selected-complete");
    $("#fromSeatMap .comparment .selected").removeClass("selected");
    $("option[id*=fromSeatNoOption-]").each(function (params) {
      $(this).removeAttr("selected");
    });
    selectedSeatCount = 0;

    console.log("selectd " + selectedSeatCount);
    console.log("noOfPas " + noOfPassengers);

    $(this).addClass("selected");
    seatOption.attr("selected", "selected");
    selectedSeatCount++;
    if (noOfPassengers == selectedSeatCount) {
      $("#fromSeatMap .comparment .selected").addClass("selected-complete");
    }
  }

  $("#fromSeatCountSelected span").text(
    selectedSeatCount + "/" + noOfPassengers
  );
}

// Add click event to seats
fromSeats.click(handleEventFrom);

// Select seats using jQuery
var toSeats = $('[id^="toSeatNo-"]:not(.reserved)');

// Function to handle the click event
function handleEventTo() {
  //add seletced attribute to the selected seat option
  var seatOption = $(
    "#toSeatNoOption-" + parseInt($(this).attr("id").split("-")[1])
  );

  //get the count of elements with class selected
  var selectedSeatCount = $("#toSeatMap").find(
    ".comparment  .selected , #toSeatMap .comparment .selected-complete"
  ).length;

  // string to int conversion
  // get no of passengers from PHP session variable
  var noOfPassengers = parseInt($("#noOfPassengers").val());

  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
    if ($(this).hasClass("selected-complete")) {
      $(this).removeClass("selected-complete");
    }
    --selectedSeatCount;
    seatOption.removeAttr("selected");
  } else {
    $(this).addClass("selected");
    ++selectedSeatCount;

    seatOption.attr("selected", "selected");
  }

  if (noOfPassengers == selectedSeatCount) {
    $("#toSeatMap .comparment .selected").addClass("selected-complete");
  }

  if (selectedSeatCount < noOfPassengers) {
    if ($("#toSeatMap .comparment .selected").hasClass("selected-complete")) {
      $("#toSeatMap .comparment .selected").removeClass("selected-complete");
      seatOption.removeAttr("selected");
    }
  }

  if (selectedSeatCount > noOfPassengers) {
    seatOption.removeAttr("selected");
    $("#toSeatMap .comparment .selected").removeClass("selected-complete");
    $("#toSeatMap .comparment .selected").removeClass("selected");
    $("option[id*=toSeatNoOption-]").each(function (params) {
      $(this).removeAttr("selected");
    });
    selectedSeatCount = 0;

    console.log("selectd " + selectedSeatCount);
    console.log("noOfPas " + noOfPassengers);

    $(this).addClass("selected");
    seatOption.attr("selected", "selected");
    selectedSeatCount++;
    if (noOfPassengers == selectedSeatCount) {
      $("#toSeatMap .comparment .selected").addClass("selected-complete");
    }
  }

  $("#toSeatCountSelected span").text(selectedSeatCount + "/" + noOfPassengers);
}

// Add click event to seats
toSeats.click(handleEventTo);

// Select checkbox and box using jQuery
var checkbox = $("#return");
var box = $("#toDate");

// Add click event to checkbox
checkbox.click(function () {
  if (checkbox.is(":checked")) {
    // show the box with an animation
    //box.css("display", "block");
    box.fadeIn(300);
  } else {
    box.css("display", "none");
  }
});

if (checkbox.is(":checked")) {
  box.css("display", "block");
}

// clear the value in the box when the checkbox is unchecked

//warrent booking toggle
var warrent = $("#warrentBooking");
var chooseImg = $("#chooseImg");

// Add click event to warrent

if (warrent.is(":checked")) {
  chooseImg.css("display", "block");
} else {
  chooseImg.css("display", "none");
}
warrent.click(function () {
  if (warrent.is(":checked")) {
    chooseImg.css("display", "block");
  } else {
    chooseImg.css("display", "none");
  }
});
// });

//drop down

$("select.dropdown").each(function () {
  var dropdown = $("<div />").addClass("dropdown selectDropdown");

  $(this).wrap(dropdown);

  var label = $("<span />")
    .text($(this).attr("placeholder"))
    .insertAfter($(this));
  var list = $("<ul />");

  label.attr("class", "input-field");

  $(this)
    .find("option")
    .each(function () {
      list.append($("<li />").append($("<a />").text($(this).text())));
    });

  list.insertAfter($(this));

  if ($(this).find("option:selected").length) {
    label.text($(this).find("option:selected").text());
    list
      .find("li:contains(" + $(this).find("option:selected").text() + ")")
      .addClass("active");
    $(this).parent().addClass("filled");
  }
});

$(document).on("click touch", ".selectDropdown ul li a", function (e) {
  e.preventDefault();
  var dropdown = $(this).parent().parent().parent();
  var active = $(this).parent().hasClass("active");
  var label = active
    ? dropdown.find("select").attr("placeholder")
    : $(this).text();

  dropdown.find("option").prop("selected", false);
  dropdown.find("ul li").removeClass("active");

  dropdown.toggleClass("filled", !active);
  dropdown.children("span").text(label);
  if (!active) {
    var selectedOption = dropdown
      .find("option:contains(" + $(this).text() + ")")
      .prop("selected", true);

    $(this).parent().addClass("active");

    // Make sure the selected option's value is set in the original select
    dropdown.find("select").val(selectedOption.val());
    
  }

  dropdown.removeClass("open");

  //trigger change event
  dropdown.find("select").trigger("change");
});

$(".dropdown > span").on("click touch", function (e) {
  var self = $(this).parent();
  self.toggleClass("open");
});

$(document).on("click touch", function (e) {
  var dropdown = $(".dropdown");
  if (dropdown !== e.target && !dropdown.has(e.target).length) {
    dropdown.removeClass("open");
  }
});

// $(document).ready(function () {
$("#popup").hide();

$("#yes").on("click", function () {
  $("#popup").show();
});

$("#no").on("click", function () {
  $("#popup").hide();
});
//});

//QR Code Scanner
function domReady(fn) {
  if (
    document.readyState === "complete" ||
    document.readyState === "interactive"
  ) {
    setTimeout(fn, 1000);
  } else {
    document.addEventListener("DOMContentLoaded", fn);
  }
}

domReady(function () {
  // If found you qr code
  function onScanSuccess(decodeText, decodeResult) {
    // alert("You Qr is : " + decodeText);

    // redirect to decodetext
    // http://localhost/trackNbook/public/traindriver/addlocation/342
    window.location.replace(decodeText);
  }

  let htmlscanner = new Html5QrcodeScanner("my-qr-reader", {
    fps: 10,
    qrbos: 250,
  });
  htmlscanner.render(onScanSuccess);
});

//popup

function hello() {
  alert("hello");
}

// get errors from the server

function getErrors(url, data, callback) {
  $.ajax({
    url: url, //<?= ROOT ?>home/validate
    type: "post",
    data: data, //formData
    success: function (data, status) {
      // console.log(data);

      var res = JSON.parse(data);

      // if res has error throw an error
      if (res == true) {
        // console.log(res);
        callback(res);
      }

      if (res.hasOwnProperty("errors")) {
        callback(res.errors);
        // xhr = res.errors;
        printErrors(res);
      }
    },
  });
}

function printErrors(errors) {
  if ($("div.assistive-text").length) {
    $("div.assistive-text").remove();
  }

  var errs = errors.errors;
  // loop through the errors
  for (var key in errs) {
    if (errs.hasOwnProperty(key)) {
      var value = errs[key];

      var tag = $("[name=" + key + "]")
        .parent()
        .parent();

      var errorDiv = $("<div class='assistive-text'></div>").text(value);
      tag.append(errorDiv);
    }
  }
}

function changeImage(imageInput, imageBox) {
  $(imageInput).change(function () {
    var file = $(this)[0].files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
      $(imageBox).attr("src", e.target.result);
    };
    reader.readAsDataURL(file);
  });
}

// make popup box

function makePopupBox(title, description, buttonText, imgURL, action) {
  if ($(".main-popup-box").length) {
    return;
  }

  var popupBox = $("<div/>").addClass("main-popup-box").appendTo("body");
  var box = $("<div/>").addClass("box").appendTo(popupBox);
  var heading = $("<h2/>").addClass("heading").appendTo(box);
  var body = $("<div/>").addClass("body").appendTo(box);
  var img = $("<img/>").addClass("img").appendTo(body);
  var desc = $("<p/>").addClass("desc").appendTo(body);

  var btnBox = $("<div/>").addClass("footer").appendTo(box);
  var button = $("<button/>").appendTo(btnBox);
  // var buttonBase = $("<div/>").addClass("button-base").appendTo(button);
  var proceedBtn = $("<div/>").appendTo(button);

  heading.text(title);
  img.attr("src", imgURL);
  desc.html(description);
  proceedBtn.text(buttonText);

  button.on("click", function () {
    popupBox.remove();

    if (action) {
      action(true);
    }
  });
  // if you click outside the popup box it will remove the box
  popupBox.on("click", function (e) {
    if (e.target == popupBox[0]) {
      popupBox.remove();
    }
  });
}

// make popup box model with close btn
function makePopupModel(title, description, buttons, imgURL, action) {
  if ($(".main-popup-box").length) {
    return;
  }

  if (!buttons) {
    buttons = ["Close", "Ok"];
  }
  var popupBox = $("<div/>").addClass("main-popup-box").appendTo("body");
  var box = $("<div/>").addClass("box").appendTo(popupBox);
  var heading = $("<h2/>").addClass("heading").appendTo(box);
  var body = $("<div/>").addClass("body").appendTo(box);
  var img = $("<img/>").addClass("img").appendTo(body);
  var desc = $("<p/>").addClass("desc").appendTo(body);

  // print the buttons
  var btnBox = $("<div/>")
    .addClass("footer d-flex g-5 justify-content-end")
    .appendTo(box);
  if (buttons.length > 0) {
    buttons.forEach((button) => {
      var btn = $("<button/>").addClass("model-btn").appendTo(btnBox);
      // var buttonBase = $("<div/>").addClass("button-base").appendTo(btn);
      var buttonText = $("<div/>").addClass("text").appendTo(btn);
      buttonText.text(button);
    });
  }

  // close button
  var closeBtn = $("<button/>").addClass("model-btn").appendTo(btnBox);
  var closeButtonText = $("<div/>").addClass("text").appendTo(closeBtn);
  closeBtn.attr("id", "closeModelBtn");
  closeButtonText.text("Close");

  heading.text(title);
  img.attr("src", imgURL);
  desc.html(description);

  // if you click outside the popup box it will remove the box
  popupBox.on("click", function (e) {
    if (e.target == popupBox[0]) {
      popupBox.remove();
    }
  });

  // if clicked on the close button
  closeBtn.on("click", function () {
    popupBox.remove();
  });

  // add click event to the buttons
  var btns = $("button.model-btn");
  btns.each(function (index, element) {
    console.log(element);
    $(element).on("click", function (e) {
      e.preventDefault();
      if (action) {
        action(popupBox);
      }
    });
  });
}

// var shown = false;
// setInterval(function () {
//   var ROOTURL = "http://localhost/trackNbook/public/";
//   $.ajax({
//     url: ROOTURL + "ajax/getSession/reservation",
//     type: "post",
//     success: function (response) {
//       var res = JSON.parse(response);
//       var created_time = new Date(res.reservation_created_time);

//       var now = new Date();
//       var distance = now - created_time;
//       var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//       var reservation_status = res.reservation_status;
//       if (minutes > 10 && reservation_status == "Pending") {
//         // create a popup message called reservation expired try again to book
//         if (!shown) {
//           shown = true;
//           var reservationExpMsg = $("<div/>")
//             .addClass("reservation-expired")
//             .appendTo("body");
//           var expBox = $("<div/>")
//             .addClass("exp-box")
//             .appendTo(reservationExpMsg);

//           var expMsg = $("<div/>").appendTo(expBox);
//           var errTitle = $("<h2/>").addClass("err-title").appendTo(expMsg);
//           var errDesc = $("<p/>").addClass("err-desc").appendTo(expMsg);
//           var expBtnBox = $("<div></div>")
//             .addClass("d-flex justify-content-end")
//             .appendTo(expBox);
//           var closeButton = $("<button/>")
//             .addClass("button")
//             .appendTo(expBtnBox);
//           var buttonBase = $("<div/>")
//             .addClass("button-base")
//             .appendTo(closeButton);
//           var buttonText = $("<div/>").addClass("text").appendTo(buttonBase);
//           buttonText.text("Close");

//           closeButton.on("click", function () {
//             reservationExpMsg.remove();
//             window.location.replace(ROOTURL);
//           });
//           errTitle.text("Reservation Expired");
//           errDesc.text(
//             "Your reservation has expired. Please try again to book."
//           );
//           // expBtn.text("Ok");
//         }
//       }
//     },
//   });
// }, 1000);

// mobile hamburger menu
var checkboxBurger = $("#burger");

checkboxBurger.click(function () {
  console.log("clicked");
  if (checkboxBurger.is(":checked")) {
    $(".nav-menu-items").addClass("nav-menu-items-show");
  } else {
    $(".nav-menu-items").removeClass("nav-menu-items-show");
  }
});

// loader when the page is loading
$(window).on("load", function () {
  $(".loader__main").fadeOut();
});

function makeCalendar(id, startDate, endDate) {
  // if start date is not provided
  var element = $(id);

  if (!element.hasClass("calendar-none")) {
    element.addClass("calendar-none");
  }
  if (!startDate) {
    startDate = moment();
  }

  // if end date is not provided
  if (!endDate) {
    endDate = moment().add(1, "months");
  }

  $(id).daterangepicker(
    {
      singleDatePicker: true,
      autoApply: true,
      linkedCalendars: false,
      autoUpdateInput: false,
      showCustomRangeLabel: false,
      alwaysShowCalendars: true,
      minDate: startDate.format("MM/DD/YYYY"),
      maxDate: endDate.format("MM/DD/YYYY"),
      opens: "center",
    },
    function (start, end, label) {
      $(id).val(start.format("YYYY-MM-DD"));
    }
  );
}

function makeSelectDropdown(outputContainer) {
  $(outputContainer)
    .find("select.dropdown")
    .each(function () {
      var dropdown = $("<div />").addClass("dropdown selectDropdown");

      $(this).wrap(dropdown);

      var label = $("<span />")
        .text($(this).attr("placeholder"))
        .insertAfter($(this));
      var list = $("<ul />");

      label.attr("class", "input-field");

      $(this)
        .find("option")
        .each(function () {
          list.append($("<li />").append($("<a />").text($(this).text())));
        });

      list.insertAfter($(this));

      if ($(this).find("option:selected").length) {
        label.text($(this).find("option:selected").text());
        list
          .find("li:contains(" + $(this).find("option:selected").text() + ")")
          .addClass("active");
        $(this).parent().addClass("filled");
      }
        //trigger change event
  // dropdown.find("select").trigger("change");
    });

  $(outputContainer).on("click touch", ".selectDropdown ul li a", function (e) {
    e.stopImmediatePropagation();
    console.log($(this).text());
    var dropdown = $(this).parent().parent().parent();
    // console.log(dropdown);
    var active = $(this).parent().hasClass("active");
    var label = active
      ? dropdown.find("select").attr("placeholder")
      : $(this).text();

    console.log($(this));

    dropdown.find("option").prop("selected", false);
    dropdown.find("ul li").removeClass("active");

    dropdown.toggleClass("filled", !active);
    dropdown.children("span").text(label);
    if (!active) {
      dropdown
        .find("option:contains(" + $(this).text() + ")")
        .prop("selected", true);

      $(this).parent().addClass("active");
    }

    dropdown.removeClass("open");

    //trigger change event
    dropdown.find("select").trigger("change");
  });

  $(".dropdown > span").on("click touch", function (e) {
    var self = $(this).parent();
    self.toggleClass("open");
  });

  $(outputContainer).on("click touch", function (e) {
    var dropdown = $(".dropdown");
    if (dropdown !== e.target && !dropdown.has(e.target).length) {
      dropdown.removeClass("open");
    }
  });
}

function checkNotification(getParam){
  return window.location.href.indexOf(getParam);
}

function makeSuccessToast(title, description) {
  toastr["success"](title, description);

  toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
  };

  
  
}

function makeTicketQrCode(ticketId, QrContainer){
  $('#'+QrContainer).empty();
  var qrcode = new QRCode(QrContainer, {
      text: "http://localhost/trackNbook/public/ticketchecker/summary/" + ticketId,
      width: 128,
      height: 128,
      colorDark: "#324054",
      colorLight: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H
  });
}

function makeErrorToast(title, description) {
  toastr["error"](title, description);

  toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
  };
}

$(document).ready(function () {
    $.ajax({
      url: "http://localhost/trackNbook/public/ajax/getErrors",
      type: "post",
      success: function (data) {
        var err = JSON.parse(data);
        if (err != false) {
          makeErrorToast(err,'');
        }
      },
    });
});
