<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Enum\GalMode;
use Zimbra\Struct\AccountSelector as Account;

/**
 * AddGalSyncDataSource request class
 * Add a GalSync data source
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddGalSyncDataSource extends BaseAttr
{
    /**
     * Name of the data source
     * @var string
     */
    private $_name;

    /**
     * Name of pre-existing domain
     * @var string
     */
    private $_domain;

    /**
     * GalMode type
     * @var GalMode
     */
    private $_type;

    /**
     * Contact folder name
     * @var string
     */
    private $_folder;

    /**
     * The account
     * @var Account
     */
    private $_account;

    /**
     * Constructor method for AddGalSyncDataSource
     * @param string $name
     * @param string $domain
     * @param GalMode $type
     * @param string $folder
     * @param Account $account
     * @return self
     */
    public function __construct(
        Account $account,
        $name,
        $domain,
        GalMode $type,
        $folder = null,
        array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setChild('account', $account);
        $this->setProperty('name', trim($name));
        $this->setProperty('domain', trim($domain));
        $this->setProperty('type', $type);
        if(null !== $folder)
        {
            $this->setProperty('folder', trim($folder));
        }
    }

    /**
     * Gets the account.
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->getChild('account');
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account)
    {
        return $this->setChild('account', $account);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->getProperty('domain');
    }

    /**
     * Sets domain
     *
     * @param  string $domain
     * @return self
     */
    public function setDomain($domain)
    {
        return $this->setProperty('domain', trim($domain));
    }

    /**
     * Gets type
     *
     * @return GalMode
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  GalMode $type
     * @return self
     */
    public function setType(GalMode $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->getProperty('folder');
    }

    /**
     * Sets folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder($folder)
    {
        return $this->setProperty('folder', trim($folder));
    }
}
