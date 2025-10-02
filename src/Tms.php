<?php

namespace Jacobtims\Tms;

use DateInterval;
use DateTimeImmutable;
use Jacobtims\Tms\Concerns\SupportsJobsEndpoints;
use Jacobtims\Tms\Concerns\SupportsTaskTemplatesEndpoints;
use Jacobtims\Tms\Exceptions\TmsException;
use Saloon\Contracts\OAuthAuthenticator;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\CursorPaginator;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class Tms extends Connector implements HasPagination
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use ClientCredentialsGrant;
    use SupportsJobsEndpoints;
    use SupportsTaskTemplatesEndpoints;

    protected string $baseUrl;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $baseUrl = 'https://localhost:3006/',
        bool $verifySsl = true,
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->oauthConfig()->setClientId($clientId);
        $this->oauthConfig()->setClientSecret($clientSecret);
        $this->config()->set(['verify' => $verifySsl]);
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return new TmsException(
            $response,
            $senderException?->getMessage() ?? 'Request failed',
            $senderException?->getCode() ?? 0,
        );
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setTokenEndpoint('/auth/application/token');
    }

    protected function createOAuthAuthenticatorFromResponse(Response $response): OAuthAuthenticator
    {
        $responseData = $response->object();

        $accessToken = $responseData->access_token;

        $expiresAt = (new DateTimeImmutable($responseData->created_date))
            ->add(DateInterval::createFromDateString('5 minutes')); // TMS default expiry time is 5 minutes

        return $this->createOAuthAuthenticator($accessToken, $expiresAt);
    }

    public function paginate(Request $request): CursorPaginator
    {
        return new TmsPaginator($this, $request);
    }
}
