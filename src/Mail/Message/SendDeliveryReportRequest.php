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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SendDeliveryReportRequest class
 * Send a delivery report
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SendDeliveryReportRequest extends SoapRequest
{
    /**
     * Message ID
     * 
     * @Accessor(getter="getMessageId", setter="setMessageId")
     * @SerializedName("mid")
     * @Type("string")
     * @XmlAttribute
     */
    private $messageId;

    /**
     * Constructor method for SendDeliveryReportRequest
     *
     * @param  string $messageId
     * @return self
     */
    public function __construct(string $messageId = '')
    {
        $this->setMessageId($messageId);
    }

    /**
     * Gets messageId
     *
     * @return string
     */
    public function getMessageId(): ?string
    {
        return $this->messageId;
    }

    /**
     * Sets messageId
     *
     * @param  string $messageId
     * @return self
     */
    public function setMessageId(string $messageId): self
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SendDeliveryReportEnvelope(
            new SendDeliveryReportBody($this)
        );
    }
}
