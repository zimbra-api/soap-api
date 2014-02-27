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

use PhpCollection\Sequence;
use Zimbra\Enum\MdsConnectionType;
use Zimbra\Struct\Base;

/**
 * MailDataSource struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailDataSource extends Base
{
    /**
     * Properties for the data source
     * @var array
     */
    private $_a;

    /**
     * Constructor method for MailDataSource
     * @param string $id Unique ID for data source
     * @param string $name Name for data source
     * @param string $l Folder ID for data source
     * @param bool $isEnabled Flag whether or not the data source is enabled
     * @param bool $importOnly Indicates that this datasource is used for one way (incoming) import versus two-way sync
     * @param string $host Name of server
     * @param int $port Port number of server
     * @param MdsConnectionType $connectionType Which security layer to use for connection (cleartext, ssl, tls, or tls if available).
     * @param string $username Login string on {data-source-server}, for example a user name
     * @param string $password Login password for data source
     * @param string $pollingInterval Polling interval. For instance "10m"
     * @param string $emailAddress Email address for the data-source
     * @param bool $useAddressForForwardReply When forwarding or replying to messages sent to this data source,  flags whether or not to use the email address of the data source for the from address and the designated signature/replyTo of the data source for the outgoing message.
     * @param string $defaultSignature ID for default signature
     * @param string $forwardReplySignature Forward / Reply Signature ID for data source
     * @param string $fromDisplay Personal part of email address to put in the from header
     * @param string $replyToAddress Email address to put in the reply-to header
     * @param string $replyToDisplay Personal part of Email address to put in the reply-to header
     * @param string $importClass Data import class used bt this data source
     * @param string $failingSince Failing Since
     * @param int $lastError Last Error
     * @param array $a Properties for the data source
     * @return self
     */
    public function __construct(
        $id = null,
        $name = null,
        $l = null,
        $isEnabled = null,
        $importOnly = null,
        $host = null,
        $port = null,
        MdsConnectionType $connectionType = null,
        $username = null,
        $password = null,
        $pollingInterval = null,
        $emailAddress = null,
        $useAddressForForwardReply = null,
        $defaultSignature = null,
        $forwardReplySignature = null,
        $fromDisplay = null,
        $replyToAddress = null,
        $replyToDisplay = null,
        $importClass = null,
        $failingSince = null,
        $lastError = null,
        array $a = array()
    )
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $isEnabled)
        {
            $this->property('isEnabled', (bool) $isEnabled);
        }
        if(null !== $importOnly)
        {
            $this->property('importOnly', (bool) $importOnly);
        }
        if(null !== $host)
        {
            $this->property('host', trim($host));
        }
        if(null !== $port)
        {
            $this->property('port', (int) $port);
        }
        if($connectionType instanceof MdsConnectionType)
        {
            $this->property('connectionType', $connectionType);
        }
        if(null !== $username)
        {
            $this->property('username', trim($username));
        }
        if(null !== $password)
        {
            $this->property('password', trim($password));
        }
        if(null !== $pollingInterval)
        {
            $this->property('pollingInterval', trim($pollingInterval));
        }
        if(null !== $emailAddress)
        {
            $this->property('emailAddress', trim($emailAddress));
        }
        if(null !== $useAddressForForwardReply)
        {
            $this->property('useAddressForForwardReply', (bool) $useAddressForForwardReply);
        }
        if(null !== $defaultSignature)
        {
            $this->property('defaultSignature', trim($defaultSignature));
        }
        if(null !== $forwardReplySignature)
        {
            $this->property('forwardReplySignature', trim($forwardReplySignature));
        }
        if(null !== $fromDisplay)
        {
            $this->property('fromDisplay', trim($fromDisplay));
        }
        if(null !== $replyToAddress)
        {
            $this->property('replyToAddress', trim($replyToAddress));
        }
        if(null !== $replyToDisplay)
        {
            $this->property('replyToDisplay', trim($replyToDisplay));
        }
        if(null !== $importClass)
        {
            $this->property('importClass', trim($importClass));
        }
        if(null !== $failingSince)
        {
            $this->property('failingSince', (int) $failingSince);
        }
        if(null !== $lastError)
        {
            $this->child('lastError', trim($lastError));
        }
        $this->_a = new Sequence();
        foreach($a as $value)
        {
            $value = trim($value);
            if(!$this->_a->contains($value))
            {
                $this->_a->add($value);
            }
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->a()->count())
            {
                $sender->child('a', $sender->a()->all());
            }
        });
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
    }

    /**
     * Gets or sets isEnabled
     *
     * @param  bool $isEnabled
     * @return bool|self
     */
    public function isEnabled($isEnabled = null)
    {
        if(null === $isEnabled)
        {
            return $this->property('isEnabled');
        }
        return $this->property('isEnabled', (bool) $isEnabled);
    }

    /**
     * Gets or sets importOnly
     *
     * @param  bool $importOnly
     * @return bool|self
     */
    public function importOnly($importOnly = null)
    {
        if(null === $importOnly)
        {
            return $this->property('importOnly');
        }
        return $this->property('importOnly', (bool) $importOnly);
    }

    /**
     * Gets or sets host
     *
     * @param  string $host
     * @return string|self
     */
    public function host($host = null)
    {
        if(null === $host)
        {
            return $this->property('host');
        }
        return $this->property('host', trim($host));
    }

    /**
     * Gets or sets port
     *
     * @param  int $port
     * @return int|self
     */
    public function port($port = null)
    {
        if(null === $port)
        {
            return $this->property('port');
        }
        return $this->property('port', (int) $port);
    }

    /**
     * Gets or sets connectionType
     *
     * @param  MdsConnectionType $connectionType
     * @return MdsConnectionType|self
     */
    public function connectionType(MdsConnectionType $connectionType = null)
    {
        if(null === $connectionType)
        {
            return $this->property('connectionType');
        }
        return $this->property('connectionType', $connectionType);
    }

    /**
     * Gets or sets username
     *
     * @param  string $username
     * @return string|self
     */
    public function username($username = null)
    {
        if(null === $username)
        {
            return $this->property('username');
        }
        return $this->property('username', trim($username));
    }

    /**
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->property('password');
        }
        return $this->property('password', trim($password));
    }

    /**
     * Gets or sets pollingInterval
     *
     * @param  string $pollingInterval
     * @return string|self
     */
    public function pollingInterval($pollingInterval = null)
    {
        if(null === $pollingInterval)
        {
            return $this->property('pollingInterval');
        }
        return $this->property('pollingInterval', trim($pollingInterval));
    }

    /**
     * Gets or sets emailAddress
     *
     * @param  string $emailAddress
     * @return string|self
     */
    public function emailAddress($emailAddress = null)
    {
        if(null === $emailAddress)
        {
            return $this->property('emailAddress');
        }
        return $this->property('emailAddress', trim($emailAddress));
    }

    /**
     * Gets or sets useAddressForForwardReply
     *
     * @param  bool $useAddressForForwardReply
     * @return bool|self
     */
    public function useAddressForForwardReply($useAddressForForwardReply = null)
    {
        if(null === $useAddressForForwardReply)
        {
            return $this->property('useAddressForForwardReply');
        }
        return $this->property('useAddressForForwardReply', (bool) $useAddressForForwardReply);
    }

    /**
     * Gets or sets defaultSignature
     *
     * @param  string $defaultSignature
     * @return string|self
     */
    public function defaultSignature($defaultSignature = null)
    {
        if(null === $defaultSignature)
        {
            return $this->property('defaultSignature');
        }
        return $this->property('defaultSignature', trim($defaultSignature));
    }

    /**
     * Gets or sets forwardReplySignature
     *
     * @param  string $forwardReplySignature
     * @return string|self
     */
    public function forwardReplySignature($forwardReplySignature = null)
    {
        if(null === $forwardReplySignature)
        {
            return $this->property('forwardReplySignature');
        }
        return $this->property('forwardReplySignature', trim($forwardReplySignature));
    }

    /**
     * Gets or sets fromDisplay
     *
     * @param  string $fromDisplay
     * @return string|self
     */
    public function fromDisplay($fromDisplay = null)
    {
        if(null === $fromDisplay)
        {
            return $this->property('fromDisplay');
        }
        return $this->property('fromDisplay', trim($fromDisplay));
    }

    /**
     * Gets or sets replyToAddress
     *
     * @param  string $replyToAddress
     * @return string|self
     */
    public function replyToAddress($replyToAddress = null)
    {
        if(null === $replyToAddress)
        {
            return $this->property('replyToAddress');
        }
        return $this->property('replyToAddress', trim($replyToAddress));
    }

    /**
     * Gets or sets replyToDisplay
     *
     * @param  string $replyToDisplay
     * @return string|self
     */
    public function replyToDisplay($replyToDisplay = null)
    {
        if(null === $replyToDisplay)
        {
            return $this->property('replyToDisplay');
        }
        return $this->property('replyToDisplay', trim($replyToDisplay));
    }

    /**
     * Gets or sets importClass
     *
     * @param  string $importClass
     * @return string|self
     */
    public function importClass($importClass = null)
    {
        if(null === $importClass)
        {
            return $this->property('importClass');
        }
        return $this->property('importClass', trim($importClass));
    }

    /**
     * Gets or sets failingSince
     *
     * @param  int $failingSince
     * @return int|self
     */
    public function failingSince($failingSince = null)
    {
        if(null === $failingSince)
        {
            return $this->property('failingSince');
        }
        return $this->property('failingSince', (int) $failingSince);
    }

    /**
     * Gets or sets lastError
     *
     * @param  string $lastError
     * @return string|self
     */
    public function lastError($lastError = null)
    {
        if(null === $lastError)
        {
            return $this->child('lastError');
        }
        return $this->child('lastError', trim($lastError));
    }

    /**
     * Add a property
     *
     * @param  string $a
     * @return self
     */
    public function addA($a)
    {
        $this->_a->add(trim($a));
        return $this;
    }

    /**
     * Gets property sequence
     *
     * @return Sequence
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
    public function toArray($name = 'mail')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mail')
    {
        return parent::toXml($name);
    }
}
