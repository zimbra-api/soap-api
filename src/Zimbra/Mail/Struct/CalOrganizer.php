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
use Zimbra\Struct\Base;

/**
 * CalOrganizer struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalOrganizer extends Base
{
    /**
     * Non-standard parameters (XPARAMs)
     * @var Sequence
     */
    private $_xparam;

    /**
     * Constructor method for CalOrganizer
     * @param array $xparams
     * @param string $a Email address (without "MAILTO:")
     * @param string $url URL - has same value as {email-address}. 
     * @param string $d Friendly name - "CN" in iCalendar
     * @param string $sentBy iCalendar SENT-BY
     * @param string $dir iCalendar DIR - Reference to a directory entry associated with the calendar user. the property.
     * @param string $lang iCalendar LANGUAGE - As defined in RFC5646 * (e.g. "en-US")
     * @return self
     */
    public function __construct(
        array $xparams = array(),
        $a = null,
        $url = null,
        $d = null,
        $sentBy = null,
        $dir = null,
        $lang = null
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'or')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'or')
    {
        return parent::toXml($name);
    }
}
