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
        $this->property('id', trim($id));
        if(null !== $types)
        {
            $arrType = array();
            $types = explode(',', trim($types));
            foreach ($types as $type)
            {
                $type = trim($type);
                if(ReindexType::has($type) && !in_array($type, $arrType))
                {
                    $arrType[] = trim($type);
                }
            }
            $this->property('types', implode(',', $arrType));
        }
        if(null !== $ids)
        {
            $this->property('ids', trim($ids));
        }
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
     * Gets or sets types
     *
     * @param  string $types
     * @return string|self
     */
    public function types($types = null)
    {
        if(null === $types)
        {
            return $this->property('types');
        }
        $arrType = array();
        $types = explode(',', trim($types));
        foreach ($types as $type)
        {
            $type = trim($type);
            if(ReindexType::has($type) && !in_array($type, $arrType))
            {
                $arrType[] = trim($type);
            }
        }
        return $this->property('types', implode(',', $arrType));
    }

    /**
     * Gets or sets ids
     *
     * @param  string $ids
     * @return string|self
     */
    public function ids($ids = null)
    {
        if(null === $ids)
        {
            return $this->property('ids');
        }
        return $this->property('ids', trim($ids));
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
