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

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Struct\Base;

/**
 * CalendarAttendee struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalendarAttendee extends Base
{
    /**
     * Non-standard parameters (XPARAMs)
     * @var TypedSequence<XParam>
     */
    private $_xparam;

    /**
     * Constructor method for CalendarAttendee
     * @param array $xparams Non-standard parameters (XPARAMs)
     * @param string $a Email address (without "MAILTO:")
     * @param string $url URL - has same value as {email-address}. 
     * @param string $d Friendly name - "CN" in iCalendar
     * @param string $sentBy iCalendar SENT-BY
     * @param string $dir iCalendar DIR - Reference to a directory entry associated with the calendar user. the property.
     * @param string $lang iCalendar LANGUAGE - As defined in RFC5646 * (e.g. "en-US")
     * @param string $cutype iCalendar CUTYPE (Calendar user type)
     * @param string $role iCalendar ROLE
     * @param ParticipationStatus $ptst
     * @param bool   $rsvp iCalendar RSVP iCalendar PTST (Participation status).
     * @param string $member iCalendar MEMBER - The group or list membership of the calendar user
     * @param string $delTo iCalendar DELEGATED-TO
     * @param string $delFrom iCalendar DELEGATED-FROM
     * @return self
     */
    public function __construct(
        array $xparams = array(),
        $a = null,
        $url = null,
        $d = null,
        $sentBy = null,
        $dir = null,
        $lang = null,
        $cutype = null,
        $role = null,
        ParticipationStatus $ptst = null,
        $rsvp = null,
        $member = null,
        $delTo = null,
        $delFrom = null
    )
    {
        parent::__construct();
        $this->_xparam = new TypedSequence('Zimbra\Mail\Struct\XParam', $xparams);

        if(null !== $a)
        {
            $this->property('a', trim($a));
        }
        if(null !== $url)
        {
            $this->property('url', trim($url));
        }
        if(null !== $d)
        {
            $this->property('d', trim($d));
        }
        if(null !== $sentBy)
        {
            $this->property('sentBy', trim($sentBy));
        }
        if(null !== $dir)
        {
            $this->property('dir', trim($dir));
        }
        if(null !== $lang)
        {
            $this->property('lang', trim($lang));
        }
        if(null !== $cutype)
        {
            $this->property('cutype', trim($cutype));
        }
        if(null !== $role)
        {
            $this->property('role', trim($role));
        }
        if($ptst instanceof ParticipationStatus)
        {
            $this->property('ptst', $ptst);
        }
        if(null !== $rsvp)
        {
            $this->property('rsvp', (bool) $rsvp);
        }
        if(null !== $member)
        {
            $this->property('member', trim($member));
        }
        if(null !== $delTo)
        {
            $this->property('delTo', trim($delTo));
        }
        if(null !== $delFrom)
        {
            $this->property('delFrom', trim($delFrom));
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->xparam()->count())
            {
                $sender->child('xparam', $sender->xparam()->all());
            }
        });
    }

    /**
     * Add xparam
     *
     * @param  XParam $xparam
     * @return self
     */
    public function addXParam(XParam $xparam)
    {
        $this->_xparam->add($xparam);
        return $this;
    }

    /**
     * Gets xparam sequence
     *
     * @return Sequence
     */
    public function xparam()
    {
        return $this->_xparam;
    }

    /**
     * Gets or sets email address
     *
     * @param  string $a email address
     * @return string|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->property('a');
        }
        return $this->property('a', trim($a));
    }

    /**
     * Gets or sets url value
     *
     * @param  string $a url url value
     * @return string|self
     */
    public function url($url = null)
    {
        if(null === $url)
        {
            return $this->property('url');
        }
        return $this->property('url', trim($url));
    }

    /**
     * Gets or sets friendly name
     *
     * @param  string $d friendly name
     * @return string|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->property('d');
        }
        return $this->property('d', trim($d));
    }

    /**
     * Gets or sets iCalendar SENT-BY
     *
     * @param  string $sentBy iCalendar SENT-BY
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
     * Gets or sets iCalendar DIR
     *
     * @param  string $dir iCalendar DIR
     * @return string|self
     */
    public function dir($dir = null)
    {
        if(null === $dir)
        {
            return $this->property('dir');
        }
        return $this->property('dir', trim($dir));
    }

    /**
     * Gets or sets iCalendar LANGUAGE
     *
     * @param  string $lang iCalendar LANGUAGE
     * @return string|self
     */
    public function lang($lang = null)
    {
        if(null === $lang)
        {
            return $this->property('lang');
        }
        return $this->property('lang', trim($lang));
    }

    /**
     * Gets or sets iCalendar CUTYPE
     *
     * @param  string $cutype iCalendar CUTYPE
     * @return string|self
     */
    public function cutype($cutype = null)
    {
        if(null === $cutype)
        {
            return $this->property('cutype');
        }
        return $this->property('cutype', trim($cutype));
    }

    /**
     * Gets or sets iCalendar ROLE
     *
     * @param  string $cutype iCalendar ROLE
     * @return string|self
     */
    public function role($role = null)
    {
        if(null === $role)
        {
            return $this->property('role');
        }
        return $this->property('role', trim($role));
    }

    /**
     * Gets or sets iCalendar PTST
     * Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF
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
     * Gets or sets iCalendar RSVP
     *
     * @param  bool $rsvp iCalendar RSVP
     * @return bool|self
     */
    public function rsvp($rsvp = null)
    {
        if(null === $rsvp)
        {
            return $this->property('rsvp');
        }
        return $this->property('rsvp', (bool) $rsvp);
    }

    /**
     * Gets or sets iCalendar MEMBER
     *
     * @param  string $member iCalendar MEMBER
     * @return string|self
     */
    public function member($member = null)
    {
        if(null === $member)
        {
            return $this->property('member');
        }
        return $this->property('member', trim($member));
    }

    /**
     * Gets or sets iCalendar DELEGATED-TO
     *
     * @param  string $delTo iCalendar DELEGATED-TO
     * @return string|self
     */
    public function delTo($delTo = null)
    {
        if(null === $delTo)
        {
            return $this->property('delTo');
        }
        return $this->property('delTo', trim($delTo));
    }

    /**
     * Gets or sets iCalendar DELEGATED-FROM
     *
     * @param  string $delTo iCalendar DELEGATED-FROM
     * @return string|self
     */
    public function delFrom($delFrom = null)
    {
        if(null === $delFrom)
        {
            return $this->property('delFrom');
        }
        return $this->property('delFrom', trim($delFrom));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'at')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'at')
    {
        return parent::toXml($name);
    }
}
