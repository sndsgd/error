<?php

namespace sndsgd;

class Error implements ErrorInterface, \JsonSerializable
{
    /**
     * Append a message with the message from the last encountered error
     *
     * @param string $message The message to append
     * @return string
     */
    public static function createMessage(string $message): string
    {
        $lastErrorMessage = error_get_last();
        if ($lastErrorMessage !== null) {
            $message .= "; ".$lastErrorMessage["message"];
        }
        return $message;
    }

    /**
     * A human readable message
     *
     * @var string
     */
    protected $message;

    /**
     * A code that indicates the specific error instance
     *
     * @var int
     */
    protected $code;

    public function __construct(string $message, int $code = 0)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            "message" => $this->getMessage(),
            "code" => $this->getCode(),
        ];
    }

    /**
     * @see http://php.net/manual/en/jsonserializable.jsonserialize.php
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
