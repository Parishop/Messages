<?php
namespace Parishop;

/**
 * Class Messages
 * @package Parishop
 * @since   1.0
 */
class Messages implements \PHPixie\Template\Extensions\Extension
{
    use \Psr\Log\LoggerTrait;

    /**
     * @var \PHPixie\Framework\Context
     * @since 1.0
     */
    protected $context;

    /**
     * @var array
     * @since 1.0
     */
    protected $messages;

    /**
     * @param \PHPixie\Framework\Context $context
     * @since 1.0 \PHPixie\HTTP\Context
     * @version 1.0.3 \PHPixie\Framework\Context
     */
    public function __construct($context)
    {
        $this->context = $context;
    }

    /**
     * Map of method aliases
     * @return array
     * @since 1.0.1
     */
    public function aliases()
    {
        return [];
    }

    /**
     * @param string $level
     * @return Messages\Message[]
     * @since   1.0 asArray()
     * @version 1.0.3 asArray($level = null)
     */
    public function asArray($level = null)
    {
        $this->requireMessages();
        $result = [];
        foreach($this->messages as $lvl => $messages) {
            if($level !== null && $lvl !== $level) {
                continue;
            }
            foreach($messages as $message) {
                $result[] = $message;
            }
        }
        $this->context->httpContext()->session()->remove('messages' . ($level ? '.' . $level : null));

        return $result;
    }

    /**
     * @param string $message
     * @param array  $context
     * @since 1.0.1
     */
    public function danger($message, array $context = array())
    {
        $this->log('danger', $message, $context);
    }

    /**
     * @param string $level
     * @param string $message
     * @param array  $context
     * @since 1.0
     */
    public function log($level, $message, array $context = array())
    {
        $this->requireMessages();
        $this->messages[$level][] = new Messages\Message($level, $message, $context);
        $this->context->httpContext()->session()->set('messages', $this->messages);
    }

    /**
     * Map of methods that should be available in templates.
     * @return array
     * @since 1.0.1
     */
    public function methods()
    {
        return [
            'messages' => 'asArray',
        ];
    }

    /**
     * Extension name
     * @return string
     * @since 1.0.1
     */
    public function name()
    {
        return 'messages';
    }

    /**
     * @since 1.0.3
     */
    protected function requireMessages()
    {
        if($this->messages !== null) {
            return;
        }
        $this->messages = $this->context->httpContext()->session()->get('messages', []);
    }

}

