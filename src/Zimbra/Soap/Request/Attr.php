<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Request;

use Zimbra\Soap\Request;
use Zimbra\Struct\AttrsImplTrait;

/**
 * Attr class in Zimbra API PHP, not to be instantiated.
 * 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Attr extends Request
{
    use AttrsImplTrait {
        AttrsImplTrait::__construct as private __attrsConstruct;
    }

    /**
     * Constructor method for AttrsImpl
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = [])
    {
        $this->__attrsConstruct($attrs);
    }
}
