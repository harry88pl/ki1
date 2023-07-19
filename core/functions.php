<?php

function sigmoid($matrix, $const = 1) {
    return matrix::divide_constant($const, (matrix::add_constant($const, matrix::exp(matrix::reverse($matrix)))));
}
function d_sigmoid($matrix, $const = 1) {
    return matrix::multiply($matrix, matrix::subtract_constant($const, $matrix));
}
function clampToRange($value) {
    if (is_array($value)) {
        return array_map('clampToRange', $value);
    }
    return max(-1, min(1, $value));
}
function roundAll($value) {
    if (is_array($value)) {
        return array_map('roundAll', $value);
    }
    return round($value, 6);
}
function xavier_init($input_size, $output_size) {
    $limit = sqrt(6 / ($input_size + $output_size));
    $weights = array();

    for ($i = 0; $i < $input_size; $i++) {
        for ($j = 0; $j < $output_size; $j++) {
            $weights[$i][$j] = (rand(0, 2000) - 1000) / 1000 * $limit;
        }
    }

    return $weights;
}

