<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AccountACEInfo;
use Zimbra\Utils\TypedSequence;

/**
 * RevokePermission request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RevokePermission extends Request
{
    /**
     * Specify Access Control Entries (ACEs)
     * @var TypedSequence<AccountACEInfo>
     */
    private $_ace;

    /**
     * Constructor method for RevokePermission
     * @param  array $ace;
     * @return self
     */
    public function __construct(array $ace = array())
    {
        parent::__construct();
        $this->_ace = new TypedSequence('Zimbra\Soap\Struct\AccountACEInfo', $ace);
    }

    /**
     * Add an ace
     *
     * @param  AccountACEInfo $xprop
     * @return self
     */
    public function addAce(AccountACEInfo $ace)
    {
        $this->_ace->add($ace);
        return $this;
    }

    /**
     * Gets ace sequence
     *
     * @return Sequence
     */
    public function ace()
    {
        return $this->_ace;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_ace))
        {
            $this->array['ace'] = array();
            foreach ($this->_ace as $ace)
            {
                $aceArr = $ace->toArray('ace');
                $this->array['ace'][] = $aceArr['ace'];
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
        foreach ($this->_ace as $ace)
        {
            $this->xml->append($ace->toXml('ace'));
        }
        return parent::toXml();
    }
}
