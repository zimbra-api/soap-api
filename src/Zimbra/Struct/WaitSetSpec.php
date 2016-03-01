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

use Zimbra\Common\TypedSequence;

/**
 * WaitSetSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class WaitSetSpec extends Base
{
    /**
     * Attributes
     * @var TypedSequence<WaitSetAddSpec>
     */
    private $_accounts;

    /**
     * Constructor method for WaitSetAdd
     * @param array $accounts
     * @return self
     */
    public function __construct(array $accounts = [])
    {
        parent::__construct();
        $this->setAccounts($accounts);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAccounts()->count())
            {
                $sender->setChild('a', $sender->getAccounts()->all());
            }
        });
    }

    /**
     * Add WaitSet
     *
     * @param  WaitSetAddSpec $account
     * @return self
     */
    public function addAccount(WaitSetAddSpec $account)
    {
        $this->_accounts->add($account);
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
        $this->_accounts = new TypedSequence('Zimbra\Struct\WaitSetAddSpec', $accounts);
        return $this;
    }

    /**
     * Gets WaitSet sequence
     *
     * @return TypedSequence<WaitSetAddSpec>
     */
    public function getAccounts()
    {
        return $this->_accounts;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'add')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'add')
    {
        return parent::toXml($name);
    }
}
