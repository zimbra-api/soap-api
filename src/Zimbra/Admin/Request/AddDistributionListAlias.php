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
 * AddDistributionListAlias request class
 * Add an alias for a distribution list
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddDistributionListAlias extends Base
{
    /**
     * Constructor method for AddDistributionListAlias
     * @param  string $id Zimbra ID
     * @param  string $alias Alias
     * @return self
     */
    public function __construct($id, $alias)
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->property('alias', trim($alias));
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets alias
     *
     * @param  string $alias
     * @return string|self
     */
    public function alias($alias = null)
    {
        if(null === $alias)
        {
            return $this->property('alias');
        }
        return $this->property('alias', trim($alias));
    }
}
