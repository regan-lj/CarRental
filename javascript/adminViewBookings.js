let ViewBookings = (function() {
    "use strict";
    let pub = {};

    pub.setup = function() {

        // Get JSON data from bookings file
        $.getJSON("../json/bookings.json", function(data) {

            let allBookings = data.bookings.booking;
            let index;

            // Loop through all the data to display the booking information
            for (index = 0; index < allBookings.length; index += 1) {
                let booked = allBookings[index];
                let section = $("#viewBookings");

                section.append("<h3>" + booked.number + "</h3>" +
                    "<p>" + booked.name + "</p>" +
                    "<p>Pick Up: " + booked.pickup.day + "-" +
                    booked.pickup.month + "-" + booked.pickup.year + "</p>" +
                    "<p>Drop Off: " + booked.dropoff.day + "-" +
                    booked.dropoff.month + "-" + booked.dropoff.year +
                    "</p><br><br>");
            }

        });

    };

    return pub;

}());

$(document).ready(ViewBookings.setup);