<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\RequestFormat;

/**
 * FormatInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="format")
 */
class FormatInfo
{
    /**
     * Desired response format. Valid values "xml" (default) and "js"
     * @Accessor(getter="getFormat", setter="setFormat")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $_format;

    /**
     * Constructor method for FormatInfo
     * @param integer $format
     * @return self
     */
    public function __construct($format = NULL)
    {
        if (NULL !== $format) {
            $this->setFormat($format);
        }
    }

    /**
     * Gets desired response format.
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->_format;
    }

    /**
     * Sets desired response format.
     *
     * @param  string $format
     * @return self
     */
    public function setFormat($format)
    {
        if (RequestFormat::has(trim($format))) {
            $this->_format = trim($format);
        }
        return $this;
    }
}
