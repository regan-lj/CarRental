let DisplayCars = (function() {
    "use strict";
    let pub = {};

    /**
     * Show and hide the description + picture + 'Book Now' button
     */
    function expand() {
        let rego = $(this).text();
        let $description = $(document.getElementsByName(rego));
        $description.toggle(250);
    }

    /**
     * Get all of the vehicle information to be displayed
     */
    function getDetails() {
        $.getJSON("../json/vehicles.json", function(data) {

            // Get the data from the JSON file
            let cars = data.fleet.vehicle;
            let index;

            // Loop through each element to display the car information
            for (index = 0; index < cars.length; index += 1) {
                let car = cars[index];
                let section = $(".car-info");
                section.append(
                    "<div class='group'><h2 class='rego'>" + car.registration +
                    "</h2>" + "<h3>$" + car.pricePerDay +
                    " per day</h3><br><br>" + "<p><b>Vehicle Type:</b> " +
                    car.vehicleType + "</p>");

                let rego = car.registration;

                // Use the registration to identify which image to display
                let regoImage = rego.replace(" ", "_");
                regoImage = regoImage.concat(".jpg");

                // Display the description and image
                section.append(
                    "<p class='toToggle' name='" + rego + "'>" +
                    car.description + "</p>" + "<br class='toToggle' name='" +
                    rego + "'>");

                section.append("<img class='toToggle' name='" + rego +
                    "' src='../images/" + regoImage + "'><br>");


                // Display the button to make a booking
                section.append(
                    "<input type='button' class='bookButton' id='bookButton'" +
                    " name='" + rego + "' value='Book Now'><br><br></div>");

            }

        });

    }

    pub.setup = function () {
        getDetails();
        $(document).on("click", ".rego", expand);
    };

    return pub;

}());

$(document).ready(DisplayCars.setup);