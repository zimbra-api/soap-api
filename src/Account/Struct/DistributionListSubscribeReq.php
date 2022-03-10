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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Enum\DistributionListSubscribeOp as SubscribeOp;

/**
 * DistributionListSubscribeReq struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DistributionListSubscribeReq
{
    /**
     * operation
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
     * Flag whether to bcc all other owners on the accept/reject notification emails.
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
    public function __construct(SubscribeOp $op, ?string $value = NULL, ?bool $bccOwners = NULL)
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
    public function setOp(SubscribeOp $op): self
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets bccOwners flag
     *
     * @return bool
     */
    public function getBccOwners(): ?bool
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
    public function setBccOwners(bool $bccOwners): self
    {
        $this->bccOwners = $bccOwners;
        return $this;
    }
}
