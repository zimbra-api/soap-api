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
 * GetFolderSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetFolderSpec extends Base
{
    /**
     * Constructor method for GetFolderSpec
     * @param string $uuid Base folder UUID
     * @param string $folder Base folder ID
     * @param string $path Fully qualified path
     * @return self
     */
    public function __construct(
        $uuid = null,
        $folder = null,
        $path = null
    )
    {
        parent::__construct();
        if(null !== $uuid)
        {
            $this->setProperty('uuid', trim($uuid));
        }
        if(null !== $folder)
        {
            $this->setProperty('l', trim($folder));
        }
        if(null !== $path)
        {
            $this->setProperty('path', trim($path));
        }
    }

    /**
     * Gets uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->getProperty('uuid');
    }

    /**
     * Sets uuid
     *
     * @param  string $uuid
     * @return self
     */
    public function setUuid($uuid)
    {
        return $this->setProperty('uuid', trim($uuid));
    }

    /**
     * Gets folder Id
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder Id
     *
     * @param  string $l
     * @return self
     */
    public function setFolderId($l)
    {
        return $this->setProperty('l', trim($l));
    }

    /**
     * Gets path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getProperty('path');
    }

    /**
     * Sets path
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path)
    {
        return $this->setProperty('path', trim($path));
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
