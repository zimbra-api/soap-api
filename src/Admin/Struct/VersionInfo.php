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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * VersionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="info")
 */
class VersionInfo
{
    /**
     * Type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $type;

    /**
     * Version string
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("version")
     * @Type("string")
     * @XmlAttribute
     */
    private $version;

    /**
     * Release string
     * @Accessor(getter="getRelease", setter="setRelease")
     * @SerializedName("release")
     * @Type("string")
     * @XmlAttribute
     */
    private $release;

    /**
     * Build Date - format : YYYYMMDD-hhmm
     * @Accessor(getter="getBuildDate", setter="setBuildDate")
     * @SerializedName("buildDate")
     * @Type("string")
     * @XmlAttribute
     */
    private $buildDate;

    /**
     * Host name
     * @Accessor(getter="getHost", setter="setHost")
     * @SerializedName("host")
     * @Type("string")
     * @XmlAttribute
     */
    private $host;

    /**
     * Major version
     * @Accessor(getter="getMajorVersion", setter="setMajorVersion")
     * @SerializedName("majorversion")
     * @Type("string")
     * @XmlAttribute
     */
    private $majorVersion;

    /**
     * Minor version
     * @Accessor(getter="getMinorVersion", setter="setMinorVersion")
     * @SerializedName("minorversion")
     * @Type("string")
     * @XmlAttribute
     */
    private $minorVersion;

    /**
     * Micro version
     * @Accessor(getter="getMicroVersion", setter="setMicroVersion")
     * @SerializedName("microversion")
     * @Type("string")
     * @XmlAttribute
     */
    private $microVersion;

    /**
     * Platform
     * @Accessor(getter="getPlatform", setter="setPlatform")
     * @SerializedName("platform")
     * @Type("string")
     * @XmlAttribute
     */
    private $platform;

    /**
     * Constructor method for VersionInfo
     *
     * @param string $type
     * @param string $version
     * @param string $release
     * @param string $buildDate
     * @param string $host
     * @param string $majorVersion
     * @param string $minorVersion
     * @param string $microVersion
     * @param string $platform
     * @return self
     */
    public function __construct(
        ?string $type = NULL,
        ?string $version = NULL,
        ?string $release = NULL,
        ?string $buildDate = NULL,
        ?string $host = NULL,
        ?string $majorVersion = NULL,
        ?string $minorVersion = NULL,
        ?string $microVersion = NULL,
        ?string $platform = NULL
    )
    {
        if (NULL !== $type) {
            $this->setType($type);
        }
        if (NULL !== $version) {
            $this->setVersion($version);
        }
        if (NULL !== $release) {
            $this->setRelease($release);
        }
        if (NULL !== $buildDate) {
            $this->setBuildDate($buildDate);
        }
        if (NULL !== $host) {
            $this->setHost($host);
        }
        if (NULL !== $majorVersion) {
            $this->setMajorVersion($majorVersion);
        }
        if (NULL !== $minorVersion) {
            $this->setMinorVersion($minorVersion);
        }
        if (NULL !== $microVersion) {
            $this->setMicroVersion($microVersion);
        }
        if (NULL !== $platform) {
            $this->setPlatform($platform);
        }

    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets the version
     *
     * @return string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * Sets the version
     *
     * @param  string $version
     * @return self
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Gets the release
     *
     * @return string
     */
    public function getRelease(): ?string
    {
        return $this->release;
    }

    /**
     * Sets the release
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
     * Gets the buildDate
     *
     * @return string
     */
    public function getBuildDate(): ?string
    {
        return $this->buildDate;
    }

    /**
     * Sets the buildDate
     *
     * @param  string $buildDate
     * @return self
     */
    public function setBuildDate(string $buildDate): self
    {
        $this->buildDate = $buildDate;
        return $this;
    }

    /**
     * Gets the host
     *
     * @return string
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * Sets the host
     *
     * @param  string $host
     * @return self
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Gets the majorVersion
     *
     * @return string
     */
    public function getMajorVersion(): ?string
    {
        return $this->majorVersion;
    }

    /**
     * Sets the majorVersion
     *
     * @param  string $majorVersion
     * @return self
     */
    public function setMajorVersion(string $majorVersion): self
    {
        $this->majorVersion = $majorVersion;
        return $this;
    }

    /**
     * Gets the minorVersion
     *
     * @return string
     */
    public function getMinorVersion(): ?string
    {
        return $this->minorVersion;
    }

    /**
     * Sets the minorVersion
     *
     * @param  string $minorVersion
     * @return self
     */
    public function setMinorVersion(string $minorVersion): self
    {
        $this->minorVersion = $minorVersion;
        return $this;
    }

    /**
     * Gets the microVersion
     *
     * @return string
     */
    public function getMicroVersion(): ?string
    {
        return $this->microVersion;
    }

    /**
     * Sets the microVersion
     *
     * @param  string $microVersion
     * @return self
     */
    public function setMicroVersion(string $microVersion): self
    {
        $this->microVersion = $microVersion;
        return $this;
    }

    /**
     * Gets the platform
     *
     * @return string
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * Sets the platform
     *
     * @param  string $platform
     * @return self
     */
    public function setPlatform(string $platform): self
    {
        $this->platform = $platform;
        return $this;
    }
}