<?php
function traduit($niveau) {
    if ($niveau == 1) {
        return "Notion";
    }elseif ($niveau == 2) {
        return "Débutant";
    }elseif ($niveau == 3) {
        return "Intermédiaire";
    }elseif ($niveau == 4) {
        return "Confirmé";
    }elseif ($niveau == 5) {
        return "Expert";
    }
    return "Non défini";
}

$choix = 0;

while ($choix < 1 || $choix > 5) {
    $choix = (int) readline("Entrez une valeure entre 1 et 5 : ");
}
echo "Niveau enregistré : $choix (" . traduit($choix) . ")\n";
?>