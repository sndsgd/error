<?php

namespace sndsgd;

/**
 * @coversDefaultClass \sndsgd\Error
 */
class ErrorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::createMessage
     */
    public function testCreateMessage()
    {
        @file_get_contents(42);
        $message = Error::createMessage("test");

        $match = "test; file_get_contents(";
        $this->assertTrue(strpos($message, $match) === 0);
    }

    /**
     * @covers ::__construct
     * @covers ::getMessage
     * @covers ::getCode
     */
    public function testSimple()
    {
        $message = \sndsgd\Str::random(42);
        $code = mt_rand();
        $error = new Error($message, $code);
        $this->assertSame($message, $error->getMessage());
        $this->assertSame($code, $error->getCode());
    }

    /**
     * @covers ::toArray
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
     * @covers ::jsonSerialize
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
