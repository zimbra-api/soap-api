<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\DistributionListSelector as DistList;
use Zimbra\Enum\DistributionListSubscribeOp as SubscribeOp;

/**
 * SubscribeDistributionList request class
 * Subscribe to or unsubscribe from a distribution list
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SubscribeDistributionList extends Base
{
    /**
     * Constructor method for subscribeDistributionList
     * @param SubscribeOp $op The operation to perform. 
     * @param DistList $dl Selector for the distribution list
     * @return self
     */
    public function __construct(SubscribeOp $op, DistList $dl)
    {
        parent::__construct();
        $this->property('op', $op);
        $this->child('dl', $dl);
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
     * Gets or sets dl
     *
     * @param  DistList $dl
     * @return DistList|self
     */
    public function dl(DistList $dl = null)
    {
        if(null === $dl)
        {
            return $this->child('dl');
        }
        return $this->child('dl', $dl);
    }
}
