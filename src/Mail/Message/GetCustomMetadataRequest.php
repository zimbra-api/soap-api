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
use Zimbra\Common\Struct\SectionAttr;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * GetCustomMetadataRequest class
 * Get Custom metadata
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetCustomMetadataRequest extends Request
{
    /**
     * Item ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Metadata section selector
     * @Accessor(getter="getMetadata", setter="setMetadata")
     * @SerializedName("meta")
     * @Type("Zimbra\Common\Struct\SectionAttr")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private SectionAttr $metadata;

    /**
     * Constructor method for GetCustomMetadataRequest
     *
     * @param  SectionAttr $metadata
     * @param  string $id
     * @return self
     */
    public function __construct(
        SectionAttr $metadata, ?string $id = NULL
    )
    {
        $this->setMetadata($metadata);
        if (NULL !== $id) {
            $this->setId($id);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
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
     * @return SectionAttr
     */
    public function getMetadata(): SectionAttr
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
        return new GetCustomMetadataEnvelope(
            new GetCustomMetadataBody($this)
        );
    }
}
