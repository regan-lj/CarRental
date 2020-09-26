let CustViewBookings = (function() {
    "use strict";
    let pub = {};

    pub.setup = function() {

        let stored = window.localStorage.getItem("booking");
        let section = $("#custViewBookings");
        let bookings = [];

        if (stored === null) {
            section.html("<p>You have no potential bookings yet.</p>");
        } else {
            section.html("<h2>Your Potential Bookings:</h2><br><br><br>");
            bookings = JSON.parse(stored);
            let index;
            for (index = 0; index < bookings.length; index += 1) {
                let booked = bookings[index];
                section.append("<h3>" + booked.registration + "</h3>" +
                    "<p>" + booked.name + "</p>" +
                    "<p>Pick Up: " + booked.pickupDay + "-" +
                    booked.pickupMonth + "-" + booked.pickupYear + "</p>" +
                    "<p>Drop Off: " + booked.dropoffDay + "-" +
                    booked.dropoffMonth + "-" + booked.dropoffYear +
                    "</p><br><br>");
            }
        }

    };

    return pub;

}());

$(document).ready(CustViewBookings.setup);