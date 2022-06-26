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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllAccountsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllAccountsResponse implements ResponseInterface
{
    /**
     * Information on accounts
     * 
     * @Accessor(getter="getAccountList", setter="setAccountList")
     * @SerializedName("account")
     * @Type("array<Zimbra\Admin\Struct\AccountInfo>")
     * @XmlList(inline=true, entry="account", namespace="urn:zimbraAdmin")
     */
    private $accounts = [];

    /**
     * Constructor method for GetAllAccountsResponse
     *
     * @param array $accounts
     * @return self
     */
    public function __construct(array $accounts = [])
    {
        $this->setAccountList($accounts);
    }

    /**
     * Add an account
     *
     * @param  AccountInfo $account
     * @return self
     */
    public function addAccount(AccountInfo $account): self
    {
        $this->accounts[] = $account;
        return $this;
    }

    /**
     * Sets accounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setAccountList(array $accounts): self
    {
        $this->accounts = array_filter($accounts, static fn ($account) => $account instanceof AccountInfo);
        return $this;
    }

    /**
     * Gets accounts
     *
     * @return array
     */
    public function getAccountList(): array
    {
        return $this->accounts;
    }
}
