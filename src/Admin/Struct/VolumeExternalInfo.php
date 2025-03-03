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
 * VolumeExternalInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VolumeExternalInfo extends BaseExternalVolume
{
    /**
     * Prefix for bucket location e.g. server1_primary
     *
     * @var string
     */
    #[Accessor(getter: "getVolumePrefix", setter: "setVolumePrefix")]
    #[SerializedName("volumePrefix")]
    #[Type("string")]
    #[XmlAttribute]
    private $volumePrefix;

    /**
     * Specifies global bucket configuration Id
     *
     * @var string
     */
    #[
        Accessor(
            getter: "getGlobalBucketConfigurationId",
            setter: "setGlobalBucketConfigurationId"
        )
    ]
    #[SerializedName("globalBucketConfigId")]
    #[Type("string")]
    #[XmlAttribute]
    private $globalBucketConfigId;

    /**
     * Specifies frequent access enabled or not
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "isUseInFrequentAccess",
            setter: "setUseInFrequentAccess"
        )
    ]
    #[SerializedName("useInFrequentAccess")]
    #[Type("bool")]
    #[XmlAttribute]
    private $useInFrequentAccess;

    /**
     * Specifies threshold value of useInFrequentAccess
     *
     * @var int
     */
    #[
        Accessor(
            getter: "getUseInFrequentAccessThreshold",
            setter: "setUseInFrequentAccessThreshold"
        )
    ]
    #[SerializedName("useInFrequentAccessThreshold")]
    #[Type("int")]
    #[XmlAttribute]
    private $useInFrequentAccessThreshold;

    /**
     * Specifies intelligent tiering enabled or not
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "isUseIntelligentTiering",
            setter: "setUseIntelligentTiering"
        )
    ]
    #[SerializedName("useIntelligentTiering")]
    #[Type("bool")]
    #[XmlAttribute]
    private $useIntelligentTiering;

    /**
     * Specifies unified/shared enabled or not
     *
     * @var bool
     */
    #[Accessor(getter: "isUnified", setter: "setUnified")]
    #[SerializedName("unified")]
    #[Type("bool")]
    #[XmlAttribute]
    private $unified;

    /**
     * Constructor
     *
     * @param string $storageType
     * @param string $volumePrefix
     * @param string $globalBucketConfigId
     * @param bool   $useInFrequentAccess
     * @param int    $useInFrequentAccessThreshold
     * @param bool   $useIntelligentTiering
     * @param bool   $unified
     * @return self
     */
    public function __construct(
        ?string $storageType = null,
        ?string $volumePrefix = null,
        ?string $globalBucketConfigId = null,
        ?bool $useInFrequentAccess = null,
        ?int $useInFrequentAccessThreshold = null,
        ?bool $useIntelligentTiering = null,
        ?bool $unified = null
    ) {
        parent::__construct($storageType);
        if (null !== $volumePrefix) {
            $this->setVolumePrefix($volumePrefix);
        }
        if (null !== $globalBucketConfigId) {
            $this->setGlobalBucketConfigurationId($globalBucketConfigId);
        }
        if (null !== $useInFrequentAccess) {
            $this->setUseInFrequentAccess($useInFrequentAccess);
        }
        if (null !== $useInFrequentAccessThreshold) {
            $this->setUseInFrequentAccessThreshold(
                $useInFrequentAccessThreshold
            );
        }
        if (null !== $useIntelligentTiering) {
            $this->setUseIntelligentTiering($useIntelligentTiering);
        }
        if (null !== $unified) {
            $this->setUnified($unified);
        }
    }

    /**
     * Get the volumePrefix
     *
     * @return string
     */
    public function getVolumePrefix(): ?string
    {
        return $this->volumePrefix;
    }

    /**
     * Set the volumePrefix
     *
     * @param  string $volumePrefix
     * @return self
     */
    public function setVolumePrefix(string $volumePrefix): self
    {
        $this->volumePrefix = $volumePrefix;
        return $this;
    }

    /**
     * Get the globalBucketConfigId
     *
     * @return string
     */
    public function getGlobalBucketConfigurationId(): ?string
    {
        return $this->globalBucketConfigId;
    }

    /**
     * Set the globalBucketConfigId
     *
     * @param  string $globalBucketConfigId
     * @return self
     */
    public function setGlobalBucketConfigurationId(
        string $globalBucketConfigId
    ): self {
        $this->globalBucketConfigId = $globalBucketConfigId;
        return $this;
    }

    /**
     * Get the useInFrequentAccess
     *
     * @return bool
     */
    public function isUseInFrequentAccess(): ?bool
    {
        return $this->useInFrequentAccess;
    }

    /**
     * Set the useInFrequentAccess
     *
     * @param  bool $useInFrequentAccess
     * @return self
     */
    public function setUseInFrequentAccess(bool $useInFrequentAccess): self
    {
        $this->useInFrequentAccess = $useInFrequentAccess;
        return $this;
    }

    /**
     * Get the useIntelligentTiering
     *
     * @return bool
     */
    public function isUseIntelligentTiering(): ?bool
    {
        return $this->useIntelligentTiering;
    }

    /**
     * Set the useIntelligentTiering
     *
     * @param  bool $useIntelligentTiering
     * @return self
     */
    public function setUseIntelligentTiering(bool $useIntelligentTiering): self
    {
        $this->useIntelligentTiering = $useIntelligentTiering;
        return $this;
    }

    /**
     * Get the compression threshold
     *
     * @return int
     */
    public function getUseInFrequentAccessThreshold(): ?int
    {
        return $this->useInFrequentAccessThreshold;
    }

    /**
     * Set the compression threshold
     *
     * @param  int $useInFrequentAccessThreshold
     * @return self
     */
    public function setUseInFrequentAccessThreshold(
        int $useInFrequentAccessThreshold
    ): self {
        $this->useInFrequentAccessThreshold = $useInFrequentAccessThreshold;
        return $this;
    }

    /**
     * Get the unified
     *
     * @return bool
     */
    public function isUnified(): ?bool
    {
        return $this->unified;
    }

    /**
     * Set the unified
     *
     * @param  bool $unified
     * @return self
     */
    public function setUnified(bool $unified): self
    {
        $this->unified = $unified;
        return $this;
    }
}
