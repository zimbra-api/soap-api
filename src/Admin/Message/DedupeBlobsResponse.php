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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\VolumeIdAndProgress;
use Zimbra\Common\Enum\DedupStatus;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * DedupeBlobsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DedupeBlobsResponse implements SoapResponseInterface
{
    /**
     * Status - one of started|running|idle|stopped
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Common\Enum\DedupStatus")
     * @XmlAttribute
     */
    private ?DedupStatus $status = NULL;

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
     * @Type("array<Zimbra\Admin\Struct\VolumeIdAndProgress>")
     * @XmlList(inline=true, entry="volumeBlobsProgress", namespace="urn:zimbraAdmin")
     */
    private $volumeBlobsProgress = [];

    /**
     * blobDigestsProgress
     * @Accessor(getter="getBlobDigestsProgress", setter="setBlobDigestsProgress")
     * @Type("array<Zimbra\Admin\Struct\VolumeIdAndProgress>")
     * @XmlList(inline=true, entry="blobDigestsProgress", namespace="urn:zimbraAdmin")
     */
    private $blobDigestsProgress = [];

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
     * @param  array $progress
     * @return self
     */
    public function setVolumeBlobsProgress(array $progress): self
    {
        $this->volumeBlobsProgress = array_filter($progress, static fn ($progress) => $progress instanceof VolumeIdAndProgress);
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
     * @param  array $progress
     * @return self
     */
    public function setBlobDigestsProgress(array $progress): self
    {
        $this->blobDigestsProgress = array_filter($progress, static fn ($progress) => $progress instanceof VolumeIdAndProgress);
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
