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
use Zimbra\Account\Struct\Attrs;
use Zimbra\Account\Struct\AttrsImplTrait;
use Zimbra\Struct\DistributionListSelector;
use Zimbra\Soap\Request;

/**
 * GetDistributionListRequest class
 * Get a distribution list, optionally with ownership information an granted rights.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetDistributionListRequest")
 */
class GetDistributionListRequest extends Request implements Attrs
{
    use AttrsImplTrait;

    /**
     * Whether to return owners, default is 0 (i.e. Don't return owners)
     * @Accessor(getter="getNeedOwners", setter="setNeedOwners")
     * @SerializedName("needOwners")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needOwners;

    /**
     * return grants for the specified (comma-seperated) rights. e.g. needRights="sendToDistList,viewDistList"
     * @Accessor(getter="getNeedRights", setter="setNeedRights")
     * @SerializedName("needRights")
     * @Type("string")
     * @XmlAttribute
     */
    private $needRights;

    /**
     * Specify the distribution list
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Struct\DistributionListSelector")
     * @XmlElement
     */
    private $dl;

    /**
     * Constructor method for GetDistributionListRequest
     * 
     * @param  DistributionListSelector $dl
     * @param  bool $needOwners
     * @param  string $needRights
     * @param  array $attrs
     * @return self
     */
    public function __construct(
        DistributionListSelector $dl,
        ?bool $needOwners = NULL,
        ?string $needRights = NULL,
        array $attrs = []
    )
    {
        $this->setDl($dl)
             ->setAttrs($attrs);
        if (NULL !== $needOwners) {
            $this->setNeedOwners($needOwners);
        }
        if (NULL !== $needRights) {
            $this->setNeedRights($needRights);
        }
    }

    /**
     * Gets needOwners
     *
     * @return bool
     */
    public function getNeedOwners(): ?bool
    {
        return $this->needOwners;
    }

    /**
     * Sets needOwners
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
     * Gets needRights
     *
     * @return string
     */
    public function getNeedRights(): ?string
    {
        return $this->needRights;
    }

    /**
     * Sets needRights
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
     * Gets the dl.
     *
     * @return DistributionListSelector
     */
    public function getDl(): DistributionListSelector
    {
        return $this->dl;
    }

    /**
     * Sets the dl.
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetDistributionListEnvelope)) {
            $this->envelope = new GetDistributionListEnvelope(
                new GetDistributionListBody($this)
            );
        }
    }
}
