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
class GetDocumentShareURL extends Base
{
    /**
     * Constructor method for GetDocumentShareURL
     * @param  ItemSpec $item
     * @return self
     */
    public function __construct(ItemSpec $item)
    {
        parent::__construct();
        $this->setChild('item', $item);
    }

    /**
     * Gets item specification
     *
     * @return ItemSpec
     */
    public function getItem()
    {
        return $this->getChild('item');
    }

    /**
     * Sets item specification
     *
     * @param  ItemSpec $item
     * @return self
     */
    public function setItem(ItemSpec $item)
    {
        return $this->setChild('item', $item);
    }
}
