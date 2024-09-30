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
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Common\Struct\{
    AttributeSelector,
    AttributeSelectorTrait,
    SoapEnvelopeInterface,
    SoapRequest
};

/**
 * GetUCServiceRequest class
 * Get UC Service
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetUCServiceRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * UC Service
     *
     * @Accessor(getter="getUCService", setter="setUCService")
     * @SerializedName("ucservice")
     * @Type("Zimbra\Admin\Struct\UcServiceSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var UcServiceSelector
     */
    #[Accessor(getter: "getUCService", setter: "setUCService")]
    #[SerializedName("ucservice")]
    #[Type(UcServiceSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private UcServiceSelector $ucService;

    /**
     * Constructor
     *
     * @param  UcServiceSelector $ucService
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        UcServiceSelector $ucService,
        ?string $attrs = null
    ) {
        $this->setUCService($ucService);
        if (null !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Get the ucService.
     *
     * @return UcServiceSelector
     */
    public function getUCService(): UcServiceSelector
    {
        return $this->ucService;
    }

    /**
     * Set the ucService.
     *
     * @param  UcServiceSelector $ucService
     * @return self
     */
    public function setUCService(UcServiceSelector $ucService): self
    {
        $this->ucService = $ucService;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetUCServiceEnvelope(new GetUCServiceBody($this));
    }
}
