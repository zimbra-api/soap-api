<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\Base;

/**
 * LoggerInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 level Nguyen Van Nguyen.
 */
class LoggerInfo extends Base
{
    /**
     * Name of the logger category
     * @var string
     */
    private $_category;

    /**
     * Level of the logging.
     * @var LoggingLevel
     */
    private $_level;

    /**
     * Constructor method for loggerInfo
     * @param string $category
     * @param LoggingLevel $level
     * @return self
     */
    public function __construct($category, LoggingLevel $level = null)
    {
        parent::__construct();
        $this->setProperty('category', trim($category));
        if($level instanceof LoggingLevel)
        {
            $this->setProperty('level', $level);
        }
    }

    /**
     * Gets category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->getProperty('category');
    }

    /**
     * Sets category
     *
     * @param  string $category
     * @return self
     */
    public function setCategory($category)
    {
        return $this->setProperty('category', trim($category));
    }

    /**
     * Gets level enum
     *
     * @return Zimbra\Enum\LoggingLevel
     */
    public function getLevel()
    {
        return $this->getProperty('level');
    }

    /**
     * Sets level enum
     *
     * @param  Zimbra\Enum\LoggingLevel $level
     * @return self
     */
    public function setLevel(LoggingLevel $level)
    {
        return $this->setProperty('level', $level);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'logger')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'logger')
    {
        return parent::toXml($name);
    }
}
