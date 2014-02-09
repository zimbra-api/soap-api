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
        array $attrs = array())
    {
        parent::__construct($attrs);
        $this->child('account', $account);
        $this->property('name', trim($name));
        $this->property('domain', trim($domain));
        $this->property('type', $type);
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
