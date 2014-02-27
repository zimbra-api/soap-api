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
    private $_directory = array();

    /**
     * Constructor method for CheckDirectory
     * @param array $directory Directories
     * @return self
     */
    public function __construct(array $directory = array())
    {
        parent::__construct();
        $this->_directory = new TypedSequence('Zimbra\Admin\Struct\CheckDirSelector', $directory);

        $this->on('before', function(Base $sender)
        {
            if($sender->directory()->count())
            {
                $sender->child('directory', $sender->directory()->all());
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
        $this->_directory->add($directory);
    }

    /**
     * Gets directory Sequence
     *
     * @return Sequence
     */
    public function directory()
    {
        return $this->_directory;
    }
}
