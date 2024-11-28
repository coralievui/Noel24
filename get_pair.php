<?php
$resultFile = 'pairs.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (file_exists($resultFile)) {
        $pairs = json_decode(file_get_contents($resultFile), true);

        if (isset($pairs[$email])) {
            $receiver = $pairs[$email]['receiver'];
            $icon = $pairs[$email]['icon'];
            echo "<div style='text-align: center; font-family: Arial;'>";
            echo "<h1>Your Secret Santa Pair</h1>";
            echo "<p>You need to buy a gift for:</p>";
            echo "<h2>$icon $receiver</h2>";
            echo "</div>";
        } else {
            echo "<div style='text-align: center; color: red;'>Email not found in the participant list!</div>";
        }
    } else {
        echo "<div style='text-align: center; color: red;'>Pairs have not been generated yet!</div>";
    }
}
?>
<br><br>
<a href="view_result.html" style="text-align: center; display: block;">Back to View</a>
