let SaveBooking = (function () {
    "use strict";
    let pub = {};
    let bookingDetails = {};

    function storeBooking(booking) {
        let stored = [];
        let value;

        value = window.localStorage.getItem("booking");

        if (value !== null) {
            stored = JSON.parse(value);
        }

        stored.push(booking);
        window.localStorage.setItem("booking", JSON.stringify(stored));
    }

    /**
     * Store booking to local storage
     */
    function test() {

        // let bookingDetails = {};
        const pickupDate = $("#pick-up").val();
        const dropoffDate = $("#drop-off").val();

        bookingDetails.registration = $("#registration-number").text();
        bookingDetails.name = $("#name").val();
        bookingDetails.pickupDay = pickupDate.slice(8, 10);
        bookingDetails.pickupMonth = pickupDate.slice(5, 7);
        bookingDetails.pickupYear = pickupDate.slice(0, 4);
        bookingDetails.dropoffDay = dropoffDate.slice(8, 10);
        bookingDetails.dropoffMonth = dropoffDate.slice(5, 7);
        bookingDetails.dropoffYear = dropoffDate.slice(0, 4);

        storeBooking(bookingDetails);
    }

    pub.setup = function () {
        $(document).on("click", "#proceed", test);
    };

    return pub;

}());

$(document).ready(SaveBooking.setup);