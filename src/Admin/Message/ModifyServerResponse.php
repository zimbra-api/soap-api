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
use Zimbra\Soap\ResponseInterface;

/**
 * ModifyServerResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyServerResponse implements ResponseInterface
{
    /**
     * Information about server
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?ServerInfo $server = NULL;

    /**
     * Constructor method for ModifyServerResponse
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
     * Gets the server.
     *
     * @return ServerInfo
     */
    public function getServer(): ?ServerInfo
    {
        return $this->server;
    }

    /**
     * Sets the server.
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
