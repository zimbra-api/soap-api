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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetCustomMetadataResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetCustomMetadataResponse extends SoapResponse
{
    /**
     * Item ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Custom metadata
     * 
     * @Accessor(getter="getMetadata", setter="setMetadata")
     * @SerializedName("meta")
     * @Type("Zimbra\Mail\Struct\MailCustomMetadata")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var MailCustomMetadata
     */
    #[Accessor(getter: 'getMetadata', setter: 'setMetadata')]
    #[SerializedName('meta')]
    #[Type(MailCustomMetadata::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?MailCustomMetadata $metadata;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function __construct(
        ?string $id = NULL, ?MailCustomMetadata $metadata = NULL
    )
    {
        $this->metadata = $metadata;
        if (NULL !== $id) {
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
}
