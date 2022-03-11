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

/**
 * MsgToSend class
 * Message to send input.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MsgToSend extends Msg
{
    /**
     * Saved draft ID
     * @Accessor(getter="getDraftId", setter="setDraftId")
     * @SerializedName("did")
     * @Type("string")
     * @XmlAttribute
     */
    private $draftId;

    /**
     * If set, message gets constructed based on the "did" (id of the draft).
     * @Accessor(getter="getSendFromDraft", setter="setSendFromDraft")
     * @SerializedName("sfd")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sendFromDraft;

    /**
     * Id of the data source in case SMTP settings of that data source must be used for sending the message.
     * @Accessor(getter="getDataSourceId", setter="setDataSourceId")
     * @SerializedName("dsId")
     * @Type("string")
     * @XmlAttribute
     */
    private $dataSourceId;

    /**
     * Gets draftId
     *
     * @return string
     */
    public function getDraftId(): ?string
    {
        return $this->draftId;
    }

    /**
     * Sets draftId
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
     * Gets sendFromDraft
     *
     * @return int
     */
    public function getSendFromDraft(): ?int
    {
        return $this->sendFromDraft;
    }

    /**
     * Sets sendFromDraft
     *
     * @param  int $sendFromDraft
     * @return self
     */
    public function setSendFromDraft(int $sendFromDraft): self
    {
        if($sendFromDraft != 0 && abs($sendFromDraft) < 54) {
            $this->sendFromDraft = $sendFromDraft;
        }
        return $this;
    }

    /**
     * Gets dataSourceId
     *
     * @return string
     */
    public function getDataSourceId(): ?string
    {
        return $this->dataSourceId;
    }

    /**
     * Sets dataSourceId
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
