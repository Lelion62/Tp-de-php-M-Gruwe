<?php
require __DIR__ . '/../inc/fonctions.php';
$competences = require __DIR__ . '/../data/competences.php';

/* B6.2 — Filtre par catégorie */
$categorie = $_GET['categorie'] ?? null;

if ($categorie) {
    $competences = array_filter($competences, function ($competence) use ($categorie) {
        return $competence['categorie'] === $categorie;
    });
}

/* B6.3 — Tri par nombre de maîtrises décroissant */
usort($competences, function ($a, $b) {
    return $b['nb_maitrises'] <=> $a['nb_maitrises'];
});

/* B6.1 — Statistiques */
$competencesToutes = require __DIR__ . '/../data/competences.php';

$totalCompetences = count($competencesToutes);

$categories = array_unique(
    array_column($competencesToutes, 'categorie')
);

$totalCategories = count($categories);

$moyenneMaitrises = array_sum(
    array_column($competencesToutes, 'nb_maitrises')
) / $totalCompetences;
?>

<h2>Statistiques</h2>

<p>
    Nombre total de compétences :
    <strong><?= $totalCompetences ?></strong>
</p>

<p>
    Nombre de catégories :
    <strong><?= $totalCategories ?></strong>
</p>

<p>
    Moyenne des maîtrises :
    <strong><?= number_format($moyenneMaitrises, 1, ',', ' ') ?></strong>
</p>

<h2>Filtrer par catégorie</h2>

<p>
    <a href="index.php">Toutes</a>

    <?php foreach ($categories as $cat): ?>
        |
        <a href="index.php?categorie=<?= urlencode($cat) ?>">
            <?= htmlspecialchars($cat) ?>
        </a>
    <?php endforeach; ?>
</p>

<table border="1">
    <tr>
        <th>Compétence</th>
        <th>Catégorie</th>
        <th>Description</th>
        <th>Nombre de maîtrises</th>
    </tr>

    <?php foreach ($competences as $competence): ?>
        <tr>
            <td>
                <a href="fiche.php?id=<?= urlencode($competence['id']) ?>">
                    <?= htmlspecialchars($competence['libelle']) ?>
                </a>
            </td>

            <td>
                <?= htmlspecialchars($competence['categorie']) ?>
            </td>

            <td>
                <?= htmlspecialchars($competence['description']) ?>
            </td>

            <td>
                <?= calcul_badge($competence['nb_maitrises']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>