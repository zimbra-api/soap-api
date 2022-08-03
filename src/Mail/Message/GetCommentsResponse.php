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
use Zimbra\Mail\Struct\{IdEmailName, CommentInfo};
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetCommentsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyentry © 2020-present by Nguyen Van Nguyen.
 */
class GetCommentsResponse implements SoapResponseInterface
{
    /**
     * Users
     * 
     * @Accessor(getter="getUsers", setter="setUsers")
     * @Type("array<Zimbra\Mail\Struct\IdEmailName>")
     * @XmlList(inline=true, entry="user", namespace="urn:zimbraMail")
     */
    private $users = [];

    /**
     * Comment information
     * 
     * @Accessor(getter="getComments", setter="setComments")
     * @Type("array<Zimbra\Mail\Struct\CommentInfo>")
     * @XmlList(inline=true, entry="comment", namespace="urn:zimbraMail")
     */
    private $comments = [];

    /**
     * Constructor method for GetCommentsResponse
     *
     * @param  array $users
     * @param  array $comments
     * @return self
     */
    public function __construct(
        array $users = [],
        array $comments = []
    )
    {
        $this->setUsers($users)
             ->setComments($comments);
    }

    /**
     * Add user
     *
     * @param  IdEmailName $user
     * @return self
     */
    public function addUser(IdEmailName $user): self
    {
        $this->users[] = $user;
        return $this;
    }

    /**
     * Set users
     *
     * @param  array $entries
     * @return self
     */
    public function setUsers(array $entries): self
    {
        $this->users = array_filter($entries, static fn ($entry) => $entry instanceof IdEmailName);
        return $this;
    }

    /**
     * Get users
     *
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * Add comment
     *
     * @param  CommentInfo $comment
     * @return self
     */
    public function addComment(CommentInfo $comment): self
    {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * Set comments
     *
     * @param  array $entries
     * @return self
     */
    public function setComments(array $entries): self
    {
        $this->comments = array_filter($entries, static fn ($entry) => $entry instanceof CommentInfo);
        return $this;
    }

    /**
     * Get comments
     *
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }
}
