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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * SetMailboxMetadataRequest class
 * Set Mailbox Metadata
 * - Setting a mailbox metadata section but providing no key/value pairs will remove the section from mailbox metadata
 * - Empty value not allowed
 * - {metadata-section-key} must be no more than 36 characters long and must be in the format of
 *   {namespace}:{section-name}.  currently the only valid namespace is "zwc".
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SetMailboxMetadataRequest extends Request
{
    /**
     * New metadata information
     * 
     * @Accessor(getter="getMetadata", setter="setMetadata")
     * @SerializedName("meta")
     * @Type("Zimbra\Mail\Struct\MailCustomMetadata")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailCustomMetadata $metadata = NULL;

    /**
     * Constructor method for SetMailboxMetadataRequest
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function __construct(?MailCustomMetadata $metadata = NULL)
    {
        if ($metadata instanceof MailCustomMetadata) {
            $this->setMetadata($metadata);
        }
    }


    /**
     * Gets metadata
     *
     * @return MailCustomMetadata
     */
    public function getMetadata(): ?MailCustomMetadata
    {
        return $this->metadata;
    }

    /**
     * Sets metadata
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function setMetadata(MailCustomMetadata $metadata): self
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
        return new SetMailboxMetadataEnvelope(
            new SetMailboxMetadataBody($this)
        );
    }
}
