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

use Zimbra\Mail\Struct\ModifySearchFolderSpec;

/**
 * ModifySearchFolder request class
 * Modify Search Folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifySearchFolder extends Base
{
    /**
     * Constructor method for ModifySearchFolder
     * @param  ModifySearchFolderSpec $searchFolder
     * @return self
     */
    public function __construct(ModifySearchFolderSpec $searchFolder)
    {
        parent::__construct();
        $this->setChild('search', $searchFolder);
    }

    /**
     * Gets specification of search folder modifications
     *
     * @return ModifySearchFolderSpec
     */
    public function getSearchFolder()
    {
        return $this->getChild('search');
    }

    /**
     * Sets specification of search folder modifications
     *
     * @param  ModifySearchFolderSpec $searchFolder
     * @return self
     */
    public function setSearchFolder(ModifySearchFolderSpec $searchFolder)
    {
        return $this->setChild('search', $searchFolder);
    }
}
