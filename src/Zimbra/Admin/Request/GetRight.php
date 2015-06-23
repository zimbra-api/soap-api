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
        $this->setChild('right', trim($right));
        if(null !== $expandAllAttrs)
        {
            $this->setProperty('expandAllAttrs', (bool) $expandAllAttrs);
        }
    }

    /**
     * Gets right
     *
     * @return string
     */
    public function getRight()
    {
        return $this->getChild('right');
    }

    /**
     * Sets right
     *
     * @param  string $right
     * @return self
     */
    public function setRight($right)
    {
        return $this->setChild('right', trim($right));
    }

    /**
     * Gets expandAllAttrs
     *
     * @return bool
     */
    public function getExpandAllAttrs()
    {
        return $this->getProperty('expandAllAttrs');
    }

    /**
     * Sets expandAllAttrs
     *
     * @param  bool $expandAllAttrs
     * @return self
     */
    public function setExpandAllAttrs($expandAllAttrs)
    {
        return $this->setProperty('expandAllAttrs', (bool) $expandAllAttrs);
    }
}
