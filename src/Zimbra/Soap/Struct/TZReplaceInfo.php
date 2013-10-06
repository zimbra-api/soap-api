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

use Zimbra\Utils\SimpleXML;

/**
 * TZReplaceInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TZReplaceInfo
{
    /**
     * TZID from /opt/zimbra/conf/timezones.ics 
     * @var Id
     */
    private $_wellKnownTz;

    /**
     * Timezone
     * @var CalTZInfo
     */
    private $_tz;
    /**
     * Constructor method for TZReplaceInfo
     * @param TzOnsetInfo $standard
     * @param TzOnsetInfo $daylight
     * @return self
     */
    public function __construct(Id $wellKnownTz = null, CalTZInfo $tz = null)
    {
        if($wellKnownTz instanceof Id)
        {
            $this->_wellKnownTz = $wellKnownTz;
        }
        if($tz instanceof CalTZInfo)
        {
            $this->_tz = $tz;
        }
    }

    /**
     * Gets or sets wellKnownTz
     *
     * @param  Id $wellKnownTz
     * @return Id|self
     */
    public function wellKnownTz(Id $wellKnownTz = null)
    {
        if(null === $wellKnownTz)
        {
            return $this->_wellKnownTz;
        }
        $this->_wellKnownTz = $wellKnownTz;
        return $this;
    }

    /**
     * Gets or sets tz
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->_tz;
        }
        $this->_tz = $tz;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'replace')
    {
        $name = !empty($name) ? $name : 'replace';
        $arr = array();
        if($this->_wellKnownTz instanceof Id)
        {
            $arr += $this->_wellKnownTz->toArray('wellKnownTz');
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $arr += $this->_tz->toArray('tz');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'replace')
    {
        $name = !empty($name) ? $name : 'replace';
        $xml = new SimpleXML('<'.$name.' />');
        if($this->_wellKnownTz instanceof Id)
        {
            $xml->append($this->_wellKnownTz->toXml('wellKnownTz'));
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $xml->append($this->_tz->toXml('tz'));
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
