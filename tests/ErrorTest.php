<?php

namespace sndsgd;

class ErrorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerToArray
     */
    public function testToArray($message, $code)
    {
        $expect = [
            "message" => $message,
            "code" => $code,
        ];

        $error = new Error($message, $code);
        $this->assertSame($expect, $error->toArray());
    }

    public function providerToArray()
    {
        return [
            ["the message", 42]
        ];
    }
}
