<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class ApiClientEnrich
{
    private const string BASE_URL = 'https://api.companyenrich.com';

    public function __construct(private HttpClientInterface $client, private string $apiKey)
    {}

    /**
     * Company Search
     */
    public function searchCompanies(string $query, int $page = 1, int $pageSize = 10): array
    {
        if (empty(trim($query))) {
            return $this->error('Query darf nicht leer sein.');
        }

        return $this->post('/companies/search', [
            'query' => $query,
            'page' => $page,
            'pageSize' => $pageSize,
        ]);
    }

    /**
     * People Search
     */
    public function searchPeopleByDomain(array $domains, int $pageSize = 10): array
    {
        $domains = array_filter(array_map('trim', $domains));
        if (empty($domains)) {
            return $this->error('Mindestens eine Domain muss übergeben werden.');
        }

        return $this->post('/people/search/scroll', [
            'domains' => $domains,
            'pageSize' => $pageSize,
        ]);
    }

    public function post(string $endpoint, array $payload): array
    {
        try {
            $response = $this->client->request(
                'POST',
                self::BASE_URL . $endpoint,
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $payload,
                    'timeout' => 15,
                ]
            );

            return [
                'success' => true,
                'data' => $response->toArray(false),
            ];

        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }

    private function error(string $message): array
    {
        return [
            'success' => false,
            'error' => $message,
        ];
    }
}
