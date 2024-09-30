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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};
use Zimbra\Common\Struct\{CalOrganizerInterface, XParamInterface};

/**
 * CalOrganizer struct class
 * Calendar organizer
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalOrganizer implements CalOrganizerInterface
{
    /**
     * Email address (without "MAILTO:")
     *
     * @Accessor(getter="getAddress", setter="setAddress")
     * @SerializedName("a")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getAddress", setter: "setAddress")]
    #[SerializedName("a")]
    #[Type("string")]
    #[XmlAttribute]
    private $address;

    /**
     * URL - has same value as email-address.
     *
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getUrl", setter: "setUrl")]
    #[SerializedName("url")]
    #[Type("string")]
    #[XmlAttribute]
    private $url;

    /**
     * Friendly name - "CN" in iCalendar
     *
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getDisplayName", setter: "setDisplayName")]
    #[SerializedName("d")]
    #[Type("string")]
    #[XmlAttribute]
    private $displayName;

    /**
     * iCalendar SENT-BY
     *
     * @Accessor(getter="getSentBy", setter="setSentBy")
     * @SerializedName("sentBy")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSentBy", setter: "setSentBy")]
    #[SerializedName("sentBy")]
    #[Type("string")]
    #[XmlAttribute]
    private $sentBy;

    /**
     * iCalendar DIR - Reference to a directory entry associated with the calendar user.
     *
     * @Accessor(getter="getDir", setter="setDir")
     * @SerializedName("dir")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getDir", setter: "setDir")]
    #[SerializedName("dir")]
    #[Type("string")]
    #[XmlAttribute]
    private $dir;

    /**
     * iCalendar LANGUAGE - As defined in RFC5646 * (e.g. "en-US")
     *
     * @Accessor(getter="getLanguage", setter="setLanguage")
     * @SerializedName("lang")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getLanguage", setter: "setLanguage")]
    #[SerializedName("lang")]
    #[Type("string")]
    #[XmlAttribute]
    private $language;

    /**
     * Non-standard parameters (XPARAMs)
     *
     * @Accessor(getter="getXParams", setter="setXParams")
     * @Type("array<Zimbra\Mail\Struct\XParam>")
     * @XmlList(inline=true, entry="xparam", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getXParams", setter: "setXParams")]
    #[Type("array<Zimbra\Mail\Struct\XParam>")]
    #[XmlList(inline: true, entry: "xparam", namespace: "urn:zimbraMail")]
    private $xParams = [];

    /**
     * Constructor
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
        ?string $address = null,
        ?string $url = null,
        ?string $displayName = null,
        ?string $sentBy = null,
        ?string $dir = null,
        ?string $language = null,
        array $xParams = []
    ) {
        $this->setXParams($xParams);
        if (null !== $address) {
            $this->setAddress($address);
        }
        if (null !== $url) {
            $this->setUrl($url);
        }
        if (null !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (null !== $sentBy) {
            $this->setSentBy($sentBy);
        }
        if (null !== $dir) {
            $this->setDir($dir);
        }
        if (null !== $language) {
            $this->setLanguage($language);
        }
    }

    /**
     * Get the address
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set the address
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
     * Get the url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set the url
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
     * Get the displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Set the displayName
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
     * Get the sentBy
     *
     * @return string
     */
    public function getSentBy(): ?string
    {
        return $this->sentBy;
    }

    /**
     * Set the sentBy
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
     * Get the dir
     *
     * @return string
     */
    public function getDir(): ?string
    {
        return $this->dir;
    }

    /**
     * Set the dir
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
     * Get the language
     *
     * @return string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * Set the language
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
        $this->xParams = array_filter(
            $xParams,
            static fn($xParam) => $xParam instanceof XParamInterface
        );
        return $this;
    }

    /**
     * Get xParams
     *
     * @return array
     */
    public function getXParams(): array
    {
        return $this->xParams;
    }
}
