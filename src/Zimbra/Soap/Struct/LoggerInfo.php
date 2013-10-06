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

use Zimbra\Soap\Enum\LoggingLevel;
use Zimbra\Utils\SimpleXML;

/**
 * LoggerInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class LoggerInfo
{
    /**
     * Name of the logger category
     * - use : required
     * @var string
     */
    private $_category;

    /**
     * Level of the logging.
     * @var string
     */
    private $_level;

    /**
     * Constructor method for loggerInfo
     * @param string $category
     * @param string $level
     * @return self
     */
    public function __construct($category, $level = null)
    {
        $this->_category = trim($category);
        if(LoggingLevel::isValid(trim($level)))
        {
            $this->_level = trim($level);
        }
    }

    /**
     * Gets or sets category
     *
     * @param  string $category
     * @return string|self
     */
    public function category($category = null)
    {
        if(null === $category)
        {
            return $this->_category;
        }
        $this->_category = trim($category);
        return $this;
    }

    /**
     * Gets or sets level
     *
     * @param  string $level
     * @return string|self
     */
    public function level($level = null)
    {
        if(null === $level)
        {
            return $this->_level;
        }
        if(LoggingLevel::isValid(trim($level)))
        {
            $this->_level = trim($level);
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'logger')
    {
        $name = !empty($name) ? $name : 'logger';
        $arr = array(
            'category' => $this->_category,
        );
        if(!empty($this->_level))
        {
            $arr['level'] = $this->_level;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'logger')
    {
        $name = !empty($name) ? $name : 'logger';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('category', $this->_category);
        if(!empty($this->_level))
        {
            $xml->addAttribute('level', $this->_level);
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
