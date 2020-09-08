<?php

require_once __DIR__ . '/vendor/autoload.php';

$converter = new \yswery\MoneyConversion\Converter();

// Loop through some random 10 examples:
for($i = 0; $i < 10; $i++) {
    $randomDollarAmount = rand(0, 100000) / 100;
    echo '$' . $randomDollarAmount . ' = ' . $converter->convert($randomDollarAmount);
    echo PHP_EOL;
}
