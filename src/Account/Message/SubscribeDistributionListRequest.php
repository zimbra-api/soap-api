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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Enum\DistributionListSubscribeOp;
use Zimbra\Common\Struct\DistributionListSelector;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * SubscribeDistributionListRequest class
 * Subscribe to or unsubscribe from a distribution list 
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SubscribeDistributionListRequest extends Request
{
    /**
     * The operation to perform.
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Zimbra\Common\Enum\DistributionListSubscribeOp")
     * @XmlAttribute
     */
    private DistributionListSubscribeOp $op;

    /**
     * Selector for the distribution list
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Common\Struct\DistributionListSelector")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private DistributionListSelector $dl;

    /**
     * Constructor method for SubscribeDistributionListRequest
     *
     * @param  DistributionListSelector $dl
     * @param  DistributionListSubscribeOp $op
     * @return self
     */
    public function __construct(
        DistributionListSelector $dl, ?DistributionListSubscribeOp $op = NULL
    )
    {
        $this->setDl($dl)
             ->setOp($op ?? DistributionListSubscribeOp::SUBSCRIBE());
    }

    /**
     * Gets the dl to authenticate against
     *
     * @return DistributionListSelector
     */
    public function getDl(): DistributionListSelector
    {
        return $this->dl;
    }

    /**
     * Sets the dl to authenticate against
     *
     * @param  DistributionListSelector $dl
     * @return self
     */
    public function setDl(DistributionListSelector $dl): self
    {
        $this->dl = $dl;
        return $this;
    }

    /**
     * Gets op
     *
     * @return DistributionListSubscribeOp
     */
    public function getOp(): DistributionListSubscribeOp
    {
        return $this->op;
    }

    /**
     * Sets op
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new SubscribeDistributionListEnvelope(
            new SubscribeDistributionListBody($this)
        );
    }
}
