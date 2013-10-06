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

/**
 * SetCurrentVolume class
 * Set current volume. 
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetCurrentVolume extends Request
{
    /**
     * ID
     * @var string
     */
    private $_id;

    /**
     * Volume type: 1 (primary message), 2 (secondary message) or 10 (index)
     * @var string
     */
    private $_type = 1;

    /**
     * Constructor method for SetCurrentVolume
     * @param int $id
     * @param string $type
     * @return self
     */
    public function __construct($id, $type)
    {
        parent::__construct();
        $this->_id = (int) $id;
        if(in_array((int) $type, array(1, 2, 10)))
        {
            $this->_type = (int) $type;
        }
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
     * Gets or sets type
     *
     * @param  int $type
     * @return int|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        if(in_array((int) $type, array(1, 2, 10)))
        {
            $this->_type = (int) $type;
        }
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
            'type' => $this->_type,
        );
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
                  ->addAttribute('type', $this->_type);
        return parent::toXml();
    }
}
