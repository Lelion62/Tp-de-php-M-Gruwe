<?php
require __DIR__ . '/../inc/fonctions.php';
$competences = require __DIR__ . '/../data/competences.php';

$id = $_GET["id"];
$ids = array_column($competences, 'id');

if (in_array($id, $ids)) {
    $competence = $competences[$id];
}
else{
    echo "Undefined array key $id";
}
?>

<table border="1">
    <tr>
        <td><?= htmlspecialchars($competence["libelle"]);?></td>
        <td><?= htmlspecialchars($competence["categorie"]);?></td>
        <td><?= htmlspecialchars($competence["description"]);?></td>
        <td><?= calcul_badge($competence["nb_maitrises"]); ?></td>
    </tr>
</table>