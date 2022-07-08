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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\FreeBusyUserInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetWorkingHoursResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetWorkingHoursResponse implements ResponseInterface
{
    /**
     * Working hours information by user
     * 
     * @Accessor(getter="getFreebusyUsers", setter="setFreebusyUsers")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyUserInfo>")
     * @XmlList(inline=true, entry="usr", namespace="urn:zimbraMail")
     */
    private $freebusyUsers = [];

    /**
     * Constructor method for GetWorkingHoursResponse
     *
     * @param  array $freebusyUsers
     * @return self
     */
    public function __construct(array $freebusyUsers = [])
    {
        $this->setFreebusyUsers($freebusyUsers);
    }

    /**
     * Add freebusyUser
     *
     * @param  FreeBusyUserInfo $freebusyUser
     * @return self
     */
    public function addFreebusyUser(FreeBusyUserInfo $freebusyUser): self
    {
        $this->freebusyUsers[] = $freebusyUser;
        return $this;
    }

    /**
     * Sets freebusyUsers
     *
     * @param  array $users
     * @return self
     */
    public function setFreebusyUsers(array $users): self
    {
        $this->freebusyUsers = array_filter($users, static fn ($usr) => $usr instanceof FreeBusyUserInfo);
        return $this;
    }

    /**
     * Gets freebusyUsers
     *
     * @return array
     */
    public function getFreebusyUsers(): array
    {
        return $this->freebusyUsers;
    }
}
