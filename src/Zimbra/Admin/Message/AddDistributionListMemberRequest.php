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
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Soap\ClientInterface;
use Zimbra\Soap\Request;

/**
 * AddDistributionListMemberRequest request class
 * Adding members to a distribution list
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="AddDistributionListMemberRequest")
 */
class AddDistributionListMemberRequest extends Request
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $_id;

    /**
     * Members
     * @Accessor(getter="getMembers", setter="setMembers")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "dlm")
     */
    private $_members;

    /**
     * Constructor method for AddDistributionListMember
     * @param  string $id Zimbra ID
     * @param  array  $members Members
     * @return self
     */
    public function __construct($id, array $members)
    {
        $this->setId($id);
        $this->setMembers($members);
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
     * Add a dl member
     *
     * @param  string $member
     * @return self
     */
    public function addMember($member)
    {
        $member = trim($member);
        if (!empty($member) && !in_array($member, $this->_members)) {
            $this->_members[] = $member;
        }
        return $this;
    }

    /**
     * Sets member sequence
     *
     * @param  array $members Members
     * @return self
     */
    public function setMembers(array $members)
    {
        $this->_members = [];
        foreach ($members as $member) {
            $this->addMember($member);
        }
        return $this;
    }

    /**
     * Gets member sequence
     *
     * @return array
     */
    public function getMembers()
    {
        return $this->_members;
    }

    public function execute(ClientInterface $client)
    {
        $requestEnvelope = new AddDistributionListMemberEnvelope();
        $requestEnvelope->setBody(new AddDistributionListMemberBody($this));
        $response = $client->doRequest(
            $this->getSerializer()->serialize($requestEnvelope, 'xml')
        );
        $responseEnvelope = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            'Zimbra\Admin\Message\AddDistributionListMemberEnvelope', 'xml'
        );
        return $responseEnvelope->getBody()->getResponse();
    }
}
