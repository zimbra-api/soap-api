<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\AutoProvTaskStatus;
use Zimbra\Soap\ResponseInterface;

/**
 * AutoProvTaskControlResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AutoProvTaskControlResponse")
 */
class AutoProvTaskControlResponse implements ResponseInterface
{

    /**
     * Auth token
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Enum\AutoProvTaskStatus")
     * @XmlAttribute
     */
    private $status;

    /**
     * Constructor method for AutoProvTaskControlResponse
     * @param AutoProvTaskStatus $status
     * @return self
     */
    public function __construct(AutoProvTaskStatus $status)
    {
        $this->setStatus($status);
    }

    /**
     * Gets the status.
     *
     * @return AutoProvTaskStatus
     */
    public function getStatus(): AutoProvTaskStatus
    {
        return $this->status;
    }

    /**
     * Sets the status.
     *
     * @param  AutoProvTaskStatus $status
     * @return self
     */
    public function setStatus(AutoProvTaskStatus $status): self
    {
        $this->status = $status;
        return $this;
    }
}
