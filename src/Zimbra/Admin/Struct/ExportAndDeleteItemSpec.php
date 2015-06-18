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
        $this->setProperty('id', (int) $id);
        $this->setProperty('version', (int) $version);
    }

    /**
     * Gets ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets ID
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', (int) $id);
    }

    /**
     * Gets version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->getProperty('version');
    }

    /**
     * Sets version
     *
     * @param  int $version
     * @return self
     */
    public function setVersion($version)
    {
        return $this->setProperty('version', (int) $version);
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
