<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

/**
 * FileIntoAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FileIntoAction extends FilterAction
{
    /**
     * Constructor method for FileIntoAction
     * @param int $index Index - specifies a guaranteed order for the action elements
     * @param string $folderPath Folder path
     * @return self
     */
    public function __construct($index, $folderPath = null)
    {
        parent::__construct($index);
        if(null !== $folderPath)
        {
            $this->setProperty('folderPath', trim($folderPath));
        }
    }

    /**
     * Gets folder path
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->getProperty('folderPath');
    }

    /**
     * Sets folder path
     *
     * @param  string $folderPath
     * @return self
     */
    public function setFolder($folderPath)
    {
        return $this->setProperty('folderPath', trim($folderPath));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionFileInto')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionFileInto')
    {
        return parent::toXml($name);
    }
}
