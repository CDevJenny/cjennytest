<?php

/* Cette fonction renvoie deux array d'intervalles (ordonnées "<" définies selon les paramètres suivants :
- array 1 contient la valeur la plus basse du set de données et la valeur la plus haut inférieur à la plus basse de
l'array2
- array 2 contient la valeur plus haute (en deuxieme clé) et sa seconde valeur par défaut à condition qu'elle ne soit
pas inférieure à la valeur la plus haute de l'array 1.
Dans ce cas, on set un seul array dans lequel on place la valeur la plus basse et la valeur la plus haute de notre
ensemble de données.
*/
$array = [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]];
// [[7, 8], [3, 6], [2, 4]]
// [[0, 5], [3, 10]]
// [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]

function foo ($array)
{
    /*
        max() n'étant pas 100% fiable pour ce qu'on cherche à obtenir, (prend la premiere valeur de chaque tableau
        pour définir la plus haute) on s'assure qu'on cherche bien sur la 2eme valeur pour avoir notre array contenant
        la valeur la plus haute. Sachant que les tableaux sont ordonnés du plus bas au plus haut dans notre cas
    */
    $rValues = array_column($array, 1);
    $maxArrayKey = array_search(max($rValues), $rValues, true);
    //  set des tableaux contenants la plus haute valeur et la plus basse de notre ensemble de données
    $maxArray = $array[$maxArrayKey];
    $minArray = min($array);
    //  set du int le plus haut et le plus bas
    $maxInt = max($maxArray);
    $minInt = min($minArray);
    /*
        1er cas : si la premiere valeur de notre maxArray est plus basse que la plus haute de notre minArray, on set les
        résultats sur un seul tableau.
        2eme cas : on merge notre tableau de données pour trouver une valeur égale ou plus haute que la deuxieme valeur
        de notre minArray et inférieur à la deuxieme de notre max Array. On set les résultats sur deux tableau
    */
    if ($maxArray[0] < $minArray[1]) {
        $result = [[$minInt, $maxInt]];
    } else {
        $merged = array_merge(...$array);
        $needle = range($minArray[1], $maxArray[0] - 1);

        $result = [[$minInt, max(array_intersect($merged, $needle))], $maxArray];
    }
    return $result;
}

print_r(foo($array));
