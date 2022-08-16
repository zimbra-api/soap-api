<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetMemcachedClientConfigResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMemcachedClientConfigResponse extends SoapResponse
{
    /**
     * Comma separated list of host:port for memcached servers
     * 
     * @var string
     */
    #[Accessor(getter: 'getServerList', setter: 'setServerList')]
    #[SerializedName(name: 'serverList')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $serverList;

    /**
     * KETAMA_HASH, etc.
     * 
     * @var string
     */
    #[Accessor(getter: 'getHashAlgorithm', setter: 'setHashAlgorithm')]
    #[SerializedName(name: 'hashAlgorithm')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $hashAlgorithm;

    /**
     * Flags whether memcached binary protocol is in use or not
     * 
     * @var bool
     */
    #[Accessor(getter: 'getBinaryProtocolEnabled', setter: 'setBinaryProtocolEnabled')]
    #[SerializedName(name: 'binaryProtocol')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $binaryProtocolEnabled;

    /**
     * Default entry expiry in seconds
     * 
     * @var int
     */
    #[Accessor(getter: 'getDefaultExpirySeconds', setter: 'setDefaultExpirySeconds')]
    #[SerializedName(name: 'defaultExpirySeconds')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $defaultExpirySeconds;

    /**
     * Default timeout in milliseconds
     * 
     * @var int
     */
    #[Accessor(getter: 'getDefaultTimeoutMillis', setter: 'setDefaultTimeoutMillis')]
    #[SerializedName(name: 'defaultTimeoutMillis')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $defaultTimeoutMillis;

    /**
     * Constructor
     * 
     * @param string $serverList
     * @param string $hashAlgorithm
     * @param bool $binaryProtocolEnabled
     * @param int $defaultExpirySeconds
     * @param int $defaultTimeoutMillis
     * @return self
     */
    public function __construct(
        ?string $serverList = NULL,
        ?string $hashAlgorithm = NULL,
        ?bool $binaryProtocolEnabled = NULL,
        ?int $defaultExpirySeconds = NULL,
        ?int $defaultTimeoutMillis = NULL
    )
    {
        if (NULL !== $serverList) {
            $this->setServerList($serverList);
        }
        if (NULL !== $hashAlgorithm) {
            $this->setHashAlgorithm($hashAlgorithm);
        }
        if (NULL !== $binaryProtocolEnabled) {
            $this->setBinaryProtocolEnabled($binaryProtocolEnabled);
        }
        if (NULL !== $defaultExpirySeconds) {
            $this->setDefaultExpirySeconds($defaultExpirySeconds);
        }
        if (NULL !== $defaultTimeoutMillis) {
            $this->setDefaultTimeoutMillis($defaultTimeoutMillis);
        }
    }

    /**
     * Get serverList
     *
     * @return string
     */
    public function getServerList(): ?string
    {
        return $this->serverList;
    }

    /**
     * Set serverList
     *
     * @param  string $serverList
     * @return self
     */
    public function setServerList(string $serverList): self
    {
        $this->serverList = $serverList;
        return $this;
    }

    /**
     * Get hashAlgorithm
     *
     * @return string
     */
    public function getHashAlgorithm(): ?string
    {
        return $this->hashAlgorithm;
    }

    /**
     * Set hashAlgorithm
     *
     * @param  string $hashAlgorithm
     * @return self
     */
    public function setHashAlgorithm(string $hashAlgorithm): self
    {
        $this->hashAlgorithm = $hashAlgorithm;
        return $this;
    }

    /**
     * Get binaryProtocolEnabled
     *
     * @return bool
     */
    public function getBinaryProtocolEnabled(): bool
    {
        return $this->binaryProtocolEnabled;
    }

    /**
     * Set binaryProtocolEnabled
     *
     * @param  bool $binaryProtocolEnabled
     * @return self
     */
    public function setBinaryProtocolEnabled(bool $binaryProtocolEnabled): self
    {
        $this->binaryProtocolEnabled = $binaryProtocolEnabled;
        return $this;
    }

    /**
     * Get defaultExpirySeconds
     *
     * @return int
     */
    public function getDefaultExpirySeconds(): int
    {
        return $this->defaultExpirySeconds;
    }

    /**
     * Set defaultExpirySeconds
     *
     * @param  int $defaultExpirySeconds
     * @return self
     */
    public function setDefaultExpirySeconds(int $defaultExpirySeconds): self
    {
        $this->defaultExpirySeconds = $defaultExpirySeconds;
        return $this;
    }

    /**
     * Get defaultTimeoutMillis
     *
     * @return int
     */
    public function getDefaultTimeoutMillis(): int
    {
        return $this->defaultTimeoutMillis;
    }

    /**
     * Set defaultTimeoutMillis
     *
     * @param  int $defaultTimeoutMillis
     * @return self
     */
    public function setDefaultTimeoutMillis(int $defaultTimeoutMillis): self
    {
        $this->defaultTimeoutMillis = $defaultTimeoutMillis;
        return $this;
    }
}
