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
    private $_props;

    /**
     * Constructor method for ModifyProperties
     * @param array $props Specify the properties to be modified
     * @return self
     */
    public function __construct(array $props = [])
    {
        parent::__construct();
        $this->setProps($props);

        $this->on('before', function(Base $sender)
        {
            if($sender->getProps()->count())
            {
                $sender->setChild('prop', $sender->getProps()->all());
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
        $this->_props->add($prop);
        return $this;
    }

    /**
     * Sets property sequence
     *
     * @param array $props
     * @return Sequence
     */
    public function setProps(array $props)
    {
        $this->_props = new TypedSequence('Zimbra\Account\Struct\Prop', $props);
        return $this;
    }

    /**
     * Gets property sequence
     *
     * @return Sequence
     */
    public function getProps()
    {
        return $this->_props;
    }
}
