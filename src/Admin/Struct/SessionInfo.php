<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlAttributeMap};

/**
 * SessionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SessionInfo
{
    /**
     * Account ID
     * 
     * @Accessor(getter="getZimbraId", setter="setZimbraId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getZimbraId', setter: 'setZimbraId')]
    #[SerializedName('zid')]
    #[Type('string')]
    #[XmlAttribute]
    private $zimbraId;

    /**
     * Account name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Session ID
     * 
     * @Accessor(getter="getSessionId", setter="setSessionId")
     * @SerializedName("sid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getSessionId', setter: 'setSessionId')]
    #[SerializedName('sid')]
    #[Type('string')]
    #[XmlAttribute]
    private $sessionId;

    /**
     * Creation date
     * 
     * @Accessor(getter="getCreatedDate", setter="setCreatedDate")
     * @SerializedName("cd")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getCreatedDate', setter: 'setCreatedDate')]
    #[SerializedName('cd')]
    #[Type('int')]
    #[XmlAttribute]
    private $createdDate;

    /**
     * Last accessed date
     * 
     * @Accessor(getter="getLastAccessedDate", setter="setLastAccessedDate")
     * @SerializedName("ld")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getLastAccessedDate', setter: 'setLastAccessedDate')]
    #[SerializedName('ld')]
    #[Type('int')]
    #[XmlAttribute]
    private $lastAccessedDate;

    /**
     * Extra attributes - possibly including "push"
     * 
     * @Accessor(getter="getExtraAttributes", setter="setExtraAttributes")
     * @Type("array<string, string>")
     * @XmlAttributeMap
     * 
     * @var array
     */
    #[Accessor(getter: 'getExtraAttributes', setter: 'setExtraAttributes')]
    #[Type('array<string, string>')]
    #[XmlAttributeMap]
    private $extraAttributes = [];

    /**
     * Constructor
     * 
     * @param string $sessionId
     * @param int $createdDate
     * @param int $lastAccessedDate
     * @param string $zimbraId
     * @param string $name
     * @return self
     */
    public function __construct(
        string $sessionId = '',
        int $createdDate = 0,
        int $lastAccessedDate = 0,
        ?string $zimbraId = NULL,
        ?string $name = NULL
    )
    {
        $this->setSessionId($sessionId)
             ->setCreatedDate($createdDate)
             ->setLastAccessedDate($lastAccessedDate);

        if (NULL !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
    }

    /**
     * Get session ID
     *
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Set session ID
     *
     * @param  string $sessionId
     * @return self
     */
    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    /**
     * Get the createdDate
     *
     * @return int
     */
    public function getCreatedDate(): int
    {
        return $this->createdDate;
    }

    /**
     * Set the createdDate
     *
     * @param  int $createdDate
     * @return self
     */
    public function setCreatedDate(int $createdDate): self
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * Get the lastAccessedDate
     *
     * @return int
     */
    public function getLastAccessedDate(): int
    {
        return $this->lastAccessedDate;
    }

    /**
     * Set the lastAccessedDate
     *
     * @param  int $lastAccessedDate
     * @return self
     */
    public function setLastAccessedDate(int $lastAccessedDate): self
    {
        $this->lastAccessedDate = $lastAccessedDate;
        return $this;
    }

    /**
     * Get the zimbraId
     *
     * @return string
     */
    public function getZimbraId(): ?string
    {
        return $this->zimbraId;
    }

    /**
     * Set the zimbraId
     *
     * @param  string $zimbraId
     * @return self
     */
    public function setZimbraId(string $zimbraId): self
    {
        $this->zimbraId = $zimbraId;
        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the extraAttributes
     *
     * @return array
     */
    public function getExtraAttributes(): ?array
    {
        return $this->extraAttributes;
    }

    /**
     * Set the extraAttributes
     *
     * @param  array $attributes
     * @return self
     */
    public function setExtraAttributes(array $attributes): self
    {
        foreach ($attributes as $name => $value) {
            $this->addExtraAttribute($name, $value);
        }
        return $this;
    }

    public function addExtraAttribute(string $name, string $value): self
    {
        if (!empty($name) && !empty($value)) {
            $this->extraAttributes[$name] = $value;
        }
        return $this;
    }
}
