<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Upload;

use Evenement\EventEmitter;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Message\Response as HttpResponse;
use GuzzleHttp\Post\PostFile;
use GuzzleHttp\Url;
use GuzzleHttp\Stream\Stream;

/**
 * Upload request class in Zimbra API PHP.
 * 
 * @package   Zimbra
 * @category  Upload
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Client extends EventEmitter
{

    /**
     * Upload service location
     * @var string
     */
    private $_location;

    /**
     * authentication token
     * @var string
     */
    private $_authToken;

    /**
     * Http client
     * @var HttpClient
     */
    private $_httpClient;

    /**
     * Http headers
     * @var array
     */
    private $_headers = [];

    /**
     * Base constructor
     *
     * @param string $location  The URL to request.
     * @param string $authToken The authentication token
     */
    public function __construct($location, $authToken = null)
    {
        $this->_location = $location;
        $this->_httpClient = new HttpClient();
        $this->_headers = array(
            'Method'     => 'POST',
            'User-Agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'PHP-Zimbra-Soap-API',
        );
        if(null !== $authToken)
        {
            $this->_authToken = trim($authToken);
        }
    }

    /**
     * Performs a upload request
     *
     * @param  Request $request
     * @return An array attactment objects
     */
    public function upload(Request $request)
    {
        $this->emit('before.request', [$request, &$this->headers]);
        $files = $request->getFiles();
        $body = $request->getBody();
        if ($files->count() == 0 || empty($body)) {
            throw new \UnexpectedValueException(
                "Upload request must have at least one file or has body content."
            );
        }

        $options = [
            'headers' => $this->headers,
            'cookies' => true,
            'verify' => false,
        ];
        if (!empty($this->_authToken))
        {
            $options['cookies'] = array('ZM_AUTH_TOKEN' => $this->_authToken);
        }

        $httpRequest = $this->_httpClient->createRequest(
            'POST', $this->_location, $options
        );
        $postBody = $httpRequest->getBody();
        $postBody->setField('requestId', $request->getRequestId());
        if ($files->count() > 0) {
            foreach ($files as $file) {
                $postBody->addFile(new PostFile(basename($file), fopen($file, 'r')));
            }
        }
        elseif (!empty($body)) {
            $httpRequest->setBody(Stream::factory($body));
        }
        $httpRequest->setQuery(['fmt' => 'raw,extended']);
        try
        {
            $response = $this->_httpClient->send($httpRequest);
            $this->emit('after.request', [$response, $response->getHeaders()]);
        }
        catch (BadResponseException $ex)
        {
            if ($ex->hasResponse())
            {
                $response = $ex->getResponse();
                $this->emit('after.request', [$response, $response->getHeaders()]);
            }
            throw $ex;
        }
        return $this->_parseResponse($response);
    }

    /**
     * Gets headers
     *
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Sets headers
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers = array())
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Add headers
     *
     * @param  string $name
     * @param  mix $value
     * @return self
     */
    public function addHeader($name, $value)
    {
        if (!isset($this->headers[$name])) {
            $this->headers[$name] = $value;
        }
        else {
            if (is_array($this->headers[$name])) {
                $this->headers[$name][] = $value;
            }
            else {
                $current_value = $this->headers[$name];
                $this->headers[$name] = array($current_value);
                $this->headers[$name][] = $value;
            }
        }
        return $this;
    }

    /**
     * Check if a specific header exists on the POST file by name.
     *
     * @param string $name Case-insensitive header to check
     *
     * @return bool
     */
    public function hasHeader($name)
    {
        return isset(array_change_key_case($this->_headers)[strtolower($name)]);
    }

    /**
     * Gets upload service location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->_location;
    }

    /**
     * Sets upload service location
     *
     * @param  string $location
     * @return self
     */
    public function setLocation($location)
    {
        $this->_location = trim($location);
        return $this;
    }

    /**
     * Gets authentication token
     *
     * @return string
     */
    public function getAuthToken()
    {
        return $this->_authToken;
    }

    /**
     * Sets authentication token
     *
     * @param  string $filePath
     * @return self
     */
    public function setAuthToken($authToken)
    {
        $this->_authToken = trim($authToken);
        return $this;
    }

    /**
     * Gets http client
     *
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->_httpClient;
    }

    /**
     * Sets http client
     *
     * @param  HttpClient $httpClient
     * @return self
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->_httpClient = $httpClient;
        return $this;
    }

    private function _parseResponse(HttpResponse $httpResponse)
    {
        $attactments = [];
        $body = $httpResponse->getBody();
        preg_match('/\[\{(.*)\}\]/', $body, $matches, PREG_OFFSET_CAPTURE, 3);
        $match = !empty($matches[0][0]) ? $matches[0][0] : false;
        if (!empty($match))
        {
            $data = json_decode($match);
            if (is_array($data))
            {
                foreach ($data as $object)
                {
                    $attachmentId = !empty($object->aid) ? $object->aid : '';
                    $fileName = !empty($object->filename) ? $object->filename : '';
                    $contentType = !empty($object->ct) ? $object->ct : '';
                    $attactments[] = new Attactment($attachmentId, $fileName, $contentType);
                }
            }
            else
            {
                $attachmentId = !empty($data->aid) ? $data->aid : '';
                $fileName = !empty($data->filename) ? $data->filename : '';
                $contentType = !empty($data->ct) ? $data->ct : '';
                $attactments[] = new Attactment($attachmentId, $fileName, $contentType);
            }
        }
        return $attactments;
    }
}
