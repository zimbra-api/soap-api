<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct\Header;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * SessionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SessionInfo
{
    /**
     * @Accessor(getter="getSessionProxied", setter="setSessionProxied")
     * @SerializedName("proxy")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $sessionProxied;

    /**
     * @Accessor(getter="getSessionId", setter="setSessionId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $sessionId;

    /**
     * @Accessor(getter="getSequenceNum", setter="setSequenceNum")
     * @SerializedName("seq")
     * @Type("integer")
     * @XmlAttribute
     */
    private $sequenceNum;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor
     * 
     * @param bool $sessionProxied
     * @param string $sessionId
     * @param int $sequenceNum
     * @param string $value
     * @return self
     */
    public function __construct(
        ?bool $sessionProxied = NULL,
        ?string $sessionId = NULL,
        ?int $sequenceNum = NULL,
        ?string $value = NULL
    )
    {
        if (NULL !== $sessionProxied) {
            $this->setSessionProxied($sessionProxied);
        }
        if (NULL !== $sessionId) {
            $this->setSessionId($sessionId);
        }
        if (NULL !== $sequenceNum) {
            $this->setSequenceNum($sequenceNum);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets an sessionProxied
     *
     * @param  bool $sessionProxied
     * @return bool
     */
    public function getSessionProxied(): ?bool
    {
        return $this->sessionProxied;
    }

    /**
     * Sets sessionProxied
     *
     * @param  bool $sessionProxied
     * @return self
     */
    public function setSessionProxied(bool $sessionProxied): self
    {
        $this->sessionProxied = $sessionProxied;
        return $this;
    }

    /**
     * Gets session ID
     *
     * @return string
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * Sets session ID
     *
     * @param  string $id
     * @return string|self
     */
    public function setSessionId(string $id): self
    {
        $this->sessionId = $id;
        return $this;
    }

    /**
     * Gets sequence number for the highest notification received
     *
     * @return int
     */
    public function getSequenceNum(): ?int
    {
        return $this->sequenceNum;
    }

    /**
     * Sets sequence number for the highest notification received
     *
     * @param  int $sequenceNum
     * @return self
     */
    public function setSequenceNum(int $sequenceNum): self
    {
        $this->sequenceNum = $sequenceNum;
        return $this;
    }

    /**
     * Gets an value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
