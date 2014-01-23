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
 * CreateCalendarResource request class
 * Create a calendar resource.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateCalendarResource extends Attr
{
    /**
     * Constructor method for CreateCalendarResource
     * @param string $name The name
     * @param string $password The password
     * @param array  $attrs
     * @return self
     */
    public function __construct($name = null, $password = null, array $attrs = array())
    {
        parent::__construct($attrs);
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $password)
        {
            $this->property('password', trim($password));
        }
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
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->property('password');
        }
        return $this->property('password', trim($password));
    }
}
