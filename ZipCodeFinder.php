<?php include "profileHeader.php"; ?>

    <div id="mainContainer">
        <div class="container">
            <div class="row center">
                <h1 class="text-black">Zip Code Finder</h1>
                <p class="lead">Enter your city below to get the zip code.</p>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Paris, San Francisco..." />
                    </div>
                    <button id="findMyZipCode" class="btn btn-success btn-lg">Find My Zip Code</button>
                </form>
                <br />
                <div id="success" class="alert alert-success">Success!</div>
                <div id="fail" class="alert alert-danger">Could not find the zip code for that city. Please try again.</div>
                <div id="noZipCode" class="alert alert-danger">Please enter a city!</div>
            </div>
        </div>
    </div>

<?php include "scripts.php"; ?>
<script>
    $(document).ready(function () {
        $("body").addClass("imgBigCity");
        $(".alert").hide();
        $("#findMyZipCode").click(function(event) {
            event.preventDefault();
            $(".alert").hide();
            var city = $("#city");
            if (city.val() == "") {
                $("#noZipCode").fadeIn();
                return;
            }
            $.ajax({
                type: "GET",
                url:
                    "https://maps.googleapis.com/maps/api/geocode/json?address=" + encodeURIComponent(city.val()) + "&sensor=false&key=AIzaSyCe4MddD-mLTAPmtbELBVjXMhwebdz57ik",
                dataType: "json",
                success: processJson,
                error: error
            });

            function error() {
                var failObject = $("#fail");
                failObject.fadeIn();
                failObject.html("Could not connect to server. Please try again.");
            }

            function processJson(json) {

                var failObject = $("#fail");
                if (json.status == "ZERO_RESULTS") {
                    failObject.fadeIn();
                    return;
                }

                var multipleZipCodes = false;
                for (var i = 0; i < json.results.length; i++) {
                    if (typeof(json.results[i].address_components) !== 'undefined') {
                        var addressComponent = json.results[i].address_components;
                        for (var j = 0; j < addressComponent.length; j++) {
                            var component = addressComponent[j];
                            for (var k = 0; k < component.types.length; k++) {
                                var type = component.types[k];
                                if (type == "postal_code") {
                                    console.log(type);
                                    var successObject = $("#success");
                                    successObject.fadeIn();
                                    if (multipleZipCodes) {
                                        successObject.add("<br/>The postcode is " + component.long_name);
                                    } else {
                                        successObject.html("The postcode is " + component.long_name);
                                    }
                                    multipleZipCodes = true;
                                    return;
                                }
                            }
                        }
                    }
                }
                failObject.fadeIn();
                failObject.html("Sorry, that is not a city. Please try again.");
            }
        });
    });

</script>
<?php include "footer.php"; ?>