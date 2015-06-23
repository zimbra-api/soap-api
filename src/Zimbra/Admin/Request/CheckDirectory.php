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

use Zimbra\Admin\Struct\CheckDirSelector as CheckDir;
use Zimbra\Common\TypedSequence;

/**
 * CheckDirectory request class
 * Check existence of one or more directory and optionally create them..
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckDirectory extends Base
{
    /**
     * Directories
     * @var TypedSequence<CheckDirSelector>
     */
    private $_directories;

    /**
     * Constructor method for CheckDirectory
     * @param array $directories Directories
     * @return self
     */
    public function __construct(array $directories = [])
    {
        parent::__construct();
        $this->setDirectories($directories);

        $this->on('before', function(Base $sender)
        {
            if($sender->getDirectories()->count())
            {
                $sender->setChild('directory', $sender->getDirectories()->all());
            }
        });
    }

    /**
     * Add a directory
     *
     * @param  CheckDir $directory
     * @return self
     */
    public function addDirectory(CheckDir $directory)
    {
        $this->_directories->add($directory);
        return $this;
    }

    /**
     * Sets directory sequence
     *
     * @param array $directories Directories
     * @return self
     */
    public function setDirectories(array $directories)
    {
        $this->_directories = new TypedSequence('Zimbra\Admin\Struct\CheckDirSelector', $directories);
        return $this;
    }

    /**
     * Gets directory sequence
     *
     * @return Sequence
     */
    public function getDirectories()
    {
        return $this->_directories;
    }
}
