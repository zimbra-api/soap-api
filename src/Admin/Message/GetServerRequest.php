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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Soap\Request;

/**
 * GetServerRequest class
 * Get Server
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetServerRequest")
 */
class GetServerRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * If {apply-config} is 1 (true), then certain unset attrs on a server will get their values from the global config. 
     * if {apply-config} is 0 (false), then only attributes directly set on the server will be returned
     * @Accessor(getter="isApplyConfig", setter="setApplyConfig")
     * @SerializedName("applyConfig")
     * @Type("bool")
     * @XmlAttribute
     */
    private $applyConfig;

    /**
     * Server
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerSelector")
     * @XmlElement
     */
    private $server;

    /**
     * Constructor method for GetServerRequest
     * 
     * @param  ServerSelector $server
     * @param  bool $applyConfig
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?ServerSelector $server = NULL,
        ?bool $applyConfig = NULL,
        ?string $attrs = NULL
    )
    {
        if ($server instanceof ServerSelector) {
            $this->setServer($server);
        }
        if (NULL !== $applyConfig) {
            $this->setApplyConfig($applyConfig);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets applyConfig
     *
     * @return bool
     */
    public function isApplyConfig(): ?bool
    {
        return $this->applyConfig;
    }

    /**
     * Sets applyConfig
     *
     * @param  bool $applyConfig
     * @return self
     */
    public function setApplyConfig(bool $applyConfig): self
    {
        $this->applyConfig = $applyConfig;
        return $this;
    }

    /**
     * Gets the server.
     *
     * @return ServerSelector
     */
    public function getServer(): ?ServerSelector
    {
        return $this->server;
    }

    /**
     * Sets the server.
     *
     * @param  ServerSelector $server
     * @return self
     */
    public function setServer(ServerSelector $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetServerEnvelope)) {
            $this->envelope = new GetServerEnvelope(
                new GetServerBody($this)
            );
        }
    }
}