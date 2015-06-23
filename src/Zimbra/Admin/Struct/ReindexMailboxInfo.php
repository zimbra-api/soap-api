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

use Zimbra\Enum\ReindexType;
use Zimbra\Struct\Base;

/**
 * ReindexMailboxInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ReindexMailboxInfo extends Base
{
    /**
     * Constructor method for ReindexMailboxInfo
     * @param string $id Account ID
     * @param string $types Comma separated list of types. Legal values are: conversation|message|contact|appointment|task|note|wiki|document
     * @param string $ids Comma separated list of IDs to re-index
     * @return self
     */
    public function __construct($id, $types = null, $ids = null)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        if(null !== $types)
        {
            $this->setTypes($types);
        }
        if(null !== $ids)
        {
            $this->setProperty('ids', trim($ids));
        }
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets types
     *
     * @return string
     */
    public function getTypes()
    {
        return $this->getProperty('types');
    }

    /**
     * Sets types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes($types)
    {
        $arrType = [];
        $types = explode(',', trim($types));
        foreach ($types as $type)
        {
            $type = trim($type);
            if(ReindexType::has($type) && !in_array($type, $arrType))
            {
                $arrType[] = trim($type);
            }
        }
        return $this->setProperty('types', implode(',', $arrType));
    }

    /**
     * Sets the Standard Time component's timezone name
     *
     * @return string
     */
    public function getIds()
    {
        return $this->getProperty('ids');
    }

    /**
     * Sets the Standard Time component's timezone name
     *
     * @param  string $ids
     * @return self
     */
    public function setIds($ids)
    {
        return $this->setProperty('ids', trim($ids));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'mbox')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mbox')
    {
        return parent::toXml($name);
    }
}
