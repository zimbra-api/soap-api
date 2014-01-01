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

use Zimbra\Soap\Enum\MdsConnectionType;
use Zimbra\Utils\SimpleXML;

/**
 * MailDataSource struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailDataSource
{
    /**
     * Unique ID for data source
     * @var string
     */
    private $_id;

    /**
     * Name for data source
     * e.g. "My IMAP Account"
     * @var string
     */
    private $_name;

    /**
     * Folder ID for data sourc
     * @var string
     */
    private $_l;

    /**
     * Flag whether or not the data source is enabled
     * @var bool
     */
    private $_isEnabled;

    /**
     * Indicates that this datasource is used for one way (incoming) import versus two-way sync
     * @var bool
     */
    private $_importOnly;

    /**
     * Name of server
     * e.g. "imap.myisp.com"
     * @var string
     */
    private $_host;

    /**
     * Port number of server
     * e.g. "143"
     * @var int
     */
    private $_port;

    /**
     * Which security layer to use for connection (cleartext, ssl, tls, or tls if available).
     * If not set on data source, fallback to the value on global config.
     * @var MdsConnectionType
     */
    private $_connectionType;

    /**
     * Login string on {data-source-server}, for example a user name
     * @var string
     */
    private $_username;

    /**
     * Login password for data source
     * @var string
     */
    private $_password;

    /**
     * Polling interval. For instance "10m"
     * The time interval between automated data imports for a data source.
     * If unset or 0, the data source will not be scheduled for automated polling.
     * Must be in valid duration format:
     * {digits}{time-unit}. digits: 0-9, time-unit: [hmsd]|ms. h - hours, m - * minutes, s - seconds, d - days, ms - milliseconds.
     * If time unit is not specified, the default is s(seconds).
     * @var string
     */
    private $_pollingInterval;

    /**
     * Email address for the data-source
     * @var string
     */
    private $_emailAddress;

    /**
     * When forwarding or replying to messages sent to this data source,
     * this flags whether or not to use the email address of the data source for the from address
     * and the designated signature/replyTo of the data source for the outgoing message.
     * @var bool
     */
    private $_useAddressForForwardReply;

    /**
     * ID for default signature
     * @var string
     */
    private $_defaultSignature;

    /**
     * Forward / Reply Signature ID for data source
     * @var string
     */
    private $_forwardReplySignature;

    /**
     * Personal part of email address to put in the from header
     * @var string
     */
    private $_fromDisplay;

    /**
     * Email address to put in the reply-to header
     * @var string
     */
    private $_replyToAddress;

    /**
     * Personal part of Email address to put in the reply-to header
     * @var string
     */
    private $_replyToDisplay;

    /**
     * Data import class used bt this data source
     * @var string
     */
    private $_importClass;

    /**
     * Failing Since
     * @var int
     */
    private $_failingSince;

    /**
     * Last Error
     * @var string
     */
    private $_lastError;

    /**
     * Properties for the data source
     * @var array
     */
    private $_a;

    /**
     * Constructor method for MailDataSource
     * @param string $id
     * @param string $name
     * @param string $l
     * @param bool $isEnabled
     * @param bool $importOnly
     * @param string $host
     * @param int $port
     * @param MdsConnectionType $connectionType
     * @param string $username
     * @param string $password
     * @param string $pollingInterval
     * @param string $emailAddress
     * @param bool $useAddressForForwardReply
     * @param string $defaultSignature
     * @param string $forwardReplySignature
     * @param string $fromDisplay
     * @param string $replyToAddress
     * @param string $replyToDisplay
     * @param string $importClass
     * @param string $failingSince
     * @param int $lastError
     * @param array $a
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
        $this->_id = trim($id);
        $this->_name = trim($name);
        $this->_l = trim($l);
        if(null !== $isEnabled)
        {
            $this->_isEnabled = (bool) $isEnabled;
        }
        if(null !== $importOnly)
        {
            $this->_importOnly = (bool) $importOnly;
        }
        $this->_host = trim($host);
        if(null !== $port)
        {
            $this->_port = (int) $port;
        }
        if($connectionType instanceof MdsConnectionType)
        {
            $this->_connectionType = $connectionType;
        }
        $this->_username = trim($username);
        $this->_password = trim($password);
        $this->_pollingInterval = trim($pollingInterval);
        $this->_emailAddress = trim($emailAddress);
        if(null !== $useAddressForForwardReply)
        {
            $this->_useAddressForForwardReply = (bool) $useAddressForForwardReply;
        }
        $this->_defaultSignature = trim($defaultSignature);
        $this->_forwardReplySignature = trim($forwardReplySignature);
        $this->_fromDisplay = trim($fromDisplay);
        $this->_replyToAddress = trim($replyToAddress);
        $this->_replyToDisplay = trim($replyToDisplay);
        $this->_importClass = trim($importClass);
        if(null !== $failingSince)
        {
            $this->_failingSince = (int) $failingSince;
        }
        $this->_lastError = trim($lastError);
        $this->_a = array();
        foreach($a as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_a))
            {
                $this->_a[] = $value;
            }
        }
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
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_l;
        }
        $this->_l = trim($l);
        return $this;
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
            return $this->_isEnabled;
        }
        $this->_isEnabled = (bool) $isEnabled;
        return $this;
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
            return $this->_importOnly;
        }
        $this->_importOnly = (bool) $importOnly;
        return $this;
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
            return $this->_host;
        }
        $this->_host = trim($host);
        return $this;
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
            return $this->_port;
        }
        $this->_port = (int) $port;
        return $this;
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
            return $this->_connectionType;
        }
        $this->_connectionType = $connectionType;
        return $this;
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
            return $this->_username;
        }
        $this->_username = trim($username);
        return $this;
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
            return $this->_password;
        }
        $this->_password = trim($password);
        return $this;
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
            return $this->_pollingInterval;
        }
        $this->_pollingInterval = trim($pollingInterval);
        return $this;
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
            return $this->_emailAddress;
        }
        $this->_emailAddress = trim($emailAddress);
        return $this;
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
            return $this->_useAddressForForwardReply;
        }
        $this->_useAddressForForwardReply = (bool) $useAddressForForwardReply;
        return $this;
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
            return $this->_defaultSignature;
        }
        $this->_defaultSignature = trim($defaultSignature);
        return $this;
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
            return $this->_forwardReplySignature;
        }
        $this->_forwardReplySignature = trim($forwardReplySignature);
        return $this;
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
            return $this->_fromDisplay;
        }
        $this->_fromDisplay = trim($fromDisplay);
        return $this;
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
            return $this->_replyToAddress;
        }
        $this->_replyToAddress = trim($replyToAddress);
        return $this;
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
            return $this->_replyToDisplay;
        }
        $this->_replyToDisplay = trim($replyToDisplay);
        return $this;
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
            return $this->_importClass;
        }
        $this->_importClass = trim($importClass);
        return $this;
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
            return $this->_failingSince;
        }
        $this->_failingSince = (int) $failingSince;
        return $this;
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
            return $this->_lastError;
        }
        $this->_lastError = trim($lastError);
        return $this;
    }

    /**
     * Gets or sets a
     *
     * @param  array $a
     * @return array|self
     */
    public function a(array $a = null)
    {
        if(null === $a)
        {
            return $this->_a;
        }
        $this->_a = array();
        foreach($a as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_a))
            {
                $this->_a[] = $value;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'mail')
    {
        $name = !empty($name) ? $name : 'mail';
        $arr = array();

        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(is_bool($this->_isEnabled))
        {
            $arr['isEnabled'] = $this->_isEnabled ? 1 : 0;
        }
        if(is_bool($this->_importOnly))
        {
            $arr['importOnly'] = $this->_importOnly ? 1 : 0;
        }
        if(!empty($this->_host))
        {
            $arr['host'] = $this->_host;
        }
        if(is_int($this->_port))
        {
            $arr['port'] = $this->_port;
        }
        if($this->_connectionType instanceof MdsConnectionType)
        {
            $arr['connectionType'] = (string) $this->_connectionType;
        }
        if(!empty($this->_username))
        {
            $arr['username'] = $this->_username;
        }
        if(!empty($this->_password))
        {
            $arr['password'] = $this->_password;
        }
        if(!empty($this->_pollingInterval))
        {
            $arr['pollingInterval'] = $this->_pollingInterval;
        }
        if(!empty($this->_emailAddress))
        {
            $arr['emailAddress'] = $this->_emailAddress;
        }
        if(is_bool($this->_useAddressForForwardReply))
        {
            $arr['useAddressForForwardReply'] = $this->_useAddressForForwardReply ? 1 : 0;
        }
        if(!empty($this->_defaultSignature))
        {
            $arr['defaultSignature'] = $this->_defaultSignature;
        }
        if(!empty($this->_forwardReplySignature))
        {
            $arr['forwardReplySignature'] = $this->_forwardReplySignature;
        }
        if(!empty($this->_fromDisplay))
        {
            $arr['fromDisplay'] = $this->_fromDisplay;
        }
        if(!empty($this->_replyToAddress))
        {
            $arr['replyToAddress'] = $this->_replyToAddress;
        }
        if(!empty($this->_replyToDisplay))
        {
            $arr['replyToDisplay'] = $this->_replyToDisplay;
        }
        if(!empty($this->_importClass))
        {
            $arr['importClass'] = $this->_importClass;
        }
        if(is_int($this->_failingSince))
        {
            $arr['failingSince'] = $this->_failingSince;
        }
        if(!empty($this->_lastError))
        {
            $arr['lastError'] = $this->_lastError;
        }
        if(count($this->_a))
        {
            $arr['a'] = $this->_a;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mail')
    {
        $name = !empty($name) ? $name : 'mail';
        $xml = new SimpleXML('<'.$name.' />');

        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
        }
        if(is_bool($this->_isEnabled))
        {
            $xml->addAttribute('isEnabled', $this->_isEnabled ? 1 : 0);
        }
        if(is_bool($this->_importOnly))
        {
            $xml->addAttribute('importOnly', $this->_importOnly ? 1 : 0);
        }
        if(!empty($this->_host))
        {
            $xml->addAttribute('host', $this->_host);
        }
        if(is_int($this->_port))
        {
            $xml->addAttribute('port', $this->_port);
        }
        if($this->_connectionType instanceof MdsConnectionType)
        {
            $xml->addAttribute('connectionType', (string) $this->_connectionType);
        }
        if(!empty($this->_username))
        {
            $xml->addAttribute('username', $this->_username);
        }
        if(!empty($this->_password))
        {
            $xml->addAttribute('password', $this->_password);
        }
        if(!empty($this->_pollingInterval))
        {
            $xml->addAttribute('pollingInterval', $this->_pollingInterval);
        }
        if(!empty($this->_emailAddress))
        {
            $xml->addAttribute('emailAddress', $this->_emailAddress);
        }
        if(is_bool($this->_useAddressForForwardReply))
        {
            $xml->addAttribute('useAddressForForwardReply', $this->_useAddressForForwardReply ? 1 : 0);
        }
        if(!empty($this->_defaultSignature))
        {
            $xml->addAttribute('defaultSignature', $this->_defaultSignature);
        }
        if(!empty($this->_forwardReplySignature))
        {
            $xml->addAttribute('forwardReplySignature', $this->_forwardReplySignature);
        }
        if(!empty($this->_fromDisplay))
        {
            $xml->addAttribute('fromDisplay', $this->_fromDisplay);
        }
        if(!empty($this->_replyToAddress))
        {
            $xml->addAttribute('replyToAddress', $this->_replyToAddress);
        }
        if(!empty($this->_replyToDisplay))
        {
            $xml->addAttribute('replyToDisplay', $this->_replyToDisplay);
        }
        if(!empty($this->_importClass))
        {
            $xml->addAttribute('importClass', $this->_importClass);
        }
        if(is_int($this->_failingSince))
        {
            $xml->addAttribute('failingSince', $this->_failingSince);
        }
        if(!empty($this->_lastError))
        {
            $xml->addChild('lastError', $this->_lastError);
        }
        if(count($this->_a))
        {
            foreach ($this->_a as $a)
            {
                $xml->addChild('a', $a);
            }
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
