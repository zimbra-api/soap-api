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
use Zimbra\Soap\Request;
use Zimbra\Struct\AccountSelector;

/**
 * DeleteGalSyncAccountRequest class
 * Delete a Global Address List (GAL) Synchronisation account
 * Remove its zimbraGalAccountId from the domain, then deletes the account.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="DeleteGalSyncAccountRequest")
 */
class DeleteGalSyncAccountRequest extends Request
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
     * Constructor method for DeleteGalSyncAccountRequest
     * @param  string $id Zimbra ID
     * @return self
     */
    public function __construct(AccountSelector $account)
    {
        $this->setAccount($account);
    }

    /**
     * Sets the account.
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

    protected function internalInit()
    {
        $this->envelope = new DeleteGalSyncAccountEnvelope(
            NULL,
            new DeleteGalSyncAccountBody($this)
        );
    }
}
