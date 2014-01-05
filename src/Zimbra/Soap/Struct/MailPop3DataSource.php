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

/**
 * MailPop3DataSource struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailPop3DataSource extends MailDataSource
{
    /**
     * Leave messages on the server
     * @var bool
     */
    private $_leaveOnServer;

    /**
     * Constructor method for MailPop3DataSource
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
        $leaveOnServer = null,
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
        parent::__construct(
            $id,
            $name,
            $l,
            $isEnabled,
            $importOnly,
            $host,
            $port,
            $connectionType,
            $username,
            $password,
            $pollingInterval,
            $emailAddress,
            $useAddressForForwardReply,
            $defaultSignature,
            $forwardReplySignature,
            $fromDisplay,
            $replyToAddress,
            $replyToDisplay,
            $importClass,
            $failingSince,
            $lastError ,
            $a
        );
        if(null !== $leaveOnServer)
        {
            $this->_leaveOnServer = (bool) $leaveOnServer;
        }
    }

    /**
     * Gets or sets leaveOnServer
     *
     * @param  bool $leaveOnServer
     * @return bool|self
     */
    public function leaveOnServer($leaveOnServer = null)
    {
        if(null === $leaveOnServer)
        {
            return $this->_leaveOnServer;
        }
        $this->_leaveOnServer = (bool) $leaveOnServer;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'pop3')
    {
        $name = !empty($name) ? $name : 'pop3';
        $arr = parent::toArray($name);
        if(is_bool($this->_leaveOnServer))
        {
            $arr[$name]['leaveOnServer'] = $this->_leaveOnServer ? 1 : 0;
        }
        return $arr;
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'pop3')
    {
        $name = !empty($name) ? $name : 'pop3';
        $xml = parent::toXml($name);
        if(is_bool($this->_leaveOnServer))
        {
            $xml->addAttribute('leaveOnServer', $this->_leaveOnServer ? 1 : 0);
        }
        return $xml;
    }
}
