<?php
require __DIR__ . '/../inc/fonctions.php';
$competences = require __DIR__ . '/../data/competences.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillSwap</title>
</head>
<body>
    <h1>Bienvenue sur ce site</h1>
    <p>La date actuelle est : <?php echo date("d/m/y");?></p>
    <p>La version actuelle de PHP est : <?php echo PHP_VERSION;?></p>
    <table border="1">
        <tr>
            <th>Compétence</th>
            <th>Catégorie</th>
            <th>Description</th>
            <th>Couverture</th>
        </tr>
        <?php foreach ($competences as $competence): ?>
            <tr>
                <td><?= htmlspecialchars($competence["libelle"]);?></td>
                <td><?= htmlspecialchars($competence["categorie"]);?></td>
                <td><?= htmlspecialchars($competence["description"]);?></td>
                <td><?= calcul_badge($competence["nb_maitrises"]); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>