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

use Zimbra\Mail\Struct\FolderActionSelector;

/**
 * FolderAction request class
 * Perform an action on a folder 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FolderAction extends Base
{
    /**
     * Constructor method for FolderAction
     * @param  FolderActionSelector $action
     * @return self
     */
    public function __construct(FolderActionSelector $action)
    {
        parent::__construct();
        $this->setChild('action', $action);
    }

    /**
     * Gets action to perform on folder
     *
     * @return FolderActionSelector
     */
    public function getAction()
    {
        return $this->getChild('action');
    }

    /**
     * Sets action to perform on folder
     *
     * @param  FolderActionSelector $action
     * @return self
     */
    public function setAction(FolderActionSelector $action)
    {
        return $this->setChild('action', $action);
    }
}
