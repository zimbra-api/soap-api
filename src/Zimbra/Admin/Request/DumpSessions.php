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

/**
 * DumpSessions request class
 * Dump sessions.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DumpSessions extends Base
{
    /**
     * Constructor method for DumpSessions
     * @param bool $listSessions List sessions flag
     * @param bool $groupByAccount Group by account flag
     * @return self
     */
    public function __construct($listSessions = null, $groupByAccount = null)
    {
        parent::__construct();
        if(null !== $listSessions)
        {
            $this->setProperty('listSessions', (bool) $listSessions);
        }
        if(null !== $groupByAccount)
        {
            $this->setProperty('groupByAccount', (bool) $groupByAccount);
        }
    }

    /**
     * Gets list sessions flag
     *
     * @return bool
     */
    public function getListSessions()
    {
        return $this->getProperty('listSessions');
    }

    /**
     * Sets list sessions flag
     *
     * @param  bool $listSessions
     * @return self
     */
    public function setListSessions($listSessions)
    {
        return $this->setProperty('listSessions', (bool) $listSessions);
    }

    /**
     * Gets group by account flag
     *
     * @return bool
     */
    public function getGroupByAccount()
    {
        return $this->getProperty('groupByAccount');
    }

    /**
     * Sets group by account flag
     *
     * @param  bool $groupByAccount
     * @return self
     */
    public function setGroupByAccount($groupByAccount)
    {
        return $this->setProperty('groupByAccount', (bool) $groupByAccount);
    }
}
