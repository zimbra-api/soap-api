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
     * @param bool $listSessions List Sessions flag
     * @param bool $groupByAccount Group by account flag
     * @return self
     */
    public function __construct($listSessions = null, $groupByAccount = null)
    {
        parent::__construct();
        if(null !== $listSessions)
        {
            $this->property('listSessions', (bool) $listSessions);
        }
        if(null !== $groupByAccount)
        {
            $this->property('groupByAccount', (bool) $groupByAccount);
        }
    }

    /**
     * Gets or sets listSessions
     *
     * @param  bool $listSessions
     * @return bool|self
     */
    public function listSessions($listSessions = null)
    {
        if(null === $listSessions)
        {
            return $this->property('listSessions');
        }
        return $this->property('listSessions', (bool) $listSessions);
    }

    /**
     * Gets or sets groupByAccount
     *
     * @param  bool $groupByAccount
     * @return bool|self
     */
    public function groupByAccount($groupByAccount = null)
    {
        if(null === $groupByAccount)
        {
            return $this->property('groupByAccount');
        }
        return $this->property('groupByAccount', (bool) $groupByAccount);
    }
}
