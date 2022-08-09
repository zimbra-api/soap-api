Usage
=====

## Basic Usage
1. Create `$api` instance from one of Admin, Account & Mail API.
2. Authentication with `$api->auth()` method.
3. From `$api` object, you can access to all Zimbra SOAP API.

Example: Search messages has attachment in Inbox
```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Mail\MailApi;

$query = 'in:inbox has:attachment';

$api = new MailApi('https://zimbra.server/service/soap');
$api->authByAccountName($accountName, $password);
$response = $api->search($query, FALSE, 'message');
$messages = $response->getMessageHits();
```

## Set Target Account
Sometimes you authenticate with an administrator account but want to access the mailbox of another account.
1. Get `authToken` via Admin API.
2. Create mail api instance via Mail API.
3. Call `$api->setAuthToken` of mail api instance for setting authentication token.
4. Call `$api->setTargetAccount` of mail api instance for setting target account that you want to access.

## Batch Request
1. Create `Batch Request` class which extends `BatchRequest` and implements `setRequests` method for setting requests that you want to call.
2. Create `Batch Response` class which implements `BatchResponseInterface` with `setResponses` method for setting responses that return from Zimbra SOAP service.
3. Create `Batch Envelope` & `Batch Body` classes for both `Batch Request` & `Batch Response`
4. Extends API & add method that invoke `Batch Request`

Example: Batch request for `getAccountInfo`
```php

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 * @XmlRoot(name="soap:Envelope")
 */
class BatchGetAccountInfosEnvelope extends SoapEnvelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("BatchGetAccountInfosBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $body;

    public function __construct(?BatchGetAccountInfosBody $body = NULL, ?SoapHeader $header = NULL)
    {
        parent::__construct($body, $header);
    }

    public function getBody(): ?SoapBodyInterface
    {
        return $this->body;
    }

    public function setBody(SoapBodyInterface $body): self
    {
        if ($body instanceof BatchGetAccountInfosBody) {
            $this->body = $body;
        }
        return $this;
    }
}

class BatchGetAccountInfosBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("BatchRequest")
     * @Type("BatchGetAccountInfosRequest")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("BatchResponse")
     * @Type("BatchGetAccountInfosResponse")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $response;

    public function __construct(
        ?BatchGetAccountInfosRequest $request = NULL, ?BatchGetAccountInfosResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof BatchGetAccountInfosRequest) {
            $this->request = $request;
        }
        return $this;
    }

    public function getRequest(): ?SoapRequestInterface
    {
        return $this->request;
    }

    public function setResponse(SoapResponseInterface $response): self
    {
        if ($response instanceof BatchGetAccountInfosResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?SoapResponseInterface
    {
        return $this->response;
    }
}
class BatchGetAccountInfosRequest extends BatchRequest
{
    /**
     * @Accessor(getter="getRequests", setter="setRequests")
     * @Type("array<Zimbra\Admin\Message\GetAccountInfoRequest>")
     * @XmlList(inline=true, entry="GetAccountInfoRequest", namespace="urn:zimbraAdmin")
     */
    private $requests = [];

    public function __construct(array $requests = [])
    {
        $this->setRequests($requests);
    }

    public function setRequests(array $requests): self
    {
        $this->requests = array_filter($requests, static fn($request) => $request instanceof GetAccountInfoRequest);
        return $this;
    }

    public function getRequests(): array
    {
        return $this->requests;
    }

    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new BatchGetAccountInfosEnvelope(
            new BatchGetAccountInfosBody($this)
        );
    }
}
class BatchGetAccountInfosResponse implements BatchResponseInterface
{
    /**
     * @Accessor(getter="getResponses", setter="setResponses")
     * @Type("array<Zimbra\Admin\Message\GetAccountInfoResponse>")
     * @XmlList(inline=true, entry="GetAccountInfoResponse", namespace="urn:zimbraAdmin")
     */
    private $responses = [];

    public function __construct(array $responses = [])
    {
        $this->setResponses($responses);
    }

    public function setResponses(array $responses): self
    {
        $this->responses = array_filter($responses, static fn($response) => $response instanceof GetAccountInfoResponse);
        return $this;
    }

    public function getResponses(): array
    {
        return $this->responses;
    }
}

class BatchAdminApi extends AdminApi
{
    public function batchGetAccountInfos(array $accounts): array
    {
        $accountInfos = [];
        $requests = [];
        foreach ($accounts as $account) {
            $by = filter_var($account, FILTER_VALIDATE_EMAIL) ? AccountBy::NAME() : AccountBy::ID();
            $request = GetAccountInfoRequest(
                new AccountSelector($by, $account)
            );
            $request->setRequestId($account);
            $requests[] = $request;
        }
        $responses = $this->invoke(
            new BatchGetAccountInfosRequest($requests)
        )->getResponses();
        foreach ($responses as $response) {
            $accountInfos[$response->getRequestId()] = $response;
        }
        return $accountInfos;
    }
}
```
