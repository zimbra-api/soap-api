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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetServerResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetServerResponse extends SoapResponse
{
    /**
     * Information about server
     * 
     * @var ServerInfo
     */
    #[Accessor(getter: 'getServer', setter: 'setServer')]
    #[SerializedName(name: 'server')]
    #[Type(name: ServerInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $server;

    /**
     * Constructor
     *
     * @param ServerInfo $server
     * @return self
     */
    public function __construct(?ServerInfo $server = NULL)
    {
        if ($server instanceof ServerInfo) {
            $this->setServer($server);
        }
    }

    /**
     * Get the server.
     *
     * @return ServerInfo
     */
    public function getServer(): ?ServerInfo
    {
        return $this->server;
    }

    /**
     * Set the server.
     *
     * @param  ServerInfo $server
     * @return self
     */
    public function setServer(ServerInfo $server): self
    {
        $this->server = $server;
        return $this;
    }
}
