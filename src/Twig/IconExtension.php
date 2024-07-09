<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class IconExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('icon', [$this, 'renderIcon'], ['is_safe' => ['html']]),
        ];
    }

    public function renderIcon(string $name, string $style = 'outline', string $size = '6'): string
    {
        $svgPath = __DIR__ . "/../../node_modules/@heroicons/react/{$style}/{$name}.svg";
        if (!file_exists($svgPath)) {
            return '';
        }
        $svg = file_get_contents($svgPath);
        return str_replace('<svg', "<svg class=\"w-{$size} h-{$size}\"", $svg);
    }
}