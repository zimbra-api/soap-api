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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Common\Struct\GranteeChooser;
use Zimbra\Soap\Request;

/**
 * GetShareInfoRequest class
 * Get information about published shares
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetShareInfoRequest extends Request
{

    /**
     * Flags that have been proxied to this server because the specified "owner account" is
     * homed here.  Do not proxy in this case. (Used internally by ZCS)
     * @Accessor(getter="getInternal", setter="setInternal")
     * @SerializedName("internal")
     * @Type("bool")
     * @XmlAttribute
     */
    private $internal;

    /**
     * Flag whether own shares should be included:
     * - 0: if shares owned by the requested account should not be included in the response
     * - 1: (default) include shares owned by the requested account 
     * @Accessor(getter="getIncludeSelf", setter="setIncludeSelf")
     * @SerializedName("includeSelf")
     * @Type("bool")
     * @XmlAttribute
     */
    private $includeSelf;

    /**
     * Filter by the specified grantee type
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Common\Struct\GranteeChooser")
     * @XmlElement
     */
    private ?GranteeChooser $grantee = NULL;

    /**
     * Specifies the owner of the share
     * @Accessor(getter="getOwner", setter="setOwner")
     * @SerializedName("owner")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement
     */
    private ?AccountSelector $owner = NULL;

    /**
     * Constructor method for GetShareInfoRequest
     *
     * @param  GranteeChooser $grantee
     * @param  AccountSelector $owner
     * @param  bool $internal
     * @param  bool $includeSelf
     * @return self
     */
    public function __construct(
        ?GranteeChooser $grantee = NULL,
        ?AccountSelector $owner = NULL,
        ?bool $internal = NULL,
        ?bool $includeSelf = NULL
    )
    {
        if($owner instanceof AccountSelector) {
            $this->setOwner($owner);
        }
        if($grantee instanceof GranteeChooser) {
            $this->setGrantee($grantee);
        }
        if(NULL !== $internal) {
            $this->setInternal($internal);
        }
        if(NULL !== $includeSelf) {
            $this->setIncludeSelf($includeSelf);
        }
    }

    /**
     * Gets internal
     *
     * @return bool
     */
    public function getInternal(): ?bool
    {
        return $this->internal;
    }

    /**
     * Sets internal
     *
     * @param  bool $internal
     * @return self
     */
    public function setInternal(bool $internal): self
    {
        $this->internal = $internal;
        return $this;
    }

    /**
     * Gets includeSelf
     *
     * @return bool
     */
    public function getIncludeSelf(): ?bool
    {
        return $this->includeSelf;
    }

    /**
     * Sets includeSelf
     *
     * @param  bool $includeSelf
     * @return self
     */
    public function setIncludeSelf(bool $includeSelf): self
    {
        $this->includeSelf = $includeSelf;
        return $this;
    }

    /**
     * Set grantee
     *
     * @param  GranteeChooser $grantee
     * @return self
     */
    public function setGrantee(GranteeChooser $grantee): self
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Gets grantee
     *
     * @return GranteeChooser
     */
    public function getGrantee(): GranteeChooser
    {
        return $this->grantee;
    }

    /**
     * Set owner
     *
     * @param  AccountSelector $owner
     * @return self
     */
    public function setOwner(AccountSelector $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Gets owner
     *
     * @return AccountSelector
     */
    public function getOwner(): AccountSelector
    {
        return $this->owner;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetShareInfoEnvelope)) {
            $this->envelope = new GetShareInfoEnvelope(
                new GetShareInfoBody($this)
            );
        }
    }
}
