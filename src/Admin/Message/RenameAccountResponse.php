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
 * RenameAccountResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RenameAccountResponse extends SoapResponse
{
    /**
     * Information about account after rename
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Admin\Struct\AccountInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?AccountInfo $account = NULL;

    /**
     * Constructor method for RenameAccountResponse
     *
     * @param AccountInfo $account
     * @return self
     */
    public function __construct(?AccountInfo $account = NULL)
    {
        if ($account instanceof AccountInfo) {
            $this->setAccount($account);
        }
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
