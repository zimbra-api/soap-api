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
use Zimbra\Common\Struct\SectionAttr;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetMailboxMetadataRequest class
 * Get Mailbox metadata
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetMailboxMetadataRequest extends Request
{
    /**
     * Metadata section specification
     * @Accessor(getter="getMetadata", setter="setMetadata")
     * @SerializedName("meta")
     * @Type("Zimbra\Common\Struct\SectionAttr")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?SectionAttr $metadata = NULL;

    /**
     * Constructor method for GetMailboxMetadataRequest
     *
     * @param  SectionAttr $metadata
     * @return self
     */
    public function __construct(?SectionAttr $metadata = NULL)
    {
        if ($metadata instanceof SectionAttr) {
            $this->setMetadata($metadata);
        }
    }

    /**
     * Gets metadata
     *
     * @return SectionAttr
     */
    public function getMetadata(): ?SectionAttr
    {
        return $this->metadata;
    }

    /**
     * Sets metadata
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetMailboxMetadataEnvelope(
            new GetMailboxMetadataBody($this)
        );
    }
}
