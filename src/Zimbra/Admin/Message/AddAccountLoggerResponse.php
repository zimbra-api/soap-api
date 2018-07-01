<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Admin\Struct\LoggerInfo as Logger;
use Zimbra\Soap\Response;

/**
 * AddAccountLoggerResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="AddAccountLoggerResponse", namespace="urn:zimbraAdmin")
 */
class AddAccountLoggerResponse extends Response
{
    /**
     * Information on loggers
     * @Accessor(getter="getLoggers", setter="setLoggers")
     * @Type("array<Zimbra\Admin\Struct\LoggerInfo>")
     * @XmlList(inline = true, entry = "logger")
     */
    private $_loggers;

    /**
     * Constructor method for AddAccountLoggerResponse
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
     * @param  Logger $attr
     * @return self
     */
    public function addLogger(Logger $logger)
    {
        $this->_loggers[] = $logger;
        return $this;
    }

    /**
     * Sets logger sequence
     *
     * @param  array $loggers
     * @return self
     */
    public function setLoggers(array $loggers)
    {
        $this->_loggers = [];
        foreach ($loggers as $logger) {
            if ($logger instanceof Logger) {
                $this->_loggers[] = $logger;
            }
        }
        return $this;
    }

    /**
     * Gets logger sequence
     *
     * @return array
     */
    public function getLoggers()
    {
        return $this->_loggers;
    }
}
