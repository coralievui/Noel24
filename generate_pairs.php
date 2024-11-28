<?php
$file = 'emails.txt';
$resultFile = 'pairs.json';

if (file_exists($file)) {
    $emails = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (count($emails) < 2) {
        die("<div style='text-align: center; color: red;'>Pas assez de participants pour générer les paires !</div>");
    }

    shuffle($emails); // Mélange des participants

    $pairs = [];
    $count = count($emails);

    for ($i = 0; $i < $count; $i++) {
        $giver = $emails[$i];
        $receiver = $emails[($i + 1) % $count]; // Boucle au premier participant
        $pairs[$giver] = [
            'receiver' => $receiver,
            'icon' => (rand(0, 1) ? '🎅' : '🎁') // Icône festive aléatoire
        ];
    }

    file_put_contents($resultFile, json_encode($pairs, JSON_PRETTY_PRINT));
    echo "<div style='text-align: center;'>Paires générées avec succès !</div>";
} else {
    echo "<div style='text-align: center; color: red;'>Aucun participant trouvé. Veuillez ajouter des emails d'abord.</div>";
}
?>
<br><br>
<a href="index.html" style="text-align: center; display: block;">Retour au formulaire</a>
