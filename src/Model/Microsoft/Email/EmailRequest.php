<?php
namespace Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\SerializerBuilder;

class EmailRequest
{
    public function __construct(Message $message, bool $saveToSentItems = true) {
        $this->message = $message;
        $this->saveToSentItems = $saveToSentItems;
    }

    /**
     * 
     * @var Message
     * @type("Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email\Message")
     * @SerializedName("message")
     */
    private Message $message;

    /**
     * 
     * @var bool
     * @type("bool")
     * @SerializedName("saveToSentItems")
     */
    private bool $saveToSentItems = true;

    /**
     * @return Message
     */
    public function getMessage() : Message
    {
        return $this->message;
    }

    /**
     * @param Message $message 
     * @return self
     */
    public function setMessage(Message $message) : self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return bool
     */
    public function getSaveToSentItems() : bool
    {
        return $this->saveToSentItems;
    }

    /**
     * @param bool $saveToSentItems 
     * @return self
     */
    public function setSaveToSentItems(bool $saveToSentItems) : self
    {
        $this->saveToSentItems = $saveToSentItems;
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