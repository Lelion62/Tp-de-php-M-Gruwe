# TP 1 — Premiers pas en PHP

**R3.01 · SkillSwap · Séance 1 · durée indicative 2 h 15**

---

## Le projet

Pendant neuf séances, vous construisez **SkillSwap** : l'application interne qui rend visible *qui sait quoi* dans une entreprise, permet de demander à apprendre une compétence, et transforme ces demandes en sessions de mentorat.

Aujourd'hui, deux temps. La **partie A** vous fait manipuler PHP en ligne de commande, sans navigateur, pour vous concentrer sur le langage. La **partie B** produit vos premières pages web SkillSwap.

Les données seront figées dans un fichier PHP. Dès la séance 2, elles viendront d'une vraie base MySQL.

---

## Avant de commencer

Depuis la racine du projet :

```bash
docker compose up -d --build
```

Vérifiez que http://localhost:8080 affiche la page SkillSwap. Si ce n'est pas le cas, **signalez-le tout de suite** — ne perdez pas la séance sur un problème d'environnement.

### Organisation de votre travail

```
skillswap/
├── cli/          ← partie A (à créer)
├── public/       ← partie B : les pages du site
├── inc/          ← éléments réutilisables
└── data/         ← les données figées
```

Respectez les noms de fichiers demandés : les corrigés et la suite du module s'appuient dessus.

### Deux règles

**Indentez et nommez correctement.** `$c` ne veut rien dire, `$competence` si. Les conventions PSR seront détaillées plus tard, autant prendre les bons réflexes.

**Désactivez votre assistant IA.** Ce TP a pour but de vous apprendre à écrire du PHP. C'est en tapant, en vous trompant et en lisant les messages d'erreur que la compréhension s'installe. Vous les rallumerez en séance 9, avec de quoi juger ce qu'ils produisent.

---

# Partie A — Prise en main en ligne de commande

Créez un dossier `cli/`. Chaque script s'exécute ainsi :

```bash
php cli/a1_bienvenue.php
```

> Pas besoin de Docker pour cette partie : `php` dans votre terminal suffit.

---

## A1 — Premier script

**Fichier :** `cli/a1_bienvenue.php` · *à savoir absolument* · 5 min

Affichez `Bienvenue sur SkillSwap !` suivi d'un retour à la ligne.

> **Erreur fréquente.** Un `;` manquant en fin d'instruction provoque une `Parse error`. Notez que PHP indique souvent la ligne **suivant** celle qui contient réellement l'erreur.

---

## A2 — Variables, concaténation, interpolation

**Fichier :** `cli/a2_fiche.php` · *à savoir absolument* · 15 min

Déclarez `$prenom`, `$nom`, `$service` pour un collaborateur. Affichez une phrase les combinant, **trois fois** :

1. avec l'opérateur de concaténation `.`
2. avec l'interpolation, entre guillemets **doubles**
3. avec les mêmes variables entre guillemets **simples**

Observez la troisième ligne et expliquez en commentaire ce qui se passe.

---

## A3 — Conditions et validation

**Fichier :** `cli/a3_niveau.php` · *à savoir absolument* · 20 min

Dans SkillSwap, une maîtrise est notée de **1 à 5**.

Écrivez une fonction qui traduit un niveau en libellé :

| Niveau | Libellé |
|---|---|
| 1 | Notions |
| 2 | Débutant |
| 3 | Intermédiaire |
| 4 | Confirmé |
| 5 | Expert |

Puis demandez le niveau à l'utilisateur avec `readline()`. Tant que la saisie n'est pas un entier **entre 1 et 5**, redemandez en affichant un message clair. Une fois valide, affichez `Niveau enregistré : 4 (Confirmé)`.

> **Attention.** `readline()` renvoie toujours une **chaîne**, même si l'utilisateur tape un nombre. Regardez du côté de `is_numeric()` et du transtypage.

---

## A4 — Chaînes de caractères

**Fichier :** `cli/a4_chaines.php` · *à savoir* · 20 min

À partir de `$prenom = "Camille"` et `$nom = "Marchand"` :

1. Affichez les **initiales** : `C.M.`
2. Générez l'adresse professionnelle au format `camille.marchand@skillswap.fr`, en minuscules quel que soit le contenu des variables.
3. Affichez le nom en majuscules.
4. Affichez la **longueur** du prénom. Testez ensuite avec `$prenom = "Elodie"` puis `$prenom = "Élodie"` : que constatez-vous ?

