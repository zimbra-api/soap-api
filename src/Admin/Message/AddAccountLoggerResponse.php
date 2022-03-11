<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\LoggerInfo as Logger;
use Zimbra\Soap\ResponseInterface;

/**
 * AddAccountLoggerResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AddAccountLoggerResponse implements ResponseInterface
{
    /**
     * Information on loggers
     * 
     * @Accessor(getter="getLoggers", setter="setLoggers")
     * @SerializedName("logger")
     * @Type("array<Zimbra\Admin\Struct\LoggerInfo>")
     * @XmlList(inline = true, entry = "logger")
     */
    private $loggers;

    /**
     * Constructor method for AddAccountLoggerResponse
     *
     * @param array $loggers
     * @return self
     */
    public function __construct(array $loggers = [])
    {
        $this->setLoggers($loggers);
    }

    /**
     * Add a logger
     *
     * @param  Logger $logger
     * @return self
     */
    public function addLogger(Logger $logger): self
    {
        $this->loggers[] = $logger;
        return $this;
    }

    /**
     * Sets loggers
     *
     * @param  array $loggers
     * @return self
     */
    public function setLoggers(array $loggers): self
    {
        $this->loggers = [];
        foreach ($loggers as $logger) {
            if ($logger instanceof Logger) {
                $this->loggers[] = $logger;
            }
        }
        return $this;
    }

    /**
     * Gets loggers
     *
     * @return array
     */
    public function getLoggers(): array
    {
        return $this->loggers;
    }
}
