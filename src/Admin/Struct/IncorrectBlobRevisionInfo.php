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

/**
 * IncorrectBlobRevisionInfo class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IncorrectBlobRevisionInfo
{
    /**
     * Item ID
     *
     * @var int
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("int")]
    #[XmlAttribute]
    private int $id;

    /**
     * Revision
     *
     * @var int
     */
    #[Accessor(getter: "getRevision", setter: "setRevision")]
    #[SerializedName("rev")]
    #[Type("int")]
    #[XmlAttribute]
    private int $revision;

    /**
     * Size
     *
     * @var int
     */
    #[Accessor(getter: "getSize", setter: "setSize")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private int $size;

    /**
     * Volume ID
     *
     * @var int
     */
    #[Accessor(getter: "getVolumeId", setter: "setVolumeId")]
    #[SerializedName("volumeId")]
    #[Type("int")]
    #[XmlAttribute]
    private int $volumeId;

    /**
     * Blob size information
     *
     * @var BlobRevisionInfo
     */
    #[Accessor(getter: "getBlob", setter: "setBlob")]
    #[SerializedName("blob")]
    #[Type(BlobRevisionInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?BlobRevisionInfo $blob;

    /**
     * Constructor
     *
     * @param int $id
     * @param int $revision
     * @param int $size
     * @param int $volumeId
     * @param BlobRevisionInfo $blob
     * @return self
     */
    public function __construct(
        int $id = 0,
        int $revision = 0,
        int $size = 0,
        int $volumeId = 0,
        ?BlobRevisionInfo $blob = null
    ) {
        $this->setId($id)
            ->setRevision($revision)
            ->setSize($size)
            ->setVolumeId($volumeId);
        $this->blob = $blob;
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
     * Get blob
     *
     * @return BlobRevisionInfo
     */
    public function getBlob(): ?BlobRevisionInfo
    {
        return $this->blob;
    }

    /**
     * Set blob
     *
     * @param  BlobRevisionInfo $blob
     * @return self
     */
    public function setBlob(BlobRevisionInfo $blob): self
    {
        $this->blob = $blob;
        return $this;
    }
}
