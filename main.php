<?php

$dirs = array('core', 'lib');
foreach ($dirs as $dir) {
    foreach(scandir($dir) as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) !== "php") continue;
        include_once $dir . '/' . $file;
    }
}

$network = new SimpleNeuralNetwork();
echo 'Weights start: ';
print_r($network->getWeights());
echo PHP_EOL;
$train_inputs = array(
    array(1, 1, 0),
    array(1, 1, 1),
    array(1, 1, 0),
    array(1, 0, 0),
    array(0, 1, 1),
    array(0, 0, 1),
    array(0, 1, 0),
);
$train_outputs = array(1, 1, 1, 1, 1, 1, 0);
$train_iterations = 50000;
$network->train($train_inputs, $train_outputs, $train_iterations);
echo 'Weights train: ';
print_r($network->getWeights());
echo PHP_EOL;
print("Testing the data");
$test_data = array(
    array(1, 1, 1),
    array(1, 0, 0),
    array(0, 1, 1),
    array(0, 0, 1),
    array(1, 0, 1),
    array(0, 1, 0),
    array(0, 0, 0)
);

foreach ($test_data as $data) {
    echo "Result for [" . implode(',', $data) . "] is: ";
    $res = $network->propagation(array($data), false);
    $res = end($res);
    echo end($res) . PHP_EOL;
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
