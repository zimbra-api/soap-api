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
 * CalTZInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalTZInfo
{
    /**
     * Timezone ID. If this is the only detail present then this should be an existing server-known
     * timezone's ID Otherwise, it must be present, although it will be ignored by the server
     * @var string
     */
    private $_id;

    /**
     * Standard Time's offset in minutes from UTC; local = UTC + offset
     * @var int
     */
    private $_stdoff;

    /**
     * Daylight Saving Time's offset in minutes from UTC; present only if DST is used
     * @var int
     */
    private $_dayoff;

    /**
     * Standard Time component's timezone name
     * @var string
     */
    private $_stdname;

    /**
     * Daylight Saving Time component's timezone name
     * @var string
     */
    private $_dayname;

    /**
     * Time/rule for transitioning from daylight time to standard time. Either specify week/wkday combo, or mday.
     * @var TzOnsetInfo
     */
    private $_standard;

    /**
     * Time/rule for transitioning from standard time to daylight time
     * @var TzOnsetInfo
     */
    private $_daylight;

    /**
     * Constructor method for CalTZInfo
     * @param string $id
     * @param int $stdoff
     * @param int $dayoff
     * @param string $stdname
     * @param string $dayname
     * @param TzOnsetInfo $standard
     * @param TzOnsetInfo $daylight
     * @return self
     */
    public function __construct(
        $id,
        $stdoff,
        $dayoff,
        $stdname = null,
        $dayname = null,
        TzOnsetInfo $standard = null,
        TzOnsetInfo $daylight = null)
    {
        $this->_id = trim($id);
        $this->_stdoff = (int) $stdoff;
        $this->_dayoff = (int) $dayoff;
        $this->_stdname = trim($stdname);
        $this->_dayname = trim($dayname);
        if($standard instanceof TzOnsetInfo)
        {
            $this->_standard = $standard;
        }
        if($daylight instanceof TzOnsetInfo)
        {
            $this->_daylight = $daylight;
        }
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets or sets stdoff
     *
     * @param  int $stdoff
     * @return int|self
     */
    public function stdoff($stdoff = null)
    {
        if(null === $stdoff)
        {
            return $this->_stdoff;
        }
        $this->_stdoff = (int) $stdoff;
        return $this;
    }

    /**
     * Gets or sets dayoff
     *
     * @param  int $dayoff
     * @return int|self
     */
    public function dayoff($dayoff = null)
    {
        if(null === $dayoff)
        {
            return $this->_dayoff;
        }
        $this->_dayoff = (int) $dayoff;
        return $this;
    }

    /**
     * Gets or sets stdname
     *
     * @param  string $stdname
     * @return string|self
     */
    public function stdname($stdname = null)
    {
        if(null === $stdname)
        {
            return $this->_stdname;
        }
        $this->_stdname = trim($stdname);
        return $this;
    }

    /**
     * Gets or sets dayname
     *
     * @param  string $dayname
     * @return string|self
     */
    public function dayname($dayname = null)
    {
        if(null === $dayname)
        {
            return $this->_dayname;
        }
        $this->_dayname = trim($dayname);
        return $this;
    }

    /**
     * Gets or sets standard
     *
     * @param  TzOnsetInfo $standard
     * @return TzOnsetInfo|self
     */
    public function standard(TzOnsetInfo $standard = null)
    {
        if(null === $standard)
        {
            return $this->_standard;
        }
        $this->_standard = $standard;
        return $this;
    }

    /**
     * Gets or sets daylight
     *
     * @param  TzOnsetInfo $daylight
     * @return TzOnsetInfo|self
     */
    public function daylight(TzOnsetInfo $daylight = null)
    {
        if(null === $daylight)
        {
            return $this->_daylight;
        }
        $this->_daylight = $daylight;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'tz')
    {
        $name = !empty($name) ? $name : 'tz';
        $arr = array(
            'id' => $this->_id,
            'stdoff' => $this->_stdoff,
            'dayoff' => $this->_dayoff,
        );
        if(!empty($this->_stdname))
        {
            $arr['stdname'] = $this->_stdname;
        }
        if(!empty($this->_dayname))
        {
            $arr['dayname'] = $this->_dayname;
        }
        if($this->_standard instanceof TzOnsetInfo)
        {
            $arr += $this->_standard->toArray('standard');
        }
        if($this->_daylight instanceof TzOnsetInfo)
        {
            $arr += $this->_daylight->toArray('daylight');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'tz')
    {
        $name = !empty($name) ? $name : 'tz';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id)
            ->addAttribute('stdoff', $this->_stdoff)
            ->addAttribute('dayoff', $this->_dayoff);
        if(!empty($this->_stdname))
        {
            $xml->addAttribute('stdname', $this->_stdname);
        }
        if(!empty($this->_dayname))
        {
            $xml->addAttribute('dayname', $this->_dayname);
        }
        if($this->_standard instanceof TzOnsetInfo)
        {
            $xml->append($this->_standard->toXml('standard'));
        }
        if($this->_daylight instanceof TzOnsetInfo)
        {
            $xml->append($this->_daylight->toXml('daylight'));
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
