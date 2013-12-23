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
use Zimbra\Soap\Struct\CheckRightsTargetSpec as Target;
use Zimbra\Utils\TypedSequence;

/**
 * CheckRights class
 * Check if the authed user has the specified right(s) on a target.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckRights extends Request
{
    /**
     * The targets
     * @var TypedSequence
     */
    private $_target = array();

    /**
     * Constructor method for checkRightsRequest
     * @param array $targets
     * @return self
     */
    public function __construct(array $targets)
    {
        parent::__construct();
        $this->_target = new TypedSequence('Zimbra\Soap\Struct\CheckRightsTargetSpec', $targets);
        if(count($this->_target) === 0)
        {
            throw new \InvalidArgumentException('CheckRights must have at least one target');
        }
    }

    /**
     * Add a target
     *
     * @param  CheckRightsTargetSpec $target
     * @return self
     */
    public function addTarget(Target $target)
    {
        $this->_target->add($target);
        return $this;
    }

    /**
     * Gets target sequence
     *
     * @return Sequence
     */
    public function target()
    {
        return $this->_target;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array();
        if(count($this->_target))
        {
            $this->array['target'] = array();
            foreach ($this->_target as $target)
            {
                $targetArr = $target->toArray();
                $this->array['target'][] = $targetArr['target'];
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
        foreach ($this->_target as $target)
        {
            $this->xml->append($target->toXml('target'));
        }
        return parent::toXml();
    }
}
