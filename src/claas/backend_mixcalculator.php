<?php
// file_put_contents(__DIR__ . '/debug.log', 
// file_get_contents('php://input'));
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/backend_baseproducts.php');
require_once(__DIR__ . '/backend_substances.php');
require_once(__DIR__ . '/backend_effectmultipliers.php');
require_once(__DIR__ . '/backend_replaces.php');
require_once(__DIR__ . '/backend_ranks.php');

class CalculateAllMixes
{
    public static function calculateFinalPrice(BaseProducts $baseProduct, array $substanceEffectIds): array
    {
        $debug = [];

        $basePrice = (float)$baseProduct->getBasePrice();
        $defaultEffectId = $baseProduct->getEffectId();
        $hasDefaultEffect = $defaultEffectId !== null && $defaultEffectId > 0;

        $defaultEffect = $hasDefaultEffect ? new EffectMultipliers($defaultEffectId) : null;
        $defaultEffectMultiplier = $hasDefaultEffect ? (float)$defaultEffect->getMultiplier() : 0.0;

        $usedEffectIds = $hasDefaultEffect ? [$defaultEffect->getId()] : [];
        $usedEffectNames = $hasDefaultEffect ? [$defaultEffect->getEffectName()] : [];

        // $debug[] = "🧪 Base Price (original): {$basePrice}";
        // $debug[] = $hasDefaultEffect
        //     ? "🎯 Default Effect: {$defaultEffect->getEffectName()} (x{$defaultEffectMultiplier})"
        //     : "🎯 No default effect present.";

        $cleanPrice = $basePrice;
        $removeDefault = false;
        $replacementMap = [];
        $usedSubstanceNames = [];
        $totalCost = 0.0;

        foreach ($substanceEffectIds as $index => $subEffectId) {
            // $debug[] = "\n--- 🔄 Step {$index} | SubEffectId: {$subEffectId} ---";

            $substance = Substances::GetByEffectId($subEffectId);
            if ($substance) {
                $usedSubstanceNames[] = $substance->getSubstance();
                $effectCost = (float)$substance->getSubstanceCost();
                $totalCost += $effectCost;
                // $debug[] = "📦 Substance '{$substance->getSubstance()}' Cost = {$effectCost}";
            } else {
                // $debug[] = "⚠️ Substanz nicht gefunden für EffectID {$subEffectId}";
                continue;
            }

            $replaces = Replaces::GetReplacesByEffectId((int)$subEffectId);
            // $debug[] = "📘 Replaces found: " . count($replaces);

            foreach ($replaces as $replace) {
                $replaceFrom = (int)$replace->getReplaceFrom();
                $replaceTo = (int)$replace->getReplaceTo();

                if ($hasDefaultEffect && $replaceFrom === $defaultEffect->getId()) {
                    $removeDefault = true;
                }

                if (in_array($replaceFrom, $usedEffectIds)) {
                    $replacementEffect = new EffectMultipliers($replaceTo);
                    $replaceFromName = (new EffectMultipliers($replaceFrom))->getEffectName();
                    $replacementMap[] = "{$replaceFromName} → {$replacementEffect->getEffectName()}";

                    $usedEffectIds = array_values(array_diff($usedEffectIds, [$replaceFrom]));
                    $usedEffectNames = array_values(array_diff($usedEffectNames, [$replaceFromName]));

                    $usedEffectIds[] = $replacementEffect->getId();
                    $usedEffectNames[] = $replacementEffect->getEffectName();

                    // $debug[] = "✅ REPLACED {$replaceFromName} → {$replacementEffect->getEffectName()}";
                }
            }

            $effect = new EffectMultipliers($subEffectId);
            if (!in_array($effect->getId(), $usedEffectIds)) {
                $usedEffectIds[] = $effect->getId();
                $usedEffectNames[] = $effect->getEffectName();
                // $debug[] = "➕ Added Effect: {$effect->getEffectName()}";
            } else {
                // $debug[] = "🔁 Effect {$effect->getEffectName()} already in mix – skipped adding";
            }
        }

        if ($hasDefaultEffect && $removeDefault) {
            $cleanPrice = $basePrice / (1 + $defaultEffectMultiplier);
            // $debug[] = "➖ Remove Default Effect '{$defaultEffect->getEffectName()}' (x{$defaultEffectMultiplier})";
            // $debug[] = "📉 Clean Price: {$cleanPrice}";
            $usedEffectIds = array_values(array_diff($usedEffectIds, [$defaultEffect->getId()]));
            $usedEffectNames = array_values(array_diff($usedEffectNames, [$defaultEffect->getEffectName()]));
        } elseif ($hasDefaultEffect) {
            // $debug[] = "✅ Default Effect '{$defaultEffect->getEffectName()}' remains – not removed.";
        } else {
            // $debug[] = "📎 No default effect to remove.";
        }

        $totalMultiplier = 0.0;
        $multiplierSteps = [];
        foreach ($usedEffectIds as $eid) {
            if (!$removeDefault && $hasDefaultEffect && $eid === $defaultEffect->getId()) {
                // $debug[] = "💡 Skipping Default Effect '{$defaultEffect->getEffectName()}' from multiplier sum (already in base price)";
                continue;
            }
            $m = (float)(new EffectMultipliers($eid))->getMultiplier();
            $totalMultiplier += $m;
            $multiplierSteps[] = $m;
        }

        $sellPrice = $cleanPrice * (1 + $totalMultiplier);
        $fullCost = $basePrice + $totalCost;
        $profit = $sellPrice - $totalCost; //DIE Substanze Cost (totalcost) werden von dem Sell Preis abgezogen und nicht mit dem Base noch addiert!!  

        // $debug[] = "\n==== ✅ Final Result ====";
        // $debug[] = "📈 Total Multiplier: +{$totalMultiplier}";
        // $debug[] = "📈 Multipliers Applied: " . implode(" + ", array_map(fn($m) => round($m, 2), $multiplierSteps));
        // $debug[] = "💰 Substances Cost: {$totalCost}";
        // $debug[] = "💰 Full Cost (Base + Substances): {$fullCost}";
        // $debug[] = "💵 Final Sell Price: {$sellPrice}";
        // $debug[] = "📈 Profit: {$profit}";

        // file_put_contents(__DIR__ . '/debug_mix.txt', implode(PHP_EOL, $debug) . PHP_EOL . str_repeat('-', 40) . PHP_EOL, FILE_APPEND);

        $rankWeights = [];
        foreach ($usedEffectIds as $eid) {
            $rank = (new EffectMultipliers($eid))->getRank();
            if ($rank) $rankWeights[$rank->getRankName()] = $rank->getRankLevel();
        }

        $highestRank = !empty($rankWeights)
            ? array_key_first(array_slice(array_reverse($rankWeights, true), 0, 1))
            : 'Unranked';

        return [
            'cost' => round($totalCost, 2),
            'full_cost' => round($fullCost, 2),
            'sell' => round($sellPrice, 2),
            'profit' => round($profit, 2),
            'used_effects' => array_values(array_unique($usedEffectNames)),
            'replaced_from_to' => $replacementMap,
            'rank' => $highestRank,
            'base_price' => $basePrice,
            'base_default_effect' => $baseProduct->getDefaultEffect(),
            'base_effect_cost' => $hasDefaultEffect ? $defaultEffect->getEffectCost() : 0,
            'used_substances' => array_map(fn($n) => ['name' => $n], array_unique($usedSubstanceNames))
            // 'debug_steps' => $debug
        ];
    }
}