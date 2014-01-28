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

use Zimbra\Mail\Struct\ItemSpec;
use Zimbra\Soap\Request;

/**
 * GetDocumentShareURL request class
 * Get the download URL of shared document
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDocumentShareURL extends Request
{
    /**
     * Constructor method for GetDocumentShareURL
     * @param  ItemSpec $item
     * @return self
     */
    public function __construct(ItemSpec $item)
    {
        parent::__construct();
        $this->child('item', $item);
    }

    /**
     * Get or set item
     * Item specification
     *
     * @param  ItemSpec $item
     * @return ItemSpec|self
     */
    public function item(ItemSpec $item = null)
    {
        if(null === $item)
        {
            return $this->child('item');
        }
        return $this->child('item', $item);
    }
}
