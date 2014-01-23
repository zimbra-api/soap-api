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
 * ExportAndDeleteItemSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExportAndDeleteItemSpec extends Base
{
    /**
     * Constructor method for ExportAndDeleteItemSpec
     * @param  int $id ID
     * @param  int $version Version
     * @return self
     */
    public function __construct($id, $version)
    {
        parent::__construct();
        $this->property('id', (int) $id);
        $this->property('version', (int) $version);
    }

    /**
     * Gets or sets id
     *
     * @param  int $id
     * @return int|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', (int) $id);
    }

    /**
     * Gets or sets version
     *
     * @param  int $version
     * @return int|self
     */
    public function version($version = null)
    {
        if(null === $version)
        {
            return $this->property('version');
        }
        return $this->property('version', (int) $version);
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
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'item')
    {
        return parent::toXml($name);
    }
}
