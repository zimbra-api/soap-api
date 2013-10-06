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
 * ModifyVolume class
 * Modify volume.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyVolume extends Request
{
    /**
     * Volume ID
     * @var int
     */
    private $_id;

    /**
     * Volume information
     * @var Volume
     */
    private $_volume;

    /**
     * Constructor method for ModifyVolume
     * @param int $id
     * @param Volume $volume
     * @return self
     */
    public function __construct($id, Volume $volume)
    {
        parent::__construct();
        $this->_id = (int) $id;
        $this->_volume = $volume;
    }

    /**
     * Gets or sets id
     *
     * @param  int $id
     * @return int|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = (int) $id;
        return $this;
    }

    /**
     * Gets or sets volume
     *
     * @param  Volume $volume
     * @return Volume|self
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
        $this->array = array(
            'id' => $this->_id,
        );
        $this->array += $this->_volume->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('id', $this->_id)
                  ->append($this->_volume->toXml());
        return parent::toXml();
    }
}
