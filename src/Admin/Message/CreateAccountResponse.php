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
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateAccountResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateAccountResponse extends SoapResponse
{
    /**
     * Details of created account
     *
     * @var AccountInfo
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type(AccountInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?AccountInfo $account;

    /**
     * Constructor
     *
     * @param AccountInfo $account
     * @return self
     */
    public function __construct(?AccountInfo $account = null)
    {
        $this->account = $account;
    }

    /**
     * Get the account.
     *
     * @return AccountInfo
     */
    public function getAccount(): ?AccountInfo
    {
        return $this->account;
    }

    /**
     * Set the account.
     *
     * @param  AccountInfo $account
     * @return self
     */
    public function setAccount(AccountInfo $account): self
    {
        $this->account = $account;
        return $this;
    }
}
