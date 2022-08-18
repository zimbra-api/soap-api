<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * AddDistributionListMemberRequest request class
 * Adding members to a distribution list
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddDistributionListMemberRequest extends SoapRequest
{
    /**
     * Zimbra ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Members
     * 
     * @Accessor(getter="getMembers", setter="setMembers")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="dlm", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getMembers', setter: 'setMembers')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'dlm', namespace: 'urn:zimbraAdmin')]
    private $members = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  array  $members
     * @return self
     */
    public function __construct(string $id = '', array $members = [])
    {
        $this->setId($id)
             ->setMembers($members);
    }

    /**
     * Get zimbra id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set zimbra id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Add a dl member
     *
     * @param  string $member
     * @return self
     */
    public function addMember(string $member): self
    {
        $member = trim($member);
        if (!empty($member) && !in_array($member, $this->members)) {
            $this->members[] = $member;
        }
        return $this;
    }

    /**
     * Set members
     *
     * @param  array $members Members
     * @return self
     */
    public function setMembers(array $members): self
    {
        $this->members = array_unique($members);
        return $this;
    }

    /**
     * Get members
     *
     * @return array
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AddDistributionListMemberEnvelope(
            new AddDistributionListMemberBody($this)
        );
    }
}
