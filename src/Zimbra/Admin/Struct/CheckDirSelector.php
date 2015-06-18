<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Struct\Base;

/**
 * CheckDirSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckDirSelector extends Base
{
    /**
     * Constructor method for CheckDirSelector
     * @param string $path Full path to the directory
     * @param bool   $create Whether to create the directory or not if it doesn't exist
     * @return self
     */
    public function __construct($path, $create = null)
    {
        parent::__construct();
        $this->setProperty('path', trim($path));
        if(null !== $create)
        {
            $this->setProperty('create', (bool) $create);
        }
    }

    /**
     * Gets the path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getProperty('path');
    }

    /**
     * Sets the path
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path)
    {
        return $this->setProperty('path', trim($path));
    }

    /**
     * Gets create flag
     *
     * @return bool
     */
    public function isCreate()
    {
        return $this->getProperty('create');
    }

    /**
     * Sets create flag
     *
     * @param  bool $create
     * @return self
     */
    public function setCreate($create)
    {
        return $this->setProperty('create', (bool) $create);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'directory')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'directory')
    {
        return parent::toXml($name);
    }
}
