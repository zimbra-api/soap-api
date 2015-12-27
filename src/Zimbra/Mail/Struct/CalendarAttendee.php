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
    private $_xparams;

    /**
     * Constructor method for CalendarAttendee
     * @param array $xparams Non-standard parameters (XPARAMs)
     * @param string $address Email address (without "MAILTO:")
     * @param string $url URL - has same value as {email-address}. 
     * @param string $displayName Friendly name - "CN" in iCalendar
     * @param string $sentBy iCalendar SENT-BY
     * @param string $dir iCalendar DIR - Reference to a directory entry associated with the calendar user. the setProperty.
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
        $address = null,
        $url = null,
        $displayName = null,
        $sentBy = null,
        $dir = null,
        $lang = null,
        $cutype = null,
        $role = null,
        ParticipationStatus $partStat = null,
        $rsvp = null,
        $member = null,
        $delTo = null,
        $delFrom = null,
        array $xparams = []
    )
    {
        parent::__construct();

        if(null !== $address)
        {
            $this->setProperty('a', trim($address));
        }
        if(null !== $url)
        {
            $this->setProperty('url', trim($url));
        }
        if(null !== $displayName)
        {
            $this->setProperty('d', trim($displayName));
        }
        if(null !== $sentBy)
        {
            $this->setProperty('sentBy', trim($sentBy));
        }
        if(null !== $dir)
        {
            $this->setProperty('dir', trim($dir));
        }
        if(null !== $lang)
        {
            $this->setProperty('lang', trim($lang));
        }
        if(null !== $cutype)
        {
            $this->setProperty('cutype', trim($cutype));
        }
        if(null !== $role)
        {
            $this->setProperty('role', trim($role));
        }
        if($partStat instanceof ParticipationStatus)
        {
            $this->setProperty('ptst', $partStat);
        }
        if(null !== $rsvp)
        {
            $this->setProperty('rsvp', (bool) $rsvp);
        }
        if(null !== $member)
        {
            $this->setProperty('member', trim($member));
        }
        if(null !== $delTo)
        {
            $this->setProperty('delTo', trim($delTo));
        }
        if(null !== $delFrom)
        {
            $this->setProperty('delFrom', trim($delFrom));
        }

        $this->setXParams($xparams);
        $this->on('before', function(Base $sender)
        {
            if($sender->getXParams()->count())
            {
                $sender->setChild('xparam', $sender->getXParams()->all());
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
        $this->_xparams->add($xparam);
        return $this;
    }

    /**
     * Sets xparam sequence
     *
     * @param  array $xparams
     * @return self
     */
    public function setXParams(array $xparams)
    {
        $this->_xparams = new TypedSequence('Zimbra\Mail\Struct\XParam', $xparams);
        return $this;
    }

    /**
     * Gets xparam sequence
     *
     * @return Sequence
     */
    public function getXParams()
    {
        return $this->_xparams;
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->getProperty('a');
    }

    /**
     * Sets address
     *
     * @param  string $address
     * @return self
     */
    public function setAddress($address)
    {
        return $this->setProperty('a', trim($address));
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->getProperty('url');
    }

    /**
     * Sets url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl($url)
    {
        return $this->setProperty('url', trim($url));
    }

    /**
     * Gets display name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets display name
     *
     * @param  string $displayName
     * @return self
     */
    public function setDisplayName($displayName)
    {
        return $this->setProperty('d', trim($displayName));
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
     * Gets sent by
     *
     * @return string
     */
    public function getDir()
    {
        return $this->getProperty('dir');
    }

    /**
     * Sets sent by
     *
     * @param  string $dir
     * @return self
     */
    public function setDir($dir)
    {
        return $this->setProperty('dir', trim($dir));
    }

    /**
     * Gets lang
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->getProperty('lang');
    }

    /**
     * Sets lang
     *
     * @param  string $lang
     * @return self
     */
    public function setLanguage($lang)
    {
        return $this->setProperty('lang', trim($lang));
    }

    /**
     * Gets cutype
     *
     * @return string
     */
    public function getCuType()
    {
        return $this->getProperty('cutype');
    }

    /**
     * Sets cutype
     *
     * @param  string $cutype
     * @return self
     */
    public function setCuType($cutype)
    {
        return $this->setProperty('cutype', trim($cutype));
    }

    /**
     * Gets role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->getProperty('role');
    }

    /**
     * Sets role
     *
     * @param  string $role
     * @return self
     */
    public function setRole($role)
    {
        return $this->setProperty('role', trim($role));
    }

    /**
     * Gets ptst
     *
     * @return ParticipationStatus
     */
    public function getPartStat()
    {
        return $this->getProperty('ptst');
    }

    /**
     * Sets ptst
     *
     * @param  ParticipationStatus $ptst
     * @return self
     */
    public function setPartStat(ParticipationStatus $ptst)
    {
        return $this->setProperty('ptst', $ptst);
    }

    /**
     * Gets rsvp
     *
     * @return bool
     */
    public function getRsvp()
    {
        return $this->getProperty('rsvp');
    }

    /**
     * Sets rsvp
     *
     * @param  bool $rsvp
     * @return self
     */
    public function setRsvp($rsvp)
    {
        return $this->setProperty('rsvp', (bool) $rsvp);
    }

    /**
     * Gets member
     *
     * @return string
     */
    public function getMember()
    {
        return $this->getProperty('member');
    }

    /**
     * Sets member
     *
     * @param  string $member
     * @return self
     */
    public function setMember($member)
    {
        return $this->setProperty('member', trim($member));
    }

    /**
     * Gets delTo
     *
     * @return string
     */
    public function getDelegatedTo()
    {
        return $this->getProperty('delTo');
    }

    /**
     * Sets delTo
     *
     * @param  string $delTo
     * @return self
     */
    public function setDelegatedTo($delTo)
    {
        return $this->setProperty('delTo', trim($delTo));
    }

    /**
     * Gets delFrom
     *
     * @return string
     */
    public function getDelegatedFrom()
    {
        return $this->getProperty('delFrom');
    }

    /**
     * Sets delFrom
     *
     * @param  string $delFrom
     * @return self
     */
    public function setDelegatedFrom($delFrom)
    {
        return $this->setProperty('delFrom', trim($delFrom));
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
