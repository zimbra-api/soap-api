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
use Zimbra\Enum\AutoProvTaskAction;
use Zimbra\Soap\Request;

/**
 * AutoProvTaskControlRequest class
 * Auto-provision an account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AutoProvTaskControlRequest")
 */
class AutoProvTaskControlRequest extends Request
{
    /**
     * Action to perform - one of start|status|stop
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Enum\AutoProvTaskAction")
     * @XmlAttribute()
     */
    private $action;

    /**
     * Constructor method for AutoProvTaskControlRequest
     * @param AutoProvTaskAction  $action Action to perform
     * @return self
     */
    public function __construct(AutoProvTaskAction $action)
    {
        $this->setAction($action);
    }

    /**
     * Gets the action.
     *
     * @return AutoProvTaskAction
     */
    public function getAction(): AutoProvTaskAction
    {
        return $this->action;
    }

    /**
     * Sets the action.
     *
     * @param  AutoProvTaskAction $action
     * @return self
     */
    public function setAction(AutoProvTaskAction $action): self
    {
        $this->action = $action;
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new AutoProvTaskControlEnvelope(
            NULL,
            new AutoProvTaskControlBody($this)
        );
    }
}
