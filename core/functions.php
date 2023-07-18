<?php

function sigmoid($matrix, $const = 1) {
    return matrix::divide_constant($const, (matrix::add_constant($const, matrix::exp(matrix::reverse($matrix)))));
}
function d_sigmoid($matrix, $const = 1) {
    $sub = matrix::subtract_constant($const, $matrix);
    return matrix::multiplyAdrian($matrix, $sub);
}

