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

use Zimbra\Admin\Struct\WaitSetSpec;
use Zimbra\Common\TypedSequence;
use Zimbra\Enum\InterestType;

/**
 * AdminCreateWaitSet request class
 * Create a waitset to listen for changes on one or more accounts
 * Called once to initialize a WaitSet and to set its "default interest types"
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AdminCreateWaitSet extends Base
{
    /**
     * Default interest types
     * @var array
     */
    private $_defTypes;

    /**
     * Constructor method for AdminCreateWaitSet
     * @param  WaitSetSpec $add The WaitSet add spec
     * @param  array $defTypes Default interest types
     * @param  bool  $allAccounts The allAccounts
     * @return self
     */
    public function __construct(WaitSetSpec $add = null, array $defTypes = array(), $allAccounts = null)
    {
        parent::__construct();
        $this->child('add', $add);
        if(null !== $allAccounts)
        {
            $this->property('allAccounts', (bool) $allAccounts);
        }
        $this->_defTypes = new TypedSequence('Zimbra\Enum\InterestType', $defTypes);

        $this->addHook(function($sender)
        {
            $sender->property('defTypes', $sender->defTypes());
        });
    }

    /**
     * Gets or sets add
     *
     * @param  WaitSetSpec $add
     * @return WaitSetSpec|self
     */
    public function add(WaitSetSpec $add = null)
    {
        if(null === $add)
        {
            return $this->child('add');
        }
        return $this->child('add', $add);
    }

    /**
     * Add a type
     *
     * @param  InterestType $type
     * @return self
     */
    public function addDefType(InterestType $type)
    {
        $this->_defTypes->add($type);
        return $this;
    }

    /**
     * Gets defTypes
     *
     * @return string
     */
    public function defTypes()
    {
        return count($this->_defTypes) ? implode(',', $this->_defTypes->all()) : 'all';
    }

    /**
     * Gets or sets allAccounts
     *
     * @param  bool $allAccounts
     * @return bool|self
     */
    public function allAccounts($allAccounts = null)
    {
        if(null === $allAccounts)
        {
            return $this->property('allAccounts');
        }
        return $this->property('allAccounts', (bool) $allAccounts);
    }
}
