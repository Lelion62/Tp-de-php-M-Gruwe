<?php

function calcul_badge($nb_maitrises) {
    if ($nb_maitrises == 0) {
        return '<span style="color: red;">Personne ne la maîtrise</span>';
    } elseif ($nb_maitrises <= 2) {
        return '<span style="color: orange;">Peu couverte</span>';
    } else {
        return '<span style="color: green;">Bien couverte</span>';
    }
}