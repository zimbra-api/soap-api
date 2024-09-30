<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct\Fault;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * Fault code class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Code
{
    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("Value")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="http://www.w3.org/2003/05/soap-envelope")
     *
     * @var string
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[SerializedName("Value")]
    #[Type("string")]
    #[
        XmlElement(
            cdata: false,
            namespace: "http://www.w3.org/2003/05/soap-envelope"
        )
    ]
    private $value;

    /**
     * Constructor
     *
     * @param string $value
     * @return self
     */
    public function __construct(?string $value = null)
    {
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
}
