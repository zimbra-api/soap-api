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
use Zimbra\Admin\Struct\AccountLoggerInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllAccountLoggersResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllAccountLoggersResponse extends SoapResponse
{
    /**
     * Account loggers that have been created on the given server since the last server start
     * 
     * @Accessor(getter="getLoggers", setter="setLoggers")
     * @Type("array<Zimbra\Admin\Struct\AccountLoggerInfo>")
     * @XmlList(inline=true, entry="accountLogger", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getLoggers', setter: 'setLoggers')]
    #[Type('array<Zimbra\Admin\Struct\AccountLoggerInfo>')]
    #[XmlList(inline: true, entry: 'accountLogger', namespace: 'urn:zimbraAdmin')]
    private $loggers = [];

    /**
     * Constructor
     *
     * @param array $loggers
     * @return self
     */
    public function __construct(array $loggers = [])
    {
        $this->setLoggers($loggers);
    }

    /**
     * Set account loggers
     *
     * @param  array $loggers
     * @return self
     */
    public function setLoggers(array $loggers): self
    {
        $this->loggers = array_filter($loggers, static fn ($logger) => $logger instanceof AccountLoggerInfo);
        return $this;
    }

    /**
     * Get account loggers
     *
     * @return array
     */
    public function getLoggers(): array
    {
        return $this->loggers;
    }
}
