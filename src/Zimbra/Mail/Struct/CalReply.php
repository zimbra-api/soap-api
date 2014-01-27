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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class CalReply extends RecurIdInfo
{
    /**
     * Constructor method for CalReply
     * @param string $at Address of attendee who replied
     * @param int $seq Sequence
     * @param int $d Timestamp of reply
     * @param int $rangeType Recurrence range type
     * @param string $recurId Recurrence ID in format : YYMMDD[THHMMSS[Z]]
     * @param string $sentBy SENT-BY
     * @param ParticipationStatus $ptst iCalendar PTST (Participation status) 
     * @param string $tz Timezone name
     * @param string $ridZ Recurrence-id in UTC time zone; used in non-all-day appointments only. Format: YYMMDDTHHMMSSZ
     * @return self
     */
    public function __construct(
        $at,
        $seq,
        $d,
        $rangeType,
        $recurId,
        $sentBy = null,
        ParticipationStatus $ptst = null,
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
        $this->property('at', trim($at));
        $this->property('seq', (int) $seq);
        $this->property('d', (int) $d);
        if(null !== $sentBy)
        {
            $this->property('sentBy', trim($sentBy));
        }
        if($ptst instanceof ParticipationStatus)
        {
            $this->property('ptst', $ptst);
        }
    }

    /**
     * Gets or sets at
     *
     * @param  string $at
     * @return string|self
     */
    public function at($at = null)
    {
        if(null === $at)
        {
            return $this->property('at');
        }
        return $this->property('at', trim($at));
    }

    /**
     * Gets or sets sentBy
     *
     * @param  string $sentBy
     * @return string|self
     */
    public function sentBy($sentBy = null)
    {
        if(null === $sentBy)
        {
            return $this->property('sentBy');
        }
        return $this->property('sentBy', trim($sentBy));
    }

    /**
     * Get or set ptst
     *
     * @param  ParticipationStatus $ptst
     * @return ParticipationStatus|self
     */
    public function ptst(ParticipationStatus $ptst = null)
    {
        if(null === $ptst)
        {
            return $this->property('ptst');
        }
        return $this->property('ptst', $ptst);
    }

    /**
     * Gets or sets seq
     *
     * @param  int $seq
     * @return int|self
     */
    public function seq($seq = null)
    {
        if(null === $seq)
        {
            return $this->property('seq');
        }
        return $this->property('seq', (int) $seq);
    }

    /**
     * Gets or sets d
     *
     * @param  int $d
     * @return int|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->property('d');
        }
        return $this->property('d', (int) $d);
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
