<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Struct\GeoInfoInterface;

/**
 * GeoInfo struct class
 * Geo information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GeoInfo implements GeoInfoInterface
{
    /**
     * Latitude (float value)
     * @Accessor(getter="getLatitude", setter="setLatitude")
     * @SerializedName("lat")
     * @Type("string")
     * @XmlAttribute
     */
    private $latitude;

    /**
     * Longitude (float value)
     * @Accessor(getter="getLongitude", setter="setLongitude")
     * @SerializedName("lon")
     * @Type("string")
     * @XmlAttribute
     */
    private $longitude;

    /**
     * Constructor method for GeoInfo
     * 
     * @param string $latitude
     * @param string $longitude
     * @return self
     */
    public function __construct(?string $latitude = NULL, ?string $longitude = NULL)
    {
        if (NULL !== $latitude) {
            $this->setLatitude($latitude);
        }
        if (NULL !== $longitude) {
            $this->setLongitude($longitude);
        }
    }

    /**
     * Gets latitude
     *
     * @return string
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * Sets latitude
     *
     * @param  string $latitude
     * @return self
     */
    public function setLatitude(string $latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Gets longitude
     *
     * @return string
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * Sets longitude
     *
     * @param  string $longitude
     * @return self
     */
    public function setLongitude(string $longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }
}
