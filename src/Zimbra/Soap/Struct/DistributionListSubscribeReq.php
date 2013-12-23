<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\DistributionListSubscribeOp as SubscribeOp;
use Zimbra\Utils\SimpleXML;

/**
 * DistributionListSubscribeReq class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListSubscribeReq
{
    /**
     * The operation
     * @var SubscribeOp
     */
    private $_op;

    /**
     * Subscription request
     * @var string
     */
    private $_value;

    /**
     * Flag whether to bcc all other owners on the accept/reject notification emails.
     * @var bool
     */
    private $_bccOwners;

    /**
     * Constructor method for DistributionListSubscribeReq
     * @param  SubscribeOp $op
     * @param  string $value
     * @param  bool   $bccOwners
     * @return self
     */
    public function __construct(SubscribeOp $op, $value = null, $bccOwners = null)
    {
        $this->_op = $op;
        $this->_value = trim($value);
        if(null !== $bccOwners)
        {
            $this->_bccOwners = (bool) $bccOwners;
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
            return $this->_op;
        }
        $this->_op = $op;
        return $this;
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
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
            return $this->_bccOwners;
        }
        $this->_bccOwners = (bool) $bccOwners;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'subsReq')
    {
        $name = !empty($name) ? $name : 'subsReq';
        $arr = array(
            'op' => (string) $this->_op,
            '_' => $this->_value,
        );
        if(is_bool($this->_bccOwners))
        {
            $arr['bccOwners'] = $this->_bccOwners ? 1 : 0;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'subsReq')
    {
        $name = !empty($name) ? $name : 'subsReq';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('op', (string) $this->_op);
        if(is_bool($this->_bccOwners))
        {
            $xml->addAttribute('bccOwners', $this->_bccOwners ? 1 : 0);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
