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
            $this->property('lat', (float) $lat);
        }
        if(null !== $lon)
        {
            $this->property('lon', (float) $lon);
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
            return $this->property('lat');
        }
        return $this->property('lat', (float) $lat);
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
            return $this->property('lon');
        }
        return $this->property('lon', (float) $lon);
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
