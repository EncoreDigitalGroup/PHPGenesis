<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Services\Cloudflare\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

/** @experimental */
class UpdateCloudflareDomainContactsCommand extends Command
{
    protected $signature = 'cloudflare:updateDomainContacts';
    protected $description = 'Iterates over all domains in a Cloudflare account and updates their contacts';

    public function handle(): void
    {
        $this->info('Fetching domains...');
        $domains = $this->fetchDomains();

        foreach ($domains as $domain) {
            $this->info('Processing domain: ' . $domain['name']);
            $this->updateDomainContacts($domain['name']);
        }

        $this->info('All domains processed.');
    }

    private function fetchDomains(): array
    {
        $accountId = config('phpgenesis.cloudflare.accountId');
        $email = config('phpgenesis.cloudflare.email');
        $apiKey = config('phpgenesis.cloudflare.apiKey');

        $response = Http::withHeaders([
            'X-Auth-Email' => $email,
            'X-Auth-Key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->get("https://api.cloudflare.com/client/v4/accounts/{$accountId}/registrar/domains");

        $data = $response->json();

        if ($response->failed()) {
            $this->error('Failed to fetch domains: ' . $data['errors'][0]['message']);
            return [];
        }

        return $data['result'];
    }

    private function updateDomainContacts($domainId): void
    {
        $accountId = config('phpgenesis.cloudflare.accountId');
        $email = config('phpgenesis.cloudflare.email');
        $apiKey = config('phpgenesis.cloudflare.apiKey');
        $defaultProfile = config('phpgenesis.cloudflare.defaultContactProfile');

        $contact = [
            'first_name' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.firstName"),
            'last_name' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.lastName"),
            'email' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.email"),
            'phone' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.phone"),
            'address' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.addressLine1"),
            'address2' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.addressLine2"),
            'city' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.city"),
            'state' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.state"),
            'zip' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.postalCode"),
            'country' => config("phpgenesis.cloudflare.contactProfiles.{$defaultProfile}.country"),
        ];

        $contacts = [
            'registrant' => $contact,
            'administrator' => $contact,
            'technical' => $contact,
            'billing' => $contact,
        ];

        $response = Http::withHeaders([
            'X-Auth-Email' => $email,
            'X-Auth-Key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->put("https://api.cloudflare.com/client/v4/accounts/$accountId/registrar/domains/{$domainId}/contacts", $contacts);

        if ($response->successful()) {
            $this->info('Contacts updated successfully for domain: ' . $domainId);
        } else {
            $this->error('Failed to update contacts for domain: ' . $domainId . '. Error: ' . $response->json()['errors'][0]['message']);
        }
    }
}
