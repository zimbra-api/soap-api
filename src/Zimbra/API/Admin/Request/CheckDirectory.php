<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\CheckDirSelector as CheckDir;

/**
 * CheckDirectory class
 * Check existence of one or more directories and optionally create them..
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckDirectory extends Request
{
    /**
     * Directories
     * @var array
     */
    private $_directories = array();

    /**
     * Constructor method for CheckDirectory
     * @param array $directories
     * @return self
     */
    public function __construct(array $directories = array())
    {
        parent::__construct();
        $this->directories($directories);
    }

    /**
     * Add a directory
     *
     * @param  CheckDir $directory
     * @return self
     */
    public function addDirectory(CheckDir $directory)
    {
        $this->_directories[] = $directory;
    }

    /**
     * Gets or sets directories
     *
     * @param  array $directories
     * @return array|self
     */
    public function directories(array $directories = null)
    {
        if(null === $directories)
        {
            return $this->_directories;
        }
        $this->_directories = array();
        foreach ($directories as $directory)
        {
            if($directory instanceof CheckDir)
            {
                $this->_directories[] = $directory;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_directories))
        {
            $this->array['directory'] = array();
            foreach ($this->_directories as $directory)
            {
                $directoryArr = $directory->toArray('directory');
                $this->array['directory'][] = $directoryArr['directory'];
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        foreach ($this->_directories as $directory)
        {
            $this->xml->append($directory->toXml('directory'));
        }
        return parent::toXml();
    }
}
