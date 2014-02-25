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

use Zimbra\Struct\KeyValuePair;

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
class GetConfig extends Base
{
    /**
     * Constructor method for GetConfig
     * @param  KeyValuePair $attr
     * @return self
     */
    public function __construct(KeyValuePair $attr = null)
    {
        parent::__construct();
        if($attr instanceof KeyValuePair)
        {
            $this->child('a', $attr);
        }
    }

    /**
     * Gets or sets attr
     *
     * @param  KeyValuePair $attr
     * @return KeyValuePair|self
     */
    public function attr(KeyValuePair $attr = null)
    {
        if(null === $attr)
        {
            return $this->child('a');
        }
        return $this->child('a', $attr);
    }
}
