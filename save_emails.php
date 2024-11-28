<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $file = 'emails.txt';
        file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
        echo "<div style='text-align: center;'>Email added successfully!</div>";
    } else {
        echo "<div style='text-align: center; color: red;'>Invalid email address!</div>";
    }
}
?>
<br><br>
<a href="index.html" style="text-align: center; display: block;">Back to Form</a>
