<?php
class TrainingData
{
    public $input;
    public $output;

    public function __construct(array $input, $output)
    {
        $this->input = $input;
        $this->output = $output;
    }
}