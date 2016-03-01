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
        $this->setChild('id', trim($id));
        $this->setChild('newName', trim($newName));
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

    /**
     * Gets new name
     *
     * @return string
     */
    public function getNewName()
    {
        return $this->getChild('newName');
    }

    /**
     * Sets new name
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName($newName)
    {
        return $this->setChild('newName', trim($newName));
    }
}
