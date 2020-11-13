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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};
use Zimbra\Enum\DistributionListSubscribeOp as SubscribeOp;

/**
 * DistributionListSubscribeReq struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="subsReq")
 */
class DistributionListSubscribeReq
{
    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Zimbra\Enum\DistributionListSubscribeOp")
     * @XmlAttribute
     */
    private $op;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * @Accessor(getter="getBccOwners", setter="setBccOwners")
     * @SerializedName("bccOwners")
     * @Type("bool")
     * @XmlAttribute
     */
    private $bccOwners;

    /**
     * Constructor method for DistributionListSubscribeReq
     * @param  SubscribeOp $op
     * @param  string $value
     * @param  bool   $bccOwners
     * @return self
     */
    public function __construct(SubscribeOp $op, $value = NULL, $bccOwners = NULL)
    {
		$this->setOp($op);
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $bccOwners) {
			$this->setBccOwners($bccOwners);
        }
    }

    /**
     * Gets operation
     *
     * @return SubscribeOp
     */
    public function getOp(): SubscribeOp
    {
        return $this->op;
    }

    /**
     * Sets operation
     *
     * @param  SubscribeOp $op
     * @return self
     */
    public function setOp(SubscribeOp $op)
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value)
    {
        $this->value = trim($value);
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
        return $this->bccOwners;
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
        $this->bccOwners = (bool) $bccOwners;
        return $this;
    }
}
