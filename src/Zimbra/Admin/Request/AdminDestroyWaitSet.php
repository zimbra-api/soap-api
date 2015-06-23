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
 * AdminDestroyWaitSet request class
 * Use this to close out the waitset.
 * Note that the server will automatically time out a wait set if there is no reference to it for (default of) 20 minutes.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AdminDestroyWaitSet extends Base
{
    /**
     * Constructor method for AdminDestroyWaitSet
     * @param  string $waitSet Waitset ID
     * @return self
     */
    public function __construct($waitSet)
    {
        parent::__construct();
        $this->setProperty('waitSet', trim($waitSet));
    }

    /**
     * Gets Waitset ID
     *
     * @return string
     */
    public function getWaitSetId()
    {
        return $this->getProperty('waitSet');
    }

    /**
     * Sets Waitset ID
     *
     * @param  string $waitSet
     * @return self
     */
    public function setWaitSetId($waitSet)
    {
        return $this->setProperty('waitSet', trim($waitSet));
    }
}
