<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Enum\DistributionListSubscribeOp as SubscribeOp;
use Zimbra\Soap\Struct\DistributionListSelector as DistList;

/**
 * SubscribeDistributionList class
 * Subscribe to or unsubscribe from a distribution list
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SubscribeDistributionList extends Request
{
    /**
     * The operation to perform. 
     * @var SubscribeOp
     */
    private $_op;

    /**
     * Selector for the distribution list
     * @var DistList
     */
    private $_dl;

    /**
     * Constructor method for subscribeDistributionList
     * @param SubscribeOp $op
     * @param DistList $dl
     * @return self
     */
    public function __construct(SubscribeOp $op, DistList $dl)
    {
        parent::__construct();
        $this->_op = $op;
        $this->_dl = $dl;
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
            return $this->_op;
        }
        $this->_op = $op;
        return $this;
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
            return $this->_dl;
        }
        $this->_dl = $dl;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'op' => (string) $this->_op,
        );
        $this->array += $this->_dl->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('op', (string) $this->_op)
                  ->append($this->_dl->toXml());
        return parent::toXml();
    }
}
