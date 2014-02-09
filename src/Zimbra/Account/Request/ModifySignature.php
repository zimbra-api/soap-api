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

use Zimbra\Account\Struct\Signature;

/**
 * ModifySignature request class
 * Change attributes of the given signature.
 * Only the attributes specified in the request are modified. 
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifySignature extends Base
{
    /**
     * Constructor method for ModifySignature
     * @param Signature $signature Specifies the changes to the signature
     * @return self
     */
    public function __construct(Signature $signature)
    {
        parent::__construct();
        $this->child('signature', $signature);
    }

    /**
     * Gets or sets signature
     *
     * @param  Signature $signature
     * @return Signature|self
     */
    public function signature(Signature $signature = null)
    {
        if(null === $signature)
        {
            return $this->child('signature');
        }
        return $this->child('signature', $signature);
    }
}
