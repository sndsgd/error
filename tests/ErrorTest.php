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

    /**
     * @dataProvider providerJsonSerialize
     */
    public function testJsonSerialize($message, $code)
    {
        $error = new Error($message, $code);
        $expect = "{\"message\":\"$message\",\"code\":$code}";
        $this->assertSame($expect, json_encode($error, \sndsgd\Json::SIMPLE));
    }

    public function providerJsonSerialize()
    {
        return [
            ["message", 42],
            [\sndsgd\Str::random(200), PHP_INT_MAX],
        ];
    }
}
