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
use Zimbra\Common\Struct\SoapResponse;

/**
 * DedupeBlobsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DedupeBlobsResponse extends SoapResponse
{
    /**
     * Status - one of started|running|idle|stopped
     * 
     * @var DedupStatus
     */
    #[Accessor(getter: 'getStatus', setter: 'setStatus')]
    #[SerializedName(name: 'status')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\DedupStatus>')]
    #[XmlAttribute]
    private $status;

    /**
     * @var int
     */
    #[Accessor(getter: 'getTotalSize', setter: 'setTotalSize')]
    #[SerializedName(name: 'totalSize')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $totalSize;

    /**
     * @var int
     */
    #[Accessor(getter: 'getTotalCount', setter: 'setTotalCount')]
    #[SerializedName(name: 'totalCount')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $totalCount;

    /**
     * volume blobs progress
     * 
     * @var array
     */
    #[Accessor(getter: 'getVolumeBlobsProgress', setter: 'setVolumeBlobsProgress')]
    #[Type(name: 'array<Zimbra\Admin\Struct\VolumeIdAndProgress>')]
    #[XmlList(inline: true, entry: 'volumeBlobsProgress', namespace: 'urn:zimbraAdmin')]
    private $volumeBlobsProgress = [];

    /**
     * blob digests progress
     * 
     * @var array
     */
    #[Accessor(getter: 'getBlobDigestsProgress', setter: 'setBlobDigestsProgress')]
    #[Type(name: 'array<Zimbra\Admin\Struct\VolumeIdAndProgress>')]
    #[XmlList(inline: true, entry: 'blobDigestsProgress', namespace: 'urn:zimbraAdmin')]
    private $blobDigestsProgress = [];

    /**
     * Constructor
     *
     * @param  DedupStatus $status
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
     * Get status
     *
     * @return DedupStatus
     */
    public function getStatus(): ?DedupStatus
    {
        return $this->status;
    }

    /**
     * Set status
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
     * Get totalSize
     *
     * @return int
     */
    public function getTotalSize(): ?int
    {
        return $this->totalSize;
    }

    /**
     * Set totalSize
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
     * Get totalCount
     *
     * @return int
     */
    public function getTotalCount(): ?int
    {
        return $this->totalCount;
    }

    /**
     * Set totalCount
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
     * Get volumeBlobsProgress
     *
     * @return array
     */
    public function getVolumeBlobsProgress(): array
    {
        return $this->volumeBlobsProgress;
    }

    /**
     * Set volumeBlobsProgress
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
     * Get setBlobDigestsProgress
     *
     * @return array
     */
    public function getBlobDigestsProgress(): array
    {
        return $this->blobDigestsProgress;
    }

    /**
     * Set setBlobDigestsProgress
     *
     * @param  array $progress
     * @return self
     */
    public function setBlobDigestsProgress(array $progress): self
    {
        $this->blobDigestsProgress = array_filter($progress, static fn ($progress) => $progress instanceof VolumeIdAndProgress);
        return $this;
    }
}
