<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Enum\DistributionListSubscribeOp as SubscribeOp;
use Zimbra\Soap\Request;
use Zimbra\Struct\DistributionListSelector as DLSelector;

/**
 * SubscribeDistributionListRequest class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="SubscribeDistributionListRequest")
 */
class SubscribeDistributionListRequest extends Request
{
    /**
     * The operation to perform.
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Zimbra\Enum\DistributionListSubscribeOp")
     * @XmlAttribute
     */
    private $op;

    /**
     * Selector for the distribution list
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Struct\DistributionListSelector")
     * @XmlElement
     */
    private $dl;

    /**
     * Constructor method for SubscribeDistributionListRequest
     *
     * @param  DLSelector $dl
     * @param  SubscribeOp $op
     * @return self
     */
    public function __construct(
        DLSelector $dl,
        SubscribeOp $op
    )
    {
        $this->setDl($dl)
            ->setOp($op);
    }

    /**
     * Gets the dl to authenticate against
     *
     * @return DLSelector
     */
    public function getDl(): DLSelector
    {
        return $this->dl;
    }

    /**
     * Sets the dl to authenticate against
     *
     * @param  DLSelector $dl
     * @return self
     */
    public function setDl(DLSelector $dl): self
    {
        $this->dl = $dl;
        return $this;
    }

    /**
     * Gets op
     *
     * @return SubscribeOp
     */
    public function getOp(): SubscribeOp
    {
        return $this->op;
    }

    /**
     * Sets op
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof SubscribeDistributionListEnvelope)) {
            $this->envelope = new SubscribeDistributionListEnvelope(
                new SubscribeDistributionListBody($this)
            );
        }
    }
}
