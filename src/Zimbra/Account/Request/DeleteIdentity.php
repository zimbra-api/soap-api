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

use Zimbra\Soap\Request;
use Zimbra\Account\Struct\NameId;

/**
 * DeleteIdentity request class
 * Delete an identity
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteIdentity extends Request
{
    /**
     * Constructor method for DeleteIdentity
     * @param NameId $identity Details of the identity to delete.
     * @return self
     */
    public function __construct(NameId $identity)
    {
        parent::__construct();
        $this->child('identity', $identity);
    }

    /**
     * Gets or sets identity
     *
     * @param  NameId $identity
     * @return NameId|self
     */
    public function identity(NameId $identity = null)
    {
        if(null === $identity)
        {
            return $this->child('identity');
        }
        return $this->child('identity', $identity);
    }
}
