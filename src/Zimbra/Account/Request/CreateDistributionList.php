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

use Zimbra\Soap\Request\Attr;

/**
 * CreateDistributionList request class
 * Create a Distribution List
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateDistributionList extends Attr
{
    /**
     * Constructor method for createDistributionList
     * @param  string $name    Name for the new Distribution List
     * @param  bool   $dynamic Flag type of distribution list to create
     * @param  array  $attrs   Attributes specified as key value pairs
     * @return self
     */
    public function __construct($name, $dynamic = null, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->property('name', trim($name));
        if(null !== $dynamic)
        {
            $this->property('dynamic', (bool) $dynamic);
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
     * Gets or sets dynamic
     *
     * @param  bool $dynamic
     * @return bool|self
     */
    public function dynamic($dynamic = null)
    {
        if(null === $dynamic)
        {
            return $this->property('dynamic');
        }
        return $this->property('dynamic', (bool) $dynamic);
    }
}
