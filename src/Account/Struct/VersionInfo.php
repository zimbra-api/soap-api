<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * VersionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="info")
 */
class VersionInfo
{
    /**
     * Full version string
     * @Accessor(getter="getFullVersion", setter="setFullVersion")
     * @SerializedName("version")
     * @Type("string")
     * @XmlAttribute
     */
    private $fullVersion;

    /**
     * Release string
     * @Accessor(getter="getRelease", setter="setRelease")
     * @SerializedName("release")
     * @Type("string")
     * @XmlAttribute
     */
    private $release;

    /**
     * Build date in format: YYYYMMDD-hhmm
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("buildDate")
     * @Type("string")
     * @XmlAttribute
     */
    private $date;

    /**
     * Build host name
     * @Accessor(getter="getHost", setter="setHost")
     * @SerializedName("host")
     * @Type("string")
     * @XmlAttribute
     */
    private $host;

    /**
     * Constructor method for VersionInfo
     *
     * @param string $fullVersion
     * @param string $release
     * @param string $date
     * @param string $host
     * @return self
     */
    public function __construct(
        string $fullVersion, string $release, string $date, string $host
    )
    {
        $this->setFullVersion($fullVersion)
             ->setRelease($release)
             ->setDate($date)
             ->setHost($host);
    }

    /**
     * Gets fullVersion
     *
     * @return string
     */
    public function getFullVersion(): string
    {
        return $this->fullVersion;
    }

    /**
     * Sets fullVersion
     *
     * @param  string $fullVersion
     * @return self
     */
    public function setFullVersion(string $fullVersion): self
    {
        $this->fullVersion = $fullVersion;
        return $this;
    }

    /**
     * Gets release
     *
     * @return string
     */
    public function getRelease(): string
    {
        return $this->release;
    }

    /**
     * Sets release
     *
     * @param  string $release
     * @return self
     */
    public function setRelease(string $release): self
    {
        $this->release = $release;
        return $this;
    }

    /**
     * Gets date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Sets date
     *
     * @param  string $date
     * @return self
     */
    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Gets host
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Sets host
     *
     * @param  string $host
     * @return self
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }
}