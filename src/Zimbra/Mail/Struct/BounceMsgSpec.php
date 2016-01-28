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
 * BounceMsgSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class BounceMsgSpec extends Base
{
    /**
     * Email addresses
     * @var TypedSequence<EmailAddrInfo>
     */
    protected $_emailAddresses;

    /**
     * Constructor method for BounceMsgSpec
     * @param  string $id ID of message to resend
     * @param  array  $addresses Email addresses
     * @return self
     */
    public function __construct($id, array $addresses = [])
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->_emailAddresses = new TypedSequence('Zimbra\Mail\Struct\EmailAddrInfo', $addresses);

        $this->on('before', function(Base $sender)
        {
            if($sender->getEmailAddresses()->count())
            {
                $sender->setChild('e', $sender->getEmailAddresses()->all());
            }
        });
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Add an email address
     *
     * @param  EmailAddrInfo $e
     * @return self
     */
    public function addEmailAddresses(EmailAddrInfo $e)
    {
        $this->_emailAddresses->add($e);
        return $this;
    }

    /**
     * Sets email address sequence
     *
     * @param  array $addresses
     * @return self
     */
    public function setEmailAddresses(array $addresses)
    {
        $this->_emailAddresses = new TypedSequence('Zimbra\Mail\Struct\EmailAddrInfo', $addresses);
        return $this;
    }

    /**
     * Gets email address sequence
     *
     * @return Sequence
     */
    public function getEmailAddresses()
    {
        return $this->_emailAddresses;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        return parent::toXml($name);
    }
}
