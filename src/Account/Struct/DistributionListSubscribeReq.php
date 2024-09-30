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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};
use Zimbra\Common\Enum\DistributionListSubscribeOp;

/**
 * DistributionListSubscribeReq struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListSubscribeReq
{
    /**
     * operation
     *
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Enum<Zimbra\Common\Enum\DistributionListSubscribeOp>")
     * @XmlAttribute
     *
     * @var DistributionListSubscribeOp
     */
    #[Accessor(getter: "getOp", setter: "setOp")]
    #[SerializedName("op")]
    #[Type("Enum<Zimbra\Common\Enum\DistributionListSubscribeOp>")]
    #[XmlAttribute]
    private DistributionListSubscribeOp $op;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     *
     * @var string
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Flag whether to bcc all other owners on the accept/reject notification emails.
     *
     * @Accessor(getter="getBccOwners", setter="setBccOwners")
     * @SerializedName("bccOwners")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getBccOwners", setter: "setBccOwners")]
    #[SerializedName("bccOwners")]
    #[Type("bool")]
    #[XmlAttribute]
    private $bccOwners;

    /**
     * Constructor
     *
     * @param  DistributionListSubscribeOp $op
     * @param  string $value
     * @param  bool   $bccOwners
     * @return self
     */
    public function __construct(
        ?DistributionListSubscribeOp $op = null,
        ?string $value = null,
        ?bool $bccOwners = null
    ) {
        $this->setOp($op ?? new DistributionListSubscribeOp("subscribe"));
        if (null !== $value) {
            $this->setValue($value);
        }
        if (null !== $bccOwners) {
            $this->setBccOwners($bccOwners);
        }
    }

    /**
     * Get operation
     *
     * @return DistributionListSubscribeOp
     */
    public function getOp(): DistributionListSubscribeOp
    {
        return $this->op;
    }

    /**
     * Set operation
     *
     * @param  DistributionListSubscribeOp $op
     * @return self
     */
    public function setOp(DistributionListSubscribeOp $op): self
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
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
     * Get bccOwners flag
     *
     * @return bool
     */
    public function getBccOwners(): ?bool
    {
        return $this->bccOwners;
    }

    /**
     * Set bccOwners flag
     *
     * @param  bool $bccOwners
     * @return self
     */
    public function setBccOwners(bool $bccOwners): self
    {
        $this->bccOwners = $bccOwners;
        return $this;
    }
}
