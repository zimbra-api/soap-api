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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\IdAndAction;
use Zimbra\Soap\Request;

/**
 * MigrateAccountRequest request class
 * Migrate an account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="MigrateAccountRequest")
 */
class MigrateAccountRequest extends Request
{
    /**
     * Specification for the migration
     * @Accessor(getter="getMigrate", setter="setMigrate")
     * @SerializedName("migrate")
     * @Type("Zimbra\Admin\Struct\IdAndAction")
     * @XmlElement
     */
    private $migrate;

    /**
     * Constructor method for MigrateAccountRequest
     *
     * @param  Migrate $migrate
     * @return self
     */
    public function __construct(IdAndAction $migrate)
    {
        $this->setMigrate($migrate);
    }

    /**
     * Sets the migrate.
     *
     * @return IdAndAction
     */
    public function getMigrate(): IdAndAction
    {
        return $this->migrate;
    }

    /**
     * Sets the migrate.
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof MigrateAccountEnvelope)) {
            $this->envelope = new MigrateAccountEnvelope(
                new MigrateAccountBody($this)
            );
        }
    }
}
