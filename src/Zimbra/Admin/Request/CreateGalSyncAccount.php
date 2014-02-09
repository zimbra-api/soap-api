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
        array $attrs = array()
    )
    {
        parent::__construct($attrs);
        $this->child('account', $account);
        $this->property('name', trim($name));
        $this->property('domain', trim($domain));
        $this->property('type', $type);
        $this->property('server', trim($server));
        if(null !== $password)
        {
            $this->property('password', trim($password));
        }
        if(null !== $folder)
        {
            $this->property('folder', trim($folder));
        }
    }

    /**
     * Gets or sets account
     *
     * @param  Account $account
     * @return Account|self
     */
    public function account(Account $account = null)
    {
        if(null === $account)
        {
            return $this->child('account');
        }
        return $this->child('account', $account);
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets domain
     *
     * @param  string $domain
     * @return string|self
     */
    public function domain($domain = null)
    {
        if(null === $domain)
        {
            return $this->property('domain');
        }
        return $this->property('domain', trim($domain));
    }

    /**
     * Gets or sets type
     *
     * @param  GalMode $type
     * @return GalMode|self
     */
    public function type(GalMode $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }

    /**
     * Gets or sets server
     *
     * @param  string $server
     * @return string|self
     */
    public function server($server = null)
    {
        if(null === $server)
        {
            return $this->property('server');
        }
        return $this->property('server', trim($server));
    }

    /**
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->property('password');
        }
        return $this->property('password', trim($password));
    }

    /**
     * Gets or sets folder
     *
     * @param  string $folder
     * @return string|self
     */
    public function folder($folder = null)
    {
        if(null === $folder)
        {
            return $this->property('folder');
        }
        return $this->property('folder', trim($folder));
    }
}
