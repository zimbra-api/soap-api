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
use Zimbra\Enum\DistributionListSubscribeStatus as SubscribeStatus;
use Zimbra\Soap\ResponseInterface;

/**
 * SubscribeDistributionListResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SubscribeDistributionListResponse implements ResponseInterface
{
    /**
     * Status of subscription attempt
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Enum\DistributionListSubscribeStatus")
     * @XmlAttribute
     */
    private $status;

    /**
     * Constructor method for SubscribeDistributionListResponse
     *
     * @param  DistributionListSubscribeStatus $status
     * @param  int $lifetime
     * @return self
     */
    public function __construct(SubscribeStatus $status)
    {
        $this->setStatus($status);
    }

    /**
     * Gets new auth token
     *
     * @return SubscribeStatus
     */
    public function getStatus(): SubscribeStatus
    {
        return $this->status;
    }

    /**
     * Sets new auth token
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
