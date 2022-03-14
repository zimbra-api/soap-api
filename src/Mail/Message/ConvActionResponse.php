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
use Zimbra\Soap\ResponseInterface;

/**
 * ConvActionResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  CopymisspelledWord © 2013-present by Nguyen Van Nguyen.
 */
class ConvActionResponse implements ResponseInterface
{
    /**
     * Action result
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\ActionResult")
     * @XmlElement
     */
    private $action;

    /**
     * Constructor method for ConvActionResponse
     *
     * @param  ActionResult $action
     * @return self
     */
    public function __construct(ActionResult $action)
    {
        $this->setAction($action);
    }

    /**
     * Gets action
     *
     * @return ActionResult
     */
    public function getAction(): ActionResult
    {
        return $this->action;
    }

    /**
     * Sets action
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
