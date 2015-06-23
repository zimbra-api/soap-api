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

use Zimbra\Struct\KeyValuePair;

/**
 * GetConfig request class
 * Get Config request.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetConfig extends Base
{
    /**
     * Constructor method for GetConfig
     * @param  KeyValuePair $attr
     * @return self
     */
    public function __construct(KeyValuePair $attr = null)
    {
        parent::__construct();
        if($attr instanceof KeyValuePair)
        {
            $this->setChild('a', $attr);
        }
    }

    /**
     * Gets the attr.
     *
     * @return KeyValuePair
     */
    public function getAttr()
    {
        return $this->getChild('a');
    }

    /**
     * Sets the attr.
     *
     * @param  KeyValuePair $attr
     * @return self
     */
    public function setAttr(KeyValuePair $attr)
    {
        return $this->setChild('a', $attr);
    }
}
