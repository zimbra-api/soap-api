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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};
use Zimbra\Common\Struct\Id;

/**
 * FreeBusyQueueProvider struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FreeBusyQueueProvider
{
    /**
     * Provider name
     *
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * Information on accounts
     *
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @Type("array<Zimbra\Common\Struct\Id>")
     * @XmlList(inline=true, entry="account", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getAccounts", setter: "setAccounts")]
    #[Type("array<Zimbra\Common\Struct\Id>")]
    #[XmlList(inline: true, entry: "account", namespace: "urn:zimbraAdmin")]
    private $accounts = [];

    /**
     * Constructor
     *
     * @param  string $name
     * @param  array  $accounts
     * @return self
     */
    public function __construct(string $name = "", array $accounts = [])
    {
        $this->setName($name)->setAccounts($accounts);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Set accountibutes
     *
     * @param array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = array_filter(
            $accounts,
            static fn($account) => $account instanceof Id
        );
        return $this;
    }

    /**
     * Get accountibutes
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}
