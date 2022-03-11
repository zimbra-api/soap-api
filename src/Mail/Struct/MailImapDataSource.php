<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Struct\ImapDataSource;

/**
 * MailImapDataSource struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailImapDataSource extends MailDataSource implements ImapDataSource
{
    /**
     * oauthToken for data source
     * @Accessor(getter="getOAuthToken", setter="setOAuthToken")
     * @SerializedName("oauthToken")
     * @Type("string")
     * @XmlAttribute
     */
    private $oauthToken;

    /**
     * client Id for refreshing data source oauth token
     * @Accessor(getter="getClientId", setter="setClientId")
     * @SerializedName("clientId")
     * @Type("string")
     * @XmlAttribute
     */
    private $clientId;

    /**
     * client secret for refreshing data source oauth token
     * @Accessor(getter="getClientSecret", setter="setClientSecret")
     * @SerializedName("clientSecret")
     * @Type("string")
     * @XmlAttribute
     */
    private $clientSecret;

    /**
     * boolean field for client to denote if it wants to test the data source before creating
     * @Accessor(getter="isTest", setter="setTest")
     * @SerializedName("test")
     * @Type("bool")
     * @XmlAttribute
     */
    private $test;

    /**
     * Gets oauthToken
     *
     * @return string
     */
    public function getOAuthToken(): ?string
    {
        return $this->oauthToken;
    }

    /**
     * Sets oauthToken
     *
     * @param  string $oauthToken
     * @return self
     */
    public function setOAuthToken(string $oauthToken): self
    {
        $this->oauthToken = $oauthToken;
        return $this;
    }

    /**
     * Gets clientId
     *
     * @return string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * Sets clientId
     *
     * @param  string $clientId
     * @return self
     */
    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * Gets clientSecret
     *
     * @return string
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * Sets clientSecret
     *
     * @param  string $clientSecret
     * @return self
     */
    public function setClientSecret(string $clientSecret): self
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * Gets test
     *
     * @return bool
     */
    public function isTest(): ?bool
    {
        return $this->test;
    }

    /**
     * Sets test
     *
     * @param  bool $test
     * @return self
     */
    public function setTest(bool $test): self
    {
        $this->test = $test;
        return $this;
    }
}
