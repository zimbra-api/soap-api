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
            $this->property('path', trim($path));
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $ver)
        {
            $this->property('ver', (int) $ver);
        }
    }

    /**
     * Gets or sets path
     *
     * @param  string $path
     * @return string|self
     */
    public function path($path = null)
    {
        if(null === $path)
        {
            return $this->property('path');
        }
        return $this->property('path', trim($path));
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets ver
     *
     * @param  int $ver
     * @return int|self
     */
    public function ver($ver = null)
    {
        if(null === $ver)
        {
            return $this->property('ver');
        }
        return $this->property('ver', (int) $ver);
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
