<?php
function dot($matrix1, $matrix2) {
    var_Dump($matrix1);
    var_Dump($matrix2);
    $result = array();
    $rows1 = sizeof($matrix1);
    $cols1 = sizeof($matrix1[0]);
    $rows2 = sizeof($matrix2);
    $cols2 = sizeof($matrix2[0]);

    if ($cols1 != $rows2) {
        throw new Exception("Invalid matrix dimensions for dot product");
    }

    for ($i = 0; $i < $rows1; $i++) {
        $row = array();
        for ($j = 0; $j < $cols2; $j++) {
            $sum = 0;
            for ($k = 0; $k < $cols1; $k++) {
                $sum += $matrix1[$i][$k] * $matrix2[$k][$j];
            }
            $row[] = $sum;
        }
        $result[] = $row;
    }

    return $result;
}


