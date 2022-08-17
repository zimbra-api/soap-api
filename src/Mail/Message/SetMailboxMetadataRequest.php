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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SetMailboxMetadataRequest extends SoapRequest
{
    /**
     * New metadata information
     * 
     * @var MailCustomMetadata
     */
    #[Accessor(getter: "getMetadata", setter: "setMetadata")]
    #[SerializedName(name: 'meta')]
    #[Type(name: MailCustomMetadata::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $metadata;

    /**
     * Constructor
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function __construct(MailCustomMetadata $metadata)
    {
        $this->setMetadata($metadata);
    }


    /**
     * Get metadata
     *
     * @return MailCustomMetadata
     */
    public function getMetadata(): MailCustomMetadata
    {
        return $this->metadata;
    }

    /**
     * Set metadata
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SetMailboxMetadataEnvelope(
            new SetMailboxMetadataBody($this)
        );
    }
}
