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

use Zimbra\Mail\Struct\{MailDataSource, MailDataSourceTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateDataSourceRequest class
 * Creates a data source that imports mail items into the specified folder, for example
 * via the POP3 or IMAP protocols.  Only one data source is allowed per request.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateDataSourceRequest extends SoapRequest
{
    use MailDataSourceTrait;

    /**
     * Constructor
     *
     * @param  MailDataSource $dataSource
     * @return self
     */
    public function __construct(?MailDataSource $dataSource = null)
    {
        $this->imapDataSource = 
        $this->pop3DataSource = 
        $this->caldavDataSource = 
        $this->yabDataSource = 
        $this->rssDataSource = 
        $this->galDataSource = 
        $this->calDataSource = 
        $this->unknownDataSource = null;
        if ($dataSource instanceof MailDataSource) {
            $this->setDataSource($dataSource);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateDataSourceEnvelope(
            new CreateDataSourceBody($this)
        );
    }
}
