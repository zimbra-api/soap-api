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
use Zimbra\Common\Struct\ImapDataSource;

/**
 * MailImapDataSource struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailImapDataSource extends MailDataSource implements ImapDataSource
{
    /**
     * oauthToken for data source
     *
     * @var string
     */
    #[Accessor(getter: "getOAuthToken", setter: "setOAuthToken")]
    #[SerializedName("oauthToken")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $oauthToken = null;

    /**
     * client Id for refreshing data source oauth token
     *
     * @var string
     */
    #[Accessor(getter: "getClientId", setter: "setClientId")]
    #[SerializedName("clientId")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $clientId = null;

    /**
     * client secret for refreshing data source oauth token
     *
     * @var string
     */
    #[Accessor(getter: "getClientSecret", setter: "setClientSecret")]
    #[SerializedName("clientSecret")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $clientSecret = null;

    /**
     * bool field for client to denote if it wants to test the data source before creating
     *
     * @var bool
     */
    #[Accessor(getter: "isTest", setter: "setTest")]
    #[SerializedName("test")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $test = null;

    /**
     * Get oauthToken
     *
     * @return string
     */
    public function getOAuthToken(): ?string
    {
        return $this->oauthToken;
    }

    /**
     * Set oauthToken
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
     * Get clientId
     *
     * @return string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * Set clientId
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
     * Get clientSecret
     *
     * @return string
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * Set clientSecret
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
     * Get test
     *
     * @return bool
     */
    public function isTest(): ?bool
    {
        return $this->test;
    }

    /**
     * Set test
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
