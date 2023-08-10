<?php
namespace Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\SerializerBuilder;

class Message
{
    public function __construct(string $subject, Body $body, array $toRecipients = [], array $ccRecipients = []) {
        $this->subject = $subject;
        $this->body = $body;
        $this->toRecipients = $toRecipients;
        $this->ccRecipients = $ccRecipients;
        // $this->attachments = $attachments;
    }

    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("subject")
     */
    private string $subject;

    /**
     * 
     * @var Body
     * @type("Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email\Body")
     * @SerializedName("body")
     */
    private Body $body;

    /**
     * 
     * @var array
     * @type("array<Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email\Recipient>")
     * @SerializedName("toRecipients")
     */
    private array $toRecipients = [];
    
    /**
     * 
     * @var array
     * @type("array<Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email\Recipient>")
     * @SerializedName("ccRecipients")
     */
    private array $ccRecipients = [];

    // private array $attachments = [];


    /**
     * @return string
     */
    public function getSubject() : string
    {
        return $this->subject;
    }

    /**
     * @param string $subject 
     * @return self
     */
    public function setSubject(string $subject) : self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return Body
     */
    public function getBody() : Body
    {
        return $this->body;
    }

    /**
     * @param Body $body 
     * @return self
     */
    public function setBody(Body $body) : self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return array
     */
    public function getToRecipients() : array
    {
        return $this->toRecipients;
    }

    /**
     * @param array $toRecipients 
     * @return self
     */
    public function addToRecipient(Recipient $recipient) : self
    {
        $this->toRecipients[] = $recipient;
        return $this;
    }

    /**
     * @param array $toRecipients 
     * @return self
     */
    public function setToRecipients(array $toRecipients) : self
    {
        $this->toRecipients = $toRecipients;
        return $this;
    }

    /**
     * @return array
     */
    public function getCcRecipients() : array
    {
        return $this->ccRecipients;
    }

    /**
     * @param array $toRecipients 
     * @return self
     */
    public function addCcRecipient(Recipient $recipient) : self
    {
        $this->ccRecipients[] = $recipient;
        return $this;
    }

    /**
     * @param array $ccRecipients 
     * @return self
     */
    public function setCcRecipients(array $ccRecipients) : self
    {
        $this->ccRecipients = $ccRecipients;
        return $this;
    }

    public function toArray(): array
    {
        return SerializerBuilder::create()->build()->toArray($this);
    }

    /**
	 * @return self
	 */
	public static function fromArray(array $data) {
		return SerializerBuilder::create()->build()->fromArray($data, self::class);
	}
}