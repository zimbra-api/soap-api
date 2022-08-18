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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailQueueDetails
{
    /**
     * Queue name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Scan time
     * 
     * @var int
     */
    #[Accessor(getter: 'getTime', setter: 'setTime')]
    #[SerializedName('time')]
    #[Type('int')]
    #[XmlAttribute]
    private $time;

    /**
     * Indicates that the server has not completed scanning the MTA queue, and that this
     * scan is in progress, and the client should ask again in a little while.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getStillScanning', setter: 'setStillScanning')]
    #[SerializedName('scan')]
    #[Type('bool')]
    #[XmlAttribute]
    private $stillScanning;

    /**
     * @var int
     */
    #[Accessor(getter: 'getTotal', setter: 'setTotal')]
    #[SerializedName('total')]
    #[Type('int')]
    #[XmlAttribute]
    private $total;

    /**
     * Indicates that more qi's are available past the limit specified in the request.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getMore', setter: 'setMore')]
    #[SerializedName('more')]
    #[Type('bool')]
    #[XmlAttribute]
    private $more;

    /**
     * Queue summary.
     * The <qs> elements summarize the queue by various types of data (sender addresses, recipient domain, etc).
     * Only the deferred queue has error summary type.
     * 
     * @var array
     */
    #[Accessor(getter: 'getQueueSummaries', setter: 'setQueueSummaries')]
    #[Type('array<Zimbra\Admin\Struct\QueueSummary>')]
    #[XmlList(inline: true, entry: 'qs', namespace: 'urn:zimbraAdmin')]
    private $queueSummaries = [];

    /**
     * The various queue items that match the requested query.
     * 
     * @var array
     */
    #[Accessor(getter: 'getQueueItems', setter: 'setQueueItems')]
    #[Type('array<Zimbra\Admin\Struct\QueueItem>')]
    #[XmlList(inline: true, entry: 'qi', namespace: 'urn:zimbraAdmin')]
    private $queueItems = [];

    /**
     * Constructor
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
        string $name = '',
        int $time = 0,
        bool $stillScanning = FALSE,
        int $total = 0,
        bool $more = FALSE,
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
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get time
     *
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * Set time
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
     * Get stillScanning
     *
     * @return bool
     */
    public function getStillScanning(): bool
    {
        return $this->stillScanning;
    }

    /**
     * Set stillScanning
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
     * Get total
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Set total
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
     * Get more
     *
     * @return bool
     */
    public function getMore(): bool
    {
        return $this->more;
    }

    /**
     * Set more
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
     * Set queueSummaries
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
     * Get queueSummaries
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
     * Set queueItems
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
     * Get queueItems
     *
     * @return array
     */
    public function getQueueItems(): array
    {
        return $this->queueItems;
    }
}
