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
 * SetCustomMetadataRequest class
 * Set Custom Metadata
 * Setting a custom metadata section but providing no key/value pairs will remove the sction from the item
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SetCustomMetadataRequest extends Request
{
    /**
     * Item ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

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
     * Constructor method for SetCustomMetadataRequest
     *
     * @param  string $id
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function __construct(
        string $id = '', ?MailCustomMetadata $metadata = NULL
    )
    {
        $this->setId($id);
        if ($metadata instanceof MailCustomMetadata) {
            $this->setMetadata($metadata);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
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
        return new SetCustomMetadataEnvelope(
            new SetCustomMetadataBody($this)
        );
    }
}