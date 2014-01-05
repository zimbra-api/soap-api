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
 * FlaggedTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FlaggedTest extends FilterTest
{
    /**
     * Header
     * @var string
     */
    private $_flagName;

    /**
     * Constructor method for FlaggedTest
     * @param int $index
     * @param string $flagName
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index, $flagName, $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_flagName = trim($flagName);
    }

    /**
     * Gets or sets flagName
     *
     * @param  string $flagName
     * @return string|self
     */
    public function flagName($flagName = null)
    {
        if(null === $flagName)
        {
            return $this->_flagName;
        }
        $this->_flagName = trim($flagName);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'flaggedTest')
    {
        $name = !empty($name) ? $name : 'flaggedTest';
        $arr = parent::toArray($name);
        $arr[$name]['flagName'] = $this->_flagName;
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'flaggedTest')
    {
        $name = !empty($name) ? $name : 'flaggedTest';
        $xml = parent::toXml($name);
        $xml->addAttribute('flagName', $this->_flagName);
        return $xml;
    }
}
