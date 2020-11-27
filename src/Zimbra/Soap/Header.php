<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Soap\Header\Context;

/**
 * Soap header class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlNamespace(uri="urn:zimbra", prefix="zm")
 * @XmlRoot(name="soap:Header")
 */
class Header
{
    /**
     * @Accessor(getter="getContext", setter="setContext")
     * @SerializedName("context")
     * @Type("Zimbra\Soap\Header\Context")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $context;

    /**
     * Constructor method for Header
     * @return self
     */
    public function __construct(?Context $context = NULL)
    {
        if ($context instanceof Context) {
            $this->setContext($context);
        }
    }

    /**
     * Gets header context
     *
     * @return Context
     */
    public function getContext(): ?Context
    {
        return $this->context;
    }

    /**
     * Sets header context
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
