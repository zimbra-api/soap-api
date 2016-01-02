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
 * DocAttachSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DocAttachSpec extends AttachSpec
{
    /**
     * Constructor method for DocAttachSpec
     * @param  string $path Document path. If specified "id" and "ver" attributes are ignored
     * @param  string $id Item ID
     * @param  int $ver Optional Version.
     * @param  bool $optional
     * @return self
     */
    public function __construct($path = null, $id = null, $ver = null, $optional = null)
    {
        parent::__construct($optional);
        if(null !== $path)
        {
            $this->setProperty('path', trim($path));
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $ver)
        {
            $this->setProperty('ver', (int) $ver);
        }
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
     * Gets version
     *
     * @return bool
     */
    public function getVersion()
    {
        return $this->getProperty('ver');
    }

    /**
     * Sets version
     *
     * @param  bool $ver
     * @return self
     */
    public function setVersion($ver)
    {
        return $this->setProperty('ver', (int) $ver);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'doc')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'doc')
    {
        return parent::toXml($name);
    }
}
