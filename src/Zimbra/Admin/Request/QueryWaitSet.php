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

use Zimbra\Soap\Request;

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
class QueryWaitSet extends Request
{
    /**
     * Constructor method for QueryWaitSet
     * @param string $waitSet WaitSet ID
     * @return self
     */
    public function __construct($waitSet = null)
    {
        parent::__construct();
        $this->property('waitSet', trim($waitSet));
    }

    /**
     * Gets or sets waitSet
     *
     * @param  string $waitSet
     * @return string|self
     */
    public function waitSet($waitSet = null)
    {
        if(null === $waitSet)
        {
            return $this->property('waitSet');
        }
        return $this->property('waitSet', trim($waitSet));
    }
}
