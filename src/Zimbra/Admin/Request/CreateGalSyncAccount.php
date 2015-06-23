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
 * CreateGalSyncAccount request class
 * Create Global Address List (GAL) Synchronisation account.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateGalSyncAccount extends BaseAttr
{
   /**
     * Constructor method for CreateGalSyncAccount
     * @param Account $account The account
     * @param string $name Name of the data source
     * @param string $domain Domain name
     * @param GalMode $type GalMode type
     * @param string $server The mailhost on which this account resides
     * @param string $password The password
     * @param string $folder Contact folder name
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        Account $account,
        $name,
        $domain,
        GalMode $type,
        $server,
        $password = null,
        $folder = null,
        array $attrs = []
    )
    {
        parent::__construct($attrs);
        $this->setChild('account', $account);
        $this->setProperty('name', trim($name));
        $this->setProperty('domain', trim($domain));
        $this->setProperty('type', $type);
        $this->setProperty('server', trim($server));
        if(null !== $password)
        {
            $this->setProperty('password', trim($password));
        }
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
     * Gets mailhost server
     *
     * @return string
     */
    public function getServer()
    {
        return $this->getProperty('server');
    }

    /**
     * Sets mailhost server
     *
     * @param  string $server
     * @return self
     */
    public function setServer($server)
    {
        return $this->setProperty('server', trim($server));
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getProperty('password');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setProperty('password', trim($password));
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
