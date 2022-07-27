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
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetFreeBusyQueueInfoRequest request class
 * Get Free/Busy provider information
 * If the optional element <provider> is present in the request, the response contains the requested provider only.
 * if no provider is supplied in the request, the response contains all the providers.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetFreeBusyQueueInfoRequest extends SoapRequest
{
    /**
     * Provider
     * @Accessor(getter="getProvider", setter="setProvider")
     * @SerializedName("provider")
     * @Type("Zimbra\Common\Struct\NamedElement")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?NamedElement $provider = NULL;

    /**
     * Constructor method for GetFreeBusyQueueInfoRequest
     * 
     * @param  NamedElement $provider
     * @return self
     */
    public function __construct(?NamedElement $provider = NULL)
    {
        if ($provider instanceof NamedElement) {
            $this->setProvider($provider);
        }
    }

    /**
     * Gets provider.
     *
     * @return NamedElement
     */
    public function getProvider(): ?NamedElement
    {
        return $this->provider;
    }

    /**
     * Sets provider.
     *
     * @param  NamedElement $provider
     * @return self
     */
    public function setProvider(NamedElement $provider): self
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetFreeBusyQueueInfoEnvelope(
            new GetFreeBusyQueueInfoBody($this)
        );
    }
}
