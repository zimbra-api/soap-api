<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Admin\Struct\VolumeIdAndProgress;
use Zimbra\Enum\DedupStatus;
use Zimbra\Soap\ResponseInterface;

/**
 * DedupeBlobsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @XmlRoot(name="DedupeBlobsResponse")
 */
class DedupeBlobsResponse implements ResponseInterface
{
    /**
     * Status - one of started|running|idle|stopped
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Enum\DedupStatus")
     * @XmlAttribute
     */
    private $status;

    /**
     * @Accessor(getter="getTotalSize", setter="setTotalSize")
     * @SerializedName("totalSize")
     * @Type("integer")
     * @XmlAttribute
     */
    private $totalSize;

    /**
     * @Accessor(getter="getTotalCount", setter="setTotalCount")
     * @SerializedName("totalCount")
     * @Type("integer")
     * @XmlAttribute
     */
    private $totalCount;

    /**
     * volumeBlobsProgress
     * @Accessor(getter="getVolumeBlobsProgress", setter="setVolumeBlobsProgress")
     * @SerializedName("volumeBlobsProgress")
     * @Type("array<Zimbra\Admin\Struct\VolumeIdAndProgress>")
     * @XmlList(inline = true, entry = "volumeBlobsProgress")
     */
    private $volumeBlobsProgress;

    /**
     * blobDigestsProgress
     * @Accessor(getter="getBlobDigestsProgress", setter="setBlobDigestsProgress")
     * @SerializedName("blobDigestsProgress")
     * @Type("array<Zimbra\Admin\Struct\VolumeIdAndProgress>")
     * @XmlList(inline = true, entry = "blobDigestsProgress")
     */
    private $blobDigestsProgress;

    /**
     * Constructor method for DedupeBlobsResponse
     *
     * @param  DedupStatus $action
     * @param  int $totalSize
     * @param  int $totalCount
     * @param  array $volumeBlobsProgress
     * @param  array $blobDigestsProgress
     * @return self
     */
    public function __construct(
        ?DedupStatus $status = NULL,
        ?int $totalSize = NULL,
        ?int $totalCount = NULL,
        array $volumeBlobsProgress = [],
        array $blobDigestsProgress = []
    )
    {
        if ($status instanceof DedupStatus) {
            $this->setStatus($status);
        }
        if (NULL !== $totalSize) {
            $this->setTotalSize($totalSize);
        }
        if (NULL !== $totalCount) {
            $this->setTotalCount($totalCount);
        }
        $this->setVolumeBlobsProgress($volumeBlobsProgress)
             ->setBlobDigestsProgress($blobDigestsProgress);
    }

    /**
     * Gets status
     *
     * @return DedupStatus
     */
    public function getStatus(): ?DedupStatus
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  DedupStatus $status
     * @return self
     */
    public function setStatus(DedupStatus $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Gets totalSize
     *
     * @return int
     */
    public function getTotalSize(): ?int
    {
        return $this->totalSize;
    }

    /**
     * Sets totalSize
     *
     * @param  int $totalSize
     * @return self
     */
    public function setTotalSize(int $totalSize): self
    {
        $this->totalSize = $totalSize;
        return $this;
    }

    /**
     * Gets totalCount
     *
     * @return int
     */
    public function getTotalCount(): ?int
    {
        return $this->totalCount;
    }

    /**
     * Sets totalCount
     *
     * @param  int $totalCount
     * @return self
     */
    public function setTotalCount(int $totalCount): self
    {
        $this->totalCount = $totalCount;
        return $this;
    }

    /**
     * Gets volumeBlobsProgress
     *
     * @return array
     */
    public function getVolumeBlobsProgress(): array
    {
        return $this->volumeBlobsProgress;
    }

    /**
     * Sets volumeBlobsProgress
     *
     * @param  array $volumeBlobsProgress
     * @return self
     */
    public function setVolumeBlobsProgress(array $volumeBlobsProgress): self
    {
        $this->volumeBlobsProgress = [];
        foreach ($volumeBlobsProgress as $progress) {
            if ($progress instanceof VolumeIdAndProgress) {
                $this->volumeBlobsProgress[] = $progress;
            }
        }
        return $this;
    }

    /**
     * Add a progress
     *
     * @param  VolumeIdAndProgress $progress
     * @return self
     */
    public function addVolumeBlobsProgress(VolumeIdAndProgress $progress): self
    {
        $this->volumeBlobsProgress[] = $progress;
        return $this;
    }

    /**
     * Gets setBlobDigestsProgress
     *
     * @return array
     */
    public function getBlobDigestsProgress(): array
    {
        return $this->blobDigestsProgress;
    }

    /**
     * Sets setBlobDigestsProgress
     *
     * @param  array $blobDigestsProgress
     * @return self
     */
    public function setBlobDigestsProgress(array $blobDigestsProgress): self
    {
        $this->blobDigestsProgress = [];
        foreach ($blobDigestsProgress as $progress) {
            if ($progress instanceof VolumeIdAndProgress) {
                $this->blobDigestsProgress[] = $progress;
            }
        }
        return $this;
    }

    /**
     * Add a progress
     *
     * @param  VolumeIdAndProgress $progress
     * @return self
     */
    public function addBlobDigestsProgress(VolumeIdAndProgress $progress): self
    {
        $this->blobDigestsProgress[] = $progress;
        return $this;
    }
}
