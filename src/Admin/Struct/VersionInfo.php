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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * VersionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VersionInfo
{
    /**
     * Type
     *
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[Type("string")]
    #[XmlAttribute]
    private $type;

    /**
     * Version string
     *
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("version")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getVersion", setter: "setVersion")]
    #[SerializedName("version")]
    #[Type("string")]
    #[XmlAttribute]
    private $version;

    /**
     * Release string
     *
     * @Accessor(getter="getRelease", setter="setRelease")
     * @SerializedName("release")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getRelease", setter: "setRelease")]
    #[SerializedName("release")]
    #[Type("string")]
    #[XmlAttribute]
    private $release;

    /**
     * Build Date - format : YYYYMMDD-hhmm
     *
     * @Accessor(getter="getBuildDate", setter="setBuildDate")
     * @SerializedName("buildDate")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getBuildDate", setter: "setBuildDate")]
    #[SerializedName("buildDate")]
    #[Type("string")]
    #[XmlAttribute]
    private $buildDate;

    /**
     * Host name
     *
     * @Accessor(getter="getHost", setter="setHost")
     * @SerializedName("host")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getHost", setter: "setHost")]
    #[SerializedName("host")]
    #[Type("string")]
    #[XmlAttribute]
    private $host;

    /**
     * Major version
     *
     * @Accessor(getter="getMajorVersion", setter="setMajorVersion")
     * @SerializedName("majorversion")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getMajorVersion", setter: "setMajorVersion")]
    #[SerializedName("majorversion")]
    #[Type("string")]
    #[XmlAttribute]
    private $majorVersion;

    /**
     * Minor version
     *
     * @Accessor(getter="getMinorVersion", setter="setMinorVersion")
     * @SerializedName("minorversion")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getMinorVersion", setter: "setMinorVersion")]
    #[SerializedName("minorversion")]
    #[Type("string")]
    #[XmlAttribute]
    private $minorVersion;

    /**
     * Micro version
     *
     * @Accessor(getter="getMicroVersion", setter="setMicroVersion")
     * @SerializedName("microversion")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getMicroVersion", setter: "setMicroVersion")]
    #[SerializedName("microversion")]
    #[Type("string")]
    #[XmlAttribute]
    private $microVersion;

    /**
     * Platform
     *
     * @Accessor(getter="getPlatform", setter="setPlatform")
     * @SerializedName("platform")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getPlatform", setter: "setPlatform")]
    #[SerializedName("platform")]
    #[Type("string")]
    #[XmlAttribute]
    private $platform;

    /**
     * Constructor
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
        ?string $type = null,
        ?string $version = null,
        ?string $release = null,
        ?string $buildDate = null,
        ?string $host = null,
        ?string $majorVersion = null,
        ?string $minorVersion = null,
        ?string $microVersion = null,
        ?string $platform = null
    ) {
        if (null !== $type) {
            $this->setType($type);
        }
        if (null !== $version) {
            $this->setVersion($version);
        }
        if (null !== $release) {
            $this->setRelease($release);
        }
        if (null !== $buildDate) {
            $this->setBuildDate($buildDate);
        }
        if (null !== $host) {
            $this->setHost($host);
        }
        if (null !== $majorVersion) {
            $this->setMajorVersion($majorVersion);
        }
        if (null !== $minorVersion) {
            $this->setMinorVersion($minorVersion);
        }
        if (null !== $microVersion) {
            $this->setMicroVersion($microVersion);
        }
        if (null !== $platform) {
            $this->setPlatform($platform);
        }
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set type
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
     * Get the version
     *
     * @return string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * Set the version
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
     * Get the release
     *
     * @return string
     */
    public function getRelease(): ?string
    {
        return $this->release;
    }

    /**
     * Set the release
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
     * Get the buildDate
     *
     * @return string
     */
    public function getBuildDate(): ?string
    {
        return $this->buildDate;
    }

    /**
     * Set the buildDate
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
     * Get the host
     *
     * @return string
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * Set the host
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
     * Get the majorVersion
     *
     * @return string
     */
    public function getMajorVersion(): ?string
    {
        return $this->majorVersion;
    }

    /**
     * Set the majorVersion
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
     * Get the minorVersion
     *
     * @return string
     */
    public function getMinorVersion(): ?string
    {
        return $this->minorVersion;
    }

    /**
     * Set the minorVersion
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
     * Get the microVersion
     *
     * @return string
     */
    public function getMicroVersion(): ?string
    {
        return $this->microVersion;
    }

    /**
     * Set the microVersion
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
     * Get the platform
     *
     * @return string
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * Set the platform
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
