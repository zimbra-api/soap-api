<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * UrlAndValue class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class UrlAndValue
{
    /**
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     */
    private $url;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for UrlAndValue
     * @param  string $url
     * @param  string $value
     * @return self
     */
    public function __construct(?string $url = NULL, ?string $value = NULL)
    {
        if (NULL !== $url) {
            $this->setUrl($url);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Sets url
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
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
