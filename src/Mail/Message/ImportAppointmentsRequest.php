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
use Zimbra\Mail\Struct\ContentSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ImportAppointmentsRequest class
 * Import appointments
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ImportAppointmentsRequest extends SoapRequest
{
    /**
     * Optional folder ID to import appointments into
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName(name: 'l')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * Content type
     * Only currently supported content type is "text/calendar" (and its nickname "ics")
     * 
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getContentType', setter: 'setContentType')]
    #[SerializedName(name: 'ct')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $contentType;

    /**
     * Content specification
     * 
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("Zimbra\Mail\Struct\ContentSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ContentSpec
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[SerializedName(name: 'content')]
    #[Type(name: ContentSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $content;

    /**
     * Constructor
     *
     * @param  ContentSpec $content
     * @param  string $contentType
     * @param  string $folderId
     * 
     * @return self
     */
    public function __construct(
        ContentSpec $content,
        string $contentType = 'text/calendar',
        ?string $folderId = NULL
    )
    {
        $this->setContent($content)
             ->setContentType($contentType);
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
    }

    /**
     * Get content
     *
     * @return ContentSpec
     */
    public function getContent(): ContentSpec
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  ContentSpec $content
     * @return self
     */
    public function setContent(ContentSpec $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Get contentType
     *
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * Set contentType
     *
     * @param  string $contentType
     * @return self
     */
    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ImportAppointmentsEnvelope(
            new ImportAppointmentsBody($this)
        );
    }
}
