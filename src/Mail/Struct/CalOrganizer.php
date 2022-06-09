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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Struct\{CalOrganizerInterface, XParamInterface};

/**
 * CalOrganizer struct class
 * Calendar organizer
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CalOrganizer implements CalOrganizerInterface
{
    /**
     * Email address (without "MAILTO:")
     * @Accessor(getter="getAddress", setter="setAddress")
     * @SerializedName("a")
     * @Type("string")
     * @XmlAttribute
     */
    private $address;

    /**
     * URL - has same value as email-address.
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     */
    private $url;

    /**
     * Friendly name - "CN" in iCalendar
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $displayName;

    /**
     * iCalendar SENT-BY
     * @Accessor(getter="getSentBy", setter="setSentBy")
     * @SerializedName("sentBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $sentBy;

    /**
     * iCalendar DIR - Reference to a directory entry associated with the calendar user.
     * @Accessor(getter="getDir", setter="setDir")
     * @SerializedName("dir")
     * @Type("string")
     * @XmlAttribute
     */
    private $dir;

    /**
     * iCalendar LANGUAGE - As defined in RFC5646 * (e.g. "en-US")
     * @Accessor(getter="getLanguage", setter="setLanguage")
     * @SerializedName("lang")
     * @Type("string")
     * @XmlAttribute
     */
    private $language;

    /**
     * Non-standard parameters (XPARAMs)
     * @Accessor(getter="getXParams", setter="setXParams")
     * @SerializedName("xparam")
     * @Type("array<Zimbra\Mail\Struct\XParam>")
     * @XmlList(inline = true, entry = "xparam")
     */
    private $xParams = [];

    /**
     * Constructor mothod
     *
     * @param string $address
     * @param string $url
     * @param string $displayName
     * @param string $sentBy
     * @param string $dir
     * @param string $language
     * @param array $xParams
     * @return self
     */
    public function __construct(
        ?string $address = NULL,
        ?string $url = NULL,
        ?string $displayName = NULL,
        ?string $sentBy = NULL,
        ?string $dir = NULL,
        ?string $language = NULL,
        array $xParams = []
    )
    {
        $this->setXParams($xParams);
        if (NULL !== $address) {
            $this->setAddress($address);
        }
        if (NULL !== $url) {
            $this->setUrl($url);
        }
        if (NULL !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (NULL !== $sentBy) {
            $this->setSentBy($sentBy);
        }
        if (NULL !== $dir) {
            $this->setDir($dir);
        }
        if (NULL !== $language) {
            $this->setLanguage($language);
        }
    }

    /**
     * Gets the address
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Sets the address
     *
     * @param  string $address
     * @return self
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Gets the url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Sets the url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Gets the displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Sets the displayName
     *
     * @param  string $displayName
     * @return self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Gets the sentBy
     *
     * @return string
     */
    public function getSentBy(): ?string
    {
        return $this->sentBy;
    }

    /**
     * Sets the sentBy
     *
     * @param  string $sentBy
     * @return self
     */
    public function setSentBy(string $sentBy): self
    {
        $this->sentBy = $sentBy;
        return $this;
    }

    /**
     * Gets the dir
     *
     * @return string
     */
    public function getDir(): ?string
    {
        return $this->dir;
    }

    /**
     * Sets the dir
     *
     * @param  string $dir
     * @return self
     */
    public function setDir(string $dir): self
    {
        $this->dir = $dir;
        return $this;
    }

    /**
     * Gets the language
     *
     * @return string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * Sets the language
     *
     * @param  string $language
     * @return self
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Add xParam
     *
     * @param  XParamInterface $xParam
     * @return self
     */
    public function addXParam(XParamInterface $xParam): self
    {
        $this->xParams[] = $xParam;
        return $this;
    }

    /**
     * Set xParams
     *
     * @param  array $xParams
     * @return self
     */
    public function setXParams(array $xParams): self
    {
        $this->xParams = array_filter($xParams, static fn ($xParam) => $xParam instanceof XParamInterface);
        return $this;
    }

    /**
     * Gets xParams
     *
     * @return array
     */
    public function getXParams(): array
    {
        return $this->xParams;
    }
}
