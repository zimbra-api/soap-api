<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyserver and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllServersResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllServersResponse extends SoapResponse
{
    /**
     * Information about servers
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
     * @param  array $serverList
     * @return self
     */
    public function setServerList(array $serverList): self
    {
        $this->serverList = array_filter($serverList, static fn ($server) => $server instanceof ServerInfo);
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
