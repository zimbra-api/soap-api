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
 * DeleteDistributionListRequest class
 * Delete a distribution list
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeleteDistributionListRequest extends SoapRequest
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
     * If true, cascade delete the hab-groups else return error
     * 
     * @var bool
     */
    #[Accessor(getter: 'isCascadeDelete', setter: 'setCascadeDelete')]
    #[SerializedName('cascadeDelete')]
    #[Type('bool')]
    #[XmlAttribute]
    private $cascadeDelete;

    /**
     * Constructor
     * 
     * @param  string $id
     * @param  bool   $cascadeDelete
     * @return self
     */
    public function __construct(string $id = '', ?bool $cascadeDelete = NULL)
    {
        $this->setId($id);
        if (NULL !== $cascadeDelete) {
            $this->setCascadeDelete($cascadeDelete);
        }
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
     * Get cascadeDelete
     *
     * @return bool
     */
    public function isCascadeDelete(): ?bool
    {
        return $this->cascadeDelete;
    }

    /**
     * Set cascadeDelete
     *
     * @param  bool $cascadeDelete
     * @return self
     */
    public function setCascadeDelete(bool $cascadeDelete): self
    {
        $this->cascadeDelete = $cascadeDelete;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DeleteDistributionListEnvelope(
            new DeleteDistributionListBody($this)
        );
    }
}
