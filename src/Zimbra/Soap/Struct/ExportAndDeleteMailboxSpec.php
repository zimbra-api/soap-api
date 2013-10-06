<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * ExportAndDeleteMailboxSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExportAndDeleteMailboxSpec
{
    /**
     * ID
     * @var int
     */
    private $_id;
    /**
     * Items
     * @var array
     */
    private $_items = array();

    /**
     * Constructor method for ExportAndDeleteMailboxSpec
     * @param  int $id
     * @param  int $items
     * @return self
     */
    public function __construct($id, array $items = array())
    {
        $this->_id = (int) $id;
        $this->items($items);
    }

    /**
     * Gets or sets id
     *
     * @param  int $id
     * @return int|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
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
     * Gets or sets items
     *
     * @param  array $items
     * @return array|self
     */
    public function items(array $items = null)
    {
        if(null === $items)
        {
            return $this->_items;
        }
        $this->_items = array();
        foreach ($items as $item)
        {
            if($item instanceof ExportAndDeleteItemSpec)
            {
                $this->_items[] = $item;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'mbox')
    {
        $name = !empty($name) ? $name : 'mbox';
        $arr = array(
            'id' => $this->_id,
        );
        if(count($this->_items))
        {
            $arr['item'] = array();
            foreach ($this->_items as $item)
            {
                $itemArr = $item->toArray('item');
                $arr['item'][] = $itemArr['item'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mbox')
    {
        $name = !empty($name) ? $name : 'mbox';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id);
        foreach ($this->_items as $item)
        {
            $xml->append($item->toXml('item'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
