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
use Zimbra\Common\Enum\AutoProvTaskAction;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * AutoProvTaskControlRequest class
 * Under normal situations, the EAGER auto provisioning task(thread) should be started/stopped automatically by the server when appropriate.
 * The task should be running when zimbraAutoProvPollingInterval is not 0 and zimbraAutoProvScheduledDomains is not empty.
 * The task should be stopped otherwise. This API is to manually force start/stop or query status of the EAGER auto provisioning task.
 * It is only for diagnosis purpose and should not be used under normal situations.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoProvTaskControlRequest extends SoapRequest
{
    /**
     * Action to perform - one of start|status|stop
     * 
     * @var AutoProvTaskAction
     */
    #[Accessor(getter: 'getAction', setter: 'setAction')]
    #[SerializedName('action')]
    #[Type('Enum<Zimbra\Common\Enum\AutoProvTaskAction>')]
    #[XmlAttribute]
    private $action;

    /**
     * Constructor
     * 
     * @param AutoProvTaskAction $action
     * @return self
     */
    public function __construct(AutoProvTaskAction $action)
    {
        $this->setAction($action);
    }

    /**
     * Get the action.
     *
     * @return AutoProvTaskAction
     */
    public function getAction(): AutoProvTaskAction
    {
        return $this->action;
    }

    /**
     * Set the action.
     *
     * @param  AutoProvTaskAction $action
     * @return self
     */
    public function setAction(AutoProvTaskAction $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AutoProvTaskControlEnvelope(
            new AutoProvTaskControlBody($this)
        );
    }
}
