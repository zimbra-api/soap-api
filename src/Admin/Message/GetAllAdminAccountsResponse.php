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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllAdminAccountsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllAdminAccountsResponse extends SoapResponse
{
    /**
     * Information on accounts
     *
     * @var array
     */
    #[Accessor(getter: "getAccountList", setter: "setAccountList")]
    #[Type("array<Zimbra\Admin\Struct\AccountInfo>")]
    #[XmlList(inline: true, entry: "account", namespace: "urn:zimbraAdmin")]
    private $accountList = [];

    /**
     * Constructor
     *
     * @param array $accountList
     * @return self
     */
    public function __construct(array $accountList = [])
    {
        $this->setAccountList($accountList);
    }

    /**
     * Set account informations
     *
     * @param  array $list
     * @return self
     */
    public function setAccountList(array $list): self
    {
        $this->accountList = array_filter(
            $list,
            static fn($account) => $account instanceof AccountInfo
        );
        return $this;
    }

    /**
     * Get account informations
     *
     * @return array
     */
    public function getAccountList(): array
    {
        return $this->accountList;
    }
}
