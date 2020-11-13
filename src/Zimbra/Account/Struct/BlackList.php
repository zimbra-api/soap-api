<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Struct\OpValue;

/**
 * BlackList struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="blackList")
 */
class BlackList
{
    /**
     * @Accessor(getter="getAddrs", setter="setAddrs")
     * @SerializedName("addr")
     * @Type("array<Zimbra\Struct\OpValue>")
     * @XmlList(inline = true, entry = "addr")
     */
    private $addrs;

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
        $this->addrs[] = $addr;
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
        $this->addrs = [];
        foreach ($addrs as $addr) {
            if ($addr instanceof OpValue) {
                $this->addrs[] = $addr;
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
        return $this->addrs;
    }
}
