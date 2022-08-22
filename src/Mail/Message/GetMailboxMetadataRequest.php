<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{SectionAttr, SoapEnvelopeInterface, SoapRequest};

/**
 * GetMailboxMetadataRequest class
 * Get Mailbox metadata
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMailboxMetadataRequest extends SoapRequest
{
    /**
     * Metadata section specification
     * 
     * @Accessor(getter="getMetadata", setter="setMetadata")
     * @SerializedName("meta")
     * @Type("Zimbra\Common\Struct\SectionAttr")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var SectionAttr
     */
    #[Accessor(getter: "getMetadata", setter: "setMetadata")]
    #[SerializedName('meta')]
    #[Type(SectionAttr::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private SectionAttr $metadata;

    /**
     * Constructor
     *
     * @param  SectionAttr $metadata
     * @return self
     */
    public function __construct(SectionAttr $metadata)
    {
        $this->setMetadata($metadata);
    }

    /**
     * Get metadata
     *
     * @return SectionAttr
     */
    public function getMetadata(): SectionAttr
    {
        return $this->metadata;
    }

    /**
     * Set metadata
     *
     * @param  SectionAttr $metadata
     * @return self
     */
    public function setMetadata(SectionAttr $metadata): self
    {
        $this->metadata = $metadata;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetMailboxMetadataEnvelope(
            new GetMailboxMetadataBody($this)
        );
    }
}
