<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Mail\Struct\SetCalendarItemInfo;
use Zimbra\Mail\Struct\Replies;

/**
 * SetAppointment request class
 * Directly set status of an entire appointment.
 * This API is intended for mailbox Migration (ie migrating a mailbox onto this server) and is not used by normal mail clients.
 * Need to specify folder for appointment 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetAppointment extends Base
{
    /**
     * Calendar item information for exceptions.
     * @var TypedSequence<SetCalendarItemInfo>
     */
    private $_exceptions;

    /**
     * Calendar item information for cancellations.
     * @var TypedSequence<SetCalendarItemInfo>
     */
    private $_cancellations;

    /**
     * Constructor method for SetAppointment
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $folderId
     * @param  bool $noNextAlarm
     * @param  int $nextAlarm
     * @param  SetCalendarItemInfo $m
     * @param  array $exceptions
     * @param  array $cancellations
     * @param  Replies $replies
     * @return self
     */
    public function __construct(
        $flags = null,
        $tags = null,
        $tagNames = null,
        $folderId = null,
        $noNextAlarm = null,
        $nextAlarm = null,
        SetCalendarItemInfo $defaultId = null,
        array $exceptions = [],
        array $cancellations = [],
        Replies $replies = null
    )
    {
        parent::__construct();
        if(null !== $flags)
        {
            $this->setProperty('f', trim($flags));
        }
        if(null !== $tags)
        {
            $this->setProperty('t', trim($tags));
        }
        if(null !== $tagNames)
        {
            $this->setProperty('tn', trim($tagNames));
        }
        if(null !== $folderId)
        {
            $this->setProperty('l', trim($folderId));
        }
        if(null !== $noNextAlarm)
        {
            $this->setProperty('noNextAlarm', (bool) $noNextAlarm);
        }
        if(null !== $nextAlarm)
        {
            $this->setProperty('nextAlarm', (int) $nextAlarm);
        }
        if($defaultId instanceof SetCalendarItemInfo)
        {
            $this->setChild('default', $defaultId);
        }
        $this->setExceptions($exceptions);
        $this->setCancellations($cancellations);
        if($replies instanceof Replies)
        {
            $this->setChild('replies', $replies);
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->getExceptions()->count())
            {
                $sender->setChild('except', $sender->getExceptions()->all());
            }
            if($sender->getCancellations()->count())
            {
                $sender->setChild('cancel', $sender->getCancellations()->all());
            }
        });
    }

    /**
     * Gets flags
     *
     * @return string
     */
    public function getFlags()
    {
        return $this->getProperty('f');
    }

    /**
     * Sets flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags($flags)
    {
        return $this->setProperty('f', trim($flags));
    }

    /**
     * Gets tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->getProperty('t');
    }

    /**
     * Sets tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags($tags)
    {
        return $this->setProperty('t', trim($tags));
    }

    /**
     * Gets tag names
     * Comma separated list of tag names
     *
     * @return string
     */
    public function getTagNames()
    {
        return $this->getProperty('tn');
    }

    /**
     * Sets tag names
     * Comma separated list of tag names
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames($tagNames)
    {
        return $this->setProperty('tn', trim($tagNames));
    }

    /**
     * Gets folder Id
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder Id
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId($folderId)
    {
        return $this->setProperty('l', trim($folderId));
    }

    /**
     * Gets no next alarm
     *
     * @return bool
     */
    public function getNoNextAlarm()
    {
        return $this->getProperty('noNextAlarm');
    }

    /**
     * Sets no next alarm
     *
     * @param  bool $noNextAlarm
     * @return self
     */
    public function setNoNextAlarm($noNextAlarm)
    {
        return $this->setProperty('noNextAlarm', (bool) $noNextAlarm);
    }

    /**
     * Gets next alarm
     *
     * @return int
     */
    public function getNextAlarm()
    {
        return $this->getProperty('nextAlarm');
    }

    /**
     * Sets next alarm
     *
     * @param  int $nextAlarm
     * @return self
     */
    public function setNextAlarm($nextAlarm)
    {
        return $this->setProperty('nextAlarm', (int) $nextAlarm);
    }

    /**
     * Gets default calendar item information
     *
     * @return SetCalendarItemInfo
     */
    public function getDefaultId()
    {
        return $this->getChild('default');
    }

    /**
     * Sets default calendar item information
     *
     * @param  SetCalendarItemInfo $defaultId
     * @return self
     */
    public function setDefaultId(SetCalendarItemInfo $defaultId)
    {
        return $this->setChild('default', $defaultId);
    }

    /**
     * Add a exception
     *
     * @param  SetCalendarItemInfo $exception
     * @return self
     */
    public function addException(SetCalendarItemInfo $exception)
    {
        $this->_exceptions->add($exception);
        return $this;
    }

    /**
     * Sets calendar item information for exceptions
     *
     * @param  array $exceptions
     * @return self
     */
    public function setExceptions(array $exceptions)
    {
        $this->_exceptions = new TypedSequence('Zimbra\Mail\Struct\SetCalendarItemInfo', $exceptions);
        return $this;
    }

    /**
     * Gets calendar item information for exceptions
     *
     * @return Sequence
     */
    public function getExceptions()
    {
        return $this->_exceptions;
    }

    /**
     * Add a cancellation
     *
     * @param  SetCalendarItemInfo $cancellation
     * @return self
     */
    public function addCancellation(SetCalendarItemInfo $cancellation)
    {
        $this->_cancellations->add($cancellation);
        return $this;
    }

    /**
     * Sets calendar item information for cancellations
     *
     * @param  array $cancellations
     * @return self
     */
    public function setCancellations(array $cancellations)
    {
        $this->_cancellations = new TypedSequence('Zimbra\Mail\Struct\SetCalendarItemInfo', $cancellations);
        return $this;
    }

    /**
     * Gets calendar item information for cancellations
     *
     * @return Sequence
     */
    public function getCancellations()
    {
        return $this->_cancellations;
    }

    /**
     * Gets list of replies received from attendees
     *
     * @return Replies
     */
    public function getReplies()
    {
        return $this->getChild('replies');
    }

    /**
     * Sets list of replies received from attendees
     *
     * @param  Replies $replies
     * @return self
     */
    public function setReplies(Replies $replies)
    {
        return $this->setChild('replies', $replies);
    }
}
