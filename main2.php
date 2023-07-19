<?php
include 'autoloader.php';

// Example
// ma kola? ma skrzydla?, ma hak?
// odpowiedz: (samolot, auto)
$trainingCollection = new TrainingCollection();
$trainingCollection->add(new TrainingData(array(1, 0, 0), array(1, 1)));
$trainingCollection->add(new TrainingData(array(0, 1, 0), array(1, 0)));
$trainingCollection->add(new TrainingData(array(0, 0, 1), array(0, 1)));
$trainingCollection->add(new TrainingData(array(1, 0, 1), array(0, 1)));
$trainingCollection->add(new TrainingData(array(1, 1, 0), array(1, 0)));

$network = new DoubleNeuralNetwork();
echo PHP_EOL . 'Weights start: ' . PHP_EOL . $network->getWeightsList();
$network->train($trainingCollection, 50000);
echo PHP_EOL . 'Weights train: ' . PHP_EOL . $network->getWeightsList();
echo PHP_EOL;
print("Testing the data");
$test_data = array(
    array(1, 1, 1),
    array(1, 0, 0),
    array(0, 1, 1),
    array(0, 0, 1),
    array(0, 1, 1),
    array(1, 0, 1),
    array(0, 1, 0),
    array(0, 1, 0),
    array(1, 1, 1),
    array(0, 0, 0)
);

foreach ($test_data as $data) {
    echo "Result for [" . implode(',', $data) . "] is: ";
    $res = $network->propagation(array($data), false);
    echo '[' . implode(',', $res[0]) . ']' . PHP_EOL;
}