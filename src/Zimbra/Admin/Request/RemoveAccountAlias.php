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
 * RemoveAccountAlias request class
 * Remove Account Alias.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveAccountAlias extends Base
{
    /**
     * Constructor method for RemoveAccountAlias
     * @param string $alias Alias
     * @param string $id Zimbra ID
     * @return self
     */
    public function __construct($alias, $id = null)
    {
        parent::__construct();
        $this->property('alias', trim($alias));
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
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
}
