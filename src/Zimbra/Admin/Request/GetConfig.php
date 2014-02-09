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
 * GetConfig request class
 * Get Config request.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetConfig extends BaseAttr
{
    /**
     * Constructor method for GetConfig
     * @param  array $attrs
     * @return self
     */
    public function __construct(array $attrs = array())
    {
        parent::__construct($attrs);
    }
}
