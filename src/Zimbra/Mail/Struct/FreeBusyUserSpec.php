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
 * FreeBusyUserSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FreeBusyUserSpec extends Base
{
    /**
     * Constructor method for FreeBusyUserSpec
     * @param int $l Calendar folder ID; if omitted, get f/b on all calendar folders
     * @param string $id Zimbra ID Either "name" or "id" must be specified
     * @param string $name Email address. Either "name" or "id" must be specified
     * @return self
     */
    public function __construct(
        $folder = null,
        $id = null,
        $name = null
    )
    {
        parent::__construct();
        if(null !== $folder)
        {
            $this->setProperty('l', (int) $folder);
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
    }

    /**
     * Gets folder Id
     *
     * @return int
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder Id
     *
     * @param  int $folder
     * @return self
     */
    public function setFolderId($folder)
    {
        return $this->setProperty('l', (int) $folder);
    }

    /**
     * Gets Zimbra Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Zimbra Id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'usr')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'usr')
    {
        return parent::toXml($name);
    }
}
