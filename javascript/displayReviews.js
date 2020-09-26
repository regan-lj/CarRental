let DisplayReviews = (function() {
    "use strict";
    let pub = {};

    pub.setup = function() {
        $.getJSON("../json/reviews.json", function(data) {
            let index;
            // Loop through each element to display the review information
            for (index = 0; index < data.length; index++) {
                let review = data[index];
                let section = $("#footerReviews");
                section.append("<p><b>" + review.title + "</b></p>" +
                                "<p>" + review.author + "</p>" +
                                "<p>" + review.reviewcontent + "</p><br>");
            }
        });
    };

    return pub;

}());

$(document).ready(DisplayReviews.setup);