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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Struct\Id;

/**
 * FreeBusyQueueProvider struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="provider")
 */
class FreeBusyQueueProvider
{
    /**
     * Provider name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Information on accounts
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("account")
     * @Type("array<Zimbra\Struct\Id>")
     * @XmlList(inline = true, entry = "account")
     */
    private $accounts;

    /**
     * Constructor method for FreeBusyQueueProvider
     * 
     * @param  string $name 
     * @param  array  $accounts
     * @return self
     */
    public function __construct(string $name, array $accounts = [])
    {
        $this->setName($name)
            ->setAccounts($accounts);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Add an account
     *
     * @param  Id $account
     * @return self
     */
    public function addAccount(Id $account): self
    {
        $this->accounts[] = $account;
        return $this;
    }

    /**
     * Sets accountibutes
     *
     * @param array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = [];
        foreach ($accounts as $account) {
            if ($account instanceof Id) {
                $this->accounts[] = $account;
            }
        }
        return $this;
    }

    /**
     * Gets accountibutes
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}