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

use Zimbra\Mail\Struct\FolderSpec;

/**
 * GetEffectiveFolderPerms request class
 * Returns the effective permissions of the specified folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetEffectiveFolderPerms extends Base
{
    /**
     * Constructor method for GetEffectiveFolderPerms
     * @param  FolderSpec $folder
     * @return self
     */
    public function __construct(FolderSpec $folder)
    {
        parent::__construct();
        $this->setChild('folder', $folder);
    }

    /**
     * Gets folder specification
     *
     * @return FolderSpec
     */
    public function getFolder()
    {
        return $this->getChild('folder');
    }

    /**
     * Sets folder specification
     *
     * @param  FolderSpec $folder
     * @return self
     */
    public function setFolder(FolderSpec $folder)
    {
        return $this->setChild('folder', $folder);
    }
}
