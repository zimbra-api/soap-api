<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\ParticipationStatus;
use Zimbra\Utils\SimpleXML;

/**
 * CalReply struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalReply extends RecurIdInfo
{
    /**
     * Address of attendee who replied
     * @var string
     */
    private $_at;

    /**
     * SENT-BY
     * @var string
     */
    private $_sentBy;

    /**
     * iCalendar PTST (Participation status) 
     * Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF 
     * Meanings:
     *   "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo), "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * @var ParticipationStatus
     */
    private $_ptst;

    /**
     * Sequence
     * @var int
     */
    private $_seq;

    /**
     * Timestamp of reply
     * @var int
     */
    private $_d;

    /**
     * Constructor method for RecurIdInfo
     * @param string $at
     * @param int $seq
     * @param int $d
     * @param int $rangeType
     * @param string $recurId
     * @param string $sentBy
     * @param ParticipationStatus $ptst
     * @param string $tz
     * @param string $ridZ
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
        $this->_at = trim($at);
        $this->_seq = (int) $seq;
        $this->_d = (int) $d;
        $this->_sentBy = trim($sentBy);
        if($ptst instanceof ParticipationStatus)
        {
            $this->_ptst = $ptst;
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
            return $this->_at;
        }
        $this->_at = trim($at);
        return $this;
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
            return $this->_sentBy;
        }
        $this->_sentBy = trim($sentBy);
        return $this;
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
            return $this->_ptst;
        }
        $this->_ptst = $ptst;
        return $this;
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
            return $this->_seq;
        }
        $this->_seq = (int) $seq;
        return $this;
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
            return $this->_d;
        }
        $this->_d = (int) $d;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'reply')
    {
        $name = !empty($name) ? $name : 'reply';
        $arr = array(
            'at' => $this->_at,
            'seq' => $this->_seq,
            'd' => $this->_d,
        );
        if(!empty($this->_sentBy))
        {
            $arr['sentBy'] = $this->_sentBy;
        }
        if($this->_ptst instanceof ParticipationStatus)
        {
            $arr['ptst'] = (string) $this->_ptst;
        }

        return array_merge_recursive(array($name => $arr), parent::toArray($name));
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'reply')
    {
        $name = !empty($name) ? $name : 'reply';
        $xml = parent::toXml($name);
        $xml->addAttribute('at', $this->_at)
            ->addAttribute('seq', $this->_seq)
            ->addAttribute('d', $this->_d);
        if(!empty($this->_sentBy))
        {
            $xml->addAttribute('sentBy', $this->_sentBy);
        }
        if($this->_ptst instanceof ParticipationStatus)
        {
            $xml->addAttribute('ptst', (string) $this->_ptst);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
