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
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\DistributionListSubscribeOp as SubscribeOp;

/**
 * DistributionListSubscribeReq struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="subsReq")
 */
class DistributionListSubscribeReq
{
    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     */
    private $_op;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * @Accessor(getter="getBccOwners", setter="setBccOwners")
     * @SerializedName("bccOwners")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_bccOwners;

    /**
     * Constructor method for DistributionListSubscribeReq
     * @param  string $op
     * @param  string $value
     * @param  bool   $bccOwners
     * @return self
     */
    public function __construct($op, $value = null, $bccOwners = null)
    {
		$this->setOp($op);
        if (null !== $value) {
            $this->setValue($value);
        }
        if (null !== $bccOwners) {
			$this->setBccOwners($bccOwners);
        }
    }

    /**
     * Gets operation
     *
     * @return string
     */
    public function getOp()
    {
        return $this->_op;
    }

    /**
     * Sets operation
     *
     * @param  string $op
     * @return self
     */
    public function setOp($op)
    {
        if (SubscribeOp::has(trim($op))) {
            $this->_op = $op;
        }
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets bccOwners flag
     * Flag whether to bcc all other owners on the accept/reject notification emails.
     *
     * @return bool
     */
    public function getBccOwners()
    {
        return $this->_bccOwners;
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
        $this->_bccOwners = (bool) $bccOwners;
        return $this;
    }
}
