<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\{
    CalTZInfo,
    CancelItemRecur,
    ExceptionItemRecur,
    InviteItemRecur,
};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetRecurResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetRecurResponse extends SoapResponse
{
    /**
     * Timezone
     * 
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("tz")
     * @Type("Zimbra\Mail\Struct\CalTZInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?CalTZInfo $timezone = NULL;

    /**
     * Cancel recurrence component
     * 
     * @Accessor(getter="getCancelComponent", setter="setCancelComponent")
     * @SerializedName("cancel")
     * @Type("Zimbra\Mail\Struct\CancelItemRecur")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?CancelItemRecur $cancelComponent = NULL;

    /**
     * Except recurrence component
     * 
     * @Accessor(getter="getExceptComponent", setter="setExceptComponent")
     * @SerializedName("except")
     * @Type("Zimbra\Mail\Struct\ExceptionItemRecur")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ExceptionItemRecur $exceptComponent = NULL;

    /**
     * Invite recurrence component
     * 
     * @Accessor(getter="getInviteComponent", setter="setInviteComponent")
     * @SerializedName("comp")
     * @Type("Zimbra\Mail\Struct\InviteItemRecur")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?InviteItemRecur $inviteComponent = NULL;

    /**
     * Constructor method for GetRecurResponse
     *
     * @param  CalTZInfo $timezone
     * @param  CancelItemRecur $cancelComponent
     * @param  ExceptionItemRecur $exceptComponent
     * @param  InviteItemRecur $inviteComponent
     * @return self
     */
    public function __construct(
        ?CalTZInfo $timezone = NULL,
        ?CancelItemRecur $cancelComponent = NULL,
        ?ExceptionItemRecur $exceptComponent = NULL,
        ?InviteItemRecur $inviteComponent = NULL
    )
    {
        if ($timezone instanceof CalTZInfo) {
            $this->setTimezone($timezone);
        }
        if ($cancelComponent instanceof CancelItemRecur) {
            $this->setCancelComponent($cancelComponent);
        }
        if ($exceptComponent instanceof ExceptionItemRecur) {
            $this->setExceptComponent($exceptComponent);
        }
        if ($inviteComponent instanceof InviteItemRecur) {
            $this->setInviteComponent($inviteComponent);
        }
    }

    /**
     * Get timezone
     *
     * @return CalTZInfo
     */
    public function getTimezone(): ?CalTZInfo
    {
        return $this->timezone;
    }

    /**
     * Set timezone
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function setTimezone(CalTZInfo $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Get cancelComponent
     *
     * @return CancelItemRecur
     */
    public function getCancelComponent(): ?CancelItemRecur
    {
        return $this->cancelComponent;
    }

    /**
     * Set cancelComponent
     *
     * @param  CancelItemRecur $cancelComponent
     * @return self
     */
    public function setCancelComponent(CancelItemRecur $cancelComponent): self
    {
        $this->cancelComponent = $cancelComponent;
        return $this;
    }

    /**
     * Get exceptComponent
     *
     * @return ExceptionItemRecur
     */
    public function getExceptComponent(): ?ExceptionItemRecur
    {
        return $this->exceptComponent;
    }

    /**
     * Set exceptComponent
     *
     * @param  ExceptionItemRecur $exceptComponent
     * @return self
     */
    public function setExceptComponent(ExceptionItemRecur $exceptComponent): self
    {
        $this->exceptComponent = $exceptComponent;
        return $this;
    }

    /**
     * Get inviteComponent
     *
     * @return InviteItemRecur
     */
    public function getInviteComponent(): ?InviteItemRecur
    {
        return $this->inviteComponent;
    }

    /**
     * Set inviteComponent
     *
     * @param  InviteItemRecur $inviteComponent
     * @return self
     */
    public function setInviteComponent(InviteItemRecur $inviteComponent): self
    {
        $this->inviteComponent = $inviteComponent;
        return $this;
    }
}
