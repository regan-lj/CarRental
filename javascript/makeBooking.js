let MakeBooking = (function() {
    "use strict";
    let pub = {};

    /**
     * Display the modal and use the correct registration number
     */
    function display() {
        let rego = $(this).attr("name");
        let target = document.getElementById("registration-number");
        target.innerHTML = rego;

        let modal = document.getElementById("modal-box");
        modal.style.display = "block";

        // Set a hidden form input to be the registration number
        let form = $("#bookingForm");
        form.prepend("<input name='rego' type='hidden' value='" + rego + "'>")
    }

    /**
     * Allow user to open and close the modal
     */
    function handleVisibility() {
        // Get the modal
        let modal = document.getElementById("modal-box");
        // Get the <span> element that closes the modal
        let span = document.getElementsByClassName("close")[0];

        $(document).on("click", ".bookButton", display);

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
            // Reset the dates and coloring
            $("#pick-up").val('dd/mm/yyyy');
            $("#drop-off").val('dd/mm/yyyy');
            $("#availability").css("color", "black");
            $("#availability").html("Please Select Your Dates");
            $("#proceed").css("display", "none");
            $(".nameInput").css("display", "none");
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    }

    /**
     * Set the minimum pick-up date to be today's date
     */
    function setMinPickup() {
        let todaysDate = new Date();

        // Max date attribute is in "YYYY-MM-DD"
        // Need to format today's date accordingly
        let year = todaysDate.getFullYear();
        let month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);
        let day = ("0" + todaysDate.getDate()).slice(-2);
        let minDate = (year +"-"+ month +"-"+ day);

        $('#pick-up').attr('min', minDate);
    }

    /**
     * Set the minimum drop-off date to be at least the pick-up date
     */
    function setMinDropoff() {
        let minDate = this.value;
        $('#drop-off').attr('min', minDate);
    }

    /**
     * The above two functions only apply if user doesn't manually input text.
     * This function is to handle manual input.
     */
    function validateDates() {
        let userPickup = (new Date(
            document.getElementById(
                "pick-up").value)).setHours(0,0,0,0);
        let userDropoff = (new Date(
            document.getElementById(
                "drop-off").value)).setHours(0,0,0,0);
        let validateDates = $('#validateDates');

        if (userPickup < new Date() || userDropoff < userPickup) {
            validateDates.text("Please select valid dates.");
            return false;
        } else {
            validateDates.text("");
            return true;
        }
    }

    /**
     * Only allow user to check availability if two dates have been selected
     */
    function restrictAvailabilitySelection() {
        let pickup = $('#pick-up').val();
        let dropoff = $('#drop-off').val();
        if (!(pickup === "" || dropoff === "" || validateDates() === false)) {
            checkAvailability();
        }
    }

    /**
     * Check the availability of the vehicle by comparing to current bookings
     */
    function checkAvailability() {

        let rego = $('#registration-number').text();
        let check = "Available";

        $.getJSON("../json/bookings.json", function(data) {

            let allBookings = data.bookings.booking;
            let index;

            // Loop through each booking to identify
            // ones for this registration number
            for (index = 0; index < allBookings.length; index++) {
                let book = allBookings[index];
                if (book.number === rego) {
                    let userPickup = (new Date(
                        document.getElementById(
                            "pick-up").value)).setHours(0,0,0,0);
                    let userDropoff = (new Date(
                        document.getElementById(
                            "drop-off").value)).setHours(0,0,0,0);
                    let comparePickup = (new Date(
                        book.pickup.year, book.pickup.month - 1,
                        book.pickup.day)).setHours(0,0,0,0);
                    let compareDropoff = (new Date(
                        book.dropoff.year, book.dropoff.month - 1,
                        book.dropoff.day)).setHours(0,0,0,0);

                    // Check if there is a clash
                    if ((userPickup >= comparePickup &&
                        userPickup <= compareDropoff) ||
                        (userDropoff >= comparePickup &&
                            userDropoff <= compareDropoff)) {
                        check = "Unavailable";
                        break;
                    }
                }
            }

            let target = $("#availability");
            target.html(check);
            if (check === "Available") {
                $('#proceed').css("display", "inline-block");
                $('.nameInput').css("display", "inline-block");
                target.css("color", "green");
            } else {
                $('#proceed').css("display", "none");
                $('.nameInput').css("display", "none");
                target.css("color", "red");
            }
        });
    }

    function validateName() {
        let $name = $('#name').val();
        if ($name === "") {
            $('#validateName').text("Please supply a name.");
            return false;
        } else {
            // $('#validateName').text("");
            return true;
        }
    }

    pub.setup = function() {
        handleVisibility(); // Display the booking modal
        setMinPickup(); // Ensure that the pick-up date isn't in the past

        let $pickup = $('#pick-up');
        let $dropoff = $('#drop-off');

        $pickup.change(setMinDropoff);
        $pickup.change(restrictAvailabilitySelection);
        $dropoff.change(restrictAvailabilitySelection);
    };

    return pub;

}());

$(document).ready(MakeBooking.setup);