<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;
use Zimbra\Struct\OpValue;

/**
 * BlackList struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class BlackList extends Base
{
    /**
     * Attributes
     * @var TypedSequence<Attr>
     */
    private $_addr;

    /**
     * Constructor method for BlackList
     * @param array $addrs
     * @return self
     */
    public function __construct(array $addrs = array())
    {
		parent::__construct();
        $this->_addr = new TypedSequence('Zimbra\Struct\OpValue', $addrs);

        $this->on('before', function(Base $sender)
        {
            if($sender->addr()->count())
            {
                $sender->child('addr', $sender->addr()->all());
            }
        });
    }

    /**
     * Add an addr
     *
     * @param  Attr $addr
     * @return self
     */
    public function addAddr(OpValue $addr)
    {
        $this->_addr->add($addr);
        return $this;
    }

    /**
     * Gets addr sequence
     *
     * @return Sequence
     */
    public function addr()
    {
        return $this->_addr;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'blackList')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'blackList')
    {
        return parent::toXml($name);
    }
}
