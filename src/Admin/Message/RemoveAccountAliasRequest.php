<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * RemoveAccountAliasRequest class
 * Remove Account Alias
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RemoveAccountAliasRequest extends SoapRequest
{
    /**
     * Zimbra ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Alias
     * 
     * @var string
     */
    #[Accessor(getter: 'getAlias', setter: 'setAlias')]
    #[SerializedName('alias')]
    #[Type('string')]
    #[XmlAttribute]
    private $alias;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $alias
     * @return self
     */
    public function __construct(string $id = '', string $alias = '')
    {
        $this->setId($id)
             ->setAlias($alias);
    }

    /**
     * Get zimbra id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set zimbra id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * Set alias
     *
     * @param  string $alias
     * @return self
     */
    public function setAlias(string $alias): self
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new RemoveAccountAliasEnvelope(
            new RemoveAccountAliasBody($this)
        );
    }
}