> **Le piège de la question 4.** `strlen()` compte des **octets**, pas des caractères. Un `É` en UTF-8 en occupe deux. La bonne fonction est `mb_strlen()`. Plus généralement, dès qu'il y a des accents, préférez les fonctions préfixées `mb_`.

---

## A5 — Tableaux indexés

**Fichier :** `cli/a5_tableaux.php` · *à savoir absolument* · 20 min

Créez un tableau des compétences suivantes : `PHP 8`, `Docker`, `SQL`, `Scrum`, `Git`.

1. Affichez le nombre de compétences.
2. Affichez-les toutes, une par ligne, **numérotées** à partir de 1.
3. Triez-les par ordre alphabétique et réaffichez-les.
4. Ajoutez `Symfony` au tableau, puis affichez la **dernière** compétence ajoutée.

---

## A6 — Tableaux associatifs

**Fichier :** `cli/a6_associatifs.php` · *à savoir absolument* · 25 min

Une compétence porte plusieurs informations. Représentez-en une par un tableau associatif :

```php
$competence = [
    'id'           => 1,
    'libelle'      => 'PHP 8',
    'categorie'    => 'Développement',
    'nb_maitrises' => 4,
];
```

1. Affichez `PHP 8 (Développement) — 4 personnes la maîtrisent`.
2. Parcourez le tableau avec `foreach` en affichant `clé : valeur` pour chaque entrée.
3. Construisez maintenant un tableau `$competences` contenant **trois** compétences de cette forme. Affichez le libellé de chacune.
4. Calculez et affichez le **total** des `nb_maitrises` sur les trois compétences.

> Pour la question 4, `array_column()` puis `array_sum()` font le travail en deux lignes. Une boucle `foreach` est tout aussi valable — écrivez les deux versions si vous avez le temps.

---

# Partie B — Les premières pages de SkillSwap

On passe au web. Tous les fichiers de cette partie vont dans `public/`, et s'ouvrent depuis **http://localhost:8080**.

> **L'erreur n°1 de cette partie** : ouvrir le fichier par un double-clic, ce qui donne une adresse commençant par `file://`. Le code PHP s'affiche alors **en texte** dans le navigateur. Il faut passer par le serveur, donc par `http://localhost:8080`.

---

## B1 — Page d'accueil dynamique

**Fichier :** `public/index.php` · *à savoir absolument* · 15 min

Remplacez le contenu par une page HTML complète affichant :

- un titre `SkillSwap`
- un message de bienvenue
- la **date du jour**, au format `14/09/2026`
- la version de PHP utilisée

La date et la version doivent être **générées par PHP**, pas écrites en dur.

Une fois la page affichée, faites un **clic droit → Afficher le code source de la page**. Notez ce que vous voyez — et surtout ce que vous ne voyez pas.

---

## B2 — Les données

**Fichier :** `data/competences.php` · *à savoir absolument* · 15 min

Créez un fichier qui **retourne** un tableau de compétences :

```php
<?php
return [
    [
        'id'           => 1,
        'libelle'      => 'PHP 8',
        'categorie'    => 'Développement',
        'description'  => 'Syntaxe moderne, typage, programmation objet',
        'nb_maitrises' => 4,
    ],
    // … au moins 7 autres
];
```

Prévoyez **au moins 8 compétences**, réparties sur au moins 3 catégories. Incluez volontairement une compétence que **personne** ne maîtrise (`nb_maitrises` à 0) : elle servira en B5.

Dans `index.php`, récupérez ce tableau :

```php
$competences = require __DIR__ . '/../data/competences.php';
```

> `__DIR__` est le dossier du fichier courant. Construire les chemins ainsi évite les surprises selon l'endroit d'où le script est appelé.

---

## B3 — La liste des compétences

**Fichier :** `public/index.php` · *à savoir absolument* · 20 min

Sous le message de bienvenue, affichez toutes les compétences dans un **tableau HTML** : libellé, catégorie, nombre de personnes qui la maîtrisent.

Utilisez `foreach` et la syntaxe courte d'affichage `<?= ?>`.

