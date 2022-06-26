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
use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetMsgMetadataRequest class
 * Get message metadata
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetMsgMetadataRequest extends Request
{
    /**
     * Messages selector
     * @Accessor(getter="getMsgIds", setter="setMsgIds")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\IdsAttr")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private IdsAttr $msgIds;

    /**
     * Constructor method for GetMsgMetadataRequest
     *
     * @param  IdsAttr $msgIds
     * @return self
     */
    public function __construct(IdsAttr $msgIds)
    {
        $this->setMsgIds($msgIds);
    }

    /**
     * Gets msgIds
     *
     * @return IdsAttr
     */
    public function getMsgIds(): IdsAttr
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

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetMsgMetadataEnvelope(
            new GetMsgMetadataBody($this)
        );
    }
}
