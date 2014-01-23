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
 * DeleteSignature request class
 * Delete a signature
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteSignature extends Request
{
    /**
     * Constructor method for DeleteSignature
     * @param NameId $identity The signature to delete
     * @return self
     */
    public function __construct(NameId $signature)
    {
        parent::__construct();
        $this->child('signature', $signature);
    }

    /**
     * Gets or sets signature
     *
     * @param  NameId $signature
     * @return NameId|self
     */
    public function signature(NameId $signature = null)
    {
        if(null === $signature)
        {
            return $this->child('signature');
        }
        return $this->child('signature', $signature);
    }
}
