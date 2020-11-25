<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\RequestFormat;

/**
 * FormatInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="format")
 */
class FormatInfo
{
    /**
     * Desired response format. Valid values "xml" (default) and "js"
     * @Accessor(getter="getFormat", setter="setFormat")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\RequestFormat")
     * @XmlAttribute
     */
    private $format;

    /**
     * Constructor method for FormatInfo
     * @param RequestFormat $format
     * @return self
     */
    public function __construct(?RequestFormat $format = NULL)
    {
        if (NULL !== $format) {
            $this->setFormat($format);
        }
    }

    /**
     * Gets desired response format.
     *
     * @return RequestFormat
     */
    public function getFormat(): RequestFormat
    {
        return $this->format;
    }

    /**
     * Sets desired response format.
     *
     * @param  RequestFormat $format
     * @return self
     */
    public function setFormat(RequestFormat $format): self
    {
        $this->format = $format;
        return $this;
    }
}
