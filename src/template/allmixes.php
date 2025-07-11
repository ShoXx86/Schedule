<?php
require_once(__DIR__ . '/../../App/Config/dbcon.php');
require_once(__DIR__ . '/../claas/backend_allmixes.php');
require_once(__DIR__ . '/../claas/backend_baseproducts.php');

// Alle BaseProducts holen
$allBaseProducts = BaseProducts::GetAllBaseProducts();
$topN = 50;

$allTopMixes = [];
foreach ($allBaseProducts as $baseProduct) {
    $baseProductName = method_exists($baseProduct, 'getBaseProduct')
        ? $baseProduct->getBaseProduct()
        : (method_exists($baseProduct, 'getName') ? $baseProduct->getBaseProduct() : '');
    $mixes = AllMixes::GetTopNByBaseProduct($baseProductName, $topN);
    foreach ($mixes as $mix) {
        $allTopMixes[] = $mix;
    }
}
// Karten durchmischen
shuffle($allTopMixes);
?>

<style>
    .full-product-section {
        background: #1f1f1f;
        padding: 60px 0;
        color: #fff;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 36px;
    }

    .product-card-modern {
        background: #0A0E0A;
        border-radius: 16px;
        box-shadow: 0 0 20px #0006;
        color: #fff;
        max-width: 340px;
        min-width: 300px;
        width: 100%;
        font-family: 'Inter', Arial, sans-serif;
        overflow: hidden;
        border: 1px solid #232823;
        margin-bottom: 28px;
        transition: box-shadow .22s, border .2s;
    }

    .product-card-modern:hover {
        border-color: #4ade80;
        box-shadow: 0 0 32px #34d39933;
    }

    .product-card-modern img {
        width: 100%;
        height: 185px;
        object-fit: cover;
        background: #222;
        display: block;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .product-card-modern .card-content {
        padding: 26px 22px 16px 22px;
    }

    .product-card-modern .product-title {
        font-size: 2rem;
        font-weight: bold;
        color: #fd9d42;
        margin-bottom: 13px;
        margin-top: 0;
        letter-spacing: -0.5px;
    }

    .chip-row {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 18px;
    }

    .chip {
        display: inline-flex;
        align-items: center;
        background: #111;
        color: #8cbc73;
        border: 1px solid #8cbc73;
        border-radius: 12px;
        padding: 3px 12px;
        font-size: 0.95rem;
        font-weight: 600;
        gap: 5px;
        user-select: none;
    }

    .chip.more {
        background: #171e12;
        border-color: #53773D;
        color: #8cbc73;
        font-weight: 500;
    }

    .grid-pricing {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 10px;
        margin-bottom: 18px;
    }

    .price-box {
        background: #171e12;
        border-radius: 9px;
        padding: 10px 0 7px 0;
        border: 1px solid #53773D;
        text-align: center;
    }

    .price-title {
        color: #8cbc73;
        font-size: 0.95rem;
        margin-bottom: 3px;
        font-weight: 500;
    }

    .price-cost {
        color: #fd9d42;
        font-size: 1.16rem;
        font-weight: bold;
    }

    .price-price {
        color: #8cbc73;
        font-size: 1.16rem;
        font-weight: bold;
    }

    .price-profit {
        color: #4DA3FF;
        font-size: 1.16rem;
        font-weight: bold;
    }

    .profit-margin-label {
        display: flex;
        justify-content: space-between;
        font-size: 1.01rem;
        color: #8cbc73;
        margin-bottom: 6px;
        font-weight: 500;
    }

    .profit-bar-bg {
        background: #232823;
        height: 9px;
        border-radius: 6px;
        width: 100%;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .profit-bar-fill {
        height: 100%;
        border-radius: 6px;
        transition: width 0.3s;
    }

    .substances-label {
        font-size: 1.11rem;
        color: #8cbc73;
        margin-bottom: 12px;
        font-weight: 600;
        margin-top: 12px;
        text-align: center;
    }

    @media (max-width: 460px) {
        .full-product-section {
            gap: 10px;
        }

        .product-card-modern {
            max-width: 99vw;
            min-width: 0;
        }

        .product-card-modern .card-content {
            padding: 14px 4px 9px 4px;
        }

        .product-card-modern img {
            height: 130px;
        }

        .product-card-modern .product-title {
            font-size: 1.27rem;
        }
    }
</style>

<!-- Suchfeld & Buttons mittig -->
<div style="display:flex;flex-direction:column;align-items:center;margin-top:38px;margin-bottom:26px;">
    <input
        id="product-search-input"
        type="text"
        placeholder="Suche Produkt, Effekt oder Substanz..."
        style="
            padding:12px 18px;
            border-radius:9px;
            border:1px solid #3a493a;
            font-size:1.14rem;
            min-width:260px;
            max-width:430px;
            width:100%;
            background:#171e12;
            color:#fff;
            margin-bottom:20px;
            box-shadow:0 1px 8px #0002;
        "
        autocomplete="off" />
    <div style="display:flex;gap:14px;justify-content:center;">
        <button
            id="product-search-btn"
            style="background:#4ade80;color:#232823;border:none;padding:10px 30px;border-radius:9px;font-weight:bold;cursor:pointer;transition:background 0.18s;font-size:1.1rem;">Suchen</button>
        <button
            id="product-reset-btn"
            style="background:#fd9d42;color:#232823;border:none;padding:10px 28px;border-radius:9px;font-weight:bold;cursor:pointer;transition:background 0.18s;font-size:1.1rem;">Reset</button>
    </div>
    <div style="margin-top:20px;display:flex;gap:14px;justify-content:center;">
        <button id="sort-sell-btn"
            style="background:#38bdf8;color:#232823;border:none;padding:10px 24px;border-radius:9px;font-weight:bold;cursor:pointer;transition:background 0.18s;font-size:1.08rem;">
            Highest Sell
        </button>
        <button id="sort-profit-btn"
            style="background:#f472b6;color:#232823;border:none;padding:10px 24px;border-radius:9px;font-weight:bold;cursor:pointer;transition:background 0.18s;font-size:1.08rem;">
            Highest Profit
        </button>
    </div>

</div>

<div class="full-product-section" id="product-list">
    <?php foreach ($allTopMixes as $mix): ?>
        <?php
        $baseProductName = htmlspecialchars($mix->getBaseProduct());
        $cost = $mix->getCost();
        $sell = $mix->getSell();
        $profit = $mix->getProfit();
        $profitMargin = $mix->getProfitMargin();
        $effects = json_decode($mix->getEffects(), true);
        $substances = $mix->getSubstances();
        $productImg = '';
        $baseProduct = BaseProducts::getByName($baseProductName);
        if ($baseProduct) {
            $productImg = $baseProduct->getProductImg();
        }
        $effects = is_array($effects) ? $effects : [];
        $firstEffects = array_slice($effects, 0, 4);
        $moreEffects = count($effects) > 4 ? count($effects) - 4 : 0;
        $substances = is_array($substances) ? $substances : [];
        if ($profitMargin >= 50) {
            $gradient = "linear-gradient(90deg,#4ade80 70%,#22d3ee 100%)";
        } elseif ($profitMargin >= 25) {
            $gradient = "linear-gradient(90deg,#fd9d42 70%,#fdba74 100%)";
        } else {
            $gradient = "linear-gradient(90deg,#ef4444 70%,#ff4d4f 100%)";
        }
        ?>
        <div class="product-card-modern"
            data-title="<?= strtolower($baseProductName) ?>"
            data-effects="<?= strtolower(implode(' ', $effects)) ?>"
            data-substances="<?= strtolower(implode(' ', $substances)) ?>"
            data-sell="<?= htmlspecialchars($sell) ?>"
            data-profit="<?= htmlspecialchars($profit) ?>">

            <img src="<?= htmlspecialchars($productImg) ?>" alt="<?= $baseProductName ?>">
            <div class="card-content">
                <h2 class="product-title"><?= $baseProductName ?></h2>
                <!-- Effekte Chips -->
                <div class="chip-row">
                    <?php foreach ($firstEffects as $e): ?>
                        <span class="chip"><?= htmlspecialchars($e) ?></span>
                    <?php endforeach; ?>
                    <?php if ($moreEffects): ?>
                        <span class="chip more">+<?= $moreEffects ?> more</span>
                    <?php endif; ?>
                </div>
                <!-- Preisblock -->
                <div class="grid-pricing">
                    <div class="price-box">
                        <div class="price-title">Cost</div>
                        <div class="price-cost">$<?= number_format($cost, 2) ?></div>
                    </div>
                    <div class="price-box">
                        <div class="price-title">Price</div>
                        <div class="price-price">$<?= number_format($sell, 2) ?></div>
                    </div>
                    <div class="price-box">
                        <div class="price-title">Profit</div>
                        <div class="price-profit">$<?= number_format($profit, 2) ?></div>
                    </div>
                </div>
                <!-- Profit Margin Bar -->
                <div class="profit-margin-label">
                    <span>Profit Margin</span>
                    <span style="color: <?= $profitMargin >= 50 ? '#48ff7c' : ($profitMargin >= 25 ? '#fd9d42' : '#ff6666') ?>; font-weight: bold;">
                        <?= $profitMargin ?>%
                    </span>
                </div>
                <div class="profit-bar-bg">
                    <div class="profit-bar-fill" style="width: <?= min($profitMargin, 100) ?>%; background: <?= $gradient ?>;"></div>
                </div>
                <!-- Substanzen Icons -->
                <div style="margin-top:16px;">
                    <div class="substances-label">Substances:</div>
                    <ul style="list-style:none;padding:0;margin:0;text-align:center;">
                        <?php foreach ($substances as $s):
                            // Icon-Pfad: Nur Buchstaben/Zahlen/Leerzeichen, dann Leerzeichen->_, dann _Icon.webp
                            $iconFile = './assits/img/substanz_icon/' . preg_replace('/\s+/', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $s)) . '_Icon.webp';
                        ?>
                            <li style="margin-bottom:7px;font-size:1.08rem;display:flex;align-items:center;justify-content:center;gap:10px;">
                                <img src="<?= htmlspecialchars($iconFile) ?>" alt="<?= htmlspecialchars($s) ?>" style="width:24px;height:24px;object-fit:contain;vertical-align:middle;filter:drop-shadow(0 2px 2px #0004);" title="<?= htmlspecialchars($s) ?>">
                                <span style="color:#8cbc73;font-weight:600;"><?= htmlspecialchars($s) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('product-search-input');
        const searchBtn = document.getElementById('product-search-btn');
        const resetBtn = document.getElementById('product-reset-btn');
        const cards = document.querySelectorAll('.product-card-modern');

        // Helper: Sortiere die Karten im DOM nach Attribut
        function sortCardsBy(attr) {
            const parent = document.getElementById('product-list');
            const cardArr = Array.from(cards);

            cardArr.sort((a, b) => {
                const aVal = parseFloat(a.getAttribute(attr)) || 0;
                const bVal = parseFloat(b.getAttribute(attr)) || 0;
                return bVal - aVal;
            });

            // Karten neu im Parent-Div anordnen
            cardArr.forEach(card => parent.appendChild(card));
        }

        document.getElementById('sort-sell-btn').addEventListener('click', function() {
            sortCardsBy('data-sell');
        });
        document.getElementById('sort-profit-btn').addEventListener('click', function() {
            sortCardsBy('data-profit');
        });

        function filterProducts() {
            const query = searchInput.value.trim().toLowerCase();
            cards.forEach(card => {
                const title = card.getAttribute('data-title') || '';
                const effects = card.getAttribute('data-effects') || '';
                const substances = card.getAttribute('data-substances') || '';
                if (
                    title.includes(query) ||
                    effects.includes(query) ||
                    substances.includes(query)
                ) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function resetFilter() {
            searchInput.value = '';
            cards.forEach(card => {
                card.style.display = '';
            });
            searchInput.focus();
        }

        searchBtn.addEventListener('click', filterProducts);
        resetBtn.addEventListener('click', resetFilter);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                filterProducts();
            }
        });
    });
</script>