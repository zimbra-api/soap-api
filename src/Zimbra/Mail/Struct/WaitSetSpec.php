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

/**
 * WaitSetSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class WaitSetSpec extends Base
{
    /**
     * Attributes
     * @var TypedSequence<WaitSetAddSpec>
     */
    private $_a;

    /**
     * Constructor method for WaitSetAdd
     * @param array $a
     * @return self
     */
    public function __construct(array $a = array())
    {
        parent::__construct();
        $this->_a = new TypedSequence('Zimbra\Mail\Struct\WaitSetAddSpec', $a);

        $this->addHook(function($sender)
        {
            $sender->child('a', $sender->a()->all());
        });
    }

    /**
     * Add WaitSet
     *
     * @param  WaitSetAddSpec $a
     * @return self
     */
    public function addWaitSet(WaitSetAddSpec $a)
    {
        $this->_a->add($a);
        return $this;
    }

    /**
     * Get WaitSet sequence
     *
     * @return TypedSequence<WaitSetAddSpec>
     */
    public function a()
    {
        return $this->_a;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'add')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'add')
    {
        return parent::toXml($name);
    }
}
