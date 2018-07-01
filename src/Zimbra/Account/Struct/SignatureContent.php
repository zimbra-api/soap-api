<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\ContentType;

/**
 * SignatureContent struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="content")
 */
class SignatureContent
{
    /**
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $_contentType;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * Constructor method for signatureContent
     * @param string $value
     * @param string $type
     * @return self
     */
    public function __construct($value = null, $type = null)
    {
        if (null !== $value) {
            $this->setValue($value);
        }
        if (null !== $type) {
            $this->setContentType($type);
        }
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->_contentType;
    }

    /**
     * Sets content type
     *
     * @param  string $type
     * @return self
     */
    public function setContentType($type)
    {
        if (ContentType::has(trim($type))) {
            $this->_contentType = $type;
        }
        return $this;
    }
}
