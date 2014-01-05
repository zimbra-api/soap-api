<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

/**
 * FileIntoAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FileIntoAction extends FilterAction
{
    /**
     * Folder path
     * @var string
     */
    private $_folderPath;

    /**
     * Constructor method for FileIntoAction
     * @param int $index
     * @param string $folderPath
     * @return self
     */
    public function __construct($index, $folderPath = null)
    {
        parent::__construct($index);
        $this->_folderPath = trim($folderPath);
    }

    /**
     * Gets or sets folderPath
     *
     * @param  string $folderPath
     * @return string|self
     */
    public function folderPath($folderPath = null)
    {
        if(null === $folderPath)
        {
            return $this->_folderPath;
        }
        $this->_folderPath = trim($folderPath);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionFileInto')
    {
        $name = !empty($name) ? $name : 'actionFileInto';
        $arr = parent::toArray($name);
        if(!empty($this->_folderPath))
        {
            $arr[$name]['folderPath'] = $this->_folderPath;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionFileInto')
    {
        $name = !empty($name) ? $name : 'actionFileInto';
        $xml = parent::toXml($name);
        if(!empty($this->_folderPath))
        {
            $xml->addAttribute('folderPath', $this->_folderPath);
        }
        return $xml;
    }
}
