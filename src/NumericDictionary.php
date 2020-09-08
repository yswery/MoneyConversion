<?php

namespace yswery\MoneyConversion;

class NumericDictionary
{
    /**
     * Dictionary Constant array for numbers between 0 and 9
     *
     * @var array
     */
    const SINGLE_DIGIT_WORDS = [
        '0' => '',
        '1' => 'one',
        '2' => 'two',
        '3' => 'three',
        '4' => 'four',
        '5' => 'five',
        '6' => 'six',
        '7' => 'seven',
        '8' => 'eight',
        '9' => 'nine',
    ];

    /**
     * Dictionary Constant array for numbers between 10 and 19
     *
     * @var array
     */
    const TENS_SINGLE_DIGIT_WORDS = [
        '10' => 'ten',
        '11' => 'eleven',
        '12' => 'twelve',
        '13' => 'thirteen',
        '14' => 'fourteen',
        '15' => 'fifteen',
        '16' => 'sixteen',
        '17' => 'seventeen',
        '18' => 'eighteen',
        '19' => 'nineteen',
    ];

    /**
     * Dictionary Constant array for numbers being factor of 10's
     *
     * @var array
     */
    const TENS_WHOLE_WORDS = [
        '20' => 'twenty',
        '30' => 'thirty',
        '40' => 'forty',
        '50' => 'fifty',
        '60' => 'sixty',
        '70' => 'seventy',
        '80' => 'eighty',
        '90' => 'ninety',
    ];
}