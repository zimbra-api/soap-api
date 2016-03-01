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
    private $_xparams;

    /**
     * Constructor method for CalOrganizer
     * @param string $address Email address (without "MAILTO:")
     * @param string $url URL - has same value as {email-address}. 
     * @param string $displayName Friendly name - "CN" in iCalendar
     * @param string $sentBy iCalendar SENT-BY
     * @param string $dir iCalendar DIR - Reference to a directory entry associated with the calendar user. the setProperty.
     * @param string $lang iCalendar LANGUAGE - As defined in RFC5646 * (e.g. "en-US")
     * @param array $xparams Non-standard parameters
     * @return self
     */
    public function __construct(
        $address = null,
        $url = null,
        $displayName = null,
        $sentBy = null,
        $dir = null,
        $lang = null,
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
     * sets xparam sequence
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
     * Gets dir
     *
     * @return string
     */
    public function getDir()
    {
        return $this->getProperty('dir');
    }

    /**
     * Sets dir
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
