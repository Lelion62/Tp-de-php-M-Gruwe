<?php
$id = $_GET["id"];
$competences = require __DIR__ . '/../data/competences.php';
$ids = array_column($competences, 'id');

if (in_array($id, $ids)) {
    $competence = $competences[$id];

    echo $competence["libelle"] . "\n";
    echo $competence["categorie"] . "\n";
    echo $competence["nb_maitrises"] . "\n";
}
else{
    echo "Undefined array key $id";
}

?>