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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\AccountLoggerInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllAccountLoggersResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllAccountLoggersResponse")
 */
class GetAllAccountLoggersResponse implements ResponseInterface
{
    /**
     * Account loggers that have been created on the given server since the last server start
     * 
     * @Accessor(getter="getLoggers", setter="setLoggers")
     * @SerializedName("accountLogger")
     * @Type("array<Zimbra\Admin\Struct\AccountLoggerInfo>")
     * @XmlList(inline = true, entry = "accountLogger")
     */
    private $loggers;

    /**
     * Constructor method for GetAllAccountLoggersResponse
     * @param array $loggers
     * @return self
     */
    public function __construct(array $loggers = [])
    {
        $this->setLoggers($loggers);
    }

    /**
     * Add an account logger
     *
     * @param  AccountLoggerInfo $logger
     * @return self
     */
    public function addLogger(AccountLoggerInfo $logger): self
    {
        $this->loggers[] = $logger;
        return $this;
    }

    /**
     * Sets account loggers
     *
     * @param  array $loggers
     * @return self
     */
    public function setLoggers(array $loggers): self
    {
        $this->loggers = [];
        foreach ($loggers as $logger) {
            if ($logger instanceof AccountLoggerInfo) {
                $this->loggers[] = $logger;
            }
        }
        return $this;
    }

    /**
     * Gets account loggers
     *
     * @return array
     */
    public function getLoggers(): array
    {
        return $this->loggers;
    }
}
