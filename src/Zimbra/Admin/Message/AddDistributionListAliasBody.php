<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

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
 * AddDistributionListAliasBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 * @XmlRoot(name="Body")
 */
class AddDistributionListAliasBody extends Body
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("AddDistributionListAliasRequest")
     * @Type("Zimbra\Admin\Message\AddDistributionListAliasRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private $_request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("AddDistributionListAliasResponse")
     * @Type("Zimbra\Admin\Message\AddDistributionListAliasResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private $_response;

    /**
     * Constructor method for AddDistributionListAliasBody
     * @return self
     */
    public function __construct(AddDistributionListAliasRequest $request = NULL, AddDistributionListAliasResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    public function setRequest(RequestInterface $request)
    {
        if ($request instanceof AddDistributionListAliasRequest) {
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
        if ($response instanceof AddDistributionListAliasResponse) {
            $this->_response = $response;
        }
        return $this;
    }

    public function getResponse()
    {
        return $this->_response;
    }
}
