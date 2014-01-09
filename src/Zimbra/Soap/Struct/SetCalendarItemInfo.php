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
 * SetCalendarItemInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetCalendarItemInfo
{
    /**
     * iCalendar PTST (Participation status)
     * Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF 
     * Meanings: 
     * "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo), "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * @var ParticipationStatus
     */
    private $_ptst;

    /**
     * Message
     * @var Msg
     */
    private $_m;

    /**
     * Constructor method for SetCalendarItemInfo
     * @param  Msg $m
     * @param  ParticipationStatus $ptst
     * @return self
     */
    public function __construct(Msg $m = null, ParticipationStatus $ptst = null)
    {
        if($m instanceof Msg)
        {
            $this->_m = $m;
        }
        if($ptst instanceof ParticipationStatus)
        {
            $this->_ptst = $ptst;
        }
    }

    /**
     * Get or set m
     *
     * @param  Msg $m
     * @return Msg|self
     */
    public function m(Msg $m = null)
    {
        if(null === $m)
        {
            return $this->_m;
        }
        $this->_m = $m;
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'item')
    {
        $name = !empty($name) ? $name : 'item';
        $arr = array();
        if($this->_ptst instanceof ParticipationStatus)
        {
            $arr['ptst'] = (string) $this->_ptst;
        }
        if($this->_m instanceof Msg)
        {
            $arr += $this->_m->toArray('m');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'item')
    {
        $name = !empty($name) ? $name : 'item';
        $xml = new SimpleXML('<'.$name.' />');
        if($this->_ptst instanceof ParticipationStatus)
        {
            $xml->addAttribute('ptst', (string) $this->_ptst);
        }
        if($this->_m instanceof Msg)
        {
            $xml->append($this->_m->toXml('m'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
