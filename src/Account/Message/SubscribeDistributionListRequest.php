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
use Zimbra\Common\Struct\{DistributionListSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * SubscribeDistributionListRequest class
 * Subscribe to or unsubscribe from a distribution list 
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SubscribeDistributionListRequest extends SoapRequest
{
    /**
     * The operation to perform.
     * 
     * @var DistributionListSubscribeOp
     */
    #[Accessor(getter: 'getOp', setter: 'setOp')]
    #[SerializedName(name: 'op')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\DistributionListSubscribeOp>')]
    #[XmlAttribute]
    private $op;

    /**
     * Selector for the distribution list
     * 
     * @var DistributionListSelector
     */
    #[Accessor(getter: 'getDl', setter: 'setDl')]
    #[SerializedName(name: 'dl')]
    #[Type(name: DistributionListSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $dl;

    /**
     * Constructor
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
             ->setOp($op ?? new DistributionListSubscribeOp('subscribe'));
    }

    /**
     * Get the dl to authenticate against
     *
     * @return DistributionListSelector
     */
    public function getDl(): DistributionListSelector
    {
        return $this->dl;
    }

    /**
     * Set the dl to authenticate against
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
     * Get op
     *
     * @return DistributionListSubscribeOp
     */
    public function getOp(): DistributionListSubscribeOp
    {
        return $this->op;
    }

    /**
     * Set op
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SubscribeDistributionListEnvelope(
            new SubscribeDistributionListBody($this)
        );
    }
}
