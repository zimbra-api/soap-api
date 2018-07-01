<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * WaitSetSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="add")
 */
class WaitSetSpec
{
    /**
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @Type("array<Zimbra\Struct\WaitSetAddSpec>")
     * @XmlList(inline = true, entry = "a")
     */
    private $_accounts;

    /**
     * Constructor method for WaitSetAdd
     * @param array $accounts
     * @return self
     */
    public function __construct(array $accounts = [])
    {
        $this->setAccounts($accounts);
    }

    /**
     * Add WaitSet
     *
     * @param  WaitSetAddSpec $account
     * @return self
     */
    public function addAccount(WaitSetAddSpec $account)
    {
        $this->_accounts[] = $account;
        return $this;
    }

    /**
     * Sets WaitSet sequence
     *
     * @param array $accounts
     * @return self
     */
    public function setAccounts(array $accounts)
    {
        foreach ($accounts as $account) {
            if ($account instanceof WaitSetAddSpec) {
                $this->_accounts[] = $account;
            }
        }
        return $this;
    }

    /**
     * Gets WaitSet sequence
     *
     * @return array<WaitSetAddSpec>
     */
    public function getAccounts()
    {
        return $this->_accounts;
    }
}
