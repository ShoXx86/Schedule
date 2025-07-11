<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

require_once(__DIR__ . '/../claas/backend_baseproducts.php');
require_once(__DIR__ . '/../claas/backend_effectmultipliers.php');
require_once(__DIR__ . '/../claas/backend_substances.php');
require_once(__DIR__ . '/../claas/backend_replaces.php');
require_once(__DIR__ . '/../claas/backend_mixcalculator.php');
require_once(__DIR__ . '/../claas/backend_ranks.php');

$input = json_decode(file_get_contents('php://input'), true);
$baseProductName = $input['baseProduct'] ?? null;
$effectIds = $input['effectIds'] ?? [];

if (!$baseProductName || !is_array($effectIds) || count($effectIds) === 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing or invalid base product or effect IDs']);
    exit;
}

$product = BaseProducts::GetByName($baseProductName);
if (!$product) {
    http_response_code(404);
    echo json_encode(['error' => 'Product not found']);
    exit;
}

$result = CalculateAllMixes::calculateFinalPrice($product, $effectIds);

echo json_encode([
    'cost' => $result['cost'],
    'full_cost' => $result['full_cost'],
    'sell' => $result['sell'],
    'profit' => $result['profit'],
    'effects' => $result['used_effects'],
    'replaced_from_to' => $result['replaced_from_to'],
    'rank' => $result['rank'] ?? null,
    'base_price' => $result['base_price'],
    'base_default_effect' => $result['base_default_effect'],
    'base_effect_cost' => $result['base_effect_cost'],
    'used_substances' => $result['used_substances'] ?? [],
    // 'debug_steps' => $result['debug_steps'] ?? [] // 👈 DAS hinzufügen!
]);

