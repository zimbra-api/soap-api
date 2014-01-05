<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\RankingActionOp;
use Zimbra\Utils\SimpleXML;

/**
 * RankingActionSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RankingActionSpec
{
    /**
     * Action to perform - reset|delete.
     * reset: resets the contact ranking table for the account
     * delete: delete the ranking information for the email address
     * @var RankingActionOp
     */
    private $_op;

    /**
     * Email address. Required if action is "delete"
     * @var string
     */
    private $_email;

    /**
     * Constructor method for RankingActionSpec
     * @param RankingActionOp $op
     * @param string $email
     * @return self
     */
    public function __construct(
        RankingActionOp $op,
        $email = null
    )
    {
        $this->_op = $op;
        $this->_email = trim($email);
    }

    /**
     * Gets or sets op
     *
     * @param  RankingActionOp $op
     * @return RankingActionOp|self
     */
    public function op(RankingActionOp $op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        $this->_op = $op;
        return $this;
    }

    /**
     * Gets or sets email
     *
     * @param  string $email
     * @return string|self
     */
    public function email($email = null)
    {
        if(null === $email)
        {
            return $this->_email;
        }
        $this->_email = trim($email);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $arr = array(
            'op' => (string) $this->_op,
        );
        if(!empty($this->_email))
        {
            $arr['email'] = $this->_email;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('op', (string) $this->_op);
        if(!empty($this->_email))
        {
            $xml->addAttribute('email', $this->_email);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
