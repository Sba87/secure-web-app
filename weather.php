<?php
session_start();
include 'config.php';

$api_key = $GLOBALS['api_key']; // Access API key from config.php
$weather_url = "http://api.openweathermap.org/data/2.5/weather";

$error_message = ""; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $city = htmlspecialchars($_POST['city']); // Sanitize user input

    // Fetch weather data from API
    $api_url = "$weather_url?q=$city&appid=$api_key&units=metric";
    $weather_data = @file_get_contents($api_url); // Suppress errors

    if ($weather_data === FALSE) {
        $error_message = "Enter a valid city name";
    } else {
        $weather = json_decode($weather_data, true);

        if ($weather['cod'] == 200) {
            $weather_output = "<h2>Weather in $city</h2>";
            $weather_output .= "Temperature: " . $weather['main']['temp'] . "°C<br>";
            $weather_output .= "Humidity: " . $weather['main']['humidity'] . "%<br>";
            $weather_output .= "Weather: " . $weather['weather'][0]['description'] . "<br>";
        } else {
            $error_message = "Enter a valid city name.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Weather API</title>
    <style>
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<h1>Check Weather</h1>
<div style="margin: 20px; text-align: left;">
    <a href="index.php" style="text-decoration: none; padding: 10px; background: #007bff; color: white; border-radius: 5px;">
        Home Page
    </a>
</div>
<form method="post">
    Enter city name: <input type="text" name="city" required>
    <button type="submit">Get Weather</button>
</form>

<!-- Display error message (if any) -->
<?php if (!empty($error_message)) : ?>
    <div class="error">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>

<!-- Display weather data (if available) -->
<?php if (!empty($weather_output)) : ?>
    <div>
        <?php echo $weather_output; ?>
    </div>
<?php endif; ?>
</body>
</html>