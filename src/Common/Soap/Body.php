<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * Soap body class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class Body implements BodyInterface
{
    /**
     * @Accessor(getter="getFault", setter="setFault")
     * @SerializedName("Fault")
     * @Type("Zimbra\Common\Soap\Fault")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private ?Fault $fault = NULL;

    /**
     * Constructor
     * 
     * @param  RequestInterface $request
     * @param  ResponseInterface $response
     * @param  Fault $fault
     * @return self
     */
    public function __construct(
        ?RequestInterface $request = NULL, ?ResponseInterface $response = NULL, ?Fault $fault = NULL
    )
    {
        if ($request instanceof RequestInterface) {
            $this->setRequest($request);
        }
        if ($response instanceof ResponseInterface) {
            $this->setResponse($response);
        }
        if ($fault instanceof Fault) {
            $this->setFault($fault);
        }
    }

    /**
     * Set the soap fault
     *
     * @param  Response $fault
     * @return self
     */
    public function setFault(Fault $fault): self
    {
        $this->fault = $fault;
        return $this;
    }

    /**
     * Get the soap fault
     *
     * @return Fault
     */
    public function getFault(): ?Fault
    {
        return $this->fault;
    }

    /**
     * Set the request.
     *
     * @param  RequestInterface $request
     * @return self
     */
    abstract public function setRequest(RequestInterface $request): self;


    /**
     * Set the response.
     *
     * @param  ResponseInterface $response
     * @return self
     */
    abstract public function setResponse(ResponseInterface $response): self;
}
