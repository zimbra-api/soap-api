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

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\IdAndAction as Migrate;

/**
 * MigrateAccount class
 * Migrate an account.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MigrateAccount extends Request
{
    /**
     * Specification for the migration
     * @var Migrate
     */
    private $_migrate;

    /**
     * Constructor method for MigrateAccount
     * @param  Migrate $migrate
     * @return self
     */
    public function __construct(Migrate $migrate)
    {
        parent::__construct();
        $this->_migrate = $migrate;
    }

    /**
     * Gets or sets migrate
     *
     * @param  Migrate $migrate
     * @return Migrate|self
     */
    public function migrate(Migrate $migrate = null)
    {
        if(null === $migrate)
        {
            return $this->_migrate;
        }
        $this->_migrate = $migrate;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_migrate->toArray('migrate');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_migrate->toXml('migrate'));
        return parent::toXml();
    }
}