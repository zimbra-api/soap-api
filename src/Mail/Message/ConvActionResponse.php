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
use Zimbra\Mail\Struct\ActionResult;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ConvActionResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConvActionResponse extends SoapResponse
{
    /**
     * Action result
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\ActionResult")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ActionResult
     */
    #[Accessor(getter: "getAction", setter: "setAction")]
    #[SerializedName(name: 'action')]
    #[Type(name: ActionResult::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $action;

    /**
     * Constructor
     *
     * @param  ActionResult $action
     * @return self
     */
    public function __construct(?ActionResult $action = NULL)
    {
        if ($action instanceof ActionResult) {
            $this->setAction($action);
        }
    }

    /**
     * Get action
     *
     * @return ActionResult
     */
    public function getAction(): ?ActionResult
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  ActionResult $action
     * @return self
     */
    public function setAction(ActionResult $action): self
    {
        $this->action = $action;
        return $this;
    }
}
