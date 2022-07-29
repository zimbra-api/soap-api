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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * UsedBlobInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class UsedBlobInfo
{
    /**
     * Item ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     */
    private $id;

    /**
     * Revision
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     */
    private $revision;

    /**
     * Size
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     */
    private $size;

    /**
     * Volume ID
     * @Accessor(getter="getVolumeId", setter="setVolumeId")
     * @SerializedName("volumeId")
     * @Type("int")
     * @XmlAttribute
     */
    private $volumeId;

    /**
     * Blob size information
     * @Accessor(getter="getBlob", setter="setBlob")
     * @SerializedName("blob")
     * @Type("Zimbra\Admin\Struct\BlobSizeInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private BlobSizeInfo $blob;

    /**
     * Constructor method for UsedBlobInfo
     * @param int $id
     * @param int $revision
     * @param int $size
     * @param int $volumeId
     * @param BlobSizeInfo $blob
     * @return self
     */
    public function __construct(
        int $id = 0,
        int $revision = 0,
        int $size = 0,
        int $volumeId = 0,
        ?BlobSizeInfo $blob = NULL
    )
    {
        $this->setId($id)
             ->setRevision($revision)
             ->setSize($size)
             ->setVolumeId($volumeId);
        if ($blob instanceof BlobSizeInfo) {
            $this->setBlob($blob);
        }
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
     * @return BlobSizeInfo
     */
    public function getBlob(): ?BlobSizeInfo
    {
        return $this->blob;
    }

    /**
     * Set blob
     *
     * @param  BlobSizeInfo $blob
     * @return self
     */
    public function setBlob(BlobSizeInfo $blob): self
    {
        $this->blob = $blob;
        return $this;
    }
}
