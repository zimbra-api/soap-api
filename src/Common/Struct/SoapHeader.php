<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlNamespace
};
use Zimbra\Common\Struct\Header\Context;

/**
 * Soap header class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbra", prefix="zm")
 */
#[XmlNamespace(uri: "urn:zimbra", prefix: "zm")]
class SoapHeader implements SoapHeaderInterface
{
    /**
     * Soap header context
     *
     * @Accessor(getter="getContext", setter="setContext")
     * @SerializedName("context")
     * @Type("Zimbra\Common\Struct\Header\Context")
     * @XmlElement(namespace="urn:zimbra")
     *
     * @var Context
     */
    #[Accessor(getter: "getContext", setter: "setContext")]
    #[SerializedName("context")]
    #[Type(Context::class)]
    #[XmlElement(namespace: "urn:zimbra")]
    private ?Context $context;

    /**
     * Constructor
     *
     * @param  Context $context
     * @return self
     */
    public function __construct(?Context $context = null)
    {
        $this->context = $context;
    }

    /**
     * {@inheritdoc}
     */
    public function getContext(): ?Context
    {
        return $this->context;
    }

    /**
     * Set the soap header context
     *
     * @param  Context $context
     * @return self
     */
    public function setContext(Context $context): self
    {
        $this->context = $context;
        return $this;
    }
}
