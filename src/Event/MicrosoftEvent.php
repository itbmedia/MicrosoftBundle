<?php
namespace Logy\Bundle\MicrosoftBundle\Event;

use Logy\Bundle\MicrosoftBundle\Model\Token;
use Symfony\Contracts\EventDispatcher\Event;

class MicrosoftEvent extends Event
{
    protected ?Token $token;
    
    /**
     * 
     * @param null|Token $token 
     * @return void 
     */
    public function __construct(?Token $token = null) {
        $this->token = $token;
    }

    /**
     * @return ?Token
     */
    public function getToken() : ?Token
    {
        return $this->token;
    }
}