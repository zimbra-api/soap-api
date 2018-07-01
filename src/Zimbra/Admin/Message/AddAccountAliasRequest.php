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
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Soap\ClientInterface;
use Zimbra\Soap\Request;

/**
 * AddAccountAliasRequest class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="AddAccountAliasRequest")
 */
class AddAccountAliasRequest extends Request
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $_id;

    /**
     * @Accessor(getter="getAlias", setter="setAlias")
     * @SerializedName("alias")
     * @Type("string")
     * @XmlAttribute
     */
    private $_alias;

    /**
     * Constructor method for AddAccountAlias
     * @param  string $id Zimbra ID
     * @param  string $alias Alias
     * @return self
     */
    public function __construct($id, $alias )
    {
        $this->setId($id)
             ->setAlias($alias);
    }

    /**
     * Gets zimbra id
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets zimbra id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->_alias;
    }

    /**
     * Sets alias
     *
     * @param  string $alias
     * @return self
     */
    public function setAlias($alias)
    {
        $this->_alias = trim($alias);
        return $this;
    }

    public function execute(ClientInterface $client)
    {
        $requestEnvelope = new AddAccountAliasEnvelope();
        $requestEnvelope->setBody(new AddAccountAliasBody($this));
        $response = $client->doRequest(
            $this->getSerializer()->serialize($requestEnvelope, 'xml')
        );
        $responseEnvelope = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            'Zimbra\Admin\Message\AddAccountAliasEnvelope', 'xml'
        );
        return $responseEnvelope->getBody()->getResponse();
    }
}
