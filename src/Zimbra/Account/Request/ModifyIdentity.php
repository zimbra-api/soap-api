<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\Identity;
use Zimbra\Soap\Request;

/**
 * ModifyIdentity request class
 * Modify an Identity
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyIdentity extends Request
{
    /**
     * Constructor method for ModifyIdentity
     * @param Identity $identity Specify identity to be modified Must specify either "name" or "id" attribute
     * @return self
     */
    public function __construct(Identity $identity)
    {
        parent::__construct();
        $this->child('identity', $identity);
    }

    /**
     * Gets or sets identity
     *
     * @param  Identity $identity
     * @return Identity|self
     */
    public function identity(Identity $identity = null)
    {
        if(null === $identity)
        {
            return $this->child('identity');
        }
        return $this->child('identity', $identity);
    }
}
