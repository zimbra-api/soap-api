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
 * PurgeFreeBusyQueueRequest class
 * Purges the queue for the given freebusy provider on the current host
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class PurgeFreeBusyQueueRequest extends SoapRequest
{
    /**
     * FreeBusy Provider specification
     * 
     * @Accessor(getter="getProvider", setter="setProvider")
     * @SerializedName("provider")
     * @Type("Zimbra\Common\Struct\NamedElement")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var NamedElement
     */
    private $provider;

    /**
     * Constructor
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
     * Get zimbra provider
     *
     * @return NamedElement
     */
    public function getProvider(): ?NamedElement
    {
        return $this->provider;
    }

    /**
     * Set zimbra provider
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new PurgeFreeBusyQueueEnvelope(
            new PurgeFreeBusyQueueBody($this)
        );
    }
}
