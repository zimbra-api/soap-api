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
use Zimbra\Mail\Struct\SaveDraftMsg;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * SaveDraftRequest class
 * Save draft
 * - Only allowed one top-level <mp> but can nest <mp>s within if multipart/* on reply/forward.
 *   Set origid on <m> element and set rt to "r" or "w", respectively.
 * - Can optionally set identity-id to specify the identity being used to compose the message.  If updating an
 *   existing draft, set "id" attr on <m> element.
 * - Can refer to parts of existing draft in <attach> block
 * - Drafts default to the Drafts folder
 * - Setting folder/tags/flags/color occurs <b>after</b> the draft is created/updated, and if it fails the content
 *   WILL STILL BE SAVED
 * - Can optionally set autoSendTime to specify the time at which the draft should be automatically sent by the server
 * - The ID of the saved draft is returned in the "id" attribute of the response.
 * - The ID referenced in the response's "idnt" attribute specifies the folder where the sent message is saved.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SaveDraftRequest extends Request
{
    /**
     * Set to return IMAP UID.  (default is unset.)
     * 
     * @Accessor(getter="getWantImapUid", setter="setWantImapUid")
     * @SerializedName("wantImapUid")
     * @Type("bool")
     * @XmlAttribute
     */
    private $wantImapUid;

    /**
     * Set to return Modified Sequence.  (default is unset.)
     * 
     * @Accessor(getter="getWantModifiedSequence", setter="setWantModifiedSequence")
     * @SerializedName("wantModSeq")
     * @Type("bool")
     * @XmlAttribute
     */
    private $wantModifiedSequence;

    /**
     * Details of Draft to save
     * 
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\SaveDraftMsg")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private SaveDraftMsg $msg;

    /**
     * Constructor method for SaveDraftRequest
     *
     * @param  SaveDraftMsg $msg
     * @param  bool $wantImapUid
     * @param  bool $wantModifiedSequence
     * @return self
     */
    public function __construct(
        SaveDraftMsg $msg,
        ?bool $wantImapUid = NULL,
        ?bool $wantModifiedSequence = NULL
    )
    {
        $this->setMsg($msg);
        if (NULL !== $wantImapUid) {
            $this->setWantImapUid($wantImapUid);
        }
        if (NULL !== $wantModifiedSequence) {
            $this->setWantModifiedSequence($wantModifiedSequence);
        }
    }

    /**
     * Sets wantImapUid
     *
     * @param  array $wantImapUid
     * @return self
     */
    public function setWantImapUid(bool $wantImapUid): self
    {
        $this->wantImapUid = $wantImapUid;
        return $this;
    }

    /**
     * Gets wantImapUid
     *
     * @return bool
     */
    public function getWantImapUid(): ?bool
    {
        return $this->wantImapUid;
    }

    /**
     * Sets wantModifiedSequence
     *
     * @param  array $wantModifiedSequence
     * @return self
     */
    public function setWantModifiedSequence(bool $wantModifiedSequence): self
    {
        $this->wantModifiedSequence = $wantModifiedSequence;
        return $this;
    }

    /**
     * Gets wantModifiedSequence
     *
     * @return bool
     */
    public function getWantModifiedSequence(): ?bool
    {
        return $this->wantModifiedSequence;
    }

    /**
     * Gets msg
     *
     * @return SaveDraftMsg
     */
    public function getMsg(): SaveDraftMsg
    {
        return $this->msg;
    }

    /**
     * Sets msg
     *
     * @param  SaveDraftMsg $msg
     * @return self
     */
    public function setMsg(SaveDraftMsg $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new SaveDraftEnvelope(
            new SaveDraftBody($this)
        );
    }
}