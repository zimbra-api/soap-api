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
 * GetAllDomainsRequest class
 * Get all domains
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllDomainsRequest extends SoapRequest
{
    /**
     * Apply config flag
     * 
     * @Accessor(getter="isApplyConfig", setter="setApplyConfig")
     * @SerializedName("applyConfig")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isApplyConfig', setter: 'setApplyConfig')]
    #[SerializedName(name: 'applyConfig')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $applyConfig;

    /**
     * Constructor
     * 
     * @param  bool $applyConfig
     * @return self
     */
    public function __construct(?bool $applyConfig = NULL)
    {
        if (NULL !== $applyConfig) {
            $this->setApplyConfig($applyConfig);
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAllDomainsEnvelope(
            new GetAllDomainsBody($this)
        );
    }
}
