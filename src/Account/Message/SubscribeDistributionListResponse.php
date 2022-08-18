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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\DistributionListSubscribeStatus as SubscribeStatus;
use Zimbra\Common\Struct\SoapResponse;

/**
 * SubscribeDistributionListResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SubscribeDistributionListResponse extends SoapResponse
{
    /**
     * Status of subscription attempt
     * 
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Enum<Zimbra\Common\Enum\DistributionListSubscribeStatus>")
     * @XmlAttribute
     * 
     * @var SubscribeStatus
     */
    #[Accessor(getter: 'getStatus', setter: 'setStatus')]
    #[SerializedName('status')]
    #[Type('Enum<Zimbra\Common\Enum\DistributionListSubscribeStatus>')]
    #[XmlAttribute]
    private $status;

    /**
     * Constructor
     *
     * @param  SubscribeStatus $status
     * @return self
     */
    public function __construct(?SubscribeStatus $status = NULL)
    {
        $this->setStatus($status ?? new SubscribeStatus('subscribed'));
    }

    /**
     * Get status
     *
     * @return SubscribeStatus
     */
    public function getStatus(): SubscribeStatus
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  SubscribeStatus $status
     * @return self
     */
    public function setStatus(SubscribeStatus $status): self
    {
        $this->status = $status;
        return $this;
    }
}
