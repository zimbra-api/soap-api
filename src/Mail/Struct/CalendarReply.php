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
use Zimbra\Common\Enum\ParticipationStatus;
use Zimbra\Common\Struct\CalendarReplyInterface;

/**
 * CalendarReply class
 * Calendar reply information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalendarReply extends RecurIdInfo implements CalendarReplyInterface
{
    /**
     * Sequence number
     *
     * @var int
     */
    #[Accessor(getter: "getSeq", setter: "setSeq")]
    #[SerializedName("seq")]
    #[Type("int")]
    #[XmlAttribute]
    private int $seq;

    /**
     * DTSTAMP date in milliseconds
     *
     * @var int
     */
    #[Accessor(getter: "getDate", setter: "setDate")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private int $date;

    /**
     * Attendee address
     *
     * @var string
     */
    #[Accessor(getter: "getAttendee", setter: "setAttendee")]
    #[SerializedName("at")]
    #[Type("string")]
    #[XmlAttribute]
    private string $attendee;

    /**
     * iCalendar SENT-BY
     *
     * @var string
     */
    #[Accessor(getter: "getSentBy", setter: "setSentBy")]
    #[SerializedName("sentBy")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $sentBy = null;

    /**
     * iCalendar PTST (Participation status)
     * Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF
     * Meanings:
     * "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo),
     * "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     *
     * @var ParticipationStatus
     */
    #[Accessor(getter: "getPartStat", setter: "setPartStat")]
    #[SerializedName("ptst")]
    #[XmlAttribute]
    private ?ParticipationStatus $partStat;

    /**
     * Constructor
     *
     * @param  int $recurrenceRangeType
     * @param  string $recurrenceId
     * @param  int $seq
     * @param  int $date
     * @param  string $attendee
     * @param  string $sentBy
     * @param  ParticipationStatus $partStat
     * @return self
     */
    public function __construct(
        int $recurrenceRangeType = 0,
        string $recurrenceId = "",
        int $seq = 0,
        int $date = 0,
        string $attendee = "",
        ?string $sentBy = null,
        ?ParticipationStatus $partStat = null
    ) {
        parent::__construct($recurrenceRangeType, $recurrenceId);
        $this->setSeq($seq)->setDate($date)->setAttendee($attendee);
        $this->partStat = $partStat;
        if (null != $sentBy) {
            $this->setSentBy($sentBy);
        }
    }

    /**
     * Get seq
     *
     * @return int
     */
    public function getSeq(): int
    {
        return $this->seq;
    }

    /**
     * Set seq
     *
     * @param  int $seq
     * @return self
     */
    public function setSeq(int $seq): self
    {
        $this->seq = $seq;
        return $this;
    }

    /**
     * Get date
     *
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get attendee
     *
     * @return string
     */
    public function getAttendee(): string
    {
        return $this->attendee;
    }

    /**
     * Set attendee
     *
     * @param  string $attendee
     * @return self
     */
    public function setAttendee(string $attendee): self
    {
        $this->attendee = $attendee;
        return $this;
    }

    /**
     * Get sentBy
     *
     * @return string
     */
    public function getSentBy(): ?string
    {
        return $this->sentBy;
    }

    /**
     * Set sentBy
     *
     * @param  string $sentBy
     * @return self
     */
    public function setSentBy(string $sentBy): self
    {
        $this->sentBy = $sentBy;
        return $this;
    }

    /**
     * Get partStat
     *
     * @return ParticipationStatus
     */
    public function getPartStat(): ?ParticipationStatus
    {
        return $this->partStat;
    }

    /**
     * Set partStat
     *
     * @param  ParticipationStatus $partStat
     * @return self
     */
    public function setPartStat(ParticipationStatus $partStat): self
    {
        $this->partStat = $partStat;
        return $this;
    }
}
