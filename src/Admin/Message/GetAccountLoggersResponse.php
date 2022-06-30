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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAccountLoggersResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAccountLoggersResponse implements ResponseInterface
{
    /**
     * Information for custom loggers created for the given account since the last server start.
     * 
     * @Accessor(getter="getLoggers", setter="setLoggers")
     * @Type("array<Zimbra\Admin\Struct\LoggerInfo>")
     * @XmlList(inline=true, entry="logger", namespace="urn:zimbraAdmin")
     */
    private $loggers = [];

    /**
     * Constructor method for GetAccountLoggersResponse
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
     * @param  LoggerInfo $logger
     * @return self
     */
    public function addLogger(LoggerInfo $logger): self
    {
        $this->loggers[] = $logger;
        return $this;
    }

    /**
     * Sets loggers
     *
     * @param array $loggers
     * @return self
     */
    public function setLoggers(array $loggers): self
    {
        $this->loggers = array_filter($loggers, static fn ($logger) => $logger instanceof LoggerInfo);
        return $this;
    }

    /**
     * Gets loggers
     *
     * @return array
     */
    public function getLoggers(): ?array
    {
        return $this->loggers;
    }
}
