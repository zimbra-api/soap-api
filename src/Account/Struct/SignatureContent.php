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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};
use Zimbra\Common\Enum\ContentType;

/**
 * SignatureContent struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SignatureContent
{
    /**
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\ContentType>")
     * @XmlAttribute
     *
     * @var ContentType
     */
    #[Accessor(getter: "getContentType", setter: "setContentType")]
    #[SerializedName("type")]
    #[Type("Enum<Zimbra\Common\Enum\ContentType>")]
    #[XmlAttribute]
    private ?ContentType $type;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     *
     * @var string
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     *
     * @param string $value
     * @param ContentType $type
     * @return self
     */
    public function __construct(
        ?string $value = null,
        ?ContentType $type = null
    ) {
        $this->type = $type;
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
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
     * Get content type
     *
     * @return ContentType
     */
    public function getContentType(): ?ContentType
    {
        return $this->type;
    }

    /**
     * Set content type
     *
     * @param  ContentType $type
     * @return self
     */
    public function setContentType(ContentType $type): self
    {
        $this->type = $type;
        return $this;
    }
}
