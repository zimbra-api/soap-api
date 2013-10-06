<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request\Attr;

/**
 * ModifyConfig class
 * Modify Configuration attributes.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyConfig extends Attr
{
    /**
     * Constructor method for ModifyConfig
     * @param array  $attrs
     * @return self
     */
    public function __construct(array $attrs = array())
    {
        parent::__construct($attrs);
    }
}
