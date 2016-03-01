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
 * DiffDocumentVersionSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DiffDocumentVersionSpec extends Base
{
    /**
     * Constructor method for AccountACEInfo
     * @param string $id ID.
     * @param int $v1 Revision 1.
     * @param int $v2 Revision 2.
     * @return self
     */
    public function __construct(
        $id = null,
        $v1 = null,
        $v2 = null
    )
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $v1)
        {
            $this->setProperty('v1', (int) $v1);
        }
        if(null !== $v2)
        {
            $this->setProperty('v2', (int) $v2);
        }
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets version1
     *
     * @return int
     */
    public function getVersion1()
    {
        return $this->getProperty('v1');
    }

    /**
     * Sets version1
     *
     * @param  int $v1
     * @return self
     */
    public function setVersion1($v1)
    {
        return $this->setProperty('v1', (int) $v1);
    }

    /**
     * Gets version2
     *
     * @return int
     */
    public function getVersion2()
    {
        return $this->getProperty('v2');
    }

    /**
     * Sets version2
     *
     * @param  int $v2
     * @return self
     */
    public function setVersion2($v2)
    {
        return $this->setProperty('v2', (int) $v2);
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
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'doc')
    {
        return parent::toXml($name);
    }
}
