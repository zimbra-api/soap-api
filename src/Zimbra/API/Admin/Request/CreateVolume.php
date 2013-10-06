<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\VolumeInfo as Volume;

/**
 * CreateVolume class
 * Create a volume.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateVolume extends Request
{
    /**
     * Volume information
     * @var Volume
     */
    private $_volume;

    /**
     * Constructor method for CreateVolume
     * @param Volume $volume
     * @return CreateVolume
     */
    public function __construct(Volume $volume)
    {
        parent::__construct();
        $this->_volume = $volume;
    }

    /**
     * Gets or sets volume
     *
     * @param  Volume $volume
     * @return Volume|CreateVolume
     */
    public function volume(Volume $volume = null)
    {
        if(null === $volume)
        {
            return $this->_volume;
        }
        $this->_volume = $volume;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_volume->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_volume->toXml());
        return parent::toXml();
    }
}
