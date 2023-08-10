<?php
namespace Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\SerializerBuilder;

class Recipient
{
    public function __construct(string $address, ?string $name = null) {
        $this->emailAddress = new EmailAddress($address, $name);
    }
    
    /**
     * 
     * @var EmailAddress
     * @type("Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email\EmailAddress")
     * @SerializedName("emailAddress")
     */
    private EmailAddress $emailAddress;

    /**
     * @return EmailAddress
     */
    public function getEmailAddress() : EmailAddress
    {
        return $this->emailAddress;
    }

    /**
     * @param EmailAddress $emailAddress 
     * @return self
     */
    public function setEmailAddress(EmailAddress $emailAddress) : self
    {
        $this->emailAddress = $emailAddress;
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