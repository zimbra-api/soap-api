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

use Zimbra\Soap\Struct\ExportAndDeleteItemSpec as ItemSpec;
use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;

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
        $this->_items = new TypedSequence(
            'Zimbra\Soap\Struct\ExportAndDeleteItemSpec', $items
        );
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
     * @param  ItemSpec $item
     * @return self
     */
    public function addItem(ItemSpec $item)
    {
        $this->_items->add($item);
        return $this;
    }

    /**
     * Gets item sequence
     *
     * @return Sequence
     */
    public function items()
    {
        return $this->_items;
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
