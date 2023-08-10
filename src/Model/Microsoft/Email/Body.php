<?php
namespace Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\SerializerBuilder;

class Body
{
    public function __construct(string $contentType = "HTML", string $content) {
        $this->contentType = $contentType;
        $this->content = $content;
    }

    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("contentType")
     */
    private string $contentType = "HTML";

    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("content")
     */
    private string $content;

    /**
     * @return string
     */
    public function getContentType() : string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType 
     * @return self
     */
    public function setContentType(string $contentType) : self
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * @param string $content 
     * @return self
     */
    public function setContent(string $content) : self
    {
        $this->content = $content;
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