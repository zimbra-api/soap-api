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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Account\Struct\DistributionListAction;
use Zimbra\Common\Struct\DistributionListSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DistributionListActionRequest class
 * Perform an action on a Distribution List
 * Notes:
 *  - Authorized account must be one of the list owners 
 *  - For owners/rights, only grants on the group itself will be modified,
 *    grants on domain and globalgrant (from which the right can be inherited) will not be touched.
 *    Only admins can modify grants on domains and globalgrant, owners of groups
 *    can only modify grants on the group entry.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListActionRequest extends SoapRequest
{
    /**
     * Identifies the distribution list to act upon
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Common\Struct\DistributionListSelector")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private DistributionListSelector $dl;

    /**
     * Specifies the action to perform
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Account\Struct\DistributionListAction")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private DistributionListAction $action;

    /**
     * Constructor method for DistributionListActionRequest
     * 
     * @param DistributionListSelector $dl
     * @param DistributionListAction $action
     * @return self
     */
    public function __construct(DistributionListSelector $dl, DistributionListAction $action)
    {
        $this->setDl($dl)
             ->setAction($action);
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
     * Get the action.
     *
     * @return DistributionListAction
     */
    public function getAction(): DistributionListAction
    {
        return $this->action;
    }

    /**
     * Set the action.
     *
     * @param  DistributionListAction $action
     * @return self
     */
    public function setAction(DistributionListAction $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DistributionListActionEnvelope(
            new DistributionListActionBody($this)
        );
    }
}
