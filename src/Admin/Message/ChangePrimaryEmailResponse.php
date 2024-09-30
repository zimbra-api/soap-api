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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\AccountInfo as Account;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ChangePrimaryEmailResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ChangePrimaryEmailResponse extends SoapResponse
{
    /**
     * Information about account after rename
     *
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Admin\Struct\AccountInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var Account
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type(Account::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?Account $account;

    /**
     * Constructor
     *
     * @param Account $account
     * @return self
     */
    public function __construct(?Account $account = null)
    {
        $this->account = $account;
    }

    /**
     * Get the account.
     *
     * @return Account
     */
    public function getAccount(): ?Account
    {
        return $this->account;
    }

    /**
     * Set the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account): self
    {
        $this->account = $account;
        return $this;
    }
}
