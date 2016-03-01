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

use Zimbra\Soap\Request\Attr;

/**
 * Base admin request class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class BaseAttr extends Attr
{
    /**
     * Constructor method for base request
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setXmlNamespace('urn:zimbraAdmin');
    }
}