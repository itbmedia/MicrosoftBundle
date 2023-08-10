<?php
namespace Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\SerializerBuilder;

class EmailAddress
{
    public function __construct(string $address, ?string $name) {
        $this->address = $address;
        $this->name = $name;
    }
    
    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("address")
     */
    private string $address;
    
    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("name")
     */
    private ?string $name;

    /**
     * @return mixed
     */
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * @param mixed $address 
     * @return self
     */
    public function setAddress($address) : self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param mixed $name 
     * @return self
     */
    public function setName($name) : self
    {
        $this->name = $name;
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