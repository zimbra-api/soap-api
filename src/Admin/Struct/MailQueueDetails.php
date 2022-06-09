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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * MailQueueDetails struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailQueueDetails
{
    /**
     * Queue name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Scan time
     * @Accessor(getter="getTime", setter="setTime")
     * @SerializedName("time")
     * @Type("integer")
     * @XmlAttribute
     */
    private $time;

    /**
     * Indicates that the server has not completed scanning the MTA queue, and that this
     * scan is in progress, and the client should ask again in a little while.
     * @Accessor(getter="getStillScanning", setter="setStillScanning")
     * @SerializedName("scan")
     * @Type("bool")
     * @XmlAttribute
     */
    private $stillScanning;

    /**
     * @Accessor(getter="getTotal", setter="setTotal")
     * @SerializedName("total")
     * @Type("integer")
     * @XmlAttribute
     */
    private $total;

    /**
     * Indicates that more qi's are available past the limit specified in the request.
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Queue summary.
     * The <qs> elements summarize the queue by various types of data (sender addresses, recipient domain, etc).
     * Only the deferred queue has error summary type.
     * @Accessor(getter="getQueueSummaries", setter="setQueueSummaries")
     * @SerializedName("qs")
     * @Type("array<Zimbra\Admin\Struct\QueueSummary>")
     * @XmlList(inline = true, entry = "qs")
     */
    private $queueSummaries = [];

    /**
     * The various queue items that match the requested query.
     * @Accessor(getter="getQueueItems", setter="setQueueItems")
     * @SerializedName("qi")
     * @Type("array<Zimbra\Admin\Struct\QueueItem>")
     * @XmlList(inline = true, entry = "qi")
     */
    private $queueItems = [];

    /**
     * Constructor method for MailQueueDetails
     * 
     * @param  string $name
     * @param  int $time
     * @param  bool $stillScanning
     * @param  int $total
     * @param  bool $more
     * @param  array $queueSummaries
     * @param  array $queueItems
     * @return self
     */
    public function __construct(
        string $name,
        int $time,
        bool $stillScanning,
        int $total,
        bool $more,
        array $queueSummaries = [],
        array $queueItems = []
    )
    {
        $this->setName($name)
             ->setTime($time)
             ->setStillScanning($stillScanning)
             ->setTotal($total)
             ->setMore($more)
             ->setQueueSummaries($queueSummaries)
             ->setQueueItems($queueItems);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
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
     * Gets time
     *
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * Sets time
     *
     * @param  int $time
     * @return self
     */
    public function setTime(int $time): self
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Gets stillScanning
     *
     * @return bool
     */
    public function getStillScanning(): bool
    {
        return $this->stillScanning;
    }

    /**
     * Sets stillScanning
     *
     * @param  bool $stillScanning
     * @return self
     */
    public function setStillScanning(bool $stillScanning): self
    {
        $this->stillScanning = $stillScanning;
        return $this;
    }

    /**
     * Gets total
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Sets total
     *
     * @param  int $total
     * @return self
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;
        return $this;
    }

    /**
     * Gets more
     *
     * @return bool
     */
    public function getMore(): bool
    {
        return $this->more;
    }

    /**
     * Sets more
     *
     * @param  bool $more
     * @return self
     */
    public function setMore(bool $more): self
    {
        $this->more = $more;
        return $this;
    }

    /**
     * Add qs
     *
     * @param  QueueSummary $qs
     * @return self
     */
    public function addQueueSummary(QueueSummary $qs): self
    {
        $this->queueSummaries[] = $qs;
        return $this;
    }

    /**
     * Sets queueSummaries
     *
     * @param array $summaries
     * @return self
     */
    public function setQueueSummaries(array $summaries): self
    {
        $this->queueSummaries = array_filter($summaries, static fn ($qs) => $qs instanceof QueueSummary);
        return $this;
    }

    /**
     * Gets queueSummaries
     *
     * @return array
     */
    public function getQueueSummaries(): array
    {
        return $this->queueSummaries;
    }

    /**
     * Add qi
     *
     * @param  QueueItem $qi
     * @return self
     */
    public function addQueueItem(QueueItem $qi): self
    {
        $this->queueItems[] = $qi;
        return $this;
    }

    /**
     * Sets queueItems
     *
     * @param array $queueItems
     * @return self
     */
    public function setQueueItems(array $queueItems): self
    {
        $this->queueItems = array_filter($queueItems, static fn ($qi) => $qi instanceof QueueItem);
        return $this;
    }

    /**
     * Gets queueItems
     *
     * @return array
     */
    public function getQueueItems(): array
    {
        return $this->queueItems;
    }
}
