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
use Zimbra\Soap\Struct\NamedElement as Account;
use Zimbra\Soap\Struct\TZFixupRule;

/**
 * FixCalendarTZ class
 * Fix timezone definitions in appointments and tasks to reflect changes in daylight savings time rules in various timezones.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FixCalendarTZ extends Request
{
    /**
     * Sync flag
     * @var bool
     */
    private $_sync;

    /**
     * Fix appts/tasks that have instances after this time
     * default = January 1, 2008 00:00:00 in GMT+13:00 timezone.
     * @var int
     */
    private $_after;

    /**
     * Accounts
     * @var array
     */
    private $_accounts = array();

    /**
     * Fixup rules
     * @var array
     */
    private $_fixupRules = array();

    /**
     * Constructor method for FixCalendarTZ
     * @param  bool  $sync
     * @param  int   $after
     * @param  array $accounts
     * @param  array $fixupRules
     * @return self
     */
    public function __construct(
        $sync = null,
        $after = null,
        array $accounts = array(),
        array $fixupRules = array()
    )
    {
        parent::__construct();
        if(null !== $sync)
        {
            $this->_sync = (bool) $sync;
        }
        if(null !== $after)
        {
            $this->_after = (int) $after;
        }
        $this->accounts($accounts);
        $this->fixupRules($fixupRules);
    }

    /**
     * Gets or sets sync
     *
     * @param  bool $sync
     * @return bool|self
     */
    public function sync($sync = null)
    {
        if(null === $sync)
        {
            return $this->_sync;
        }
        $this->_sync = (bool) $sync;
        return $this;
    }

    /**
     * Gets or sets after
     *
     * @param  int $after
     * @return int|self
     */
    public function after($after = null)
    {
        if(null === $after)
        {
            return $this->_after;
        }
        $this->_after = (int) $after;
        return $this;
    }

    /**
     * Add an account
     *
     * @param  Account $attr
     * @return self
     */
    public function addAccount(Account $account)
    {
        $this->_accounts[] = $account;
        return $this;
    }

    /**
     * Gets or sets accounts array
     *
     * @param  array $accounts
     * @return array|self
     */
    public function accounts(array $accounts = null)
    {
        if(null === $accounts)
        {
            return $this->_accounts;
        }
        $this->_accounts = array();
        foreach ($accounts as $account)
        {
            if($account instanceof Account)
            {
                $this->_accounts[] = $account;
            }
        }
        return $this;
    }

    /**
     * Add a timezone fixup rule
     *
     * @param  TZFixupRule $attr
     * @return self
     */
    public function addFixupRule(TZFixupRule $fixupRule)
    {
        $this->_fixupRules[] = $fixupRule;
        return $this;
    }

    /**
     * Gets or sets fixupRules array
     *
     * @param  array $fixupRules
     * @return array|self
     */
    public function fixupRules(array $fixupRules = null)
    {
        if(null === $fixupRules)
        {
            return $this->_fixupRules;
        }
        $this->_fixupRules = array();
        foreach ($fixupRules as $fixupRule)
        {
            if($fixupRule instanceof TZFixupRule)
            {
                $this->_fixupRules[] = $fixupRule;
            }
        }
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
            'tzfixup' => array()
        );
        if(is_bool($this->_sync))
        {
            $this->array['sync'] = $this->_sync ? 1 : 0;
        }
        if(is_int($this->_after))
        {
            $this->array['after'] = $this->_after;
        }
        if(count($this->_accounts))
        {
            $this->array['account'] = array();
            foreach ($this->_accounts as $account)
            {
                $accountArr = $account->toArray('account');
                $this->array['account'][] = $accountArr['account'];
            }
        }
        if(count($this->_fixupRules))
        {
            $array['fixupRule'] = array();
            foreach ($this->_fixupRules as $fixupRule)
            {
                $fixupRuleArr = $fixupRule->toArray('fixupRule');
                $array['fixupRule'][] = $fixupRuleArr['fixupRule'];
            }
            $this->array['tzfixup'] = $array;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(is_bool($this->_sync))
        {
            $this->xml->addAttribute('sync', $this->_sync ? 1 : 0);
        }
        if(is_int($this->_after))
        {
            $this->xml->addAttribute('after', $this->_after);
        }
        foreach ($this->_accounts as $account)
        {
            $this->xml->append($account->toXml('account'));
        }
        $tzfixup = $this->xml->addChild('tzfixup', null);
        foreach ($this->_fixupRules as $fixupRule)
        {
            $tzfixup->append($fixupRule->toXml('fixupRule'));
        }
        return parent::toXml();
    }
}
