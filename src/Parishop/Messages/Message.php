<?php
namespace Parishop\Messages;

/**
 * Class Message
 * @package Parishop\Messages
 * @since   1.0
 */
class Message
{
    /**
     * @var string
     * @since 1.0
     */
    protected $level;

    /**
     * @var string
     * @since 1.0
     */
    protected $message;

    /**
     * @var array
     * @since 1.0
     */
    protected $context = [];

    /**
     * Message constructor.
     * @param string $level
     * @param string $message
     * @param array  $context
     * @since 1.0
     */
    public function __construct($level, $message, array $context = [])
    {
        $this->level   = $level;
        $this->message = $message;
        $this->context = $context;
    }

    /**
     * @return string
     * @since 1.0
     */
    public function __toString()
    {
        return $this->message();
    }

    /**
     * @return string
     * @since 1.0
     */
    public function context()
    {
        return $this->context;
    }

    /**
     * @return string
     * @since 1.0
     */
    public function level()
    {
        return $this->level;
    }

    /**
     * @return string
     * @since 1.0
     */
    public function message()
    {
        return $this->message;
    }

}

