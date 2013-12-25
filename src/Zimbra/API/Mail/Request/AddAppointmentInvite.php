<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\Msg;
use Zimbra\Soap\Enum\ParticipationStatus;

/**
 * AddAppointmentInvite request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddAppointmentInvite extends Request
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
     * Constructor method for AddAppointmentInvite
     * @param  ParticipationStatus $ptst
     * @param  Msg $m
     * @return self
     */
    public function __construct(ParticipationStatus $ptst = null, Msg $m = null)
    {
        parent::__construct();
        if($ptst instanceof ParticipationStatus)
        {
            $this->_ptst = $ptst;
        }
        if($m instanceof Msg)
        {
            $this->_m = $m;
        }
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_ptst instanceof ParticipationStatus)
        {
            $this->array['ptst'] = (string) $this->_ptst;
        }
        if($this->_m instanceof Msg)
        {
            $this->array += $this->_m->toArray('m');
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_ptst instanceof ParticipationStatus)
        {
            $this->xml->addAttribute('ptst', (string) $this->_ptst);
        }
        if($this->_m instanceof Msg)
        {
            $this->xml->append($this->_m->toXml('m'));
        }
        return parent::toXml();
    }
}
