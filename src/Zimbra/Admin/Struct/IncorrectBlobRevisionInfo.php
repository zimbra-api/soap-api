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
 * IncorrectBlobRevisionInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="item")
 */
class IncorrectBlobRevisionInfo
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
     * @Type("Zimbra\Admin\Struct\BlobRevisionInfo")
     * @XmlElement
     */
    private $blob;

    /**
     * Constructor method for IncorrectBlobRevisionInfo
     * @param int $id
     * @param int $revision
     * @param int $size
     * @param int $volumeId
     * @param BlobRevisionInfo $blob
     * @return self
     */
    public function __construct(
        $id,
        $revision,
        $size,
        $volumeId,
        BlobRevisionInfo $blob
    )
    {
        $this->setId($id)
             ->setRevision($revision)
             ->setSize($size)
             ->setVolumeId($volumeId)
             ->setBlob($blob);
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
     * Gets blob
     *
     * @return BlobRevisionInfo
     */
    public function getBlob(): BlobRevisionInfo
    {
        return $this->blob;
    }

    /**
     * Sets blob
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
