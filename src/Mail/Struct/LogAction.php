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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\LoggingLevel;

/**
 * LogAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class LogAction extends FilterAction
{
    /**
     * level - fatal|error|warn|info|debug|trace, info is default if not specified.
     * @Accessor(getter="getLevel", setter="setLevel")
     * @SerializedName("level")
     * @Type("Enum<Zimbra\Common\Enum\LoggingLevel>")
     * @XmlAttribute
     */
    private ?LoggingLevel $level = NULL;

    /**
     * message text
     * @Accessor(getter="getContent", setter="setContent")
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
    public function __construct(
        ?int $index = NULL, ?LoggingLevel $level = NULL, ?string $content = NULL
    )
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
     * Get level
     *
     * @return LoggingLevel
     */
    public function getLevel(): ?LoggingLevel
    {
        return $this->level;
    }

    /**
     * Set level
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
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
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
