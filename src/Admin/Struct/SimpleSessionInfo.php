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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * SimpleSessionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SimpleSessionInfo
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
     * Constructor method for SimpleSessionInfo
     *
     * @param string $zimbraId
     * @param string $name
     * @param string $sessionId
     * @param int $createdDate
     * @param int $lastAccessedDate
     * @return self
     */
    public function __construct(
        string $zimbraId,
        string $name,
        string $sessionId,
        int $createdDate,
        int $lastAccessedDate
    )
    {
        $this->setZimbraId($zimbraId)
             ->setName($name)
             ->setSessionId($sessionId)
             ->setCreatedDate($createdDate)
             ->setLastAccessedDate($lastAccessedDate);

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
    public function getZimbraId(): string
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
    public function getName(): string
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
}
