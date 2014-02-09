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
 * RenameUCService request class
 * Rename Unified Communication Service.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RenameUCService extends Base
{
    /**
     * Constructor method for RenameUCService
     * @param string $id Zimbra ID
     * @param string $newName new UC Service name
     * @return self
     */
    public function __construct($id, $newName)
    {
        parent::__construct();
        $this->child('id', trim($id));
        $this->child('newName', trim($newName));
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
            return $this->child('id');
        }
        return $this->child('id', trim($id));
    }

    /**
     * Gets or sets newName
     *
     * @param  string $newName
     * @return string|self
     */
    public function newName($newName = null)
    {
        if(null === $newName)
        {
            return $this->child('newName');
        }
        return $this->child('newName', trim($newName));
    }
}
