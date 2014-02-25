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
 * GetRight request class
 * Get definition of a right.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetRight extends Base
{
    /**
     * Constructor method for GetRight
     * @param string $right Right name
     * @param bool $expandAllAttrs Whether to include all attribute names in the <attrs> elements in the response if the right is meant for all attributes
     * @return self
     */
    public function __construct($right, $expandAllAttrs = null)
    {
        parent::__construct();
        $this->child('right', trim($right));
        if(null !== $expandAllAttrs)
        {
            $this->property('expandAllAttrs', (bool) $expandAllAttrs);
        }
    }

    /**
     * Gets or sets right
     *
     * @param  string $right
     * @return string|self
     */
    public function right($right = null)
    {
        if(null === $right)
        {
            return $this->child('right');
        }
        return $this->child('right', trim($right));
    }

    /**
     * Gets or sets expandAllAttrs
     *
     * @param  bool $expandAllAttrs
     * @return bool|self
     */
    public function expandAllAttrs($expandAllAttrs = null)
    {
        if(null === $expandAllAttrs)
        {
            return $this->property('expandAllAttrs');
        }
        return $this->property('expandAllAttrs', (bool) $expandAllAttrs);
    }
}
