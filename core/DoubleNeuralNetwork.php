<?php
class DoubleNeuralNetwork {
    private $weights;
    public function __construct() {
        srand(1);
        $this->weights = xavier_init(3, 2);
    }
    public function getWeights() {
        return $this->weights;
    }
    public function getWeightsList() {
        $res = array();
        foreach ($this->weights as $key => $weight) {
            $res[] = $key . ': ' . '[' . implode(',', $weight) . ']';
        }
        return implode(PHP_EOL, $res) . PHP_EOL;
    }
    public function train(TrainingCollection $trainingCollection, $train_iters) {
        for ($i = 0; $i < $train_iters; $i++) {
            $propagation_result = $this->propagation($trainingCollection->getInputs());
            $this->backward_propagation($propagation_result, $trainingCollection->getInputs(), $trainingCollection->getOutputs());
        }
    }

    public function backward_propagation($propagation_result, $train_input, $train_output) {
        $errors = matrix::subtract($train_output, $propagation_result);
        $multiply = matrix::multiply($errors, d_sigmoid($propagation_result));
        $dot = matrix::dot(matrix::transpose($train_input), $multiply);
        $this->weights = clampToRange(matrix::sum($this->weights, $dot));
    }

    public function propagation($inputs) {
        $dot = matrix::dot($inputs, $this->weights);
        $sigmoid = sigmoid($dot);
        return roundAll($sigmoid);
    }
}
