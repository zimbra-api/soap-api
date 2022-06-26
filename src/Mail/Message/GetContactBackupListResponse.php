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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Soap\ResponseInterface;

/**
 * GetContactBackupListResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetContactBackupListResponse implements ResponseInterface
{
    /**
     * list of available contact backups
     * 
     * @Accessor(getter="getBackup", setter="setBackup")
     * @SerializedName("backups")
     * @Type("array<string>")
     * @XmlList(inline=false, entry="backup", namespace="urn:zimbraMail")
     */
    private $backup = [];

    /**
     * Constructor method for GetContactBackupListResponse
     *
     * @param  array $backup
     * @return self
     */
    public function __construct(array $backup = [])
    {
        $this->setBackup($backup);
    }

    /**
     * Add backup
     *
     * @param  string $data
     * @return self
     */
    public function addBackup(string $data): self
    {
        $data = trim($data);
        if (!empty($data) && !in_array($data, $this->backup)) {
            $this->backup[] = $data;
        }
        return $this;
    }

    /**
     * Sets backup
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
     * Gets backup
     *
     * @return array
     */
    public function getBackup(): array
    {
        return $this->backup;
    }
}
