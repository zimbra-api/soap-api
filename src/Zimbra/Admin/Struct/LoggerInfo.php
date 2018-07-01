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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

use Zimbra\Enum\LoggingLevel;

/**
 * LoggerInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 level Nguyen Van Nguyen.
 * @XmlRoot(name="logger")
 */
class LoggerInfo
{
    /**
     * @Accessor(getter="getCategory", setter="setCategory")
     * @SerializedName("category")
     * @Type("string")
     * @XmlAttribute
     */
    private $_category;

    /**
     * @Accessor(getter="getLevel", setter="setLevel")
     * @SerializedName("level")
     * @Type("string")
     * @XmlAttribute
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
        $this->setCategory($category);
        if (NULL !== $level) {
            $this->setLevel($level);
        }
    }

    /**
     * Gets category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->_category;
    }

    /**
     * Sets category
     *
     * @param  string $category
     * @return self
     */
    public function setCategory($category)
    {
        $this->_category = trim($category);
        return $this;
    }

    /**
     * Gets level enum
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->_level;
    }

    /**
     * Sets level enum
     *
     * @param  string $level
     * @return self
     */
    public function setLevel($level)
    {
        if (LoggingLevel::has(trim($level))) {
            $this->_level = $level;
        }
        return $this;
    }
}
