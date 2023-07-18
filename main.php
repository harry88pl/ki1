<?php

class SimpleNeuralNetwork {

    public $weights;

    public function __construct() {
        // Seed the random number generator.
        srand(1);

        // Initialize the weights to random values.
        /*$this->weights = array(
            array(2 * rand(0, 1) - 1),
            array(2 * rand(0, 1) - 1),
            array(2 * rand(0, 1) - 1),
        );*/
        $this->weights = [
            [-0.16595599],
            [ 0.44064899],
            [-0.99977125]];
    }

    public function sigmoid($x) {
        // Sigmoid function - smooth function that maps any number to a number from 0 to 1.
        return $this->divide_by_matrix(1, ($this->add_number_to_matrix(1, $this->matrix_exp($this->reverse_matrix($x)))));
    }

    public function d_sigmoid($x) {
        // Derivative of sigmoid function.
        return $this->multiply_matrices($x, ($this->subtract_int_from_Matrix(1, $x)));
    }
    public function divide_by_matrix($number, $matrix) {
        $result = array();

        foreach ($matrix as $row) {
            $divide_row = array();

            foreach ($row as $element) {
                $divide_element = $number / $element;
                $divide_row[] = $divide_element;
            }

            $result[] = $divide_row;
        }

        return $result;
    }
    public function multiply_matrices($matrix1, $matrix2) {
        $result = array();
        if (is_array($matrix1[0])) $matrix1[0] = array($matrix1[0]);
        if (is_array($matrix2[0])) $matrix2[0] = array($matrix2[0]);

        for ($i = 0; $i < $rows1; $i++) {
            $row = array();

            for ($j = 0; $j < $columns2; $j++) {
                $element = 0;

                for ($k = 0; $k < $columns1; $k++) {
                    $element += $matrix1[$i][$k] * $matrix2[$k][$j];
                }

                $row[] = $element;
            }

            $result[] = $row;
        }

        return $result;
    }
    public function reverse_matrix($matrix) {
        $result = array();

        foreach ($matrix as $row) {
            if (is_array($element)) continue;
            $reverse_row = array();

            foreach ($row as $element) {
                $reverse_element = -$element;
                $reverse_row[] = $reverse_element;
            }

            $result[] = $reverse_row;
        }

        return $result;
    }
    public function add_number_to_matrix($number, $matrix) {
        $result = array();

        foreach ($matrix as $row) {
            $new_row = array();

            foreach ($row as $element) {
                $new_element = $number + $element;
                $new_row[] = $new_element;
            }

            $result[] = $new_row;
        }

        return $result;
    }
    public function subtract_matrices($matrix1, $matrix2) {
        $result = array();

        for ($i = 0; $i < count($matrix1); $i++) {
            $row = array();
            if (!is_array($matrix1[$i])) $matrix1[$i] = array($matrix1[$i]);
            for ($j = 0; $j < count($matrix1[$i]); $j++) {
                if ($matrix1[$i][$j] == 0) {
                    $element = -$matrix2[$i][$j];
                } else {
                    $element = $matrix1[$i][$j] - $matrix2[$i][$j];
                }
                $row[] = $element;
            }

            $result[] = $row;
        }
    }
    public function subtract_int_from_Matrix($number, $matrix) {
        $result = array();

        for ($i = 0; $i < count($matrix); $i++) {
            $row = array();
            if (is_array($matrix[$i])) {
                $element = $this->subtract_int_from_Matrix($number, $matrix[$i]);
            }
            else if ($number == 0) {
                $element = -$matrix[$i];
            } else {
                $element = $number - $matrix[$i];
            }
            $row[] = $element;
        }

        return $result;
    }
    public function matrix_exp($matrix) {
        $result = array();

        foreach ($matrix as $row) {
            $exp_row = array();

            foreach ($row as $element) {
                if (is_array($element)) continue;
                $exp_element = exp($element);
                $exp_row[] = $exp_element;
            }

            $result[] = $exp_row;
        }

        return $result;
    }

    public function train($train_input, $train_output, $train_iters) {
        for ($i = 0; $i < $train_iters; $i++) {
            // Propagation process.
            $propagation_result = $this->propagation($train_input);

            $this->backward_propagation($propagation_result, $train_input, $train_output);
        }
    }
    function backward_propagation($propagation_result, $train_input, $train_output) {
        var_dump('train_output', $train_output);
        var_dump('propagation_result', $propagation_result);
        $error = $this->subtract_matrices($train_output, $propagation_result);
        $d_sigmoid = $this->d_sigmoid($propagation_result);
        var_dump('$d_sigmoid', $d_sigmoid);
        $multiply = $this->multiply_matrices($error, $d_sigmoid);
        var_dump('$multiply', $multiply);
        $this->weights += dot(transpose($train_input), $multiply);
    }

    public function propagation($inputs) {
        // Propagation process.
        return $this->sigmoid(dot($inputs, $this->weights));
    }

}
function dot($matrix1, $matrix2) {
    var_dump('$matrix1', $matrix1);
    var_dump('$matrix2', $matrix2);
    $rows1 = count($matrix1);
    $cols1 = count($matrix1[0]);
    $rows2 = count($matrix2);
    $cols2 = count($matrix2[0]);

    if ($cols1 != $rows2) {
        throw new Exception("Invalid matrix dimensions for dot product");
    }

    $result = array();

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

function transpose($matrix) {
    $result = array();

    $rows = count($matrix);
    $columns = count($matrix[0]);

    for ($i = 0; $i < $columns; $i++) {
        $row = array();

        for ($j = 0; $j < $rows; $j++) {
            $row[] = $matrix[$j][$i];
        }

        $result[] = $row;
    }

    return $result;
}
$network = new SimpleNeuralNetwork();

print_r($network->weights);

$train_inputs = array(
    array(1, 1, 0),
    array(1, 1, 1),
    array(1, 1, 0),
    array(1, 0, 0),
    array(0, 1, 1),
    array(0, 1, 0),
);

$train_outputs = array(array(0, 1, 0, 0, 1, 0))[0];

$train_iterations = 50000;

$network->train($train_inputs, $train_outputs, $train_iterations);

print_r($network->weights);

print("Testing the data");
$test_data = array(
    array(1, 1, 1),
    array(1, 0, 0),
    array(0, 1, 1),
    array(0, 1, 0),
);

foreach ($test_data as $data) {
    print_f("Result for {data} is:");
    print_f($network->propagation($data));
}

/*
$files = scandir("core");

$files = array_filter($files, function ($file) {
    return pathinfo($file, PATHINFO_EXTENSION) === "php";
});

foreach ($files as $file) {
    include_once "core/" . $file;
}

$network = new SimpleNeuralNetwork();

echo "Initial weights:\n";
print_r($network->weights);

$train_inputs = [
    [1, 1, 0], [1, 1, 1], [1, 1, 0], [1, 0, 0], [0, 1, 1], [0, 1, 0]
];

$train_outputs = [
    [0], [1], [0], [0], [1], [0]
];

$train_iterations = 50000;

$network->train($train_inputs, $train_outputs, $train_iterations);

echo "Trained weights:\n";
print_r($network->weights);

echo "Testing the data:\n";
$test_data = [
    [1, 1, 1], [1, 0, 0], [0, 1, 1], [0, 1, 0]
];

foreach ($test_data as $data) {
    echo "Result for " . implode(", ", $data) . " is:\n";
    print_r($network->propagation($data));
}
*/
