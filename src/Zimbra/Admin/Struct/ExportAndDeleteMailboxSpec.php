<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * ExportAndDeleteMailboxSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="mbox")
 */
class ExportAndDeleteMailboxSpec
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_id;

    /**
     * Items
     * @Accessor(getter="getItems", setter="setItems")
     * @Type("array<Zimbra\Admin\Struct\ExportAndDeleteItemSpec>")
     * @XmlList(inline = true, entry = "item")
     */
    private $_items;

    /**
     * Constructor method for ExportAndDeleteMailboxSpec
     * @param  int $id ID
     * @param  int $items Items
     * @return self
     */
    public function __construct($id, array $items = [])
    {
        $this->setId($id)
             ->setItems($items);
    }

    /**
     * Gets ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets ID
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    /**
     * Add an item
     *
     * @param  ExportAndDeleteItemSpec $item
     * @return self
     */
    public function addItem(ExportAndDeleteItemSpec $item)
    {
        $this->_items[] = $item;
        return $this;
    }

    /**
     * Sets item sequence
     *
     * @param  array $items Items
     * @return self
     */
    public function setItems(array $items)
    {
        $this->_items = [];
        foreach ($items as $item) {
            if ($item instanceof ExportAndDeleteItemSpec) {
                $this->_items[] = $item;
            }
        }
        return $this;
    }

    /**
     * Gets item sequence
     *
     * @return array
     */
    public function getItems()
    {
        return $this->_items;
    }
}
