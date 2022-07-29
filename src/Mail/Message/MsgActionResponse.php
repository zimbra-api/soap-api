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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * MsgActionResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MsgActionResponse implements SoapResponseInterface
{
    /**
     * The <action> element in the response always contains the same id list that the client sent in the request.
     * In particular, IDs that were ignored due to constraints are included in the id list.
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\ActionResult")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ActionResult $action = NULL;

    /**
     * Constructor method for MsgActionResponse
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
