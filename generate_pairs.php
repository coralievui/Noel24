<?php
$file = 'emails.txt';
$resultFile = 'pairs.json';

if (file_exists($file)) {
    $emails = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (count($emails) < 2) {
        die("<div style='text-align: center; color: red;'>Not enough participants to generate pairs!</div>");
    }

    shuffle($emails); // Randomize the array

    $pairs = [];
    $count = count($emails);

    for ($i = 0; $i < $count; $i++) {
        $giver = $emails[$i];
        $receiver = $emails[($i + 1) % $count]; // Wrap around to the first participant
        $pairs[$giver] = [
            'receiver' => $receiver,
            'icon' => (rand(0, 1) ? '🎅' : '🎁') // Random festive icon
        ];
    }

    file_put_contents($resultFile, json_encode($pairs, JSON_PRETTY_PRINT));
    echo "<div style='text-align: center;'>Pairs generated successfully!</div>";
} else {
    echo "<div style='text-align: center; color: red;'>No participants found. Please add emails first.</div>";
}
?>
<br><br>
<a href="index.html" style="text-align: center; display: block;">Back to Form</a>
