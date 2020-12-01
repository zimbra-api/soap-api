<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlValue, XmlRoot};
use Zimbra\Enum\LoggingLevel;

/**
 * LogAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="actionLog")
 */
class LogAction extends FilterAction
{
    /**
     * level - fatal|error|warn|info|debug|trace, info is default if not specified.
     * @Accessor(getter="getLevel", setter="setLevel")
     * @SerializedName("level")
     * @Type("Zimbra\Enum\LoggingLevel")
     * @XmlAttribute
     */
    private $level;

    /**
     * message text
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $content;

    /**
     * Constructor method for LogAction
     * 
     * @param int $index
     * @param LoggingLevel $level
     * @param string $content
     * @return self
     */
    public function __construct(?int $index = NULL, ?LoggingLevel $level = NULL, ?string $content = NULL)
    {
    	parent::__construct($index);
        if ($level instanceof LoggingLevel) {
            $this->setLevel($level);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
    }

    /**
     * Gets level
     *
     * @return LoggingLevel
     */
    public function getLevel(): ?LoggingLevel
    {
        return $this->level;
    }

    /**
     * Sets level
     *
     * @param  LoggingLevel $level
     * @return self
     */
    public function setLevel(LoggingLevel $level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }
}
