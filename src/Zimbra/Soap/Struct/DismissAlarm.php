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
 * DismissAlarm struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DismissAlarm
{
    /**
     * Calendar item ID
     * @var string
     */
    private $_id;

    /**
     * Time alarm was dismissed, in millis
     * @var int
     */
    private $_dismissedAt;

    /**
     * Constructor method for DismissAlarm
     * @param string $id
     * @param int $dismissedAt
     * @return self
     */
    public function __construct($id, $dismissedAt)
    {
        $this->_id = trim($id);
        $this->_dismissedAt = (int) $dismissedAt;
    }

    /**
     * Get or set id
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
     * Get or set dismissedAt
     *
     * @param  int $dismissedAt
     * @return int|self
     */
    public function dismissedAt($dismissedAt = null)
    {
        if(null === $dismissedAt)
        {
            return $this->_dismissedAt;
        }
        $this->_dismissedAt = (int) $dismissedAt;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'alarm')
    {
        $name = !empty($name) ? $name : 'alarm';
        $arr =  array(
            'id' => $this->_id,
            'dismissedAt' => $this->_dismissedAt,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'alarm')
    {
        $name = !empty($name) ? $name : 'alarm';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id)
            ->addAttribute('dismissedAt', $this->_dismissedAt);
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
