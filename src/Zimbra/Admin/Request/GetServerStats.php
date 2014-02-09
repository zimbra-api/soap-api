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

use Zimbra\Admin\Struct\Stat;
use Zimbra\Common\TypedSequence;

/**
 * GetServerStats request class
 * Returns server monitoring stat.
 * These are the same stat that are logged to mailboxd.csv.
 * If no <stat> element is specified, all server stat are returned.
 * If the stat name is invalid, returns a SOAP fault..
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetServerStats extends Base
{
    /**
     * Stats
     * @var Stat
     */
    private $_stat = array();

    /**
     * Constructor method for GetServerStats
     * @param  array $stat
     * @return self
     */
    public function __construct(array $stat = array())
    {
        parent::__construct();
        $this->_stat = new TypedSequence('Zimbra\Admin\Struct\Stat', $stat);

        $this->addHook(function($sender)
        {
            $sender->child('stat', $sender->stat()->all());
        });
    }

    /**
     * Add an attr
     *
     * @param  Stat $stat
     * @return self
     */
    public function addStat(Stat $stat)
    {
        $this->_stat->add($stat);
        return $this;
    }

    /**
     * Gets stat Sequence
     *
     * @return Sequence
     */
    public function stat()
    {
        return $this->_stat;
    }
}
