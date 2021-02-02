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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Soap\ResponseInterface;

/**
 * ApplyOutgoingFilterRulesResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ApplyOutgoingFilterRulesResponse")
 */
class ApplyOutgoingFilterRulesResponse implements ResponseInterface
{
    /**
     * Comma-separated list of message IDs that were affected
     * @Accessor(getter="getMsgIds", setter="setMsgIds")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\IdsAttr")
     * @XmlElement
     */
    private $msgIds;

    /**
     * Constructor method for ApplyOutgoingFilterRulesResponse
     *
     * @param  IdsAttr $msgIds
     * @return self
     */
    public function __construct(?IdsAttr $msgIds = NULL)
    {
        if ($msgIds instanceof IdsAttr) {
            $this->setMsgIds($msgIds);
        }
    }

    /**
     * Gets msgIds
     *
     * @return IdsAttr
     */
    public function getMsgIds(): ?IdsAttr
    {
        return $this->msgIds;
    }

    /**
     * Sets msgIds
     *
     * @param  IdsAttr $msgIds
     * @return self
     */
    public function setMsgIds(IdsAttr $msgIds): self
    {
        $this->msgIds = $msgIds;
        return $this;
    }
}
