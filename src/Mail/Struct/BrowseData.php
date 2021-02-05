<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlValue, XmlRoot};

/**
 * BrowseData class
 * Browse data
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="bd")
 */
class BrowseData
{
    /**
     * Set for domains.  Indicates whether or not the domain was from the "From", "To", or
     * "Cc" header.  Valid flags are always one of: "f", "t", "ft", "c", "fc", "tc", "ftc"
     * @Accessor(getter="getBrowseDomainHeader", setter="setBrowseDomainHeader")
     * @SerializedName("h")
     * @Type("string")
     * @XmlAttribute
     */
    private $browseDomainHeader;

    /**
     * Frequency count
     * @Accessor(getter="getFrequency", setter="setFrequency")
     * @SerializedName("freq")
     * @Type("integer")
     * @XmlAttribute
     */
    private $frequency;

    /**
     * Browse data.
     * for attachments: content type (application/msword)
     * for objects: object type (url, etc)
     * for domains: domains (stanford.edu, etc)
     * @Accessor(getter="getData", setter="setData")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata = false)
     */
    private $data;

    /**
     * Constructor method for BrowseData
     *
     * @param  string $browseDomainHeader
     * @param  int $frequency
     * @param  string $data
     * @return self
     */
    public function __construct(
        string $browseDomainHeader, int $frequency, ?string $data = NULL
    )
    {
        $this->setBrowseDomainHeader($browseDomainHeader)
             ->setFrequency($frequency);
        if (NULL !== $data) {
            $this->setData($data);
        }
    }

    /**
     * Gets browseDomainHeader
     *
     * @return string
     */
    public function getBrowseDomainHeader(): string
    {
        return $this->browseDomainHeader;
    }

    /**
     * Sets browseDomainHeader
     *
     * @param  string $browseDomainHeader
     * @return self
     */
    public function setBrowseDomainHeader(string $browseDomainHeader): self
    {
        $this->browseDomainHeader = $browseDomainHeader;
        return $this;
    }

    /**
     * Gets frequency
     *
     * @return int
     */
    public function getFrequency(): int
    {
        return $this->frequency;
    }

    /**
     * Sets frequency
     *
     * @param  int $frequency
     * @return self
     */
    public function setFrequency(int $frequency): self
    {
        $this->frequency = $frequency;
        return $this;
    }

    /**
     * Gets data
     *
     * @return string
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * Sets data
     *
     * @param  string $data
     * @return self
     */
    public function setData(string $data): self
    {
        $this->data = $data;
        return $this;
    }
}