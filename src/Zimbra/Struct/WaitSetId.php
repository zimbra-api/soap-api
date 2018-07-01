<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Struct\Id;

/**
 * WaitSetRemove struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="remove")
 */
class WaitSetId
{
    /**
     * @Accessor(getter="getIds", setter="setIds")
     * @Type("array<Zimbra\Struct\Id>")
     * @XmlList(inline = true, entry = "a")
     */
    private $_ids;

    /**
     * Constructor method for WaitSetRemove
     * @param array $ids
     * @return self
     */
    public function __construct(array $ids = [])
    {
        $this->setIds($ids);
    }

    /**
     * Add WaitSet id
     *
     * @param  Id $a
     * @return self
     */
    public function addId(Id $a)
    {
        $this->_ids[] = $a;
        return $this;
    }

    /**
     * Sets Id sequence
     *
     * @param array $ids
     * @return self
     */
    public function setIds(array $ids)
    {
        $this->_ids = [];
        foreach ($ids as $id) {
            if ($id instanceof Id) {
                $this->_ids[] = $id;
            }
        }
        return $this;
    }

    /**
     * Gets Id sequence
     *
     * @return array<Id>
     */
    public function getIds()
    {
        return $this->_ids;
    }
}
