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
use Zimbra\Common\Struct\{AccountSelector, GranteeChooser, SoapEnvelopeInterface, SoapRequest};

/**
 * GetShareInfoRequest class
 * Get information about published shares
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetShareInfoRequest extends SoapRequest
{
    /**
     * Flags that have been proxied to this server because the specified "owner account" is
     * homed here.  Do not proxy in this case. (Used internally by ZCS)
     * 
     * @var bool
     */
    #[Accessor(getter: 'getInternal', setter: 'setInternal')]
    #[SerializedName('internal')]
    #[Type('bool')]
    #[XmlAttribute]
    private $internal;

    /**
     * Flag whether own shares should be included:
     * - 0: if shares owned by the requested account should not be included in the response
     * - 1: (default) include shares owned by the requested account 
     * 
     * @var bool
     */
    #[Accessor(getter: 'getIncludeSelf', setter: 'setIncludeSelf')]
    #[SerializedName('includeSelf')]
    #[Type('bool')]
    #[XmlAttribute]
    private $includeSelf;

    /**
     * Filter by the specified grantee type
     * 
     * @var GranteeChooser
     */
    #[Accessor(getter: 'getGrantee', setter: 'setGrantee')]
    #[SerializedName('grantee')]
    #[Type(GranteeChooser::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?GranteeChooser $grantee;

    /**
     * Specifies the owner of the share
     * 
     * @var AccountSelector
     */
    #[Accessor(getter: 'getOwner', setter: 'setOwner')]
    #[SerializedName('owner')]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?AccountSelector $owner;

    /**
     * Constructor
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
        $this->grantee = $grantee;
        $this->owner = $owner;
        if(NULL !== $internal) {
            $this->setInternal($internal);
        }
        if(NULL !== $includeSelf) {
            $this->setIncludeSelf($includeSelf);
        }
    }

    /**
     * Get internal
     *
     * @return bool
     */
    public function getInternal(): ?bool
    {
        return $this->internal;
    }

    /**
     * Set internal
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
     * Get includeSelf
     *
     * @return bool
     */
    public function getIncludeSelf(): ?bool
    {
        return $this->includeSelf;
    }

    /**
     * Set includeSelf
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
     * Get grantee
     *
     * @return GranteeChooser
     */
    public function getGrantee(): ?GranteeChooser
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
     * Get owner
     *
     * @return AccountSelector
     */
    public function getOwner(): ?AccountSelector
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetShareInfoEnvelope(
            new GetShareInfoBody($this)
        );
    }
}
