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
 * GetAllAdminAccounts request class
 * Get all Admin accounts.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllAdminAccounts extends Base
{
    /**
     * Constructor method for GetAllAdminAccounts
     * @param  bool $applyCos Flag whether or not to apply class of service (COS) rules
     * @return self
     */
    public function __construct($applyCos = null)
    {
        parent::__construct();
        if(null !== $applyCos)
        {
            $this->property('applyCos', (bool) $applyCos);
        }
    }

    /**
     * Gets or sets applyCos
     *
     * @param  bool $applyCos
     * @return bool|self
     */
    public function applyCos($applyCos = null)
    {
        if(null === $applyCos)
        {
            return $this->property('applyCos');
        }
        return $this->property('applyCos', (bool) $applyCos);
    }
}
