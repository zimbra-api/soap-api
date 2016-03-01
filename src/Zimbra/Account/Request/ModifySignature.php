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
        $this->setChild('signature', $signature);
    }

    /**
     * Gets the signature
     *
     * @return Signature
     */
    public function getSignature()
    {
        return $this->getChild('signature');
    }

    /**
     * Sets the signature
     *
     * @param  Signature $signature
     * @return self
     */
    public function setSignature(Signature $signature)
    {
        return $this->setChild('signature', $signature);
    }
}
