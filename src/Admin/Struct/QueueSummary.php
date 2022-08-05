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
 * QueueSummary struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class QueueSummary
{
    /**
     * Queue summary type - reason|to|from|todomain|fromdomain|addr|host
     * 
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $type;

    /**
     * Queue summary items
     * 
     * @Accessor(getter="getItems", setter="setItems")
     * @Type("array<Zimbra\Admin\Struct\QueueSummaryItem>")
     * @XmlList(inline=true, entry="qsi", namespace="urn:zimbraAdmin")
     */
    private $items = [];

    /**
     * Constructor
     * 
     * @param  string $type
     * @param  array  $items
     * @return self
     */
    public function __construct(string $type = '', array $items = [])
    {
        $this->setType($type)
             ->setItems($items);
    }

    /**
     * Get ID
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set ID
     *
     * @param  string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Add qsi
     *
     * @param  QueueSummaryItem $qsi
     * @return self
     */
    public function addItem(QueueSummaryItem $qsi): self
    {
        $this->items[] = $qsi;
        return $this;
    }

    /**
     * Set items
     *
     * @param array $items
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->items = array_filter($items, static fn ($qsi) => $qsi instanceof QueueSummaryItem);
        return $this;
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
