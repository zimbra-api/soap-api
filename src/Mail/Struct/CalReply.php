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

/**
 * CalReply class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalReply extends RecurIdInfo
{
    /**
     * Address of attendee who replied
     * 
     * @Accessor(getter="getAttendee", setter="setAttendee")
     * @SerializedName("at")
     * @Type("string")
     * @XmlAttribute
     */
    private $attendee;

    /**
     * SENT-BY
     * 
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
     * 
     * @Accessor(getter="getPartStat", setter="setPartStat")
     * @SerializedName("ptst")
     * @Type("Enum<Zimbra\Common\Enum\ParticipationStatus>")
     * @XmlAttribute
     */
    private ?ParticipationStatus $partStat = NULL;

    /**
     * Sequence
     * 
     * @Accessor(getter="getSequence", setter="setSequence")
     * @SerializedName("seq")
     * @Type("integer")
     * @XmlAttribute
     */
    private $sequence;

    /**
     * Timestamp of reply
     * 
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("integer")
     * @XmlAttribute
     */
    private $date;

    /**
     * Constructor
     *
     * @param  int $recurrenceRangeType
     * @param  string $recurrenceId
     * @param  int $sequence
     * @param  int $date
     * @param  string $attendee
     * @return self
     */
    public function __construct(
        int $recurrenceRangeType = 0,
        string $recurrenceId = '',
        int $sequence = 0,
        int $date = 0,
        string $attendee = '',
        ?string $sentBy = NULL,
        ?ParticipationStatus $partStat = NULL
    )
    {
        parent::__construct($recurrenceRangeType, $recurrenceId);
        $this->setSequence($sequence)
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
     * Get sequence
     *
     * @return int
     */
    public function getSequence(): int
    {
        return $this->sequence;
    }

    /**
     * Set sequence
     *
     * @param  int $sequence
     * @return self
     */
    public function setSequence(int $sequence): self
    {
        $this->sequence = $sequence;
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
