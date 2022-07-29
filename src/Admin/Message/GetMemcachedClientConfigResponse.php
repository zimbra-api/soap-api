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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetMemcachedClientConfigResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetMemcachedClientConfigResponse implements SoapResponseInterface
{
    /**
     * Comma separated list of host:port for memcached servers
     * @Accessor(getter="getServerList", setter="setServerList")
     * @SerializedName("serverList")
     * @Type("string")
     * @XmlAttribute
     */
    private $serverList;

    /**
     * KETAMA_HASH, etc.
     * @Accessor(getter="getHashAlgorithm", setter="setHashAlgorithm")
     * @SerializedName("hashAlgorithm")
     * @Type("string")
     * @XmlAttribute
     */
    private $hashAlgorithm;

    /**
     * Flags whether memcached binary protocol is in use or not
     * @Accessor(getter="getBinaryProtocolEnabled", setter="setBinaryProtocolEnabled")
     * @SerializedName("binaryProtocol")
     * @Type("bool")
     * @XmlAttribute
     */
    private $binaryProtocolEnabled;

    /**
     * Default entry expiry in seconds
     * @Accessor(getter="getDefaultExpirySeconds", setter="setDefaultExpirySeconds")
     * @SerializedName("defaultExpirySeconds")
     * @Type("integer")
     * @XmlAttribute
     */
    private $defaultExpirySeconds;

    /**
     * Default timeout in milliseconds
     * @Accessor(getter="getDefaultTimeoutMillis", setter="setDefaultTimeoutMillis")
     * @SerializedName("defaultTimeoutMillis")
     * @Type("integer")
     * @XmlAttribute
     */
    private $defaultTimeoutMillis;

    /**
     * Constructor method for GetMemcachedClientConfigResponse
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
