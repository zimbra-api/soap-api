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
    private $_items;

    /**
     * Constructor method for ExportAndDeleteMailboxSpec
     * @param  int $id ID
     * @param  int $items Items
     * @return self
     */
    public function __construct($id, array $items = [])
    {
        parent::__construct();
        $this->setProperty('id', (int) $id);
        $this->setItems($items);

        $this->on('before', function(Base $sender)
        {
            if($sender->getItems()->count())
            {
                $sender->setChild('item', $sender->getItems()->all());
            }
        });
    }

    /**
     * Gets ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets ID
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', (int) $id);
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
     * Sets item sequence
     *
     * @param  int $items Items
     * @return self
     */
    public function setItems(array $items)
    {
        $this->_items = new TypedSequence(
            'Zimbra\Admin\Struct\ExportAndDeleteItemSpec', $items
        );
        return $this;
    }

    /**
     * Gets item sequence
     *
     * @return Sequence
     */
    public function getItems()
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
