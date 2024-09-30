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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};
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
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Enum<Zimbra\Common\Enum\DedupStatus>")
     * @XmlAttribute
     *
     * @var DedupStatus
     */
    #[Accessor(getter: "getStatus", setter: "setStatus")]
    #[SerializedName("status")]
    #[Type("Enum<Zimbra\Common\Enum\DedupStatus>")]
    #[XmlAttribute]
    private ?DedupStatus $status;

    /**
     * @Accessor(getter="getTotalSize", setter="setTotalSize")
     * @SerializedName("totalSize")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getTotalSize", setter: "setTotalSize")]
    #[SerializedName("totalSize")]
    #[Type("int")]
    #[XmlAttribute]
    private $totalSize;

    /**
     * @Accessor(getter="getTotalCount", setter="setTotalCount")
     * @SerializedName("totalCount")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getTotalCount", setter: "setTotalCount")]
    #[SerializedName("totalCount")]
    #[Type("int")]
    #[XmlAttribute]
    private $totalCount;

    /**
     * volume blobs progress
     *
     * @Accessor(getter="getVolumeBlobsProgress", setter="setVolumeBlobsProgress")
     * @Type("array<Zimbra\Admin\Struct\VolumeIdAndProgress>")
     * @XmlList(inline=true, entry="volumeBlobsProgress", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[
        Accessor(
            getter: "getVolumeBlobsProgress",
            setter: "setVolumeBlobsProgress"
        )
    ]
    #[Type("array<Zimbra\Admin\Struct\VolumeIdAndProgress>")]
    #[
        XmlList(
            inline: true,
            entry: "volumeBlobsProgress",
            namespace: "urn:zimbraAdmin"
        )
    ]
    private $volumeBlobsProgress = [];

    /**
     * blob digests progress
     *
     * @Accessor(getter="getBlobDigestsProgress", setter="setBlobDigestsProgress")
     * @Type("array<Zimbra\Admin\Struct\VolumeIdAndProgress>")
     * @XmlList(inline=true, entry="blobDigestsProgress", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[
        Accessor(
            getter: "getBlobDigestsProgress",
            setter: "setBlobDigestsProgress"
        )
    ]
    #[Type("array<Zimbra\Admin\Struct\VolumeIdAndProgress>")]
    #[
        XmlList(
            inline: true,
            entry: "blobDigestsProgress",
            namespace: "urn:zimbraAdmin"
        )
    ]
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
        ?DedupStatus $status = null,
        ?int $totalSize = null,
        ?int $totalCount = null,
        array $volumeBlobsProgress = [],
        array $blobDigestsProgress = []
    ) {
        $this->setVolumeBlobsProgress(
            $volumeBlobsProgress
        )->setBlobDigestsProgress($blobDigestsProgress);
        $this->status = $status;
        if (null !== $totalSize) {
            $this->setTotalSize($totalSize);
        }
        if (null !== $totalCount) {
            $this->setTotalCount($totalCount);
        }
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
        $this->volumeBlobsProgress = array_filter(
            $progress,
            static fn($progress) => $progress instanceof VolumeIdAndProgress
        );
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
        $this->blobDigestsProgress = array_filter(
            $progress,
            static fn($progress) => $progress instanceof VolumeIdAndProgress
        );
        return $this;
    }
}
