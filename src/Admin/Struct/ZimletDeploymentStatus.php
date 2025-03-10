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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\ZimletDeployStatus;

/**
 * ZimletDeploymentStatus struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ZimletDeploymentStatus
{
    /**
     * Server name
     *
     * @var string
     */
    #[Accessor(getter: "getServer", setter: "setServer")]
    #[SerializedName("server")]
    #[Type("string")]
    #[XmlAttribute]
    private string $server;

    /**
     * Status - valid values succeeded|failed|pending
     *
     * @var ZimletDeployStatus
     */
    #[Accessor(getter: "getStatus", setter: "setStatus")]
    #[SerializedName("status")]
    #[XmlAttribute]
    private ZimletDeployStatus $status;

    /**
     * Error message
     *
     * @var string
     */
    #[Accessor(getter: "getError", setter: "setError")]
    #[SerializedName("error")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $error = null;

    /**
     * Constructor
     *
     * @param  string $server
     * @param  ZimletDeployStatus $status
     * @param  string $error
     * @return self
     */
    public function __construct(
        string $server = "",
        ?ZimletDeployStatus $status = null,
        ?string $error = null
    ) {
        $this->setServer($server)->setStatus(
            $status ?? ZimletDeployStatus::SUCCEEDED
        );
        if (null !== $error) {
            $this->setError($error);
        }
    }

    /**
     * Get server
     *
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * Set server
     *
     * @param  string $server
     * @return self
     */
    public function setServer(string $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * Get status
     *
     * @return ZimletDeployStatus
     */
    public function getStatus(): ZimletDeployStatus
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  ZimletDeployStatus $status
     * @return self
     */
    public function setStatus(ZimletDeployStatus $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get error
     *
     * @return string
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Set error
     *
     * @param  string $error
     * @return self
     */
    public function setError(string $error): self
    {
        $this->error = $error;
        return $this;
    }
}
