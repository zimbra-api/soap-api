<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request\Attr;
use Zimbra\Soap\Enum\GalMode;
use Zimbra\Soap\Struct\AccountSelector as Account;

/**
 * AddGalSyncDataSource class
 * Add a GalSync data source
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddGalSyncDataSource extends Attr
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
        $this->_account = $account;
        $this->_name = trim($name);
        $this->_domain = trim($domain);
		$this->_type = $type;
        $this->_folder = trim($folder);
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
            return $this->_account;
        }
        $this->_account = $account;
        return $this;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_domain;
        }
        $this->_domain = trim($domain);
        return $this;
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
            return $this->_type;
        }
		$this->_type = $type;
        return $this;
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
            return $this->_folder;
        }
        $this->_folder = trim($folder);
        return $this;
    }
    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'name' => $this->_name,
            'domain' => $this->_domain,
            'type' => (string) $this->_type,
        );
        if(!empty($this->_folder))
        {
            $this->array['folder'] = $this->_folder;
        }
        $this->array += $this->_account->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('name', $this->_name)
                  ->addAttribute('domain', $this->_domain)
                  ->addAttribute('type', (string) $this->_type);
        if(!empty($this->_folder))
        {
            $this->xml->addAttribute('folder', $this->_folder);
        }
        $this->xml->append($this->_account->toXml());
        return parent::toXml();
    }
}
