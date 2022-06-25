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
use Zimbra\Soap\ResponseInterface;
use Zimbra\Admin\Struct\AccountInfo as Account;

/**
 * ChangePrimaryEmailResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ChangePrimaryEmailResponse implements ResponseInterface
{
    /**
     * Information about account after rename
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Admin\Struct\AccountInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private Account $account;

    /**
     * Constructor method for ChangePrimaryEmailResponse
     *
     * @param Account $account
     * @return self
     */
    public function __construct(Account $account)
    {
        $this->setAccount($account);
    }

    /**
     * Gets the account.
     *
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * Sets the account.
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
