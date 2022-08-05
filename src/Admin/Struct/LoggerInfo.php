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
use Zimbra\Common\Enum\LoggingLevel;

/**
 * LoggerInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present level Nguyen Van Nguyen.
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
     * @Type("Enum<Zimbra\Common\Enum\LoggingLevel>")
     * @XmlAttribute
     */
    private ?LoggingLevel $level = NULL;

    /**
     * Constructor
     * 
     * @param string $category
     * @param LoggingLevel $level
     * @return self
     */
    public function __construct(string $category = '', ?LoggingLevel $level = NULL)
    {
        $this->setCategory($category);
        if (NULL !== $level) {
            $this->setLevel($level);
        }
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Set category
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
     * Get level enum
     *
     * @return LoggingLevel
     */
    public function getLevel(): ?LoggingLevel
    {
        return $this->level;
    }

    /**
     * Set level enum
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
