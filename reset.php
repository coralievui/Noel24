<?php
// Chemins des fichiers à réinitialiser
$emailFile = 'emails.txt';
$pairsFile = 'pairs.json';

// Réinitialisation des emails
if (file_exists($emailFile)) {
    file_put_contents($emailFile, ""); // Vide le fichier
    echo "Le fichier emails.txt a été réinitialisé.<br>";
} else {
    echo "Le fichier emails.txt n'existe pas.<br>";
}

// Réinitialisation des paires
if (file_exists($pairsFile)) {
    file_put_contents($pairsFile, "{}"); // Réinitialise avec un objet vide
    echo "Le fichier pairs.json a été réinitialisé.<br>";
} else {
    echo "Le fichier pairs.json n'existe pas.<br>";
}

// Lien pour revenir à la page d'accueil
echo "<br><a href='index.html'>Retour à l'accueil</a>";
?>
