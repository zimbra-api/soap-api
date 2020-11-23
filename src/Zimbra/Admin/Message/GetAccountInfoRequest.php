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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Struct\AccountSelector;
use Zimbra\Soap\Request;

/**
 * GetAccountInfoRequest class
 * Get information about an account
 * Currently only 2 attrs are returned:
 * zimbraId: the unique UUID of the zimbra account
 * zimbraMailHost: the server on which this user's mail resides
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAccountInfoRequest")
 */
class GetAccountInfoRequest extends Request
{
    /**
     * Account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $account;

    /**
     * Constructor method for GetAccountInfoRequest
     * @param  AccountSelector $account
     * @return self
     */
    public function __construct(AccountSelector $account)
    {
        $this->setAccount($account);
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
        if (!($this->envelope instanceof GetAccountInfoEnvelope)) {
            $this->envelope = new GetAccountInfoEnvelope(
                new GetAccountInfoBody($this)
            );
        }
    }
}
