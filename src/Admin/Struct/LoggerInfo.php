<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Enum\LoggingLevel;

/**
 * LoggerInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present level Nguyen Van Nguyen.
 */
class LoggerInfo
{
    /**
     * @Accessor(getter="getCategory", setter="setCategory")
     * @SerializedName("category")
     * @Type("string")
     * @XmlAttribute
     */
    private $category;

    /**
     * @Accessor(getter="getLevel", setter="setLevel")
     * @SerializedName("level")
     * @Type("Zimbra\Enum\LoggingLevel")
     * @XmlAttribute
     */
    private $level;

    /**
     * Constructor method for loggerInfo
     * @param string $category
     * @param LoggingLevel $level
     * @return self
     */
    public function __construct($category, ?LoggingLevel $level = NULL)
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
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Sets category
     *
     * @param  string $category
     * @return self
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Gets level enum
     *
     * @return LoggingLevel
     */
    public function getLevel(): ?LoggingLevel
    {
        return $this->level;
    }

    /**
     * Sets level enum
     *
     * @param  LoggingLevel $level
     * @return self
     */
    public function setLevel(LoggingLevel $level): self
    {
        $this->level = $level;
        return $this;
    }
}
