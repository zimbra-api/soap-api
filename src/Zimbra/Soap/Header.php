<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Soap\Header\Context;

/**
 * Soap header class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbra", prefix="urn")
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
    private $_context;

    /**
     * Constructor method for Header
     * @return self
     */
    public function __construct(Context $context = NULL)
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
    public function getContext()
    {
        return $this->_context;
    }

    /**
     * Sets header context
     *
     * @param  Context $context
     * @return self
     */
    public function setContext(Context $context)
    {
        $this->_context = $context;
        return $this;
    }
}
