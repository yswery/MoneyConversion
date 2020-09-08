<?php

use PHPUnit\Framework\TestCase;
use yswery\MoneyConversion\Converter as MoneyConverter;

class ConverterTest extends TestCase
{
    protected $moneyConverter;

    protected function setUp(): void
    {
        $this->moneyConverter = new MoneyConverter();
    }


    public function testOneThousandAmount()
    {
        $this->assertEquals(
            'one thousand dollars',
            $this->moneyConverter->convert(1000)
        );
    }

    public function testZeroAmount()
    {
        $this->assertEquals(
            'zero dollars',
            $this->moneyConverter->convert(0)
        );
    }

    public function testMalformedInput()
    {
        $this->expectException(Exception::class);
        $this->moneyConverter->convert('Some Invalid Input');
    }

    public function testExceptionInputAboveOneThousand()
    {
        $this->expectException(Exception::class);
        $this->moneyConverter->convert(1000.01);
    }

    public function testExceptionNegatiNumber()
    {
        $this->expectException(Exception::class);
        $this->moneyConverter->convert(-10.10);
    }

    public function testDollarsAndCents()
    {
        $this->assertEquals(
            'one hundred and thirty two dollars and thirty three cents',
            $this->moneyConverter->convert(132.33)
        );

        $this->assertEquals(
            'nine hundred and eighty two dollars and two cents',
            $this->moneyConverter->convert(982.02)
        );

        $this->assertEquals(
            'forty three dollars and thirty cents',
            $this->moneyConverter->convert(43.3)
        );
    }

    public function testRoundedDollarsWithoutCents()
    {
        $this->assertEquals(
            'ten dollars',
            $this->moneyConverter->convert(10)
        );

        $this->assertEquals(
            'twenty dollars',
            $this->moneyConverter->convert(20)
        );

        $this->assertEquals(
            'one hundred dollars',
            $this->moneyConverter->convert(100)
        );

        $this->assertEquals(
            'one hundred and twenty dollars',
            $this->moneyConverter->convert(120)
        );

        $this->assertEquals(
            'one hundred and ten dollars',
            $this->moneyConverter->convert(110)
        );
    }

    public function testDollarsWithoutCents()
    {
        $this->assertEquals(
            'eleven dollars',
            $this->moneyConverter->convert(11)
        );

        $this->assertEquals(
            'twenty two dollars',
            $this->moneyConverter->convert(22.00)
        );

        $this->assertEquals(
            'three dollars',
            $this->moneyConverter->convert(03)
        );

        $this->assertEquals(
            'eighteen dollars',
            $this->moneyConverter->convert(18)
        );
    }

    public function testCentsNumbers()
    {
        $this->assertEquals(
            'eighteen cents',
            $this->moneyConverter->convert(0.18)
        );

        $this->assertEquals(
            'ten cents',
            $this->moneyConverter->convert(0.1)
        );

        $this->assertEquals(
            'two cents',
            $this->moneyConverter->convert(0.02)
        );

        $this->assertEquals(
            'ninety nine cents',
            $this->moneyConverter->convert(0.99)
        );
    }


}