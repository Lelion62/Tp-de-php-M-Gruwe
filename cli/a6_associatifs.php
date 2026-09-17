<?php
$competence = [
    'id'           => 1,
    'libelle'      => 'PHP 8',
    'categorie'    => 'Développement',
    'nb_maitrises' => 4,
];

echo $competence["libelle"] . " (" . $competence["categorie"] . ") - " . $competence["nb_maitrises"] . " personnes la maitrisent\n";

foreach ($competence as $key => $value) {
    echo "$key : $value \n"; 
}

$competence2 = [
    'id'           => 2,
    'libelle'      => 'C++',
    'categorie'    => 'Développement',
    'nb_maitrises' => 2,
];

$competence3 = [
    'id'           => 3,
    'libelle'      => 'CSS',
    'categorie'    => 'UI/UX',
    'nb_maitrises' => 5,
];

$competences = [
    $competence,
    $competence2,
    $competence3,
];

$total = 0;

foreach ($competences as $key => $value) {
    echo $value["libelle"] . "\n";
    $total += $value["nb_maitrises"];
}

echo $total . "\n";
?>