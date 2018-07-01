<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Soap\Body;
use Zimbra\Soap\RequestInterface;
use Zimbra\Soap\ResponseInterface;

/**
 * AuthBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 * @XmlRoot(name="Body")
 */
class AuthBody extends Body
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("AuthRequest")
     * @Type("Zimbra\Account\Message\AuthRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private $_request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("AuthResponse")
     * @Type("Zimbra\Account\Message\AuthResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private $_response;

    /**
     * Constructor method for AuthBody
     * @return self
     */
    public function __construct(AuthRequest $request = NULL, AuthResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    public function setRequest(RequestInterface $request)
    {
        if ($request instanceof AuthRequest) {
            $this->_request = $request;
        }
        return $this;
    }

    public function getRequest()
    {
        return $this->_request;
    }

    public function setResponse(ResponseInterface $response)
    {
        if ($response instanceof AuthResponse) {
            $this->_response = $response;
        }
        return $this;
    }

    public function getResponse()
    {
        return $this->_response;
    }
}
