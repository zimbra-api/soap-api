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
 * CreateCos request class
 * Create a class of service.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateCos extends BaseAttr
{
    /**
     * Constructor method for CreateCos
     * @param string $name The name
     * @param array  $attrs
     * @return self
     */
    public function __construct($name, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->child('name', trim($name));
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->child('name');
        }
        return $this->child('name', trim($name));
    }
}
