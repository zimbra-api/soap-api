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
 * MeTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MeTest extends FilterTest
{
    /**
     * Header
     * @var string
     */
    private $_header;

    /**
     * Constructor method for MeTest
     * @param int $index
     * @param string $header
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index, $header, $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_header = trim($header);
    }

    /**
     * Gets or sets header
     *
     * @param  string $header
     * @return string|self
     */
    public function header($header = null)
    {
        if(null === $header)
        {
            return $this->_header;
        }
        $this->_header = trim($header);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'meTest')
    {
        $name = !empty($name) ? $name : 'meTest';
        $arr = parent::toArray($name);
        $arr[$name]['header'] = $this->_header;
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'meTest')
    {
        $name = !empty($name) ? $name : 'meTest';
        $xml = parent::toXml($name);
        $xml->addAttribute('header', $this->_header);
        return $xml;
    }
}
