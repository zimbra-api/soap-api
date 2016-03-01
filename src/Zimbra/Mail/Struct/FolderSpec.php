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

use Zimbra\Struct\Base;

/**
 * FolderSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FolderSpec extends Base
{
    /**
     * Constructor method for FolderSpec
     * @param string $folder Folder ID
     * @return self
     */
    public function __construct($folder = null)
    {
        parent::__construct();
        if(null !== $folder)
        {
            $this->setProperty('l', trim($folder));
        }
    }

    /**
     * Gets folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder
     *
     * @param  string $l
     * @return self
     */
    public function setFolder($l)
    {
        return $this->setProperty('l', trim($l));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'folder')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'folder')
    {
        return parent::toXml($name);
    }
}
