<?php

namespace yswery\MoneyConversion;

class Converter {


    /**
     * Convert our dollar numeric input into a human readable string in english
     *
     * @param $amountInput
     *
     * @return string
     * @throws \Exception
     */
    public function convert($input): string
    {
        // Since the criteria was specifically to cater for input amounts of
        // between 0 and 1000, we shall hard code to reply for 1,000 and 0

        // In order to handle an infinite dynamic input, we will need to add a
        // new dictionary for factors like "thousand", "million" "billion"

        if ($input < 0 || $input > 1000 || !is_numeric($input)) {
            throw new \Exception('Invalid input');
        }

        if ($input == 0) {
            // as per criteria
            return 'zero dollars';
        }

        if ($input == 1000) {
            return 'one thousand dollars';
        }

        // Split the dollars and cents
        $inputParts = explode('.', number_format($input, 2, '.', ''));

        // Convert the two sets of numbers independently
        $wholeNumberString = $this->generateString($inputParts[0], 'dollars');
        $decimalString = $this->generateString($inputParts[1], 'cents');

        // Return the combined sets of phrases for the dollars and cents together
        if ($wholeNumberString && $decimalString) {
            return $wholeNumberString . ' and ' . $decimalString;
        }

        return $wholeNumberString  . $decimalString;
    }

    /**
     * Take in a number and convert it to a human-readable string.
     *
     * @param int    $number
     * @param string $currencyTypeString
     *
     * @return string
     */
    private function generateString(int $number, string $currencyTypeString): string
    {
        // Split the number into an array of 3 for easier translations
        $digits = str_split(intval($number));

        // Prefix '0' when we have numbers that are under the hundred mark
        while (count($digits) !== 3) {
            // add the 0 to the start of the array
            array_unshift($digits, '0');
        }

        // Lets start with an empty numeric string and built it up section by section
        $numericString = '';

        // Build up the first and second digits (0 - 99)
        if ($digits[1] == '0') {
            $numericString = NumericDictionary::SINGLE_DIGIT_WORDS[$digits[2]];
        } else if ($digits[1] == '1') {
            $numericString = NumericDictionary::TENS_SINGLE_DIGIT_WORDS[$digits[1] . $digits[2]];
        } else {
            $numericString = trim(NumericDictionary::TENS_WHOLE_WORDS[$digits[1].'0'] . ' ' .  NumericDictionary::SINGLE_DIGIT_WORDS[$digits[2]]);
        }

        // Convert the hundred-th digit (100-900)
        if ($digits[0] != 0) {
            $hundredString = NumericDictionary::SINGLE_DIGIT_WORDS[$digits[0]] . ' hundred';

            // Check if we have trailing numbers and if we need the 'and'
            if ($numericString) {
                $hundredString .= ' and ';
            }

            // Combined the hundred string with the trailing numbers
            $numericString = $hundredString . $numericString;
        }

        // Add on the currency type string
        if ($numericString) {
            $numericString .= ' ' . $currencyTypeString;
        }

        return $numericString;
    }
}