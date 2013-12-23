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
 * MimePartAttachSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MimePartAttachSpec extends AttachSpec
{
    /**
     * Message ID
     * @var string
     */
    private $_mid;

    /**
     * Part
     * @var string
     */
    private $_part;

    /**
     * Constructor method for MimePartAttachSpec
     * @param  string $mid
     * @param  string $part
     * @param  bool $optional
     * @return self
     */
    public function __construct($mid, $part, $optional = null)
    {
        parent::__construct($optional);
        $this->_mid = trim($mid);
        $this->_part = trim($part);
    }

    /**
     * Gets or sets mid
     *
     * @param  string $mid
     * @return string|self
     */
    public function mid($mid = null)
    {
        if(null === $mid)
        {
            return $this->_mid;
        }
        $this->_mid = trim($mid);
        return $this;
    }

    /**
     * Gets or sets part
     *
     * @param  string $part
     * @return string|self
     */
    public function part($part = null)
    {
        if(null === $part)
        {
            return $this->_part;
        }
        $this->_part = trim($part);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'mp')
    {
        $name = !empty($name) ? $name : 'mp';
        $arr = array(
            'mid' => $this->_mid,
            'part' => $this->_part,
        );
        if(is_bool($this->_optional))
        {
            $arr['optional'] = $this->_optional ? 1 : 0;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mp')
    {
        $name = !empty($name) ? $name : 'mp';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('mid', $this->_mid);
        $xml->addAttribute('part', $this->_part);
        if(is_bool($this->_optional))
        {
            $xml->addAttribute('optional', $this->_optional ? 1 : 0);
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
