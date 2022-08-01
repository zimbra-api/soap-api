<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\MemberOfSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetAccountDistributionListsRequest class
 * Returns groups the user is either a member or an owner of. 
 * Notes:
 *  - isOwner is returned only if ownerOf on the request is 1 (true).
 *  - isMember is returned only if memberOf on the request is not "none".
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAccountDistributionListsRequest extends SoapRequest
{
    /**
     * Set to 1 if the response should include groups the user is an owner of.
     * Set to 0 (default) if do not need to know which groups the user is an owner of.
     * @Accessor(getter="getOwnerOf", setter="setOwnerOf")
     * @SerializedName("ownerOf")
     * @Type("bool")
     * @XmlAttribute
     */
    private $ownerOf;

    /**
     * Possible values: all|directOnly|none
     * @Accessor(getter="getMemberOf", setter="setMemberOf")
     * @SerializedName("memberOf")
     * @Type("Zimbra\Common\Enum\MemberOfSelector")
     * @XmlAttribute
     */
    private ?MemberOfSelector $memberOf = NULL;

    /**
     * comma-seperated attributes to return.
     * Note: non-owner user can see only certain attributes of a group.
     * If a specified attribute is not visible to the user, it will not be returned.
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("string")
     * @XmlAttribute
     */
    private $attrs;

    /**
     * Constructor method for GetAccountDistributionLists
     *
     * @param  bool $ownerOf
     * @param  MemberOfSelector $memberOf
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?bool $ownerOf = NULL,
        ?MemberOfSelector $memberOf = NULL,
        ?string $attrs = NULL
    )
    {
        if(NULL !== $ownerOf) {
            $this->setOwnerOf($ownerOf);
        }
        if($memberOf instanceof MemberOfSelector) {
            $this->setMemberOf($memberOf);
        }
        if(NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Get ownerOf
     *
     * @return bool
     */
    public function getOwnerOf(): ?bool
    {
        return $this->ownerOf;
    }

    /**
     * Set ownerOf
     *
     * @param  bool $ownerOf
     * @return self
     */
    public function setOwnerOf(bool $ownerOf): self
    {
        $this->ownerOf = $ownerOf;
        return $this;
    }

    /**
     * Get attrs
     *
     * @return string
     */
    public function getAttrs(): ?string
    {
        return $this->attrs;
    }

    /**
     * Set attrs
     *
     * @param  string $attrs
     * @return self
     */
    public function setAttrs(string $attrs): self
    {
        $this->attrs = $attrs;
        return $this;
    }

    /**
     * Get memberOf
     *
     * @return MemberOfSelector
     */
    public function getMemberOf(): ?MemberOfSelector
    {
        return $this->memberOf;
    }

    /**
     * Set memberOf
     *
     * @param  MemberOfSelector $memberOf
     * @return self
     */
    public function setMemberOf(MemberOfSelector $memberOf): self
    {
        $this->memberOf = $memberOf;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAccountDistributionListsEnvelope(
            new GetAccountDistributionListsBody($this)
        );
    }
}
