<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\IdsAttr;

/**
 * GetMsgMetadata request class
 * Get message metadata
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetMsgMetadata extends Base
{
    /**
     * Constructor method for GetMsgMetadata
     * @param  IdsAttr $m
     * @return self
     */
    public function __construct(IdsAttr $m)
    {
        parent::__construct();
        $this->child('m', $m);
    }

    /**
     * Get or set m
     *
     * @param  IdsAttr $m
     * @return IdsAttr|self
     */
    public function m(IdsAttr $m = null)
    {
        if(null === $m)
        {
            return $this->child('m');
        }
        return $this->child('m', $m);
    }
}
