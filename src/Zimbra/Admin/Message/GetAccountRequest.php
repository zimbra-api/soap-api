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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\AttributeSelector;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Soap\Request;

/**
 * GetAccountRequest class
 * Get attributes related to an account
 * {attrs} - comma-seperated list of attrs to return
 * Note: this request is by default proxied to the account's home server
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAccountRequest")
 */
class GetAccountRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Flag whether or not to apply class of service (COS) rules
     * 1 (true) [default] COS rules apply and unset attrs on an account will get their value from the COS
     * 0 (false) only attributes directly set on the account will be returned
     * @Accessor(getter="isApplyCos", setter="setApplyCos")
     * @SerializedName("applyCos")
     * @Type("bool")
     * @XmlAttribute
     */
    private $applyCos;

    /**
     * Account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $account;

    /**
     * Constructor method for GetAccountRequest
     * @param  AccountSelector $account
     * @param  bool $applyCos
     * @param  string $attrs
     * @return self
     */
    public function __construct(AccountSelector $account, $applyCos = NULL, $attrs = NULL)
    {
        $this->setAccount($account);
        if (NULL !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets applyCos
     *
     * @return bool
     */
    public function isApplyCos(): ?bool
    {
        return $this->applyCos;
    }

    /**
     * Sets applyCos
     *
     * @param  bool $applyCos
     * @return self
     */
    public function setApplyCos($applyCos): self
    {
        $this->applyCos = (bool) $applyCos;
        return $this;
    }

    /**
     * Gets the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): AccountSelector
    {
        return $this->account;
    }

    /**
     * Sets the account.
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAccountEnvelope)) {
            $this->envelope = new GetAccountEnvelope(
                new GetAccountBody($this)
            );
        }
    }
}
