<?php
class DoubleNeuralNetwork {
    private $weights;
    public function __construct() {
        srand(1);
        $this->weights = array(
            array((rand(0, 2000) - 1000) / 1000, (rand(0, 2000) - 1000) / 1000),
            array((rand(0, 2000) - 1000) / 1000, (rand(0, 2000) - 1000) / 1000),
            array((rand(0, 2000) - 1000) / 1000, (rand(0, 2000) - 1000) / 1000),
        );
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
        $d_sigmoid = d_sigmoid($propagation_result);
        $weight_updates = array();
        foreach ($errors as $id => $error) {
            $weight_update = array();
            foreach ($error as $key => $val) {
                $weight_update[$key] = clampToRange($train_input[$id][$key] * $errors[$id][$key] * $d_sigmoid[$id][$key]);
            }
            $weight_updates[] = $weight_update;
        }

        // Aktualizacja wag dla obu neuronów wyjściowych
        for ($i = 0; $i < count($this->weights); $i++) {
            for ($j = 0; $j < count($this->weights[$i]); $j++) {
                $this->weights[$i][$j] += $weight_updates[$i][$j];
            }
        }
    }

    public function propagation($inputs) {
        $dot = matrix::dot($inputs, $this->weights);
        $sigmoid = sigmoid($dot);
        return roundAll($sigmoid);
    }
}
