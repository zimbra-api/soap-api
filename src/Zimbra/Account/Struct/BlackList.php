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
     * @var TypedSequence<OpValue>
     */
    private $_addrs;

    /**
     * Constructor method for BlackList
     * @param array $addrs
     * @return self
     */
    public function __construct(array $addrs = [])
    {
		parent::__construct();
        $this->setAddrs($addrs);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAddrs()->count())
            {
                $sender->setChild('addr', $sender->getAddrs()->all());
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
        $this->_addrs->add($addr);
        return $this;
    }

    /**
     * Sets addr sequence
     *
     * @param array $addrs
     * @return self
     */
    public function setAddrs(array $addrs)
    {
        $this->_addrs = new TypedSequence('Zimbra\Struct\OpValue', $addrs);
        return $this;
    }

    /**
     * Gets addr sequence
     *
     * @return Sequence
     */
    public function getAddrs()
    {
        return $this->_addrs;
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
