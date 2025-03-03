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
 * MissingBlobInfo class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MissingBlobInfo
{
    /**
     * id
     *
     * @var int
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("int")]
    #[XmlAttribute]
    private int $id;

    /**
     * revision
     *
     * @var int
     */
    #[Accessor(getter: "getRevision", setter: "setRevision")]
    #[SerializedName("rev")]
    #[Type("int")]
    #[XmlAttribute]
    private int $revision;

    /**
     * Data size
     *
     * @var int
     */
    #[Accessor(getter: "getSize", setter: "setSize")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private int $size;

    /**
     * volume id
     *
     * @var int
     */
    #[Accessor(getter: "getVolumeId", setter: "setVolumeId")]
    #[SerializedName("volumeId")]
    #[Type("int")]
    #[XmlAttribute]
    private int $volumeId;

    /**
     * Blob path
     *
     * @var string
     */
    #[Accessor(getter: "getBlobPath", setter: "setBlobPath")]
    #[SerializedName("blobPath")]
    #[Type("string")]
    #[XmlAttribute]
    private string $blobPath;

    /**
     * Set if the blob is stored in an ExternalStoreManager rather than locally in FileBlobStore
     *
     * @var bool
     */
    #[Accessor(getter: "getExternal", setter: "setExternal")]
    #[SerializedName("external")]
    #[Type("bool")]
    #[XmlAttribute]
    private bool $external;

    /**
     * version
     *
     * @var int
     */
    #[Accessor(getter: "getVersion", setter: "setVersion")]
    #[SerializedName("version")]
    #[Type("int")]
    #[XmlAttribute]
    private int $version;

    /**
     * Constructor
     *
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
        int $id = 0,
        int $revision = 0,
        int $size = 0,
        int $volumeId = 0,
        string $blobPath = "",
        bool $external = false,
        int $version = 0
    ) {
        $this->setId($id)
            ->setRevision($revision)
            ->setSize($size)
            ->setVolumeId($volumeId)
            ->setBlobPath($blobPath)
            ->setExternal($external)
            ->setVersion($version);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get revision
     *
     * @return int
     */
    public function getRevision(): int
    {
        return $this->revision;
    }

    /**
     * Set revision
     *
     * @param  int $revision
     * @return self
     */
    public function setRevision(int $revision): self
    {
        $this->revision = $revision;
        return $this;
    }

    /**
     * Get data size
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Set data size
     *
     * @param  int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Get volume Id
     *
     * @return int
     */
    public function getVolumeId(): int
    {
        return $this->volumeId;
    }

    /**
     * Set volume Id
     *
     * @param  int $volumeId
     * @return self
     */
    public function setVolumeId(int $volumeId): self
    {
        $this->volumeId = $volumeId;
        return $this;
    }

    /**
     * Get blob path
     *
     * @return string
     */
    public function getBlobPath(): string
    {
        return $this->blobPath;
    }

    /**
     * Set blob path
     *
     * @param  string $blobPath
     * @return self
     */
    public function setBlobPath(string $blobPath): self
    {
        $this->blobPath = $blobPath;
        return $this;
    }

    /**
     * Get external
     *
     * @return bool
     */
    public function getExternal(): bool
    {
        return $this->external;
    }

    /**
     * Set external
     *
     * @param  bool $external
     * @return self
     */
    public function setExternal(bool $external): self
    {
        $this->external = $external;
        return $this;
    }

    /**
     * Get version
     *
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Set version
     *
     * @param  int $version
     * @return self
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;
        return $this;
    }
}
