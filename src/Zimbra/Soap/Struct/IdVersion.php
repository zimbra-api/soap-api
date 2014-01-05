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
 * IdVersion struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class IdVersion
{
    /**
     * ID
     * @var string
     */
    private $_id;

    /**
     * Version
     * @var int
     */
    private $_ver;

    /**
     * Constructor method for IdVersion
     * @param string $id
     * @param int    $ver
     * @return self
     */
    public function __construct(
        $id,
        $ver = null
    )
    {
        $this->_id = trim($id);
        if(null !== $ver)
        {
            $this->_ver = (int) $ver;
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
     * Gets or sets ver
     *
     * @param  int $ver
     * @return int|self
     */
    public function ver($ver = null)
    {
        if(null === $ver)
        {
            return $this->_ver;
        }
        $this->_ver = (int) $ver;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'doc')
    {
        $name = !empty($name) ? $name : 'doc';
        $arr = array(
            'id' => $this->_id,
        );
        if(is_int($this->_ver))
        {
            $arr['ver'] = $this->_ver;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'doc')
    {
        $name = !empty($name) ? $name : 'doc';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id);
        if(is_int($this->_ver))
        {
            $xml->addAttribute('ver', $this->_ver);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
