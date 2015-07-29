<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Enum\ParticipationStatus;

/**
 * CalReply struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalReply extends RecurIdInfo
{
    /**
     * Constructor method for CalReply
     * @param string $attendee Address of attendee who replied
     * @param int $sequence Sequence
     * @param int $date Timestamp of reply
     * @param int $rangeType Recurrence range type
     * @param string $recurId Recurrence ID in format : YYMMDD[THHMMSS[Z]]
     * @param string $sentBy SENT-BY
     * @param ParticipationStatus $partStat iCalendar PTST (Participation status) 
     * @param string $tz Timezone name
     * @param string $ridZ Recurrence-id in UTC time zone; used in non-all-day appointments only. Format: YYMMDDTHHMMSSZ
     * @return self
     */
    public function __construct(
        $attendee,
        $sequence,
        $date,
        $rangeType,
        $recurId,
        $sentBy = null,
        ParticipationStatus $partStat = null,
        $tz = null,
        $ridZ = null
    )
    {
        parent::__construct(
            $rangeType,
            $recurId,
            $tz,
            $ridZ
        );
        $this->setProperty('at', trim($attendee));
        $this->setProperty('seq', (int) $sequence);
        $this->setProperty('d', (int) $date);
        if(null !== $sentBy)
        {
            $this->setProperty('sentBy', trim($sentBy));
        }
        if($partStat instanceof ParticipationStatus)
        {
            $this->setProperty('ptst', $partStat);
        }
    }

    /**
     * Gets attendee
     *
     * @return string
     */
    public function getAttendee()
    {
        return $this->getProperty('at');
    }

    /**
     * Sets attendee
     *
     * @param  string $attendee
     * @return self
     */
    public function setAttendee($attendee)
    {
        return $this->setProperty('at', trim($attendee));
    }

    /**
     * Gets sent by
     *
     * @return string
     */
    public function getSentBy()
    {
        return $this->getProperty('sentBy');
    }

    /**
     * Sets sent by
     *
     * @param  string $sentBy
     * @return self
     */
    public function setSentBy($sentBy)
    {
        return $this->setProperty('sentBy', trim($sentBy));
    }

    /**
     * Gets participation status
     *
     * @return ParticipationStatus
     */
    public function getPartStat()
    {
        return $this->getProperty('ptst');
    }

    /**
     * Sets participation status
     *
     * @param  ParticipationStatus $partStat
     * @return self
     */
    public function setPartStat(ParticipationStatus $partStat)
    {
        return $this->setProperty('ptst', $partStat);
    }

    /**
     * Gets sequence
     *
     * @return int
     */
    public function getSequence()
    {
        return $this->getProperty('seq');
    }

    /**
     * Sets sequence
     *
     * @param  bool $sequence
     * @return self
     */
    public function setSequence($sequence)
    {
        return $this->setProperty('seq', (int) $sequence);
    }

    /**
     * Gets date
     *
     * @return int
     */
    public function getDate()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets date
     *
     * @param  bool $date
     * @return self
     */
    public function setDate($date)
    {
        return $this->setProperty('d', (int) $date);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'reply')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'reply')
    {
        return parent::toXml($name);
    }
}
