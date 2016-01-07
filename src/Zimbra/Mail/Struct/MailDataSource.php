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
    private $_attrs;

    /**
     * Constructor method for MailDataSource
     * @param string $id Unique ID for data source
     * @param string $name Name for data source
     * @param string $folder Folder ID for data source
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
     * @param array $attributes Properties for the data source
     * @return self
     */
    public function __construct(
        $id = null,
        $name = null,
        $folder = null,
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
        array $attrs = []
    )
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $folder)
        {
            $this->setProperty('l', trim($folder));
        }
        if(null !== $isEnabled)
        {
            $this->setProperty('isEnabled', (bool) $isEnabled);
        }
        if(null !== $importOnly)
        {
            $this->setProperty('importOnly', (bool) $importOnly);
        }
        if(null !== $host)
        {
            $this->setProperty('host', trim($host));
        }
        if(null !== $port)
        {
            $this->setProperty('port', (int) $port);
        }
        if($connectionType instanceof MdsConnectionType)
        {
            $this->setProperty('connectionType', $connectionType);
        }
        if(null !== $username)
        {
            $this->setProperty('username', trim($username));
        }
        if(null !== $password)
        {
            $this->setProperty('password', trim($password));
        }
        if(null !== $pollingInterval)
        {
            $this->setProperty('pollingInterval', trim($pollingInterval));
        }
        if(null !== $emailAddress)
        {
            $this->setProperty('emailAddress', trim($emailAddress));
        }
        if(null !== $useAddressForForwardReply)
        {
            $this->setProperty('useAddressForForwardReply', (bool) $useAddressForForwardReply);
        }
        if(null !== $defaultSignature)
        {
            $this->setProperty('defaultSignature', trim($defaultSignature));
        }
        if(null !== $forwardReplySignature)
        {
            $this->setProperty('forwardReplySignature', trim($forwardReplySignature));
        }
        if(null !== $fromDisplay)
        {
            $this->setProperty('fromDisplay', trim($fromDisplay));
        }
        if(null !== $replyToAddress)
        {
            $this->setProperty('replyToAddress', trim($replyToAddress));
        }
        if(null !== $replyToDisplay)
        {
            $this->setProperty('replyToDisplay', trim($replyToDisplay));
        }
        if(null !== $importClass)
        {
            $this->setProperty('importClass', trim($importClass));
        }
        if(null !== $failingSince)
        {
            $this->setProperty('failingSince', (int) $failingSince);
        }
        if(null !== $lastError)
        {
            $this->setChild('lastError', trim($lastError));
        }

        $this->setAttributes($attrs);
        $this->on('before', function(Base $sender)
        {
            if($sender->getAttributes()->count())
            {
                $sender->setChild('a', $sender->getAttributes()->all());
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets folder Id
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder Id
     *
     * @param  string $l
     * @return self
     */
    public function setFolderId($l)
    {
        return $this->setProperty('l', trim($l));
    }

    /**
     * Gets is enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->getProperty('isEnabled');
    }

    /**
     * Sets is enabled
     *
     * @param  bool $isEnabled
     * @return self
     */
    public function setEnabled($isEnabled)
    {
        return $this->setProperty('isEnabled', (bool) $isEnabled);
    }

    /**
     * Gets import only
     *
     * @return bool
     */
    public function getImportOnly()
    {
        return $this->getProperty('importOnly');
    }

    /**
     * Sets import only
     *
     * @param  bool $importOnly
     * @return self
     */
    public function setImportOnly($importOnly)
    {
        return $this->setProperty('importOnly', (bool) $importOnly);
    }

    /**
     * Gets host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->getProperty('host');
    }

    /**
     * Sets host
     *
     * @param  string $host
     * @return self
     */
    public function setHost($host)
    {
        return $this->setProperty('host', trim($host));
    }

    /**
     * Gets port
     *
     * @return int
     */
    public function getPort()
    {
        return $this->getProperty('port');
    }

    /**
     * Sets port
     *
     * @param  int $port
     * @return self
     */
    public function setPort($port)
    {
        return $this->setProperty('port', (int) $port);
    }

    /**
     * Gets connection type
     *
     * @return MdsConnectionType
     */
    public function getMdsConnectionType()
    {
        return $this->getProperty('connectionType');
    }

    /**
     * Sets connection type
     *
     * @param  MdsConnectionType $connectionType
     * @return self
     */
    public function setMdsConnectionType(MdsConnectionType $connectionType)
    {
        return $this->setProperty('connectionType', $connectionType);
    }

    /**
     * Gets username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getProperty('username');
    }

    /**
     * Sets username
     *
     * @param  string $username
     * @return self
     */
    public function setUsername($username)
    {
        return $this->setProperty('username', trim($username));
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getProperty('password');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setProperty('password', trim($password));
    }

    /**
     * Gets polling interval
     *
     * @return string
     */
    public function getPollingInterval()
    {
        return $this->getProperty('pollingInterval');
    }

    /**
     * Sets polling interval
     *
     * @param  string $pollingInterval
     * @return self
     */
    public function setPollingInterval($pollingInterval)
    {
        return $this->setProperty('pollingInterval', trim($pollingInterval));
    }

    /**
     * Gets email address
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->getProperty('emailAddress');
    }

    /**
     * Sets email address
     *
     * @param  string $emailAddress
     * @return self
     */
    public function setEmailAddress($emailAddress)
    {
        return $this->setProperty('emailAddress', trim($emailAddress));
    }

    /**
     * Gets use address for forward reply
     *
     * @return bool
     */
    public function getUseAddressForForwardReply()
    {
        return $this->getProperty('useAddressForForwardReply');
    }

    /**
     * Sets use address for forward reply
     *
     * @param  bool $useAddressForForwardReply
     * @return self
     */
    public function setUseAddressForForwardReply($useAddressForForwardReply)
    {
        return $this->setProperty('useAddressForForwardReply', (bool) $useAddressForForwardReply);
    }

    /**
     * Gets ID for default signature
     *
     * @return string
     */
    public function getDefaultSignature()
    {
        return $this->getProperty('defaultSignature');
    }

    /**
     * Sets ID for default signature
     *
     * @param  string $defaultSignature
     * @return self
     */
    public function setDefaultSignature($defaultSignature)
    {
        return $this->setProperty('defaultSignature', trim($defaultSignature));
    }

    /**
     * Gets Forward / Reply Signature ID
     *
     * @return string
     */
    public function getForwardReplySignature()
    {
        return $this->getProperty('forwardReplySignature');
    }

    /**
     * Sets Forward / Reply Signature ID
     *
     * @param  string $forwardReplySignature
     * @return self
     */
    public function setForwardReplySignature($forwardReplySignature)
    {
        return $this->setProperty('forwardReplySignature', trim($forwardReplySignature));
    }

    /**
     * Gets personal part of email address to put in the from header
     *
     * @return string
     */
    public function getFromDisplay()
    {
        return $this->getProperty('fromDisplay');
    }

    /**
     * Sets personal part of email address to put in the from header
     *
     * @param  string $fromDisplay
     * @return self
     */
    public function setFromDisplay($fromDisplay)
    {
        return $this->setProperty('fromDisplay', trim($fromDisplay));
    }

    /**
     * Gets email address to put in the reply-to header
     *
     * @return string
     */
    public function getReplyToAddress()
    {
        return $this->getProperty('replyToAddress');
    }

    /**
     * Sets email address to put in the reply-to header
     *
     * @param  string $replyToAddress
     * @return self
     */
    public function setReplyToAddress($replyToAddress)
    {
        return $this->setProperty('replyToAddress', trim($replyToAddress));
    }

    /**
     * Gets personal part of Email address to put in the reply-to header
     *
     * @return string
     */
    public function getReplyToDisplay()
    {
        return $this->getProperty('replyToDisplay');
    }

    /**
     * Sets personal part of Email address to put in the reply-to header
     *
     * @param  string $replyToDisplay
     * @return self
     */
    public function setReplyToDisplay($replyToDisplay)
    {
        return $this->setProperty('replyToDisplay', trim($replyToDisplay));
    }

    /**
     * Gets data import class used bt this data source
     *
     * @return string
     */
    public function getImportClass()
    {
        return $this->getProperty('importClass');
    }

    /**
     * Sets data import class used bt this data source
     *
     * @param  string $importClass
     * @return self
     */
    public function setImportClass($importClass)
    {
        return $this->setProperty('importClass', trim($importClass));
    }

    /**
     * Gets failing since
     *
     * @return int
     */
    public function getFailingSince()
    {
        return $this->getProperty('failingSince');
    }

    /**
     * Sets failing since
     *
     * @param  int $failingSince
     * @return self
     */
    public function setFailingSince($failingSince)
    {
        return $this->setProperty('failingSince', (int) $failingSince);
    }

    /**
     * Gets last error
     *
     * @return string
     */
    public function getLastError()
    {
        return $this->getChild('lastError');
    }

    /**
     * Sets last error
     *
     * @param  string $lastError
     * @return self
     */
    public function setLastError($lastError)
    {
        return $this->setChild('lastError', trim($lastError));
    }

    /**
     * Add a setProperty
     *
     * @param  string $attr
     * @return self
     */
    public function addAttribute($attr)
    {
        $this->_attrs->add(trim($attr));
        return $this;
    }

    /**
     * Sets property sequence
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttributes(array $attrs)
    {
        $this->_attrs = new Sequence();
        foreach($attrs as $value)
        {
            $value = trim($value);
            if(!$this->_attrs->contains($value))
            {
                $this->_attrs->add($value);
            }
        }
        return $this;
    }

    /**
     * Gets property sequence
     *
     * @return Sequence
     */
    public function getAttributes()
    {
        return $this->_attrs;
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
