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

use Zimbra\Mail\Struct\NewFolderSpec;

/**
 * CreateFolder request class
 * Create folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateFolder extends Base
{
    /**
     * Constructor method for CreateFolder
     * @param  NewFolderSpec $folder
     * @return self
     */
    public function __construct(NewFolderSpec $folder)
    {
        parent::__construct();
        $this->setChild('folder', $folder);
    }

    /**
     * Gets folder specification
     *
     * @return NewFolderSpec
     */
    public function getFolder()
    {
        return $this->getChild('folder');
    }

    /**
     * Sets folder specification
     *
     * @param  NewFolderSpec $folder
     * @return self
     */
    public function setFolder(NewFolderSpec $folder)
    {
        return $this->setChild('folder', $folder);
    }
}
