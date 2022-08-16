<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SyncGalRequest class
 * Synchronize with the Global Address List
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SyncGalRequest extends SoapRequest
{
    /**
     * The previous synchronization token if applicable
     * 
     * @var string
     */
    #[Accessor(getter: 'getToken', setter: 'setToken')]
    #[SerializedName(name: 'token')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $token;

    /**
     * GAL sync account ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getGalAccountId', setter: 'setGalAccountId')]
    #[SerializedName(name: 'galAcctId')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $galAccountId;

    /**
     * Flag whether only the ID attributes for matching contacts should be returned.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getIdOnly', setter: 'setIdOnly')]
    #[SerializedName(name: 'idOnly')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $idOnly;

    /**
     * Flag whether count of remaining records should be returned in response or not.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getCount', setter: 'setCount')]
    #[SerializedName(name: 'getCount')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $getCount;

    /**
     * An int specifying the maximum number of results to return
     * 
     * @var int
     */
    #[Accessor(getter: 'getLimit', setter: 'setLimit')]
    #[SerializedName(name: 'limit')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $limit;

    /**
     * Constructor
     *
     * @param  string $token
     * @param  string $galAccountId
     * @param  bool $idOnly
     * @param  bool $getCount
     * @param  int $limit
     * @return self
     */
    public function __construct(
        ?string $token = NULL,
        ?string $galAccountId = NULL,
        ?bool $idOnly = NULL,
        ?bool $getCount = NULL,
        ?int $limit = NULL
    )
    {
        if(NULL !== $token) {
            $this->setToken($token);
        }
        if(NULL !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
        }
        if(NULL !== $idOnly) {
            $this->setIdOnly($idOnly);
        }
        if(NULL !== $getCount) {
            $this->setCount($getCount);
        }
        if(NULL !== $limit) {
            $this->setLimit($limit);
        }
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set token
     *
     * @param  string $token
     * @return self
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get GAL Account ID
     *
     * @return string
     */
    public function getGalAccountId(): ?string
    {
        return $this->galAccountId;
    }

    /**
     * Set GAL Account ID
     *
     * @param  string $galAccountId
     * @return self
     */
    public function setGalAccountId(string $galAccountId): self
    {
        $this->galAccountId = $galAccountId;
        return $this;
    }

    /**
     * Get idOnly
     *
     * @return bool
     */
    public function getIdOnly(): ?bool
    {
        return $this->idOnly;
    }

    /**
     * Set idOnly
     *
     * @param  bool $idOnly
     * @return self
     */
    public function setIdOnly(bool $idOnly): self
    {
        $this->idOnly = $idOnly;
        return $this;
    }

    /**
     * Get getCount
     *
     * @return bool
     */
    public function getCount(): ?bool
    {
        return $this->getCount;
    }

    /**
     * Set getCount
     *
     * @param  bool $getCount
     * @return self
     */
    public function setCount(bool $getCount): self
    {
        $this->getCount = $getCount;
        return $this;
    }

    /**
     * Get the maximum number of results to return
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set the maximum number of results to return
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SyncGalEnvelope(
            new SyncGalBody($this)
        );
    }
}
