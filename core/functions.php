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

