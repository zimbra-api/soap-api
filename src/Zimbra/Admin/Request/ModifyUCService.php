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
 * ModifyUCService request class
 * ModifyModify attributes for a UC service.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyUCService extends BaseAttr
{
    /**
     * Constructor method for ModifyUCService
     * @param string $id Zimbra ID
     * @param array  $attrs
     * @return self
     */
    public function __construct($id, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setChild('id', trim($id));
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getChild('id');
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setChild('id', trim($id));
    }
}
