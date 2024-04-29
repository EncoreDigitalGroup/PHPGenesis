<?php

namespace PHPGenesis\CLI\Commands\CommandTraits;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

trait CommonInputs
{
    private function yesNoPrompt(string $label, string $key, string $defaultOption = 'y'): void
    {
        match (select(
            label: $label,
            options: [
                'y' => 'Yes',
                'n' => 'No',
            ],
            default: $defaultOption,
        )) {
            'y' => $this->input->setOption($key, true),
            default => null,
        };
    }

    private function textPrompt(string $label, string $placeholder = '', string $requiredMessage = 'This field is required.'): string
    {
        return text(
            label: $label,
            placeholder: $placeholder,
            required: $requiredMessage
        );
    }
}