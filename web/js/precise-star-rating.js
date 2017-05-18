/**
 * Created by Aycha on 23/03/2017.
 */
    function rateMedia(IdAutoEcole, rate, numStar, starWidth) {
    $('#group' + IdAutoEcole + ' .star_bar #' + rate).removeAttr('onclick'); // Remove the onclick attribute: prevent multi-click
    $('.box' + IdAutoEcole).html('<img src="' + window.loader + '" alt="" />'); // Display a processing icon
    var data = {IdAutoEcole: IdAutoEcole, rate: rate}; // Create JSON which will be send via Ajax
    $.ajax({ // JQuery Ajax
        type: 'POST',
        url: ROOT_URL + 'ajax/starrating/update/data', // URL to the PHP file which will insert new value in the database
        data: data, // We send the data string
        dataType: 'json',
        timeout: 3000,
        success: function(response) {
            $.cookie("symfonyRatingSystem" + IdAutoEcole, "Rated", { expires : 1 }); // Add jQuery Cookie Plugin to use this function
            $('.box' + IdAutoEcole).html('<div style="font-size: small; color: green">Thank you for rating</div>'); // Return "Thank you for rating"
            // We update the rating score and number of rates
            $('.resultMedia' + IdAutoEcole).html('<div style="font-size: small; color: grey">Rating: ' + response.avg + '/' + numStar + ' (' + response.nbrRate + ' votes)</div>');
            // We recalculate the star bar with new selected stars and unselected stars
            var nbrPixelsInDiv = numStar * starWidth;
            var numEnlightedPX = Math.round(nbrPixelsInDiv * response.avg / numStar);
            $('#group' + mediaId + ' .star_bar').attr('style', 'width:' + nbrPixelsInDiv + 'px; height:' + starWidth + 'px; background: linear-gradient(to right, #ffc600 0%,#ffc600 ' + numEnlightedPX + 'px,#ccc ' + numEnlightedPX + 'px,#ccc 100%);');
            $.each($('#group' + IdAutoEcole + ' .star_bar > div'), function () {
                $(this).removeAttr('onmouseover onclick');
            });
        },
        error: function() {
            $('#box').text('Problem');
        }
    });
}

function overStar(IdAutoEcole, myRate, numStar) {
    for ( var i = 1; i <= numStar; i++ ) {
        if (i <= myRate) $('#group' + IdAutoEcole + ' .star_bar #' + i).attr('class', 'star_hover');
        else $('#group' + IdAutoEcole + ' .star_bar #' + i).attr('class', 'star');
    }
}

function outStar(IdAutoEcole, myRate, numStar) {
    for ( var i = 1; i <= numStar; i++ ) {
        $('#group' + IdAutoEcole + ' .star_bar #' + i).attr('class', 'star');
    }
}
