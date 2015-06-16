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
        $this->setProperty('op', $op);
        $this->setChild('dl', $dl);
    }

    /**
     * Sets the operation to perform
     *
     * @return Op
     */
    public function getOp()
    {
        return $this->getProperty('op');
    }

    /**
     * Gets the operation to perform
     *
     * @param  Op $op
     * @return self
     */
    public function setOp(SubscribeOp $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets the dl
     *
     * @return Zimbra\Action\Struct\DistributionListSelector
     */
    public function getDl()
    {
        return $this->getChild('dl');
    }

    /**
     * Sets the dl
     *
     * @param  Zimbra\Action\Struct\DistributionListSelector $dl
     * @return self
     */
    public function setDl(DistList $dl)
    {
        return $this->setChild('dl', $dl);
    }
}
