<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap\Fault;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * Soap fault body class
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Body
{
    /**
     * @Accessor(getter="getSoapFault", setter="setSoapFault")
     * @SerializedName("Fault")
     * @Type("Zimbra\Common\Soap\Fault\Response")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private ?Response $fault = NULL;

    /**
     * Set the soap fault
     *
     * @param  Response $fault
     * @return self
     */
    public function setSoapFault(Response $fault): self
    {
        $this->fault = $fault;
        return $this;
    }

    /**
     * Get the soap fault
     *
     * @return Response
     */
    public function getSoapFault(): ?Response
    {
        return $this->fault;
    }
}
