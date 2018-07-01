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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Struct\OpValue;

/**
 * BlackList struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="blackList")
 */
class BlackList
{
    /**
     * @Accessor(getter="getAddrs", setter="setAddrs")
     * @Type("array<Zimbra\Struct\OpValue>")
     * @XmlList(inline = true, entry = "addr")
     */
    private $_addrs;

    /**
     * Constructor method for BlackList
     * @param array $addrs
     * @return self
     */
    public function __construct(array $addrs = [])
    {
        $this->setAddrs($addrs);
    }

    /**
     * Add an addr
     *
     * @param  OpValue $addr
     * @return self
     */
    public function addAddr(OpValue $addr)
    {
        $this->_addrs[] = $addr;
        return $this;
    }

    /**
     * Sets addr array
     *
     * @param array $addrs
     * @return self
     */
    public function setAddrs(array $addrs)
    {
        $this->_addrs = [];
        foreach ($addrs as $addr) {
            if ($addr instanceof OpValue) {
                $this->_addrs[] = $addr;
            }
        }
        return $this;
    }

    /**
     * Gets addr array
     *
     * @return array
     */
    public function getAddrs()
    {
        return $this->_addrs;
    }
}
