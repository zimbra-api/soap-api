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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};
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
     *
     * @var LoggingLevel
     */
    #[Accessor(getter: "getLevel", setter: "setLevel")]
    #[SerializedName("level")]
    #[XmlAttribute]
    private ?LoggingLevel $level;

    /**
     * message text
     *
     * @var string
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private ?string $content = null;

    /**
     * Constructor
     *
     * @param int $index
     * @param LoggingLevel $level
     * @param string $content
     * @return self
     */
    public function __construct(
        ?int $index = null,
        ?LoggingLevel $level = null,
        ?string $content = null
    ) {
        parent::__construct($index);
        $this->level = $level;
        if (null !== $content) {
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
