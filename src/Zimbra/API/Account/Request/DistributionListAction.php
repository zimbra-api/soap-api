<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\DistributionListSelector as DistList;
use Zimbra\Soap\Struct\DistributionListAction as Action;
use Zimbra\Soap\Struct\Attr;
use Zimbra\Utils\TypedSequence;

/**
 * DistributionListAction class
 * Perform an action on a Distribution List 
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListAction extends Request
{
    /**
     * Identifies the distribution list to act upon
     * @var DistList
     */
    private $_dl;

    /**
     * Specifies the action to perform
     * @var Action
     */
    private $_action;

    /**
     * Attributes
     * @var TypedSequence
     */
    private $_attr;

    /**
     * Constructor method for DistributionListAction
     * @param  DistList $dl
     * @param  Action $action
     * @param  array $attrs
     * @return self
     */
    public function __construct(DistList $dl, Action $action, array $attrs = array())
    {
        parent::__construct();
        $this->_dl = $dl;
        $this->_action = $action;
        $this->_attr = new TypedSequence('Zimbra\Soap\Struct\Attr', $attrs);
    }

    /**
     * Gets or sets dl
     *
     * @param  DistList $dl
     * @return DistList|self
     */
    public function dl(DistList $dl = null)
    {
        if(null === $dl)
        {
            return $this->_dl;
        }
        $this->_dl = $dl;
        return $this;
    }

    /**
     * Gets or sets action
     *
     * @param  Action $action
     * @return Action|self
     */
    public function action(Action $action = null)
    {
        if(null === $action)
        {
            return $this->_action;
        }
        $this->_action = $action;
        return $this;
    }

    /**
     * Add an attribute
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->_attr->add($attr);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return Sequence
     */
    public function attr()
    {
        return $this->_attr;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_dl instanceof DistList)
        {
            $this->array += $this->_dl->toArray();
        }
        if($this->_action instanceof Action)
        {
            $this->array += $this->_action->toArray();
        }
        if(count($this->_attr))
        {
            $this->array['a'] = array();
            foreach ($this->_attr as $attr)
            {
                $attrArr = $attr->toArray('a');
                $this->array['a'][] = $attrArr['a'];
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_dl instanceof DistList)
        {
            $this->xml->append($this->_dl->toXml());
        }
        if($this->_action instanceof Action)
        {
            $this->xml->append($this->_action->toXml());
        }
        foreach ($this->_attr as $attr)
        {
            $this->xml->append($attr->toXml('a'));
        }
        return parent::toXml();
    }
}
