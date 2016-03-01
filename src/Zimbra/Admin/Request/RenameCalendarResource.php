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
 * RenameCalendarResource request class
 * Rename Calendar Resource.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RenameCalendarResource extends Base
{
    /**
     * Constructor method for RenameCalendarResource
     * @param string $id
     * @param string $newName
     * @return self
     */
    public function __construct($id, $newName)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('newName', trim($newName));
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets new name
     *
     * @return string
     */
    public function getNewName()
    {
        return $this->getProperty('newName');
    }

    /**
     * Sets new name
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName($newName)
    {
        return $this->setProperty('newName', trim($newName));
    }
}
