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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Enum\VolumeType;

/**
 * VolumeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VolumeInfo
{
    /**
     * Volume ID
     *
     * @var int
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $id = null;

    /**
     * Name or description of volume
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $name = null;

    /**
     * Absolute path to root of volume, e.g. /opt/zimbra/store
     *
     * @var string
     */
    #[Accessor(getter: "getRootPath", setter: "setRootPath")]
    #[SerializedName("rootpath")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $rootPath = null;

    /**
     * Volume type
     *
     * @var int
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $type = null;

    /**
     * Specifies whether blobs in this volume are compressed
     *
     * @var bool
     */
    #[Accessor(getter: "getCompressBlobs", setter: "setCompressBlobs")]
    #[SerializedName("compressBlobs")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $compressBlobs = null;

    /**
     * Long value that specifies the maximum uncompressed file size, in bytes, of blobs
     * that will not be compressed (in other words blobs larger than this threshold are compressed)
     *
     * @var int
     */
    #[
        Accessor(
            getter: "getCompressionThreshold",
            setter: "setCompressionThreshold"
        )
    ]
    #[SerializedName("compressionThreshold")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $compressionThreshold = null;

    /**
     * The mgbits
     *
     * @var int
     */
    #[Accessor(getter: "getMgbits", setter: "setMgbits")]
    #[SerializedName("mgbits")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $mgbits = null;

    /**
     * The mbits
     *
     * @var int
     */
    #[Accessor(getter: "getMbits", setter: "setMbits")]
    #[SerializedName("mbits")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $mbits = null;

    /**
     * The fgbits
     *
     * @var int
     */
    #[Accessor(getter: "getFgbits", setter: "setFgbits")]
    #[SerializedName("fgbits")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $fgbits = null;

    /**
     * The fbits
     *
     * @var int
     */
    #[Accessor(getter: "getFbits", setter: "setFbits")]
    #[SerializedName("fbits")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $fbits = null;

    /**
     * Set if the volume is current.
     *
     * @var bool
     */
    #[Accessor(getter: "getIsCurrent", setter: "setIsCurrent")]
    #[SerializedName("isCurrent")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isCurrent = null;

    /**
     * Set if the volume is current.
     *
     * @var bool
     */
    #[Accessor(getter: "getCurrent", setter: "setCurrent")]
    #[SerializedName("current")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $current = null;

    /**
     * Set to 1 for internal volumes and 2 for external volumes
     *
     * @var int
     */
    #[Accessor(getter: "getStoreType", setter: "setStoreType")]
    #[SerializedName("storeType")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $storeType = null;

    /**
     * Store Manager Class
     *
     * @var string
     */
    #[Accessor(getter: "getStoreManagerClass", setter: "setStoreManagerClass")]
    #[SerializedName("storeManagerClass")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $storeManagerClass = null;

    /**
     * Volume external information for S3
     *
     * @var VolumeExternalInfo
     */
    #[
        Accessor(
            getter: "getVolumeExternalInfo",
            setter: "setVolumeExternalInfo"
        )
    ]
    #[SerializedName("volumeExternalInfo")]
    #[Type(VolumeExternalInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?VolumeExternalInfo $volumeExternalInfo;

    /**
     * Volume external information for OpenIO
     *
     * @var VolumeExternalOpenIOInfo
     */
    #[
        Accessor(
            getter: "getVolumeExternalOpenIOInfo",
            setter: "setVolumeExternalOpenIOInfo"
        )
    ]
    #[SerializedName("volumeExternalOpenIOInfo")]
    #[Type(VolumeExternalOpenIOInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?VolumeExternalOpenIOInfo $volumeExternalOpenIOInfo;

    /**
     * Request type
     *
     * @var string
     */
    #[Accessor(getter: "getRequestType", setter: "setRequestType")]
    #[SerializedName("requestType")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $requestType = null;

    /**
     * Constructor
     *
     * @param int    $id
     * @param string $name
     * @param string $rootPath
     * @param int    $type
     * @param bool   $compressBlobs
     * @param int    $compressionThreshold
     * @param int    $mgbits
     * @param int    $mbits
     * @param int    $fgbits
     * @param int    $fbits
     * @param bool   $isCurrent
     * @param bool   $current
     * @param int    $storeType
     * @param string $storeManagerClass
     * @param VolumeExternalInfo $volumeExternalInfo
     * @param VolumeExternalOpenIOInfo $volumeExternalOpenIOInfo
     * @param string $requestType
     * @return self
     */
    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?string $rootPath = null,
        ?int $type = null,
        ?bool $compressBlobs = null,
        ?int $compressionThreshold = null,
        ?int $mgbits = null,
        ?int $mbits = null,
        ?int $fgbits = null,
        ?int $fbits = null,
        ?bool $isCurrent = null,
        ?bool $current = null,
        ?int $storeType = null,
        ?string $storeManagerClass = null,
        ?VolumeExternalInfo $volumeExternalInfo = null,
        ?VolumeExternalOpenIOInfo $volumeExternalOpenIOInfo = null,
        ?string $requestType = null
    ) {
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $rootPath) {
            $this->setRootPath($rootPath);
        }
        if (null !== $type) {
            $this->setType($type);
        }
        if (null !== $compressBlobs) {
            $this->setCompressBlobs($compressBlobs);
        }
        if (null !== $compressionThreshold) {
            $this->setCompressionThreshold($compressionThreshold);
        }
        if (null !== $mgbits) {
            $this->setMgbits($mgbits);
        }
        if (null !== $mbits) {
            $this->setMbits($mbits);
        }
        if (null !== $fgbits) {
            $this->setFgbits($fgbits);
        }
        if (null !== $fbits) {
            $this->setFbits($fbits);
        }
        if (null !== $isCurrent) {
            $this->setIsCurrent($isCurrent);
        }
        if (null !== $current) {
            $this->setCurrent($current);
        }
        if (null !== $storeType) {
            $this->setStoreType($storeType);
        }
        if (null !== $storeManagerClass) {
            $this->setStoreManagerClass($storeManagerClass);
        }
        if (null !== $requestType) {
            $this->setRequestType($requestType);
        }
        $this->volumeExternalInfo = $volumeExternalInfo;
        $this->volumeExternalOpenIOInfo = $volumeExternalOpenIOInfo;
    }

    /**
     * Get the Id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the Id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the type
     *
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * Set the type
     *
     * @param  int $type
     * @return self
     */
    public function setType(int $type): self
    {
        $this->type = VolumeType::tryFrom($type) ? $type : 1;
        return $this;
    }

    /**
     * Get the compression threshold
     *
     * @return int
     */
    public function getCompressionThreshold(): ?int
    {
        return $this->compressionThreshold;
    }

    /**
     * Set the compression threshold
     *
     * @param  int $compressionThreshold
     * @return self
     */
    public function setCompressionThreshold(int $compressionThreshold): self
    {
        $this->compressionThreshold = $compressionThreshold;
        return $this;
    }

    /**
     * Get the mgbits
     *
     * @return int
     */
    public function getMgbits(): ?int
    {
        return $this->mgbits;
    }

    /**
     * Set the mgbits
     *
     * @param  int $mgbits
     * @return self
     */
    public function setMgbits(int $mgbits): self
    {
        $this->mgbits = $mgbits;
        return $this;
    }

    /**
     * Get the mbits
     *
     * @return int
     */
    public function getMbits(): ?int
    {
        return $this->mbits;
    }

    /**
     * Set the mbits
     *
     * @param  int $mbits
     * @return self
     */
    public function setMbits(int $mbits): self
    {
        $this->mbits = $mbits;
        return $this;
    }

    /**
     * Get the fgbits
     *
     * @return int
     */
    public function getFgbits(): ?int
    {
        return $this->fgbits;
    }

    /**
     * Set the fgbits
     *
     * @param  int $fgbits
     * @return self
     */
    public function setFgbits(int $fgbits): self
    {
        $this->fgbits = $fgbits;
        return $this;
    }

    /**
     * Get the fbits
     *
     * @return int
     */
    public function getFbits(): ?int
    {
        return $this->fbits;
    }

    /**
     * Set the fbits
     *
     * @param  int $fbits
     * @return self
     */
    public function setFbits(int $fbits): self
    {
        $this->fbits = $fbits;
        return $this;
    }

    /**
     * Set the name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set the root path
     *
     * @return string
     */
    public function getRootPath(): ?string
    {
        return $this->rootPath;
    }

    /**
     * Set the root path
     *
     * @param  string $rootPath
     * @return self
     */
    public function setRootPath(string $rootPath): self
    {
        $this->rootPath = $rootPath;
        return $this;
    }

    /**
     * Get the compress blobs
     *
     * @return bool
     */
    public function getCompressBlobs(): ?bool
    {
        return $this->compressBlobs;
    }

    /**
     * Set the compress blobs
     *
     * @param  bool $compressBlobs
     * @return self
     */
    public function setCompressBlobs(bool $compressBlobs): self
    {
        $this->compressBlobs = $compressBlobs;
        return $this;
    }

    /**
     * Get is current
     *
     * @return bool
     */
    public function getCurrent(): ?bool
    {
        return $this->current;
    }

    /**
     * Set the current
     *
     * @param  bool $current
     * @return self
     */
    public function setCurrent(bool $current): self
    {
        $this->current = $current;
        return $this;
    }

    /**
     * Get is current
     *
     * @return bool
     */
    public function getIsCurrent(): ?bool
    {
        return $this->isCurrent;
    }

    /**
     * Set the isCurrent
     *
     * @param  bool $isCurrent
     * @return self
     */
    public function setIsCurrent(bool $isCurrent): self
    {
        $this->isCurrent = $isCurrent;
        return $this;
    }

    /**
     * Get the storeType
     *
     * @return int
     */
    public function getStoreType(): ?int
    {
        return $this->storeType;
    }

    /**
     * Set the storeType
     *
     * @param  int $storeType
     * @return self
     */
    public function setStoreType(int $storeType): self
    {
        $this->storeType = $storeType;
        return $this;
    }

    /**
     * Get the storeManagerClass
     *
     * @return string
     */
    public function getStoreManagerClass(): ?string
    {
        return $this->storeManagerClass;
    }

    /**
     * Set the storeManagerClass
     *
     * @param  string $storeManagerClass
     * @return self
     */
    public function setStoreManagerClass(string $storeManagerClass): self
    {
        $this->storeManagerClass = $storeManagerClass;
        return $this;
    }

    /**
     * Get the requestType
     *
     * @return string
     */
    public function getRequestType(): ?string
    {
        return $this->requestType;
    }

    /**
     * Set the requestType
     *
     * @param  string $requestType
     * @return self
     */
    public function setRequestType(string $requestType): self
    {
        $this->requestType = $requestType;
        return $this;
    }

    /**
     * Get volumeExternalInfo
     *
     * @return VolumeExternalInfo
     */
    public function getVolumeExternalInfo(): ?VolumeExternalInfo
    {
        return $this->volumeExternalInfo;
    }

    /**
     * Set volumeExternalInfo
     *
     * @param  VolumeExternalInfo $volumeExternalInfo
     * @return self
     */
    public function setVolumeExternalInfo(
        VolumeExternalInfo $volumeExternalInfo
    ): self {
        $this->volumeExternalInfo = $volumeExternalInfo;
        return $this;
    }

    /**
     * Get volumeExternalOpenIOInfo
     *
     * @return VolumeExternalOpenIOInfo
     */
    public function getVolumeExternalOpenIOInfo(): ?VolumeExternalOpenIOInfo
    {
        return $this->volumeExternalOpenIOInfo;
    }

    /**
     * Set volumeExternalOpenIOInfo
     *
     * @param  VolumeExternalOpenIOInfo $volumeExternalOpenIOInfo
     * @return self
     */
    public function setVolumeExternalOpenIOInfo(
        VolumeExternalOpenIOInfo $volumeExternalOpenIOInfo
    ): self {
        $this->volumeExternalOpenIOInfo = $volumeExternalOpenIOInfo;
        return $this;
    }
}
