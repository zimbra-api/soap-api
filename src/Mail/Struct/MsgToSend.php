<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\ReplyType;

/**
 * MsgToSend class
 * Message to send input.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MsgToSend extends Msg
{
    /**
     * Saved draft ID
     *
     * @var string
     */
    #[Accessor(getter: "getDraftId", setter: "setDraftId")]
    #[SerializedName("did")]
    #[Type("string")]
    #[XmlAttribute]
    private $draftId;

    /**
     * If set, message gets constructed based on the "did" (id of the draft).
     *
     * @var bool
     */
    #[Accessor(getter: "getSendFromDraft", setter: "setSendFromDraft")]
    #[SerializedName("sfd")]
    #[Type("bool")]
    #[XmlAttribute]
    private $sendFromDraft;

    /**
     * Id of the data source in case SMTP settings of that data source must be used for sending the message.
     *
     * @var string
     */
    #[Accessor(getter: "getDataSourceId", setter: "setDataSourceId")]
    #[SerializedName("dsId")]
    #[Type("string")]
    #[XmlAttribute]
    private $dataSourceId;

    /**
     * Constructor
     *
     * @param  string $attachmentId
     * @param  string $origId
     * @param  ReplyType $replyType
     * @param  string $identityId
     * @param  string $subject
     * @param  array $headers
     * @param  string $inReplyTo
     * @param  string $folderId
     * @param  string $flags
     * @param  string $content
     * @param  MimePartInfo $mimePart
     * @param  AttachmentsInfo $attachments
     * @param  InvitationInfo $invite
     * @param  array $emailAddresses
     * @param  array $timezones
     * @param  string $fragment
     * @param  string $draftId
     * @param  bool $sendFromDraft
     * @param  string $dataSourceId
     * @return self
     */
    public function __construct(
        ?string $attachmentId = null,
        ?string $origId = null,
        ?ReplyType $replyType = null,
        ?string $identityId = null,
        ?string $subject = null,
        array $headers = [],
        ?string $inReplyTo = null,
        ?string $folderId = null,
        ?string $flags = null,
        ?string $content = null,
        ?MimePartInfo $mimePart = null,
        ?AttachmentsInfo $attachments = null,
        ?InvitationInfo $invite = null,
        array $emailAddresses = [],
        array $timezones = [],
        ?string $fragment = null,
        ?string $draftId = null,
        ?bool $sendFromDraft = null,
        ?string $dataSourceId = null
    ) {
        parent::__construct(
            $attachmentId,
            $origId,
            $replyType,
            $identityId,
            $subject,
            $headers,
            $inReplyTo,
            $folderId,
            $flags,
            $content,
            $mimePart,
            $attachments,
            $invite,
            $emailAddresses,
            $timezones,
            $fragment
        );
        if (null !== $draftId) {
            $this->setDraftId($draftId);
        }
        if (null !== $sendFromDraft) {
            $this->setSendFromDraft($sendFromDraft);
        }
        if (null !== $dataSourceId) {
            $this->setDataSourceId($dataSourceId);
        }
    }

    /**
     * Get draftId
     *
     * @return string
     */
    public function getDraftId(): ?string
    {
        return $this->draftId;
    }

    /**
     * Set draftId
     *
     * @param  string $draftId
     * @return self
     */
    public function setDraftId(string $draftId): self
    {
        $this->draftId = $draftId;
        return $this;
    }

    /**
     * Get sendFromDraft
     *
     * @return bool
     */
    public function getSendFromDraft(): ?bool
    {
        return $this->sendFromDraft;
    }

    /**
     * Set sendFromDraft
     *
     * @param  bool $sendFromDraft
     * @return self
     */
    public function setSendFromDraft(bool $sendFromDraft): self
    {
        $this->sendFromDraft = $sendFromDraft;
        return $this;
    }

    /**
     * Get dataSourceId
     *
     * @return string
     */
    public function getDataSourceId(): ?string
    {
        return $this->dataSourceId;
    }

    /**
     * Set dataSourceId
     *
     * @param  string $dataSourceId
     * @return self
     */
    public function setDataSourceId(string $dataSourceId): self
    {
        $this->dataSourceId = $dataSourceId;
        return $this;
    }
}
