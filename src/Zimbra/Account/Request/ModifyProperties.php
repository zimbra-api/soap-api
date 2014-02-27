<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\Prop;
use Zimbra\Common\TypedSequence;

/**
 * ModifyProperties request class
 * Modify properties related to zimlets
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyProperties extends Base
{
    /**
     * Specify the properties to be modified
     * @var TypedSequence<Prop>
     */
    private $_prop;

    /**
     * Constructor method for ModifyProperties
     * @param array $prop Specify the properties to be modified
     * @return self
     */
    public function __construct(array $prop = array())
    {
        parent::__construct();
        $this->_prop = new TypedSequence('Zimbra\Account\Struct\Prop', $prop);

        $this->on('before', function(Base $sender)
        {
            if($sender->prop()->count())
            {
                $sender->child('prop', $sender->prop()->all());
            }
        });
    }

    /**
     * Add a prop
     *
     * @param  Pref $prop
     * @return self
     */
    public function addProp(Prop $prop)
    {
        $this->_prop->add($prop);
        return $this;
    }

    /**
     * Gets property sequence
     *
     * @return Sequence
     */
    public function prop()
    {
        return $this->_prop;
    }
}
