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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class GetFolderSpec extends Base
{
    /**
     * Constructor method for GetFolderSpec
     * @param string $uuid Base folder UUID
     * @param string $l Base folder ID
     * @param string $path Fully qualified path
     * @return self
     */
    public function __construct(
        $uuid = null,
        $l = null,
        $path = null
    )
    {
        parent::__construct();
        if(null !== $uuid)
        {
            $this->property('uuid', trim($uuid));
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $path)
        {
            $this->property('path', trim($path));
        }
    }

    /**
     * Gets or sets uuid
     *
     * @param  string $uuid
     * @return string|self
     */
    public function uuid($uuid = null)
    {
        if(null === $uuid)
        {
            return $this->property('uuid');
        }
        return $this->property('uuid', trim($uuid));
    }

    /**
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
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
