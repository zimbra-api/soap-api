<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * AccountsAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="attr")
 */
class AccountsAttrib
{
    /**
     * Comma separated list of account IDs
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("accounts")
     * @Type("string")
     * @XmlAttribute
     */
    private $accounts;

    /**
     * Constructor method for AccountsAttrib
     * 
     * @param string $accounts
     * @return self
     */
    public function __construct(string $accounts)
    {
        $this->setAccounts($accounts);
    }

    /**
     * Gets accounts
     *
     * @return string
     */
    public function getAccounts(): string
    {
        return $this->accounts;
    }

    /**
     * Sets accounts
     *
     * @param  string $name
     * @return self
     */
    public function setAccounts(string $accounts): self
    {
        $this->accounts = $accounts;
        return $this;
    }
}