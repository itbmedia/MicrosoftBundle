<?php
namespace Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\SerializerBuilder;

class Attachment
{
    public function __construct($upload) {
        $this->dataType = "#microsoft.graph.fileAttachment";
        $this->name = $upload["name"];
        $this->contentType = $upload["type"];
        $this->contentBytes =substr($upload["data"], strpos($upload["data"], ',') + 1);
    }

    /**
     *
     * @var string
     * @type("string")
     * @SerializedName("@odata.type")
     */
    private string $dataType = "#microsoft.graph.fileAttachment";

    /**
     *
     * @var string
     * @type("string")
     * @SerializedName("name")
     */
    private string $name;

    /**
     *
     * @var string
     * @type("string")
     * @SerializedName("contentType")
     */
    private string $contentType;

    /**
     *
     * @var string
     * @type("string")
     * @SerializedName("contentBytes")
     */

    private string $contentBytes;


    /**
     * @return string
     */
    public function getDataType() : string
    {
        return $this->dataType;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType() : string
    {
        return $this->contentType;
    }

    /**
     * @param string
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
    public function getContentBytes() : string
    {
        return $this->contentBytes;
    }

    /**
     * @param string
     * @return self
     */
    public function setContentBytes(string $contentBytes) : self
    {
        $this->contentBytes = $contentBytes;
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