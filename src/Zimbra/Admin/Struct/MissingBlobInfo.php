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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * MissingBlobInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="item")
 */
class MissingBlobInfo
{
    /**
     * id
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     */
    private $id;

    /**
     * revision
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     */
    private $revision;

    /**
     * Data size
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     */
    private $size;

    /**
     * volume id
     * @Accessor(getter="getVolumeId", setter="setVolumeId")
     * @SerializedName("volumeId")
     * @Type("int")
     * @XmlAttribute
     */
    private $volumeId;

    /**
     * Blob path
     * @Accessor(getter="getBlobPath", setter="setBlobPath")
     * @SerializedName("blobPath")
     * @Type("string")
     * @XmlAttribute
     */
    private $blobPath;

    /**
     * Set if the blob is stored in an ExternalStoreManager rather than locally in FileBlobStore
     * @Accessor(getter="getExternal", setter="setExternal")
     * @SerializedName("external")
     * @Type("bool")
     * @XmlAttribute
     */
    private $external;

    /**
     * version
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("version")
     * @Type("int")
     * @XmlAttribute
     */
    private $version;

    /**
     * Constructor method for MissingBlobInfo
     * @param int $id
     * @param int $revision
     * @param int $size
     * @param int $volumeId
     * @param string $blobPath
     * @param bool $external
     * @param int $version
     * @return self
     */
    public function __construct(
        $id,
        $revision,
        $size,
        $volumeId,
        $blobPath,
        $external,
        $version
    )
    {
        $this->setId($id)
             ->setRevision($revision)
             ->setSize($size)
             ->setVolumeId($volumeId)
             ->setBlobPath($blobPath)
             ->setExternal($external)
             ->setVersion($version);
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  int $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Gets revision
     *
     * @return int
     */
    public function getRevision(): int
    {
        return $this->revision;
    }

    /**
     * Sets revision
     *
     * @param  int $revision
     * @return self
     */
    public function setRevision($revision): self
    {
        $this->revision = (int) $revision;
        return $this;
    }

    /**
     * Gets data size
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Sets data size
     *
     * @param  int $size
     * @return self
     */
    public function setSize($size): self
    {
        $this->size = (int) $size;
        return $this;
    }

    /**
     * Gets volume Id
     *
     * @return int
     */
    public function getVolumeId(): int
    {
        return $this->volumeId;
    }

    /**
     * Sets volume Id
     *
     * @param  int $volumeId
     * @return self
     */
    public function setVolumeId($volumeId): self
    {
        $this->volumeId = (int) $volumeId;
        return $this;
    }

    /**
     * Gets blob path
     *
     * @return string
     */
    public function getBlobPath(): string
    {
        return $this->blobPath;
    }

    /**
     * Sets blob path
     *
     * @param  string $blobPath
     * @return self
     */
    public function setBlobPath($blobPath): self
    {
        $this->blobPath = $blobPath;
        return $this;
    }

    /**
     * Gets external
     *
     * @return bool
     */
    public function getExternal(): bool
    {
        return $this->external;
    }

    /**
     * Sets external
     *
     * @param  bool $external
     * @return self
     */
    public function setExternal($external): self
    {
        $this->external = (bool) $external;
        return $this;
    }

    /**
     * Gets version
     *
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Sets version
     *
     * @param  int $version
     * @return self
     */
    public function setVersion($version): self
    {
        $this->version = (int) $version;
        return $this;
    }
}
