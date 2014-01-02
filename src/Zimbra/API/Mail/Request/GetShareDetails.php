<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\Id;

/**
 * GetShareDetails request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetShareDetails extends Request
{
    /**
     * Item ID.
     * @var Id
     */
    private $_item;

    /**
     * Constructor method for GetShareDetails
     * @param  Id $item
     * @return self
     */
    public function __construct(Id $item)
    {
        parent::__construct();
        $this->_item = $item;
    }

    /**
     * Get or set item
     *
     * @param  Id $item
     * @return Id|self
     */
    public function item(Id $item = null)
    {
        if(null === $item)
        {
            return $this->_item;
        }
        $this->_item = $item;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_item->toArray('item');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_item->toXml('item'));
        return parent::toXml();
    }
}
