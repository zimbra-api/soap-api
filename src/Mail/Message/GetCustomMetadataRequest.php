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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Struct\{SectionAttr, SoapEnvelopeInterface, SoapRequest};

/**
 * GetCustomMetadataRequest class
 * Get custom metadata
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetCustomMetadataRequest extends SoapRequest
{
    /**
     * Item ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Metadata section selector
     *
     * @var SectionAttr
     */
    #[Accessor(getter: "getMetadata", setter: "setMetadata")]
    #[SerializedName("meta")]
    #[Type(SectionAttr::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private SectionAttr $metadata;

    /**
     * Constructor
     *
     * @param  SectionAttr $metadata
     * @param  string $id
     * @return self
     */
    public function __construct(SectionAttr $metadata, ?string $id = null)
    {
        $this->setMetadata($metadata);
        if (null !== $id) {
            $this->setId($id);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
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
        return new GetCustomMetadataEnvelope(new GetCustomMetadataBody($this));
    }
}
