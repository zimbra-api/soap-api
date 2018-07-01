<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

/**
 * SessionInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="session")
 */
class SessionInfo
{
    /**
     * @Accessor(getter="getSessionProxied", setter="setSessionProxied")
     * @SerializedName("proxy")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $_sessionProxied;

    /**
     * @Accessor(getter="getSessionId", setter="setSessionId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $_sessionId;

    /**
     * @Accessor(getter="getSequenceNum", setter="setSequenceNum")
     * @SerializedName("seq")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_sequenceNum;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * Constructor method for SessionInfo
     * @param bool $sessionProxied
     * @param string $sessionId
     * @param integer $sequenceNum
     * @param string $value
     * @return self
     */
    public function __construct(
        $sessionProxied = null,
        $sessionId = null,
        $sequenceNum = null,
        $value = null
    )
    {
        if(null !== $sessionProxied)
        {
            $this->setSessionProxied($sessionProxied);
        }
        if(null !== $sessionId)
        {
            $this->setSessionId($sessionId);
        }
        if(null !== $sequenceNum)
        {
            $this->setSequenceNum($sequenceNum);
        }
        if(null !== $value)
        {
            $this->setValue($value);
        }
    }

    /**
     * Gets an sessionProxied
     *
     * @param  bool $sessionProxied
     * @return bool
     */
    public function getSessionProxied()
    {
        return $this->_sessionProxied;
    }

    /**
     * Sets sessionProxied
     *
     * @param  bool $sessionProxied
     * @return self
     */
    public function setSessionProxied($sessionProxied)
    {
        $this->_sessionProxied = (bool) $sessionProxied;
        return $this;
    }

    /**
     * Gets session ID
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->_sessionId;
    }

    /**
     * Sets session ID
     *
     * @param  string $id
     * @return string|self
     */
    public function setSessionId($id)
    {
        $this->_sessionId = trim($id);
        return $this;
    }

    /**
     * Gets sequence number for the highest notification received
     *
     * @return string
     */
    public function getSequenceNum()
    {
        return $this->_sequenceNum;
    }

    /**
     * Sets sequence number for the highest notification received
     *
     * @param  int $sequenceNum
     * @return self
     */
    public function setSequenceNum($sequenceNum)
    {
        $this->_sequenceNum = (int) $sequenceNum;
        return $this;
    }

    /**
     * Gets an value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }
}
