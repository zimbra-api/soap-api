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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Account\Struct\{Attrs, AttrsImplTrait};
use Zimbra\Common\Struct\{
    DistributionListSelector,
    SoapEnvelopeInterface,
    SoapRequest
};

/**
 * GetDistributionListRequest class
 * Get a distribution list, optionally with ownership information an granted rights.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDistributionListRequest extends SoapRequest implements Attrs
{
    use AttrsImplTrait;

    /**
     * Whether to return owners, default is 0 (i.e. Don't return owners)
     *
     * @var bool
     */
    #[Accessor(getter: "getNeedOwners", setter: "setNeedOwners")]
    #[SerializedName("needOwners")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $needOwners = null;

    /**
     * return grants for the specified (comma-seperated) rights. e.g. needRights="sendToDistList,viewDistList"
     *
     * @var string
     */
    #[Accessor(getter: "getNeedRights", setter: "setNeedRights")]
    #[SerializedName("needRights")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $needRights = null;

    /**
     * Specify the distribution list
     *
     * @var DistributionListSelector
     */
    #[Accessor(getter: "getDl", setter: "setDl")]
    #[SerializedName("dl")]
    #[Type(DistributionListSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private DistributionListSelector $dl;

    /**
     * Constructor
     *
     * @param  DistributionListSelector $dl
     * @param  bool $needOwners
     * @param  string $needRights
     * @param  array $attrs
     * @return self
     */
    public function __construct(
        DistributionListSelector $dl,
        ?bool $needOwners = null,
        ?string $needRights = null,
        array $attrs = []
    ) {
        $this->setDl($dl)->setAttrs($attrs);
        if (null !== $needOwners) {
            $this->setNeedOwners($needOwners);
        }
        if (null !== $needRights) {
            $this->setNeedRights($needRights);
        }
    }

    /**
     * Get needOwners
     *
     * @return bool
     */
    public function getNeedOwners(): ?bool
    {
        return $this->needOwners;
    }

    /**
     * Set needOwners
     *
     * @param  bool $needOwners
     * @return self
     */
    public function setNeedOwners(bool $needOwners): self
    {
        $this->needOwners = $needOwners;
        return $this;
    }

    /**
     * Get needRights
     *
     * @return string
     */
    public function getNeedRights(): ?string
    {
        return $this->needRights;
    }

    /**
     * Set needRights
     *
     * @param  string $needRights
     * @return self
     */
    public function setNeedRights(string $needRights): self
    {
        $this->needRights = $needRights;
        return $this;
    }

    /**
     * Get the dl.
     *
     * @return DistributionListSelector
     */
    public function getDl(): DistributionListSelector
    {
        return $this->dl;
    }

    /**
     * Set the dl.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetDistributionListEnvelope(
            new GetDistributionListBody($this)
        );
    }
}
