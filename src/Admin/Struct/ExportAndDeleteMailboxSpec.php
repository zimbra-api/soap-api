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
 * ExportAndDeleteMailboxSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ExportAndDeleteMailboxSpec
{
    /**
     * ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $id;

    /**
     * Items
     * 
     * @Accessor(getter="getItems", setter="setItems")
     * @Type("array<Zimbra\Admin\Struct\ExportAndDeleteItemSpec>")
     * @XmlList(inline=true, entry="item", namespace="urn:zimbraAdmin")
     */
    private $items = [];

    /**
     * Constructor
     * 
     * @param  int $id
     * @param  array $items
     * @return self
     */
    public function __construct(int $id = 0, array $items = [])
    {
        $this->setId($id)
             ->setItems($items);
    }

    /**
     * Get ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set ID
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
     * Add an item
     *
     * @param  ExportAndDeleteItemSpec $item
     * @return self
     */
    public function addItem(ExportAndDeleteItemSpec $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Set item sequence
     *
     * @param  array $items Items
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->items = array_filter($items, static fn ($item) => $item instanceof ExportAndDeleteItemSpec);
        return $this;
    }

    /**
     * Get item sequence
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
