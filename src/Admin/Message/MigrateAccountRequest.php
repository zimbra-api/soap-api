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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\IdAndAction;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * MigrateAccountRequest request class
 * Migrate an account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MigrateAccountRequest extends SoapRequest
{
    /**
     * Specification for the migration
     * 
     * @Accessor(getter="getMigrate", setter="setMigrate")
     * @SerializedName("migrate")
     * @Type("Zimbra\Admin\Struct\IdAndAction")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private IdAndAction $migrate;

    /**
     * Constructor
     *
     * @param  IdAndAction $migrate
     * @return self
     */
    public function __construct(IdAndAction $migrate)
    {
        $this->setMigrate($migrate);
    }

    /**
     * Set the migrate.
     *
     * @return IdAndAction
     */
    public function getMigrate(): IdAndAction
    {
        return $this->migrate;
    }

    /**
     * Set the migrate.
     *
     * @param  IdAndAction $migrate
     * @return self
     */
    public function setMigrate(IdAndAction $migrate): self
    {
        $this->migrate = $migrate;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new MigrateAccountEnvelope(
            new MigrateAccountBody($this)
        );
    }
}
