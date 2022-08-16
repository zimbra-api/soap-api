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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Common\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetServerRequest class
 * Get Server
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetServerRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * If {apply-config} is 1 (true), then certain unset attrs on a server will get their values from the global config. 
     * if {apply-config} is 0 (false), then only attributes directly set on the server will be returned
     * 
     * @var bool
     */
    #[Accessor(getter: 'isApplyConfig', setter: 'setApplyConfig')]
    #[SerializedName(name: 'applyConfig')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $applyConfig;

    /**
     * Server
     * 
     * @var ServerSelector
     */
    #[Accessor(getter: 'getServer', setter: 'setServer')]
    #[SerializedName(name: 'server')]
    #[Type(name: ServerSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $server;

    /**
     * Constructor
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
     * Get applyConfig
     *
     * @return bool
     */
    public function isApplyConfig(): ?bool
    {
        return $this->applyConfig;
    }

    /**
     * Set applyConfig
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
     * Get the server.
     *
     * @return ServerSelector
     */
    public function getServer(): ?ServerSelector
    {
        return $this->server;
    }

    /**
     * Set the server.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetServerEnvelope(
            new GetServerBody($this)
        );
    }
}
