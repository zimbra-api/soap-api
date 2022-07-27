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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ExportContactsRequest class
 * Export contacts
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ExportContactsRequest extends SoapRequest
{
    /**
     * Content type. Currently, the only supported content type is "csv" (comma-separated values)
     * 
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentType;

    /**
     * Optional folder id to export contacts from
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * Optional csv format for exported contacts.  the supported formats are defined in
     * $ZIMBRA_HOME/conf/zimbra-contact-fields.xml
     * 
     * @Accessor(getter="getCsvFormat", setter="setCsvFormat")
     * @SerializedName("csvfmt")
     * @Type("string")
     * @XmlAttribute
     */
    private $csvFormat;

    /**
     * The locale to use when there are multiple {csv-format} locales defined.
     * When it is not specified, the {csv-format} with no locale specification is used.
     * 
     * @Accessor(getter="getCsvLocale", setter="setCsvLocale")
     * @SerializedName("csvlocale")
     * @Type("string")
     * @XmlAttribute
     */
    private $csvLocale;

    /**
     * Optional delimiter character to use in the resulting csv file - usually "," or ";"
     * 
     * @Accessor(getter="getCsvDelimiter", setter="setCsvDelimiter")
     * @SerializedName("csvsep")
     * @Type("string")
     * @XmlAttribute
     */
    private $csvDelimiter;

    /**
     * Constructor method for ExportContactsRequest
     *
     * @param  string $contentType
     * @param  string $folderId
     * @param  string $csvFormat
     * @param  string $csvLocale
     * @param  string $csvDelimiter
     * @return self
     */
    public function __construct(
        string $contentType = '',
        ?string $folderId = NULL,
        ?string $csvFormat = NULL,
        ?string $csvLocale = NULL,
        ?string $csvDelimiter = NULL
    )
    {
        $this->setContentType($contentType);
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $csvFormat) {
            $this->setCsvFormat($csvFormat);
        }
        if (NULL !== $csvLocale) {
            $this->setCsvLocale($csvLocale);
        }
        if (NULL !== $csvDelimiter) {
            $this->setCsvDelimiter($csvDelimiter);
        }
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
     * Gets csvDelimiter
     *
     * @return string
     */
    public function getCsvDelimiter(): ?string
    {
        return $this->csvDelimiter;
    }

    /**
     * Sets csvDelimiter
     *
     * @param  string $csvDelimiter
     * @return self
     */
    public function setCsvDelimiter(string $csvDelimiter): self
    {
        $this->csvDelimiter = $csvDelimiter;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ExportContactsEnvelope(
            new ExportContactsBody($this)
        );
    }
}
