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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CalendarReply extends RecurIdInfo implements CalendarReplyInterface
{
    /**
     * Sequence number
     * @Accessor(getter="getSeq", setter="setSeq")
     * @SerializedName("seq")
     * @Type("integer")
     * @XmlAttribute
     */
    private $seq;

    /**
     * DTSTAMP date in milliseconds
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("integer")
     * @XmlAttribute
     */
    private $date;

    /**
     * Attendee address
     * @Accessor(getter="getAttendee", setter="setAttendee")
     * @SerializedName("at")
     * @Type("string")
     * @XmlAttribute
     */
    private $attendee;

    /**
     * iCalendar SENT-BY
     * @Accessor(getter="getSentBy", setter="setSentBy")
     * @SerializedName("sentBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $sentBy;

    /**
     * iCalendar PTST (Participation status)
     * Valid values: <b>NE|AC|TE|DE|DG|CO|IN|WE|DF</b>
     * Meanings:
     * "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo),
     * "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * @Accessor(getter="getPartStat", setter="setPartStat")
     * @SerializedName("ptst")
     * @Type("Zimbra\Common\Enum\ParticipationStatus")
     * @XmlAttribute
     */
    private ?ParticipationStatus $partStat = NULL;

    /**
     * Constructor method for CalendarReply
     *
     * @param  int $recurrenceRangeType
     * @param  int $recurrenceId
     * @param  int $seq
     * @param  int $date
     * @param  string $attendee
     * @return self
     */
    public function __construct(
        int $recurrenceRangeType,
        string $recurrenceId,
        int $seq,
        int $date,
        string $attendee,
        ?string $sentBy = NULL,
        ?ParticipationStatus $partStat = NULL
    )
    {
        parent::__construct($recurrenceRangeType, $recurrenceId);
        $this->setSeq($seq)
             ->setDate($date)
             ->setAttendee($attendee);
        if (NULL != $sentBy) {
            $this->setSentBy($sentBy);
        }
        if ($partStat instanceof ParticipationStatus) {
            $this->setPartStat($partStat);
        }
    }

    /**
     * Gets seq
     *
     * @return int
     */
    public function getSeq(): int
    {
        return $this->seq;
    }

    /**
     * Sets seq
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
     * Gets date
     *
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * Sets date
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
     * Gets attendee
     *
     * @return string
     */
    public function getAttendee(): string
    {
        return $this->attendee;
    }

    /**
     * Sets attendee
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
     * Gets sentBy
     *
     * @return string
     */
    public function getSentBy(): ?string
    {
        return $this->sentBy;
    }

    /**
     * Sets sentBy
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
     * Gets partStat
     *
     * @return ParticipationStatus
     */
    public function getPartStat(): ?ParticipationStatus
    {
        return $this->partStat;
    }

    /**
     * Sets partStat
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
