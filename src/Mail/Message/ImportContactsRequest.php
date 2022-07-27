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
use Zimbra\Mail\Struct\Content;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ImportContactsRequest class
 * Import contacts
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ImportContactsRequest extends SoapRequest
{
    /**
     * Content type.
     * Only currenctly supported content type is "csv"
     * 
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentType;

    /**
     * Optional Folder ID to import contacts to
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * The format of csv being imported.  when it's not defined, Zimbra format is assumed.
     * The supported formats are defined in $ZIMBRA_HOME/conf/zimbra-contact-fields.xml
     * 
     * @Accessor(getter="getCsvFormat", setter="setCsvFormat")
     * @SerializedName("csvfmt")
     * @Type("string")
     * @XmlAttribute
     */
    private $csvFormat;

    /**
     * The locale to use when there are multiple <csvfmtt> locales defined.
     * When it is not specified, the <csvfmtt> with no locale specification is used.
     * 
     * @Accessor(getter="getCsvLocale", setter="setCsvLocale")
     * @SerializedName("csvlocale")
     * @Type("string")
     * @XmlAttribute
     */
    private $csvLocale;

    /**
     * Content specification
     * 
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("Zimbra\Mail\Struct\Content")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private Content $content;

    /**
     * Constructor method for ImportContactsRequest
     *
     * @param  Content $content
     * @param  string $contentType
     * @param  string $folderId
     * @param  string $csvFormat
     * @param  string $csvLocale
     * @return self
     */
    public function __construct(
        Content $content,
        string $contentType = 'text/csv',
        ?string $folderId = NULL,
        ?string $csvFormat = NULL,
        ?string $csvLocale = NULL
    )
    {
        $this->setContent($content)
             ->setContentType($contentType);
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $csvFormat) {
            $this->setCsvFormat($csvFormat);
        }
        if (NULL !== $csvLocale) {
            $this->setCsvLocale($csvLocale);
        }
    }

    /**
     * Gets content
     *
     * @return Content
     */
    public function getContent(): Content
    {
        return $this->content;
    }

    /**
     * Sets content
     *
     * @param  Content $content
     * @return self
     */
    public function setContent(Content $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Gets folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
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
     * Gets contentType
     *
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * Sets contentType
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
     * Gets csvFormat
     *
     * @return string
     */
    public function getCsvFormat(): ?string
    {
        return $this->csvFormat;
    }

    /**
     * Sets csvFormat
     *
     * @param  string $csvFormat
     * @return self
     */
    public function setCsvFormat(string $csvFormat): self
    {
        $this->csvFormat = $csvFormat;
        return $this;
    }

    /**
     * Gets csvLocale
     *
     * @return string
     */
    public function getCsvLocale(): ?string
    {
        return $this->csvLocale;
    }

    /**
     * Sets csvLocale
     *
     * @param  string $csvLocale
     * @return self
     */
    public function setCsvLocale(string $csvLocale): self
    {
        $this->csvLocale = $csvLocale;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ImportContactsEnvelope(
            new ImportContactsBody($this)
        );
    }
}
