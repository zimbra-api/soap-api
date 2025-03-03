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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * AccountsAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountsAttrib
{
    /**
     * Comma separated list of account IDs
     *
     * @var string
     */
    #[Accessor(getter: "getAccounts", setter: "setAccounts")]
    #[SerializedName("accounts")]
    #[Type("string")]
    #[XmlAttribute]
    private string $accounts;

    /**
     * Constructor
     *
     * @param string $accounts
     * @return self
     */
    public function __construct(string $accounts = "")
    {
        $this->setAccounts($accounts);
    }

    /**
     * Get accounts
     *
     * @return string
     */
    public function getAccounts(): string
    {
        return $this->accounts;
    }

    /**
     * Set accounts
     *
     * @param  string $accounts
     * @return self
     */
    public function setAccounts(string $accounts): self
    {
        $this->accounts = $accounts;
        return $this;
    }
}
