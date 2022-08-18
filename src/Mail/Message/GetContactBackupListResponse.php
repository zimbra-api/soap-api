<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetContactBackupListResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetContactBackupListResponse extends SoapResponse
{
    /**
     * list of available contact backups
     * 
     * @Accessor(getter="getBackup", setter="setBackup")
     * @SerializedName("backups")
     * @Type("array<string>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="backup", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getBackup', setter: 'setBackup')]
    #[SerializedName('backups')]
    #[Type('array<string>')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    #[XmlList(inline: false, entry: 'backup', namespace: 'urn:zimbraMail')]
    private $backup = [];

    /**
     * Constructor
     *
     * @param  array $backup
     * @return self
     */
    public function __construct(array $backup = [])
    {
        $this->setBackup($backup);
    }

    /**
     * Set backup
     *
     * @param  array $backup
     * @return self
     */
    public function setBackup(array $backup): self
    {
        $this->backup = array_unique($backup);
        return $this;
    }

    /**
     * Get backup
     *
     * @return array
     */
    public function getBackup(): array
    {
        return $this->backup;
    }
}
