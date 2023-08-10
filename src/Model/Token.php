<?php
namespace Logy\Bundle\MicrosoftBundle\Model;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\SerializerBuilder;

class Token
{
    public function __construct(
        string $idToken, 
        string $accessToken, 
        string $refreshToken, 
        string $scope, 
        string $tokenType,
        int $expiresIn,
        int $extExpiresIn,
        ?int $expiresOn = null,
        ?int $notBefore = null,
        ?string $resource = null
    ) {
        $this->idToken = $idToken;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->scope = $scope;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
        $this->extExpiresIn = $extExpiresIn;
        $this->expiresOn = $expiresOn;
        $this->notBefore = $notBefore;
        $this->resource = $resource;
    }
    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("id_token")
     */
    private string $idToken;

    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("access_token")
     */
    private string $accessToken;

    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("refresh_token")
     */
    private string $refreshToken;

    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("scope")
     */
    private string $scope;

    /**
     * 
     * @var string
     * @type("string")
     * @SerializedName("token_type")
     */
    private string $tokenType;

    /**
     * 
     * @var int
     * @type("int")
     * @SerializedName("expires_in")
     */
    private int $expiresIn;

    /**
     * 
     * @var int
     * @SerializedName("ext_expires_in")
     */
    private int $extExpiresIn;

     /**
     * 
     * @var int
     * @type("int")
     * @SerializedName("expires_on")
     */
    private ?int $expiresOn = null;

     /**
     * 
     * @var int
     * @type("int")
     * @SerializedName("not_before")
     */
    private ?int $notBefore = null;

     /**
     * 
     * @var string
     * @type("int")
     * @SerializedName("resource")
     */
    private ?string $resource = null;

    /**
     * @return string
     */
    public function getIdToken()
    {
        return $this->idToken;
    }

    /**
     * @param string $idToken 
     * @return self
     */
    public function setIdToken(string $idToken)
    {
        $this->idToken = $idToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken 
     * @return self
     */
    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken 
     * @return self
     */
    public function setRefreshToken(string $refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scopes 
     * @return self
     */
    public function setScope(string $scope)
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @param string $tokenType 
     * @return self
     */
    public function setTokenType(string $tokenType)
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn 
     * @return self
     */
    public function setExpiresIn(int $expiresIn)
    {
        $this->expiresIn = $expiresIn;
        return $this;
    }

    /**
     * @return int
     */
    public function getExtExpiresIn()
    {
        return $this->extExpiresIn;
    }

    /**
     * @param int $extExpiresIn 
     * @return self
     */
    public function setExtExpiresIn(int $extExpiresIn)
    {
        $this->extExpiresIn = $extExpiresIn;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresOn()
    {
        return $this->expiresOn;
    }

    /**
     * @param int $expiresOn 
     * @return self
     */
    public function setExpiresOn(int $expiresOn)
    {
        $this->expiresOn = $expiresOn;
        return $this;
    }

    /**
     * @return int
     */
    public function getNotBefore()
    {
        return $this->notBefore;
    }

    /**
     * @param int $notBefore 
     * @return self
     */
    public function setNotBefore(int $notBefore)
    {
        $this->notBefore = $notBefore;
        return $this;
    }

    /**
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param string $resource 
     * @return self
     */
    public function setResource(string $resource)
    {
        $this->resource = $resource;
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