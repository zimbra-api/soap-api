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
 * ItemSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ItemSpec extends Base
{
    /**
     * Constructor method for ItemSpec
     * @param string $id Item ID
     * @param string $folder Folder ID
     * @param string $name Name
     * @param string $path Fully qualified path
     * @return self
     */
    public function __construct(
        $id = null,
        $folder = null,
        $name = null,
        $path = null
    )
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $folder)
        {
            $this->setProperty('l', trim($folder));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $path)
        {
            $this->setProperty('path', trim($path));
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
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
     * @param  string $folder
     * @return self
     */
    public function setFolder($folder)
    {
        return $this->setProperty('l', trim($folder));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
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
    public function toArray($name = 'item')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'item')
    {
        return parent::toXml($name);
    }
}
