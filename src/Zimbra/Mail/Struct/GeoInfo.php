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

use Zimbra\Struct\Base;

/**
 * GeoInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GeoInfo extends Base
{
    /**
     * Constructor method for GeoInfo
     * @param  float $lat Latitude
     * @param  float $lon Longitude
     * @return self
     */
    public function __construct($lat = null, $lon = null)
    {
        parent::__construct();
        if(null !== $lat)
        {
            $this->setProperty('lat', (float) $lat);
        }
        if(null !== $lon)
        {
            $this->setProperty('lon', (float) $lon);
        }
    }

    /**
     * Gets latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->getProperty('lat');
    }

    /**
     * Sets latitude
     *
     * @param  float $lat
     * @return self
     */
    public function setLatitude($lat)
    {
        return $this->setProperty('lat', (float) $lat);
    }

    /**
     * Gets longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->getProperty('lon');
    }

    /**
     * Sets longitude
     *
     * @param  float $lon
     * @return self
     */
    public function setLongitude($lon)
    {
        return $this->setProperty('lon', (float) $lon);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'geo')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'geo')
    {
        return parent::toXml($name);
    }
}
