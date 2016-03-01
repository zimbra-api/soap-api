<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\ItemActionSelector;

/**
 * ItemAction request class
 * Perform an action on an item
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ItemAction extends Base
{
    /**
     * Constructor method for ItemAction
     * @param  ItemActionSelector $action
     * @return self
     */
    public function __construct(ItemActionSelector $action)
    {
        parent::__construct();
        $this->setChild('action', $action);
    }

    /**
     * Gets action to perform on item
     *
     * @return ItemActionSelector
     */
    public function getAction()
    {
        return $this->getChild('action');
    }

    /**
     * Sets action to perform on item
     *
     * @param  ItemActionSelector $action
     * @return self
     */
    public function setAction(ItemActionSelector $action)
    {
        return $this->setChild('action', $action);
    }
}
