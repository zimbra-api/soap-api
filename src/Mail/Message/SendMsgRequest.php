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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\MsgToSend;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * SendMsgRequest class
 * Send message
 * 
 * - Supports (f)rom, (t)o, (c)c, (b)cc, (r)eply-to, (s)ender, read-receipt (n)otification "type" on
 *      <e> elements.
 * - Only allowed one top-level <mp> but can nest <mp>s within if multipart/*
 * - A leaf <mp> can have inlined content (<mp ct="{content-type}"><content>...</content></mp>)
 * - A leaf <mp> can have referenced content (<mp><attach ...></mp>)
 * - Any <mp> can have a Content-ID header attached to it.
 * - On reply/forward, set origid on <m> element and set rt to "r" or "w", respectively
 * - Can optionally set identity-id to specify the identity being used to compose the message
 * - If noSave is set, a copy will not be saved to sent regardless of account/identity settings
 * - Can set priority high (!) or low (?) on sent message by specifying "f" attr on <m>
 * - The message to be sent can be fully specified under the <m> element or, to compose the message
 *      remotely remotely, upload it via FileUploadServlet, and submit it through our server using something like:
 *      <code>
 *         <SendMsgRequest [suid="{send-uid}"] [needCalendarSentByFixup="0|1"]>
 *             <m aid="{uploaded-MIME-body-ID}" [origid="..." rt="r|w"]/>
 *         </SendMsgRequest>
 *      </code>
 * - If the message is saved to the sent folder then the ID of the message is returned.  Otherwise, no ID is
 *      returned -- just a <m> is returned.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SendMsgRequest extends Request
{
    /**
     * Message
     * 
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MsgToSend")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private MsgToSend $msg;

    /**
     * If set then Add SENT-BY parameter to ORGANIZER and/or ATTENDEE properties in
     * iCalendar part when sending message on behalf of another user.  Default is unset.
     * 
     * @Accessor(getter="getNeedCalendarSentbyFixup", setter="setNeedCalendarSentbyFixup")
     * @SerializedName("needCalendarSentByFixup")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needCalendarSentbyFixup;

    /**
     * Indicates whether this a forward of calendar invitation in which
     * case the server sends Forward Invitation Notification, default is unset.
     * 
     * @Accessor(getter="getIsCalendarForward", setter="setIsCalendarForward")
     * @SerializedName("isCalendarForward")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isCalendarForward;

    /**
     * If set, a copy will not be saved to sent regardless of account/identity settings
     * 
     * @Accessor(getter="getNoSaveToSent", setter="setNoSaveToSent")
     * @SerializedName("noSave")
     * @Type("bool")
     * @XmlAttribute
     */
    private $noSaveToSent;

    /**
     * If set, return the copy of the sent message, if it was saved, in the response.
     * 
     * @Accessor(getter="getFetchSavedMsg", setter="setFetchSavedMsg")
     * @SerializedName("fetchSavedMsg")
     * @Type("bool")
     * @XmlAttribute
     */
    private $fetchSavedMsg;

    /**
     * Send UID
     * 
     * @Accessor(getter="getSendUid", setter="setSendUid")
     * @SerializedName("suid")
     * @Type("string")
     * @XmlAttribute
     */
    private $sendUid;

    /**
     * If set, delivery receipt notification will be sent.
     * 
     * @Accessor(getter="getDeliveryReport", setter="setDeliveryReport")
     * @SerializedName("deliveryReport")
     * @Type("bool")
     * @XmlAttribute
     */
    private $deliveryReport;

    /**
     * Constructor method for SendMsgRequest
     * 
     * @param MsgToSend $msg
     * @param bool $needCalendarSentbyFixup
     * @param bool $isCalendarForward
     * @param bool $noSaveToSent
     * @param bool $fetchSavedMsg
     * @param string $sendUid
     * @param bool $deliveryReport
     * @return self
     */
    public function __construct(
        MsgToSend $msg,
        ?bool $needCalendarSentbyFixup = NULL,
        ?bool $isCalendarForward = NULL,
        ?bool $noSaveToSent = NULL,
        ?bool $fetchSavedMsg = NULL,
        ?string $sendUid = NULL,
        ?bool $deliveryReport = NULL
    )
    {
        $this->setMsg($msg);
        if (NULL !== $needCalendarSentbyFixup) {
            $this->setNeedCalendarSentbyFixup($needCalendarSentbyFixup);
        }
        if (NULL !== $isCalendarForward) {
            $this->setIsCalendarForward($isCalendarForward);
        }
        if (NULL !== $noSaveToSent) {
            $this->setNoSaveToSent($noSaveToSent);
        }
        if (NULL !== $fetchSavedMsg) {
            $this->setFetchSavedMsg($fetchSavedMsg);
        }
        if (NULL !== $sendUid) {
            $this->setSendUid($sendUid);
        }
        if (NULL !== $deliveryReport) {
            $this->setDeliveryReport($deliveryReport);
        }
    }

    /**
     * Gets the msg.
     *
     * @return MsgToSend
     */
    public function getMsg(): MsgToSend
    {
        return $this->msg;
    }

    /**
     * Sets the msg.
     *
     * @param  MsgToSend $msg
     * @return self
     */
    public function setMsg(MsgToSend $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Gets needCalendarSentbyFixup
     *
     * @return bool
     */
    public function getNeedCalendarSentbyFixup(): ?bool
    {
        return $this->needCalendarSentbyFixup;
    }

    /**
     * Sets needCalendarSentbyFixup
     *
     * @param  bool $needCalendarSentbyFixup
     * @return self
     */
    public function setNeedCalendarSentbyFixup(bool $needCalendarSentbyFixup): self
    {
        $this->needCalendarSentbyFixup = $needCalendarSentbyFixup;
        return $this;
    }

    /**
     * Gets isCalendarForward
     *
     * @return bool
     */
    public function getIsCalendarForward(): ?bool
    {
        return $this->isCalendarForward;
    }

    /**
     * Sets isCalendarForward
     *
     * @param  bool $isCalendarForward
     * @return self
     */
    public function setIsCalendarForward(bool $isCalendarForward): self
    {
        $this->isCalendarForward = $isCalendarForward;
        return $this;
    }

    /**
     * Gets noSaveToSent
     *
     * @return bool
     */
    public function getNoSaveToSent(): ?bool
    {
        return $this->noSaveToSent;
    }

    /**
     * Sets noSaveToSent
     *
     * @param  bool $noSaveToSent
     * @return self
     */
    public function setNoSaveToSent(bool $noSaveToSent): self
    {
        $this->noSaveToSent = $noSaveToSent;
        return $this;
    }

    /**
     * Gets fetchSavedMsg
     *
     * @return bool
     */
    public function getFetchSavedMsg(): ?bool
    {
        return $this->fetchSavedMsg;
    }

    /**
     * Sets fetchSavedMsg
     *
     * @param  bool $fetchSavedMsg
     * @return self
     */
    public function setFetchSavedMsg(bool $fetchSavedMsg): self
    {
        $this->fetchSavedMsg = $fetchSavedMsg;
        return $this;
    }

    /**
     * Gets sendUid
     *
     * @return string
     */
    public function getSendUid(): ?string
    {
        return $this->sendUid;
    }

    /**
     * Sets sendUid
     *
     * @param  string $sendUid
     * @return self
     */
    public function setSendUid(string $sendUid): self
    {
        $this->sendUid = $sendUid;
        return $this;
    }

    /**
     * Gets deliveryReport
     *
     * @return bool
     */
    public function getDeliveryReport(): ?bool
    {
        return $this->deliveryReport;
    }

    /**
     * Sets deliveryReport
     *
     * @param  bool $deliveryReport
     * @return self
     */
    public function setDeliveryReport(bool $deliveryReport): self
    {
        $this->deliveryReport = $deliveryReport;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new SendMsgEnvelope(
            new SendMsgBody($this)
        );
    }
}
