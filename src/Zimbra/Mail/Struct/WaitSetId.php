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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;
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
    private $_a;

    /**
     * Constructor method for WaitSetRemove
     * @param array $a
     * @return self
     */
    public function __construct(array $a = array())
    {
        parent::__construct();
        $this->_a = new TypedSequence('Zimbra\Struct\Id', $a);

        $this->addHook(function($sender)
        {
            $sender->child('a', $sender->a()->all());
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
        $this->_a->add($a);
        return $this;
    }

    /**
     * Get WaitSet sequence
     *
     * @return TypedSequence<Id>
     */
    public function a()
    {
        return $this->_a;
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
