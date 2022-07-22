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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\AutoProvTaskStatus;
use Zimbra\Common\Soap\ResponseInterface;

/**
 * AutoProvTaskControlResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AutoProvTaskControlResponse implements ResponseInterface
{
    /**
     * Auth token
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Common\Enum\AutoProvTaskStatus")
     * @XmlAttribute
     */
    private ?AutoProvTaskStatus $status = NULL;

    /**
     * Constructor method for AutoProvTaskControlResponse
     *
     * @param AutoProvTaskStatus $status
     * @return self
     */
    public function __construct(?AutoProvTaskStatus $status = NULL)
    {
        if ($status instanceof AutoProvTaskStatus) {
            $this->setStatus($status);
        }
    }

    /**
     * Gets the status.
     *
     * @return AutoProvTaskStatus
     */
    public function getStatus(): ?AutoProvTaskStatus
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
