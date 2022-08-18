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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetAllServersRequest class
 * Get all servers defined in the system or all servers that have a particular service enabled (eg, mta, antispam, spell).
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllServersRequest extends SoapRequest
{
    /**
     * Service name.  e.g. mta, antispam, spell.
     * 
     * @var string
     */
    #[Accessor(getter: 'getService', setter: 'setService')]
    #[SerializedName('service')]
    #[Type('string')]
    #[XmlAttribute]
    private $service;

    /**
     * alwaysOnClusterId
     * 
     * @var string
     */
    #[Accessor(getter: 'getAlwaysOnClusterId', setter: 'setAlwaysOnClusterId')]
    #[SerializedName('alwaysOnClusterId')]
    #[Type('string')]
    #[XmlAttribute]
    private $alwaysOnClusterId;

    /**
     * if {apply-config} is 1 (true), then certain unset attrs on a server will get their value from the global config.
     * if {apply-config} is 0 (false), then only attributes directly set on the server will be returned
     * 
     * @var bool
     */
    #[Accessor(getter: 'isApplyConfig', setter: 'setApplyConfig')]
    #[SerializedName('applyConfig')]
    #[Type('bool')]
    #[XmlAttribute]
    private $applyConfig;

    /**
     * Constructor
     * 
     * @param  string $service
     * @param  string $alwaysOnClusterId
     * @param  bool $applyConfig
     * @return self
     */
    public function __construct(
        ?string $service = NULL, ?string $alwaysOnClusterId = NULL, ?bool $applyConfig = NULL
    )
    {
        if (NULL !== $service) {
            $this->setService($service);
        }
        if (NULL !== $alwaysOnClusterId) {
            $this->setAlwaysOnClusterId($alwaysOnClusterId);
        }
        if (NULL !== $applyConfig) {
            $this->setApplyConfig($applyConfig);
        }
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService(): ?string
    {
        return $this->service;
    }

    /**
     * Set service
     *
     * @param  string $service
     * @return self
     */
    public function setService(string $service): self
    {
        $this->service = $service;
        return $this;
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
     * Get alwaysOnClusterId
     *
     * @return string
     */
    public function getAlwaysOnClusterId(): ?string
    {
        return $this->alwaysOnClusterId;
    }

    /**
     * Set alwaysOnClusterId
     *
     * @param  string $alwaysOnClusterId
     * @return self
     */
    public function setAlwaysOnClusterId(string $alwaysOnClusterId): self
    {
        $this->alwaysOnClusterId = $alwaysOnClusterId;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAllServersEnvelope(
            new GetAllServersBody($this)
        );
    }
}
