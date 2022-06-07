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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SessionInfo
{
    /**
     * Account ID
     * @Accessor(getter="getZimbraId", setter="setZimbraId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     */
    private $zimbraId;

    /**
     * Account name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Session ID
     * @Accessor(getter="getSessionId", setter="setSessionId")
     * @SerializedName("sid")
     * @Type("string")
     * @XmlAttribute
     */
    private $sessionId;

    /**
     * Creation date
     * @Accessor(getter="getCreatedDate", setter="setCreatedDate")
     * @SerializedName("cd")
     * @Type("integer")
     * @XmlAttribute
     */
    private $createdDate;

    /**
     * Last accessed date
     * @Accessor(getter="getLastAccessedDate", setter="setLastAccessedDate")
     * @SerializedName("ld")
     * @Type("integer")
     * @XmlAttribute
     */
    private $lastAccessedDate;

    /**
     * Extra attributes - possibly including "push"
     * @Accessor(getter="getExtraAttributes", setter="setExtraAttributes")
     * @Type("array<string, string>")
     * @XmlAttributeMap
     */
    private $extraAttributes = [];

    /**
     * Constructor method for SessionInfo
     * @param string $sessionId
     * @param int $createdDate
     * @param int $lastAccessedDate
     * @param string $zimbraId
     * @param string $name
     * @return self
     */
    public function __construct(
        string $sessionId,
        int $createdDate,
        int $lastAccessedDate,
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
     * Gets session ID
     *
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Sets session ID
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
     * Gets the createdDate
     *
     * @return int
     */
    public function getCreatedDate(): int
    {
        return $this->createdDate;
    }

    /**
     * Sets the createdDate
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
     * Gets the lastAccessedDate
     *
     * @return int
     */
    public function getLastAccessedDate(): int
    {
        return $this->lastAccessedDate;
    }

    /**
     * Sets the lastAccessedDate
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
     * Gets the zimbraId
     *
     * @return string
     */
    public function getZimbraId(): ?string
    {
        return $this->zimbraId;
    }

    /**
     * Sets the zimbraId
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
     * Gets the name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets the name
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
     * Gets the extraAttributes
     *
     * @return array
     */
    public function getExtraAttributes(): ?array
    {
        return $this->extraAttributes;
    }

    /**
     * Sets the extraAttributes
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

    public function addExtraAttribute($name, $value): self
    {
        if (!empty($name) && !empty($value)) {
            $this->extraAttributes[$name] = $value;
        }
        return $this;
    }
}