> **Toujours échapper ce que vous affichez.** Entourez chaque valeur de `htmlspecialchars()`. Ici les données viennent de vous et sont sans danger — mais dès la séance 4 elles viendront d'un formulaire, et cette habitude vous évitera une faille XSS. On prend le réflexe maintenant.

---

## B4 — La fiche d'une compétence

**Fichier :** `public/fiche.php` · *à savoir absolument* · 25 min

Cette page affiche **une** compétence, désignée par son identifiant dans l'URL :

```
http://localhost:8080/fiche.php?id=3
```

1. Récupérez l'identifiant depuis `$_GET`.
2. Cherchez la compétence correspondante dans le tableau.
3. Affichez son libellé, sa catégorie, sa description et son nombre de maîtrises.
4. Si l'identifiant est **absent**, **non numérique**, ou ne correspond à **aucune** compétence, affichez un message d'erreur clair plutôt qu'une page cassée.
5. Depuis `index.php`, faites de chaque libellé un **lien** vers sa fiche.

> **Le point qui compte ici, c'est le 4.** Testez `?id=999`, `?id=abc`, et l'URL sans aucun paramètre. Une page qui affiche `Undefined array key "id"` n'est pas terminée. Ne faites jamais confiance à ce qui arrive par l'URL : c'est l'utilisateur qui l'écrit.

---

## B5 — Badge de couverture

**Fichiers :** `public/index.php` et `public/fiche.php` · *à savoir absolument* · 20 min

Affichez à côté de chaque compétence un badge dépendant de `nb_maitrises` :

| Condition | Badge |
|---|---|
| 0 | **Personne ne la maîtrise** |
| 1 ou 2 | **Peu couverte** |
| 3 et plus | **Bien couverte** |

Donnez-leur une couleur distincte, via une classe CSS ou un style en ligne.

Le calcul du badge est utilisé sur deux pages : écrivez-le **une seule fois**, dans une fonction placée dans `inc/fonctions.php`, que vous inclurez où nécessaire. C'est le premier pas vers ce qu'on généralisera en séance 5.

---

## B6 — Extensions

*Facultatif, à ne traiter que si B1 à B5 sont terminés et vérifiés.*

**B6.1 — Statistiques.** En haut de `index.php`, affichez le nombre total de compétences, le nombre de catégories distinctes, et la moyenne des `nb_maitrises` arrondie à une décimale.

**B6.2 — Filtre par catégorie.** Permettez `index.php?categorie=Développement` pour n'afficher que les compétences de cette catégorie. Proposez au-dessus du tableau la liste des catégories sous forme de liens, plus un lien « Toutes ».

**B6.3 — Tri.** Triez les compétences par nombre de maîtrises décroissant, pour faire remonter les mieux couvertes.

---

## Checklist de fin de séance

- [ ] Les six scripts de la partie A s'exécutent sans erreur ni avertissement
- [ ] A3 refuse `0`, `7` et `abc`, et accepte `4`
- [ ] A4 : j'ai compris la différence entre `strlen` et `mb_strlen`
- [ ] `index.php` affiche la date du jour et la version de PHP, générées par PHP
- [ ] J'ai regardé le code source de la page et je sais pourquoi il n'y a aucune balise `<?php`
- [ ] `data/competences.php` contient au moins 8 compétences sur au moins 3 catégories
- [ ] `index.php` affiche la liste complète dans un tableau, sans erreur ni notice
- [ ] `fiche.php?id=3` affiche la bonne compétence
- [ ] `fiche.php?id=999`, `?id=abc` et `fiche.php` sans paramètre affichent un message clair
- [ ] Chaque libellé de la liste est un lien vers sa fiche
- [ ] Les trois cas de badge sont visibles et corrects
- [ ] La fonction de badge est écrite **une seule fois**, dans `inc/fonctions.php`
- [ ] **J'ai copié mon dossier de projet ailleurs qu'à l'IUT**

---

## Pour la suite

Vos compétences sont aujourd'hui figées dans un fichier PHP : pour en ajouter une, il faut éditer du code. En **séance 2**, elles viendront d'une vraie base MySQL, celle qui tourne déjà dans votre conteneur. Vous découvrirez PDO, les requêtes préparées, et pourquoi une application qui concatène des chaînes dans ses requêtes SQL se fait pirater.
