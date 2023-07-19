<?php
class SimpleNeuralNetwork {
    private $weights;
    public function __construct() {
        srand(1);

        $this->weights = array(
            array((rand(0, 2000)-1000)/1000),
            array((rand(0, 2000)-1000)/1000),
            array((rand(0, 2000)-1000)/1000),
            array((rand(0, 2000)-1000)/1000),
        );
    }
    public function getWeights() {
        return $this->weights;
    }
    public function getWeightsList() {
        $res = array();
        foreach ($this->weights as $key => $weight) {
            $res[] = $key . ': ' . end($weight);
        }
        return implode(PHP_EOL, $res) . PHP_EOL;
    }
    public function train(TrainingCollection $trainingCollection, $train_iters) {
        for ($i = 0; $i < $train_iters; $i++) {
            $propagation_result = $this->propagation($trainingCollection->getInputs());
            $this->backward_propagation($propagation_result, $trainingCollection->getInputs(), $trainingCollection->getOutputs());
        }
    }

    function backward_propagation($propagation_result, $train_input, $train_output) {
        $error = matrix::subtract($train_output, $propagation_result);
        $d_sigmoid = d_sigmoid($propagation_result);
        $multiply = matrix::multiply($error, $d_sigmoid);
        $this->weights = array_map('clampToRange', matrix::sum($this->weights, matrix::dot(matrix::transpose($train_input), $multiply)));
    }

    public function propagation($inputs) {
        $dot = matrix::dot($inputs, $this->weights);
        $sigmoid = sigmoid($dot);
        return $sigmoid;
    }
}
