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
 * GeoInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GeoInfo
{
    /**
     * Latitude
     * @var float
     */
    private $_lat;

    /**
     * Longitude
     * @var float
     */
    private $_lon;

    /**
     * Constructor method for GeoInfo
     * @param  float $lat
     * @param  float $lon
     * @return self
     */
    public function __construct($lat = null, $lon = null)
    {
        if(null !== $lat)
        {
            $this->_lat = (float) $lat;
        }
        if(null !== $lon)
        {
            $this->_lon = (float) $lon;
        }
    }

    /**
     * Gets or sets lat
     *
     * @param  float $lat
     * @return float|self
     */
    public function lat($lat = null)
    {
        if(null === $lat)
        {
            return $this->_lat;
        }
        $this->_lat = (float) $lat;
        return $this;
    }

    /**
     * Gets or sets lon
     *
     * @param  float $lon
     * @return float|self
     */
    public function lon($lon = null)
    {
        if(null === $lon)
        {
            return $this->_lon;
        }
        $this->_lon = (float) $lon;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'geo')
    {
        $name = !empty($name) ? $name : 'geo';
        $arr = array();
        if(is_float($this->_lat))
        {
            $arr['lat'] = $this->_lat;
        }
        if(is_float($this->_lon))
        {
            $arr['lon'] = $this->_lon;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'geo')
    {
        $name = !empty($name) ? $name : 'geo';
        $xml = new SimpleXML('<'.$name.' />');
        if(is_float($this->_lat))
        {
            $xml->addAttribute('lat', $this->_lat);
        }
        if(is_float($this->_lon))
        {
            $xml->addAttribute('lon', $this->_lon);
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
