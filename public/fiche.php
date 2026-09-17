<?php
require __DIR__ . '/../inc/fonctions.php';
$competences = require __DIR__ . '/../data/competences.php';

$id = $_GET['id'] ?? null;

$competence = null;

foreach ($competences as $item) {
    if ((string)$item['id'] === (string)$id) {
        $competence = $item;
        break;
    }
}

if ($competence === null) {
    echo "Compétence introuvable.";
    exit;
}
?>

<table border="1">
    <tr>
        <td><?= htmlspecialchars($competence['libelle']) ?></td>
        <td><?= htmlspecialchars($competence['categorie']) ?></td>
        <td><?= htmlspecialchars($competence['description']) ?></td>
        <td><?= calcul_badge($competence['nb_maitrises']) ?></td>
    </tr>
</table>