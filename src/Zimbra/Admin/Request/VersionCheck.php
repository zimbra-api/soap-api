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

use Zimbra\Enum\VersionCheckAction as Action;

/**
 * VersionCheck request class
 * Version Check.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VersionCheck extends Base
{
    /**
     * Constructor method for VersionCheck
     * @param Action $action The action
     * @return self
     */
    public function __construct(Action $action)
    {
        parent::__construct();
        $this->setProperty('action', $action);
    }

    /**
     * Gets action
     *
     * @return Action
     */
    public function getAction()
    {
        return $this->getProperty('action');
    }

    /**
     * Sets action
     *
     * @param  Action $action
     * @return self
     */
    public function setAction(Action $action)
    {
        return $this->setProperty('action', $action);
    }
}
