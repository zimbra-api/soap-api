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
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Common\Soap\ResponseInterface;

/**
 * GetAllActiveServersResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllActiveServersResponse implements ResponseInterface
{
    /**
     * Information about active servers
     * 
     * @Accessor(getter="getServerList", setter="setServerList")
     * @Type("array<Zimbra\Admin\Struct\ServerInfo>")
     * @XmlList(inline=true, entry="server", namespace="urn:zimbraAdmin")
     */
    private $serverList = [];

    /**
     * Constructor method for GetAllActiveServersResponse
     *
     * @param array $serverList
     * @return self
     */
    public function __construct(array $serverList = [])
    {
        $this->setServerList($serverList);
    }

    /**
     * Add a server information
     *
     * @param  ServerInfo $server
     * @return self
     */
    public function addServer(ServerInfo $server): self
    {
        $this->serverList[] = $server;
        return $this;
    }

    /**
     * Sets server informations
     *
     * @param  array $list
     * @return self
     */
    public function setServerList(array $list): self
    {
        $this->serverList = array_filter($list, static fn ($server) => $server instanceof ServerInfo);
        return $this;
    }

    /**
     * Gets server informations
     *
     * @return array
     */
    public function getServerList(): array
    {
        return $this->serverList;
    }
}
