<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\ZimletDeployStatus as DeployStatus;

/**
 * ZimletDeploymentStatus struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="progress")
 */
class ZimletDeploymentStatus
{
    /**
     * Server name
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("string")
     * @XmlAttribute
     */
    private $server;

    /**
     * Status - valid values succeeded|failed|pending
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Enum\ZimletDeployStatus")
     * @XmlAttribute
     */
    private $status;

    /**
     * Error message
     * @Accessor(getter="getError", setter="setError")
     * @SerializedName("error")
     * @Type("string")
     * @XmlAttribute
     */
    private $error;

    /**
     * Constructor method for ZimletDeploymentStatus
     * @param  string $server
     * @param  DeployStatus $status
     * @param  string $error
     * @return self
     */
    public function __construct($server, DeployStatus $status, $error = NULL)
    {
        $this->setServer($server)
             ->setStatus($status);
        if (NULL !== $error) {
            $this->setError($error);
        }
    }

    /**
     * Gets server
     *
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * Sets server
     *
     * @param  string $server
     * @return self
     */
    public function setServer($server): self
    {
        $this->server = trim($server);
        return $this;
    }

    /**
     * Gets status
     *
     * @return DeployStatus
     */
    public function getStatus(): DeployStatus
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  DeployStatus $status
     * @return self
     */
    public function setStatus(DeployStatus $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Gets error
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * Sets error
     *
     * @param  string $error
     * @return self
     */
    public function setError($error): self
    {
        $this->error = trim($error);
        return $this;
    }
}
