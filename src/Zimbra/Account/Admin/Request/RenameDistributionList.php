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

use Zimbra\Soap\Request;

/**
 * RenameDistributionList request class
 * Rename Distribution List.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RenameDistributionList extends Request
{
    /**
     * Constructor method for RenameDistributionList
     * @param string $id Zimbra ID
     * @param string $newName New Distribution List name
     * @return self
     */
    public function __construct($id, $newName)
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->property('newName', trim($newName));
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
            return $this->property('id');
        }
        return $this->property('id', trim($id));
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
            return $this->property('newName');
        }
        return $this->property('newName', trim($newName));
    }
}
