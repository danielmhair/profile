<?php include "profileHeader.php"; ?>

    <div id="mainContainer">
        <div class="container center">
            <div class="row">
                <h1 class="white">Weather Predictor</h1>
                <p class="lead white">Enter your city below to get a forecast for the
                    weather.</p>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Paris, San Francisco..." />
                    </div>
                    <button id="findMyWeather" class="btn btn-success btn-lg">Find My Weather</button>
                </form>
                <br />
                <div id="success" class="alert alert-success">Success!</div>
                <div id="fail" class="alert alert-danger">Could not find weather data for that city. Please try again.</div>
                <div id="noCity" class="alert alert-danger">Please enter a city!</div>
            </div>
        </div>
    </div>

<?php include "scripts.php"; ?>
<?php include "footer.php"; ?>