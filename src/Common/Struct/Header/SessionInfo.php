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
     * @var bool
     */
    #[Accessor(getter: 'getSessionProxied', setter: 'setSessionProxied')]
    #[SerializedName('proxy')]
    #[Type('bool')]
    #[XmlAttribute]
    private $sessionProxied;

    /**
     * @var string
     */
    #[Accessor(getter: 'getSessionId', setter: 'setSessionId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $sessionId;

    /**
     * @var int
     */
    #[Accessor(getter: 'getSequenceNum', setter: 'setSequenceNum')]
    #[SerializedName('seq')]
    #[Type('int')]
    #[XmlAttribute]
    private $sequenceNum;

    /**
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
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
     * Get sessionProxied
     *
     * @return bool
     */
    public function getSessionProxied(): ?bool
    {
        return $this->sessionProxied;
    }

    /**
     * Set sessionProxied
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
     * Get session ID
     *
     * @return string
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * Set session ID
     *
     * @param  string $id
     * @return self
     */
    public function setSessionId(string $id): self
    {
        $this->sessionId = $id;
        return $this;
    }

    /**
     * Get sequence number for the highest notification received
     *
     * @return int
     */
    public function getSequenceNum(): ?int
    {
        return $this->sequenceNum;
    }

    /**
     * Set sequence number for the highest notification received
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
     * Get an value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
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
