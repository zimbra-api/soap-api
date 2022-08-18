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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllActiveServersResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllActiveServersResponse extends SoapResponse
{
    /**
     * Information about active servers
     * 
     * @Accessor(getter="getServerList", setter="setServerList")
     * @Type("array<Zimbra\Admin\Struct\ServerInfo>")
     * @XmlList(inline=true, entry="server", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getServerList', setter: 'setServerList')]
    #[Type('array<Zimbra\Admin\Struct\ServerInfo>')]
    #[XmlList(inline: true, entry: 'server', namespace: 'urn:zimbraAdmin')]
    private $serverList = [];

    /**
     * Constructor
     *
     * @param array $serverList
     * @return self
     */
    public function __construct(array $serverList = [])
    {
        $this->setServerList($serverList);
    }

    /**
     * Set server informations
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
     * Get server informations
     *
     * @return array
     */
    public function getServerList(): array
    {
        return $this->serverList;
    }
}
