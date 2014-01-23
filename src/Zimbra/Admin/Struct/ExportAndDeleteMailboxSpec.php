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

use Zimbra\Admin\Struct\ExportAndDeleteItemSpec as ItemSpec;
use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * ExportAndDeleteMailboxSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExportAndDeleteMailboxSpec extends Base
{
    /**
     * Items
     * @var TypedSequence
     */
    private $_item = array();

    /**
     * Constructor method for ExportAndDeleteMailboxSpec
     * @param  int $id ID
     * @param  int $items Items
     * @return self
     */
    public function __construct($id, array $items = array())
    {
        parent::__construct();
        $this->property('id', (int) $id);
        $this->_item = new TypedSequence(
            'Zimbra\Admin\Struct\ExportAndDeleteItemSpec', $items
        );

        $this->addHook(function($sender)
        {
            $sender->child('item', $sender->item()->all());
        });
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
            return $this->property('id');
        }
        return $this->property('id', (int) $id);
    }

    /**
     * Add an item
     *
     * @param  ItemSpec $item
     * @return self
     */
    public function addItem(ItemSpec $item)
    {
        $this->_item->add($item);
        return $this;
    }

    /**
     * Gets item sequence
     *
     * @return Sequence
     */
    public function item()
    {
        return $this->_item;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'mbox')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mbox')
    {
        return parent::toXml($name);
    }
}
