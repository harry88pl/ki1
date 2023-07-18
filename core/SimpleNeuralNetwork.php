<?php
class SimpleNeuralNetwork {
    private $weights;
    public function __construct() {
        srand(1);
        $this->weights = [[-0.16595599], [0.44064899], [-0.99977125]];

        /*$this->weights = array(
            array(2 * rand(0, 1) - 1),
            array(2 * rand(0, 1) - 1),
            array(2 * rand(0, 1) - 1),
        );*/
    }
    public function getWeights() {
        return $this->weights;
    }
    public function train($train_input, $train_output, $train_iters) {
        for ($i = 0; $i < $train_iters; $i++) {
            $propagation_result = $this->propagation($train_input);
            $this->backward_propagation($propagation_result, $train_input, $train_output);
        }
    }

    function backward_propagation($propagation_result, $train_input, $train_output) {
        $error = matrix::subtract($train_output, $propagation_result);
        $d_sigmoid = d_sigmoid($propagation_result);
        $multiply = matrix::multiplyAdrian($error, $d_sigmoid);
        $this->weights = matrix::sum($this->weights, matrix::dot(matrix::transpose($train_input), $multiply));
    }

    public function propagation($inputs, $debug = false) {
        if ($debug) {
            var_dump('$inputs', $inputs);
            var_dump('$this->weights', $this->weights);
        }
        $dot = matrix::dot($inputs, $this->weights);
        if ($debug) {
            var_dump('$dot', $dot);
        }
        $sigmoid = sigmoid($dot);
        if ($debug) {
            var_dump('$sigmoid', $sigmoid);
        }
        return $sigmoid;
    }
}
