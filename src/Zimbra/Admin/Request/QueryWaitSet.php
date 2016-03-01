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
 * QueryWaitSet request class
 * Query WaitSet.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class QueryWaitSet extends Base
{
    /**
     * Constructor method for QueryWaitSet
     * @param string $waitSet WaitSet ID
     * @return self
     */
    public function __construct($waitSet = null)
    {
        parent::__construct();
        $this->setProperty('waitSet', trim($waitSet));
    }

    /**
     * Gets waitSet
     *
     * @return string
     */
    public function getWaitSet()
    {
        return $this->getProperty('waitSet');
    }

    /**
     * Sets waitSet
     *
     * @param  string $waitSet
     * @return self
     */
    public function setWaitSet($waitSet)
    {
        return $this->setProperty('waitSet', trim($waitSet));
    }
}
