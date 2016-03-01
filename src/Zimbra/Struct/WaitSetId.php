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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Id;

/**
 * WaitSetRemove struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class WaitSetId extends Base
{
    /**
     * Attributes
     * @var TypedSequence<Id>
     */
    private $_ids;

    /**
     * Constructor method for WaitSetRemove
     * @param array $ids
     * @return self
     */
    public function __construct(array $ids = [])
    {
        parent::__construct();
        $this->setIds($ids);

        $this->on('before', function(Base $sender)
        {
            if($sender->getIds()->count())
            {
                $sender->setChild('a', $sender->getIds()->all());
            }
        });
    }

    /**
     * Add WaitSet id
     *
     * @param  Id $a
     * @return self
     */
    public function addId(Id $a)
    {
        $this->_ids->add($a);
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
        $this->_ids = new TypedSequence('Zimbra\Struct\Id', $ids);
        return $this;
    }

    /**
     * Gets Id sequence
     *
     * @return TypedSequence<Id>
     */
    public function getIds()
    {
        return $this->_ids;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'remove')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'remove')
    {
        return parent::toXml($name);
    }
}
