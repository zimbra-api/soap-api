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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * VersionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
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
        string $fullVersion = '', string $release = '', string $date = '', string $host = ''
    )
    {
        $this->setFullVersion($fullVersion)
             ->setRelease($release)
             ->setDate($date)
             ->setHost($host);
    }

    /**
     * Get fullVersion
     *
     * @return string
     */
    public function getFullVersion(): string
    {
        return $this->fullVersion;
    }

    /**
     * Set fullVersion
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
     * Get release
     *
     * @return string
     */
    public function getRelease(): string
    {
        return $this->release;
    }

    /**
     * Set release
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
     * Get date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set date
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
     * Get host
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Set host
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
