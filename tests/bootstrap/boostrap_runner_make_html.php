<?php
// bin/bs_snapshot.php
declare(strict_types=1);

/**
 * Użycie:
 *  php bin/bs_snapshot.php --out tests/fixtures/before
 *  php bin/bs_snapshot.php --out tests/fixtures/after
 *
 * Skrypt zakłada, że autoload (lub require) wciąga klasę BS z Twojego kodu.
 * Przed upgradem zrzuca "before", po upgr. – "after".
 */

use braga\widgets\bootstrap\BS;
error_reporting(E_ALL);
ini_set('display_errors', '1');

$opts = [];
$opts['out'] = ".";
if(empty($opts['out']))
{
	fwrite(STDERR, "Missing --out <dir>\n");
	exit(2);
}
$outDir = rtrim($opts['out'], DIRECTORY_SEPARATOR);
if(!is_dir($outDir) && !mkdir($outDir, 0777, true) && !is_dir($outDir))
{
	fwrite(STDERR, "Cannot create dir: {$outDir}\n");
	exit(3);
}

// TODO: dopasuj do swojego autoloadera / ścieżek:
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

function section(string $title, string $html): string
{
	return <<<HTML
<section class="mb-5">
  <h2 class="h5 mb-3">{$title}</h2>
  {$html}
</section>
HTML;
}

function gridWrap(string $inner): string
{
	return <<<HTML
<div class="row g-3">
  {$inner}
</div>
HTML;
}

function colWrap(string $html, string $col = 'col-md-6 col-lg-4'): string
{
	return <<<HTML
<div class="{$col}">
  <div class="p-3 border rounded-3 h-100">
    {$html}
  </div>
</div>
HTML;
}

// ─────────────────────────────────────────────────────────────────────
// Zawartość – przyciski
$solidVariants = [
	'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark', 'link'
];
$outlineVariants = [
	'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'
];

// SOLID
$solidButtons = [];
$solidButtons[] = '<div class="mb-2"><div class="fw-bold mb-2">Solid (`btn-*`)</div>';
foreach($solidVariants as $v)
{
	$label = "btn-{$v}";
	// BS::button($content, $attrb, $baseClass)
	$solidButtons[] = BS::button($label, 'type="button"', "btn-{$v}") . ' ';
}
$solidButtons[] = '</div>';

// OUTLINE
$outlineButtons = [];
$outlineButtons[] = '<div class="mb-2"><div class="fw-bold mb-2">Outline (`btn-outline-*`)</div>';
foreach($outlineVariants as $v)
{
	$label = "btn-outline-{$v}";
	$outlineButtons[] = BS::button($label, 'type="button"', "btn-outline-{$v}") . ' ';
}
$outlineButtons[] = '</div>';

// ROZMIARY
$sized = [];
$sized[] = '<div class="mb-2"><div class="fw-bold mb-2">Rozmiary</div>';
$sized[] = BS::button('Large (btn-lg)', 'type="button"', 'btn-primary btn-lg');
$sized[] = ' ';
$sized[] = BS::button('Normal', 'type="button"', 'btn-primary');
$sized[] = ' ';
$sized[] = BS::button('Small (btn-sm)', 'type="button"', 'btn-primary btn-sm');
$sized[] = '</div>';

// STANY: disabled/active/block
$states = [];
$states[] = '<div class="mb-2"><div class="fw-bold mb-2">Stany</div>';
$states[] = BS::button('Disabled', 'type="button" disabled', 'btn-secondary');
$states[] = ' ';
$states[] = BS::button('Active (aria-pressed)', 'type="button" aria-pressed="true"', 'btn-secondary active');
$states[] = '</div>';

$block = [];
$block[] = '<div class="mb-2"><div class="fw-bold mb-2">Szerokość 100% (w-100)</div>';
$block[] = BS::button('Full width', 'type="button"', 'btn-success w-100');
$block[] = '</div>';

// LinkButton / Submit (dla pełni obrazu API)
$apiExamples = [];
$apiExamples[] = '<div class="mb-2"><div class="fw-bold mb-2">API klasy BS</div>';
$apiExamples[] = BS::button('LinkButton: przejdź', '#', 'btn-info');
$apiExamples[] = ' ';
$apiExamples[] = '<form onsubmit="return false;" class="d-inline-block">' . BS::submit('Submit (form)', 'btn-danger') . '</form>';
$apiExamples[] = '</div>';

// Grupy przycisków – optional (czysto HTML, bez wrappera w BS)
$group = [];
$group[] = '<div class="mb-2"><div class="fw-bold mb-2">Button group (HTML, bez wrappera BS)</div>';
$group[] = <<<HTML
<div class="btn-group" role="group" aria-label="Przykład grupy">
  <button type="button" class="btn btn-outline-primary">Lewo</button>
  <button type="button" class="btn btn-outline-primary">Środek</button>
  <button type="button" class="btn btn-outline-primary">Prawo</button>
</div>
HTML;
$group[] = '</div>';

// Złóż kolumny
$col1 = implode('', array_merge($solidButtons, $outlineButtons));
$col2 = implode('', $sized);
$col3 = implode('', $states);
$col4 = implode('', $block);
$col5 = implode('', $apiExamples);
$col6 = implode('', $group);

$grid = gridWrap(
	colWrap($col1) .
	colWrap($col2) .
	colWrap($col3) .
	colWrap($col4) .
	colWrap($col5) .
	colWrap($col6)
);

// Sekcje
$body = section('Przyciski Bootstrap 5.3.3 – pełna paleta wariantów', $grid);

$bostrapCss = BS::bootstrapCss();
$bootstrapJs = BS::bootstrapJs();
$html = <<<HTML
	<!doctype html>
	<html lang="pl">
	<head>
	  <meta charset="utf-8">
	  <title>BS Compare (before vs after)</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  {$bostrapCss}
	  <style>
		body { padding: 24px; }
		section + section { border-top: 1px dashed #ddd; padding-top: 24px; }
		.small { font-size: 0.8rem; }
	  </style>
	</head>
	<body>
	  {$body}	  
	  {$bootstrapJs}
	</body>
	</html>
HTML;
file_put_contents("{$outDir}" . DIRECTORY_SEPARATOR . "index.html", $html);
echo "Snapshot written to {$outDir}\n";
