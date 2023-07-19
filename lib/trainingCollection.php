<?php
class TrainingCollection
{
    private $data = [];

    public function add(TrainingData $trainingData)
    {
        $this->data[] = $trainingData;
    }

    public function getInputs()
    {
        return array_map(function ($item) {
            return $item->input;
        }, $this->data);
    }

    public function getOutputs()
    {
        return array_map(function ($item) {
            return $item->output;
        }, $this->data);
    }
}