<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\ContentType;

/**
 * SignatureContent struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SignatureContent
{
    /**
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\ContentType")
     * @XmlAttribute
     */
    private ?ContentType $type = NULL;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for signatureContent
     * @param string $value
     * @param ContentType $type
     * @return self
     */
    public function __construct(?string $value = NULL, ?ContentType $type = NULL)
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if ($type instanceof ContentType) {
            $this->setContentType($type);
        }
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
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets content type
     *
     * @return ContentType
     */
    public function getContentType(): ?ContentType
    {
        return $this->contentType;
    }

    /**
     * Sets content type
     *
     * @param  ContentType $type
     * @return self
     */
    public function setContentType(ContentType $type): self
    {
        $this->contentType = $type;
        return $this;
    }
}
