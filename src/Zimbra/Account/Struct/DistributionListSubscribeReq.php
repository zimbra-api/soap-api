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
		$this->setProperty('op', $op);
        if(null !== $bccOwners)
        {
			$this->setProperty('bccOwners', (bool) $bccOwners);
        }
    }

    /**
     * Gets operation
     *
     * @return SubscribeOp
     */
    public function getOp()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  SubscribeOp $op
     * @return self
     */
    public function setOp(SubscribeOp $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets bccOwners flag
     * Flag whether to bcc all other owners on the accept/reject notification emails.
     *
     * @return bool
     */
    public function getBccOwners()
    {
        return $this->getProperty('bccOwners');
    }

    /**
     * Sets bccOwners flag
     * Flag whether to bcc all other owners on the accept/reject notification emails.
     *
     * @param  bool $bccOwners
     * @return bool|self
     */
    public function setBccOwners($bccOwners)
    {
        return $this->setProperty('bccOwners', (bool) $bccOwners);
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
