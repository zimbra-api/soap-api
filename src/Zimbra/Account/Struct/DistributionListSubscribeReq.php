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

use Zimbra\Enum\DistributionListSubscribeOp as SubscribeOp;
use Zimbra\Struct\Base;

/**
 * DistributionListSubscribeReq struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListSubscribeReq extends Base
{
    /**
     * Constructor method for DistributionListSubscribeReq
     * @param  SubscribeOp $op
     * @param  string $value
     * @param  bool   $bccOwners
     * @return self
     */
    public function __construct(SubscribeOp $op, $value = null, $bccOwners = null)
    {
		parent::__construct(trim($value));
		$this->property('op', $op);
        if(null !== $bccOwners)
        {
			$this->property('bccOwners', (bool) $bccOwners);
        }
    }

    /**
     * Gets or sets op
     *
     * @param  SubscribeOp $op
     * @return SubscribeOp|self
     */
    public function op(SubscribeOp $op = null)
    {
        if(null === $op)
        {
            return $this->property('op');
        }
        return $this->property('op', $op);
    }

    /**
     * Gets or sets bccOwners
     *
     * @param  bool $bccOwners
     * @return bool|self
     */
    public function bccOwners($bccOwners = null)
    {
        if(null === $bccOwners)
        {
			return $this->property('bccOwners');
        }
        return $this->property('bccOwners', (bool) $bccOwners);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'subsReq')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'subsReq')
    {
        return parent::toXml($name);
    }
}
