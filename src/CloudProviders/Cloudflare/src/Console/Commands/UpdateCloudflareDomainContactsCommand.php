<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\CloudProviders\Cloudflare\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

/** @experimental */
class UpdateCloudflareDomainContactsCommand extends Command
{
    protected ?string $accountId;
    protected ?string $email;
    protected ?string $apiKey;
    protected ?string $defaultProfile;
    protected $signature = "cloudflare:updateDomainContacts";
    protected $description = "Iterates over all domains in a Cloudflare account and updates their contacts";

    public function __construct()
    {
        parent::__construct();

        $this->accountId = Config::get("phpgenesis.cloudflare.accountId");
        $this->email = Config::get("phpgenesis.cloudflare.email");
        $this->apiKey = Config::get("phpgenesis.cloudflare.apiKey");
        $this->defaultProfile = Config::get("phpgenesis.cloudflare.defaultContactProfile");
    }

    public function handle(): void
    {
        $this->info("Fetching domains...");
        $domains = $this->fetchDomains();

        if ($domains != []) {
            foreach ($domains as $domain) {
                $this->info("Processing domain: " . $domain["name"]);
                $this->updateDomainContacts($domain["name"]);
            }

            $this->info("All domains processed.");
        }
    }

    private function fetchDomains(): array
    {
        $response = Http::withHeaders([
            "X-Auth-Email" => $this->email,
            "X-Auth-Key" => $this->apiKey,
            "Content-Type" => "application/json",
        ])->get("https://api.cloudflare.com/client/v4/accounts/{$this->accountId}/registrar/domains");

        $data = $response->json();

        if ($response->failed()) {
            $this->error("Failed to fetch domains: " . $data["errors"][0]["message"]);

            return [];
        }

        return $data["result"];
    }

    private function updateDomainContacts(string $domain): void
    {
        $contact = [
            "first_name" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.firstName"),
            "last_name" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.lastName"),
            "email" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.email"),
            "phone" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.phone"),
            "address" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.addressLine1"),
            "address2" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.addressLine2"),
            "city" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.city"),
            "state" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.state"),
            "zip" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.postalCode"),
            "country" => Config::get("phpgenesis.cloudflare.contactProfiles.{$this->defaultProfile}.country"),
        ];

        $contacts = [
            "registrant" => $contact,
            "administrator" => $contact,
            "technical" => $contact,
            "billing" => $contact,
        ];

        $response = Http::withHeaders([
            "X-Auth-Email" => $this->email,
            "X-Auth-Key" => $this->apiKey,
            "Content-Type" => "application/json",
        ])->put("https://api.cloudflare.com/client/v4/accounts/{$this->accountId}/registrar/domains/{$domain}/contacts", $contacts);

        if ($response->successful()) {
            $this->info("Contacts updated successfully for domain: " . $domain);
        } else {
            $this->error("Failed to update contacts for domain: " . $domain . ". Error: " . $response->json()["errors"][0]["message"]);
        }
    }
}
