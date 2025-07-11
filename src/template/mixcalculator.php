<?php
require_once(__DIR__ . '/../claas/backend_baseproducts.php');
require_once(__DIR__ . '/../claas/backend_substances.php');
require_once(__DIR__ . '/../claas/backend_effectmultipliers.php');


// (1) Mapping von EffectId auf Namen vorbereiten
// Effekt-Name Map vorbereiten
$effectNames = [];
foreach (EffectMultipliers::GetAllEffects() as $effect) {
    $effectNames[$effect->getId()] = $effect->getEffectName();
}


// (2) Dann erst baseProductMap aufbauen
$baseProductMap = [];

foreach (BaseProducts::GetAllBaseProducts() as $product) {
    $effectId = $product->getEffectId();
    $effect = new EffectMultipliers($effectId);

    $basePrice = (float) $product->getBasePrice();
    $effectCost = (float) $effect->getEffectCost();
    $multiplier = (float) $effect->getMultiplier();

    $basePriceFormatted = number_format($basePrice, 2, '.', '');
    $cost = '$0.00';
    $sell = $basePrice * (1 + $multiplier);

    $baseProductMap[$product->getBaseProduct()] = [
        'base_price' => $basePrice,
        'effect_id' => $effectId,
        'effect_name' => $effect->getEffectName(), // oder getEffectName()
        'product_img' => $product->getProductImg(),
        // 'cost' => round($cost, 2),
        'sell' => round($sell, 2)
    ];
}

// (3) Substance-Auswahl bleibt gleich
$substances = [];
foreach (Substances::GetAllSubstances() as $item) {
    $effect = new EffectMultipliers($item->getEffectId());
    $substances[] = [
        'name' => $item->getSubstance(),
        'multiplier' => $effect->getMultiplier() * 100,
        'effect_id' => $item->getEffectId()
    ];
}
?>


<style>
    .mix-header {
        background-color: #1f1f1f;
        min-height: 20vh;
        color: white;
    }

    .mix-title {
        color: #8CBC73;
        font-weight: bold;
        font-size: 36px;
    }

    .mix-subtitle {
        color: #8CBC73;
        font-size: 27px;
        margin-top: 30px;
    }

    .pill-button {
        border: 1px solid #8CBC73;
        color: white;
        background: transparent;
        padding: 8px 16px;
        border-radius: 20px;
    }

    .pill-button:hover {
        background: #8CBC73;
        color: #1A1A18;
    }

    .mix-btn-start {
        background: #53773D;
        color: white;
        padding: 10px 24px;
        border-radius: 8px;
        margin-top: 40px;
    }

    .mix-btn-start:hover {
        background: #8CBC73;
        color: #1A1A18;
    }

    .separator-line {
        border-top: 1px solid #53773D;
        margin: 20px auto;
        width: 30%;
    }

    .full-line {
        border-top: 1px solid #53773D;
        /* margin: 20px auto; */
        width: 100% !important;

    }

    .trenn-line {
        background-color: #1f1f1f;
        border-top: 1px solid #53773D;
        margin: 20px auto;
        width: 100% !important;

    }

    .dropdown-menu {
        background: #2b2b2b;
        border: 1px solid #8CBC73;
        width: 280px;
    }

    .dropdown-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #8CBC73;
        color: white;
        padding: 8px 12px;
    }

    .dropdown-item span {
        color: #4DA3FF;
    }

    .mix-btn-start {
        background: #53773D;
        color: white;
        padding: 10px 24px;
        border-radius: 8px;
        margin-top: 12px;
    }

    .mix-btn-start:hover {
        background: #8CBC73;
        color: #1A1A18;
    }

    .favorite-mixes-title {
        color: #8CBC73;
        font-size: 42px;
        font-weight: bold;
    }

    .recipe-grid-wrapper {
        background: #111;
        padding: 60px 0;
        color: white;
    }

    .product-card {
        background: #0A0E0A;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    .product-type-label {
        position: absolute;
        top: -14px;
        right: -14px;
        background: #53773D;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: bold;
    }

    .view-button {
        background: #305E12;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        margin-top: auto;
        font-weight: bold;
    }

    .view-button:hover {
        background: #8CBC73;
        color: #1A1A18;
    }

    .effect-pill {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 12px;
        background: #111;
        border: 1px solid #8cbc73;
        margin: 2px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #8cbc73;
        transition: 0.2s ease-in-out;
    }

    .effect-pill:hover {
        background-color: #8cbc73;
        color: #111;
    }
</style>
<style>
    .full-product-section {
        background-color: #1f1f1f;
        padding: 60px 0;
        color: white;
    }

    .full-product-card {
        background-color: #0A0E0A;
        border-radius: 12px;
        padding: 32px;
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 900px;
        margin: 0 auto;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .full-product-card .product-type-label {
        position: absolute;
        top: -14px;
        right: -14px;
        background-color: #53773D;
        color: white;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: bold;
    }

    .full-product-card img {
        width: 150px;
        height: 150px;
    }

    .full-product-card h2 {
        font-size: 32px;
        margin-top: 20px;
    }

    .full-product-card .product-meta {
        margin-top: 20px;
        font-size: 18px;
    }

    .full-product-card .view-button {
        background-color: #305E12;
        color: white;
        padding: 10px 24px;
        border-radius: 6px;
        text-decoration: none;
        margin-top: 30px;
        font-weight: bold;
    }

    .full-product-card .view-button:hover {
        background-color: #8CBC73;
        color: #1A1A18;
    }
</style>

<div class="full-line"></div>

<div class="mixcalculator py-5" style="background-color: #1f1f1f; color: white;">
    <div class="container" style="max-width: 87%; border-top: 2px solid #3f5535; border-bottom: 2px solid #3f5535; border-radius: 20px;">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="mixcalculator-header py-4" style="background-color:rgb(24, 24, 24); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h4 class="mix-title">Mixing Calculator</h4>
                    <div class="separator-line"></div>
                </div>
                <div class="row py-2 px-5">
                    <div class="col-md-6">
                        <div class="containr-fluid text-center">
                            <!-- Product Type Buttons -->
                            <h4 class="mix-subtitle">Product Type</h4>
                            <div class="separator-line mt-1 mb-5"></div>
                            <div class="d-flex flex-wrap justify-content-center gap-3 mt-3 mb-5" id="productTypeButtons">
                                <?php
                                $productTypes = [
                                    "OG Kush" => "assits/img/schedule_icons/OGKush_Icon.webp",
                                    "Sour Diesel" => "assits/img/schedule_icons/SourDiesel_Icon.webp",
                                    "Green Crack" => "assits/img/schedule_icons/GreenCrack_Icon.webp",
                                    "Granddady Purple" => "assits/img/schedule_icons/GranddaddyPurple_Icon.webp",
                                    "Meth" => "assits/img/schedule_icons/Meth_Icon.webp",
                                    "Cocaine" => "assits/img/schedule_icons/Cocaine_Icon.webp"
                                ];
                                foreach ($productTypes as $product => $imgPath):
                                ?>
                                    <button class="pill-button d-flex align-items-center gap-2 product-type-btn" data-img="<?= htmlspecialchars($imgPath) ?>">
                                        <img src="<?= htmlspecialchars($imgPath) ?>" style="width: 20px; height: 20px;"> <?= $product ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <h4 class="mix-subtitle">Substances</h4>
                        <div class="separator-line mt-1 mb-5"></div>
                        <div id="substance-container" class="d-flex flex-column align-items-center">
                            <div class="dropdown mb-2">
                                <button class="btn btn-outline-light dropdown-toggle" type="button" id="substanceDropdown0" data-bs-toggle="dropdown">
                                    Select Substance
                                </button>
                                <ul class="dropdown-menu" id="dropdownList0">
                                    <?php foreach ($substances as $sub): ?>
                                        <?php
                                        $imgFile = str_replace(' ', '_', $sub['name']) . '_Icon.webp';
                                        $imgPath = "assits/img/substanz_icon/" . $imgFile;
                                        ?>
                                        <li class="dropdown-item d-flex align-items-center gap-2" data-name="<?= htmlspecialchars($sub['name']) ?>">
                                            <img src="<?= $imgPath ?>" alt="icon" style="width: 20px; height: 20px;">
                                            <?= htmlspecialchars($sub['name']) ?>
                                            <span class="ms-auto"><?= number_format($sub['multiplier'], 0) ?>%</span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Right side: Product Card Output -->
                        <div class="product-card-wrapper">
                            <div class="full-product-card position-relative mt-3">
                                <div class="product-type-label" id="productTypeLabel"></div>
                                <div class="row">
                                    <img id="mainProductImage" src="<?= htmlspecialchars($productImg ?? '') ?>" alt="Product Image" style="width: 87px; height: 87px;">
                                    <!-- <div class="separator-line"></div> -->
                                </div>
                                <div class="container-fluid row pb-2">
                                    <div class="col-md-6">
                                        <h4 style="color: #53773D;">Base Product</h4>
                                        <div class="separator-line pb-2"></div>
                                        <p class="text-center">Price: <span id="basePrice" class="bpp-price text-danger" style="font-weight:600;">$0.00</span></p>
                                        <p class="text-center">Default Effekt: <span id="baseEffect" class="bpp-effect" style="font-weight: 600;">–</span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 style="color: #53773D;">Mix Result</h4>
                                        <div class="separator-line pb-2"></div>
                                        <p class="product-rank text-center" id="productRankWrapper"><strong>Rank:</strong> <span id="productRank">–</span></p>
                                        <div class="product-effects text-start" id="productEffects"></div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="d-flex justify-content-center mt-3 gap-2" style="border-radius: 20px; background-color:rgb(0, 12, 2);">
                                        <div class="product-meta">
                                            <div class="row">
                                                <h3 class="col-md-12 text-center pb-2 mb-4" style="border-bottom: 1px solid #53773D; color: #53773D; display: inline-block;">Results</h3>


                                                <div class="col text-center px-3">
                                                    <p ><strong>Sub-Cost:</strong></p>
                                                    <div class="separator-line"></div>
                                                    <p><span id="productCost" class="text-info">$0.00</span></p>
                                                </div>

                                                <div class="col text-center px-3">
                                                    <p><strong>Full-Cost:</strong></p>
                                                    <div class="separator-line"></div>
                                                    <p><span id="productFullCost" class="text-warning">$0.00</span></p>
                                                </div>

                                                <div class="col text-center px-3">
                                                    <p><strong>Sell:</strong></p>
                                                    <div class="separator-line"></div>
                                                    <p><span id="productSell" class="text-success">$0.00</span></p>
                                                </div>

                                                <div class="col text-center px-3">
                                                    <p><strong>Profit:</strong></p>
                                                    <div class="separator-line"></div>
                                                    <p><span id="productProfit" class="text-primary">$0.00</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="d-flex justify-content-center gap-2 py-3">
                                        <div class="row">
                                            <h4 class="col-md-12 text-center py-2" style="border-bottom: 1px solid #53773D; display: inline-block;">Used Substanzes</h4>
                                            <!-- Target container für Substances -->
                                            <div class="col-md-12 text-center py-1" id="usedSubstancesWrapper">
                                                <!-- Substance Icons + Names erscheinen hier -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3 pb-3" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; background-color:rgb(24, 24, 24);">
                    <button id="resetMixBtn" class="mix-btn-start">🔄 Reset Mix</button>
                    <button id="startMixingButton" class="mix-btn-start">Start Mixing</button>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- JavaScript zum Bild-Wechsel -->
<script>
    document.querySelectorAll('.product-type-btn').forEach(button => {
        button.addEventListener('click', function() {
            const imgSrc = this.getAttribute('data-img');
            const productName = this.textContent.trim();

            // Hauptbild der Produktkarte ändern
            document.getElementById('mainProductImage').src = imgSrc;

            // Optional: Product Type Label aktualisieren
            document.getElementById('productTypeLabel').textContent = productName;

            const productInfo = productData[productName];
            if (productInfo) {

                document.querySelector('.bpp-price').textContent = "$" + Number(productInfo.base_price).toFixed(2);
                const defaultEffectName = productInfo.effect_name || "–";
                const badgeHTML = createEffectBadge(defaultEffectName);
                document.querySelector('.bpp-effect').innerHTML = badgeHTML;

                document.querySelector('.bpp-effect-cost').textContent = "$" + Number(productInfo.base_effect_cost || 0).toFixed(2);
                document.getElementById('productCost').textContent = "$" + Number(productInfo.cost || 0).toFixed(2);
                document.getElementById('productSell').textContent = "$" + Number(productInfo.sell || 0).toFixed(2);

                const effectText = Array.isArray(productInfo.effects) ?
                    productInfo.effects.join(", ") :
                    (productInfo.effect_name || "-");

                // document.getElementById('productEffects').textContent = effectText;
                document.getElementById('mainProductImage').src = productInfo.product_img;
                document.getElementById('productTypeLabel').textContent = productName;
            }
        });
    });
</script>


<!-- --------------------------------------------------------------------------------------------------------------- -->
<div class="full-line"></div>
<!-- --------------------------------------------------------------------------------------------------------------- -->



<style>
    .calculator-wrapper {
        background-color: #1e1e1e;
        color: #b5ffb0;
        font-family: Arial, sans-serif;
    }

    .step-card {
        background-color: #2c2c2c;
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        height: 100%;
        color: #ffffff;
    }

    .step-card h4 {
        color: #b5ffb0;
    }

    .step-active {
        border: 2px solid #33aaff;
    }

    .step-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .btn-green {
        background-color: transparent;
        border: 1px solid #7fff6b;
        color: #7fff6b;
    }

    .btn-green:hover {
        background-color: #7fff6b;
        color: #000;
    }
</style>


<div class="calculator-wrapper">
    <div class="container py-5">
        <h2 class="text-center mb-5">How to use the Mixing Calculator?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="step-card">
                    <h4>Step 1</h4>
                    <p>Choose Product</p>
                    <button class="btn btn-green">Product</button>
                    <p class="mt-3">Decide on which product you want to use</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <h4>Step 2</h4>
                    <p>Add Substance</p>
                    <div class="step-icon">+</div>
                    <p class="mt-3">Choose up to 16 substances to add to your product</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card step-active">
                    <h4>Step 3</h4>
                    <p class="step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-beaker" viewBox="0 0 16 16">
                            <path d="M8.135 1.921a.5.5 0 0 0-.27.447v2.36L4.1 12.801a2.5 2.5 0 0 0 2.31 3.699h3.18a2.5 2.5 0 0 0 2.31-3.699L8.135 4.728v-2.36a.5.5 0 0 0-.27-.447ZM5.198 13.222 8.5 5.858l3.302 7.364a1.5 1.5 0 0 1-1.386 2.136h-3.18a1.5 1.5 0 0 1-1.386-2.136Z" />
                        </svg>
                    </p>
                    <p>Press "Start Mixing" button to calculate your results</p>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="full-line"></div>
<!-- END -->
<!-- -------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------- -->

<script>
    let dropdownCount = 1;
    const maxDropdowns = 8;

    const productData = <?= json_encode($baseProductMap, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>;
    const substances = <?= json_encode($substances, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>;

    const effectColorMap = {
        "Calming": "#FFB347",
        "Energizing": "#B6FF00",
        "Refreshing": "#7FFFD4",
        "Munchies": "#90EE90",
        "Laxative": "#F08080",
        "Foggy": "#B0C4DE",
        "Balding": "#DDA0DD",
        "Athletic": "#FF7F50",
        "Anti-Gravity": "#FFD700",
        "Sedating": "#FF9999",
        "Spicy": "rgb(46, 46, 255)",
        "Tropic-Thunder": "rgb(3, 161, 42)",
        "Gingeritis": "rgb(119, 46, 255)",
        "Bright-Eyed": "rgb(145, 0, 24)",
        "Calorie-Dense": "rgb(253, 157, 66)",
        "Thought-Provoking": "rgb(46, 255, 245)",
        "Long-Faced": "rgb(93, 0, 155)",
        "Toxic": "rgb(90, 54, 25)",

        // ...
    };

    function createEffectBadge(name) {
        const color = effectColorMap[name] || "#cccccc";
        return `<span style="
        display:inline-block;
        padding: 4px 10px;
        border-radius: 12px;
        background-color: ${color};
        color: black;
        margin: 2px;
        font-size: 0.85rem;
        font-weight: 600;
    ">${name}</span>`;
    }

    function createReplaceBadgePair(text) {
        const [from, to] = text.split("→").map(s => s.trim());
        const fromColor = effectColorMap[from] || "#999";
        const toColor = effectColorMap[to] || "#999";
        return `
        <span style="display:inline-block;margin:2px;">
            <span style="background-color:${fromColor};padding:4px 8px;border-radius:10px;color:black;font-weight:600;margin">${from}</span>
            <span style="margin:0 4px;">→</span>
            <span style="background-color:${toColor};padding:4px 8px;border-radius:10px;color:black;font-weight:600;">${to}</span>
        </span>
    `;
    }

    const originalDropdownHTML = document.getElementById('dropdownList0')?.innerHTML;

    // Substanz-Dropdown Click-Handling
    document.addEventListener('click', function(event) {
        const clickedItem = event.target.closest('.dropdown-item');
        if (clickedItem) {
            const dropdownMenu = clickedItem.closest('.dropdown-menu');
            const button = dropdownMenu.previousElementSibling;

            const name = clickedItem.getAttribute('data-name');
            button.setAttribute('data-name', name);
            button.style.minWidth = "220px";

            const imgFile = `${name.replace(/\s+/g, '_')}_Icon.webp`;
            const imgPath = `assits/img/substanz_icon/${imgFile}`;

            // Button-Label + Icon setzen
            if (!button.querySelector("img")) {
                const icon = document.createElement("img");
                icon.src = imgPath;
                icon.alt = name;
                icon.style.width = "20px";
                icon.style.height = "20px";
                icon.classList.add("me-2");
                button.prepend(icon);
            } else {
                const icon = button.querySelector("img");
                icon.src = imgPath;
                icon.alt = name;
            }

            button.innerHTML = `<img src="${imgPath}" alt="${name}" style="width: 20px; height: 20px;" class="me-2">${name}`;

            // Nächstes Dropdown hinzufügen
            if (dropdownCount < maxDropdowns) {
                const container = document.getElementById('substance-container');
                const newDropdown = document.createElement('div');
                newDropdown.className = 'dropdown mb-2';
                newDropdown.innerHTML = `
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="substanceDropdown${dropdownCount}" data-bs-toggle="dropdown">
                    Select Substance
                </button>
                <ul class="dropdown-menu">
                    ${originalDropdownHTML}
                </ul>
            `;
                container.appendChild(newDropdown);
                dropdownCount++;
            }
        }
    });


    document.getElementById('resetMixBtn').addEventListener('click', function() {
        // 1. Substances-Dropdowns neu aufbauen
        const container = document.getElementById('substance-container');
        container.innerHTML = '';
        const newDropdown = document.createElement('div');
        newDropdown.className = 'dropdown mb-2';
        newDropdown.innerHTML = `
        <button class="btn btn-outline-light dropdown-toggle" type="button" id="substanceDropdown0" data-bs-toggle="dropdown">
            Select Substance
        </button>
        <ul class="dropdown-menu" id="dropdownList0">
            ${originalDropdownHTML}
        </ul>
    `;
        container.appendChild(newDropdown);
        dropdownCount = 1;

        // 2. Produktkarte zurücksetzen
        document.getElementById('productTypeLabel').textContent = "";
        document.getElementById('mainProductImage').src = "assits/img/schedule_icons/Placeholder.webp";

        document.getElementById('productCost').textContent = "$0.00";
        document.getElementById('productSell').textContent = "$0.00";
        document.getElementById('productProfit').textContent = "$0.00";
        document.getElementById('productRank').textContent = "–";
        document.getElementById('productEffects').innerHTML = "";

        document.querySelector('.bpp-price').textContent = "$0.00";
        document.querySelector('.bpp-effect').textContent = "–";
        document.querySelector('.bpp-effect-cost').textContent = "$0.00";

        // 3. Used Substances (Icons + Namen) leeren
        const subsWrapper = document.getElementById("usedSubstancesWrapper");
        if (subsWrapper) subsWrapper.innerHTML = "";
    });





    document.querySelector('.mix-btn-start:last-of-type').addEventListener('click', async function() {
        const selectedProduct = document.getElementById('productTypeLabel').textContent.trim();
        if (!selectedProduct) return;

        const dropdowns = document.querySelectorAll('#substance-container .dropdown-toggle');
        const effectIds = Array.from(dropdowns)
            .map(drop => {
                const label = drop.getAttribute('data-name');
                const found = substances.find(s => s.name === label);
                return found ? found.effect_id : null;
            })
            .filter(Boolean);

        console.log("Mixing:", selectedProduct, effectIds);

        // RICHTIG (mit base-Pfad)
        const basePath = 'src/template/ajax_mixcalc.php';
        const response = await fetch(basePath, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                baseProduct: selectedProduct,
                effectIds
            })
        });

        const result = await response.json();


        document.getElementById('productFullCost').textContent = "$" + Number(result.full_cost || 0).toFixed(2);


        if (!response.ok || result.error) {
            console.warn("Mix Error:", result);
            return alert(result.error || "Fehler bei Mix-Berechnung");
        }

        // console.log("🧪 Replacements:", result.replaced_from_to);
        // console.log("✅ Used Effects:", result.effects);
        // console.log("🏅 Rank:", result.rank);

        // if (result.debug_steps && Array.isArray(result.debug_steps)) {
        //     console.groupCollapsed("📋 Mix Debug (from PHP)");
        //     result.debug_steps.forEach(step => console.log(step));
        //     console.groupEnd();
        // }

        // if (new URLSearchParams(location.search).get('debug') === 'true' && result.debug_steps) {
        //     console.groupCollapsed("📋 Mix Debug (from PHP)");
        //     result.debug_steps.forEach(step => console.log(step));
        //     console.groupEnd();
        // }



        const subsWrapper = document.getElementById("usedSubstancesWrapper");
        subsWrapper.innerHTML = ""; // Reset vorherige

        if (Array.isArray(result.used_substances) && result.used_substances.length) {
            result.used_substances.forEach(sub => {
                const iconPath = `assits/img/substanz_icon/${sub.name.replace(/\s+/g, '_')}_Icon.webp`;

                const div = document.createElement("div");
                div.className = "d-inline-flex align-items-center gap-1 px-2";

                div.innerHTML = `
                <img src="${iconPath}" alt="${sub.name}" style="width:20px;height:20px;">
                <span>${sub.name}</span>
            `;

                subsWrapper.appendChild(div);
            });
        }


        // Produktinfos anzeigen
        const priceEl = document.querySelector('.bpp-price');
        const effectEl = document.querySelector('.bpp-effect');
        const effectCostEl = document.querySelector('.bpp-effect-cost');

        if (priceEl) priceEl.textContent = `$${Number(result.base_price).toFixed(2)}`;
        if (effectEl) {
            const name = result.base_default_effect || "-";
            const color = effectColorMap[name] || "#ccc";
            effectEl.innerHTML = `
        <span style="
            display:inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            background-color: ${color};
            color: black;
        ">${name}</span>
    `;
        }

        if (effectCostEl) effectCostEl.textContent = `$${Number(result.base_effect_cost).toFixed(2)}`;


        // Preis
        document.getElementById('productCost').textContent = "$" + Number(result.cost || 0).toFixed(2);
        document.getElementById('productSell').textContent = "$" + Number(result.sell || 0).toFixed(2);
        document.getElementById('productProfit').textContent = "$" + Number(result.profit || 0).toFixed(2);

        const profitEl = document.getElementById('productProfit');
        const profitValue = Number(result.profit || 0);
        profitEl.textContent = "$" + profitValue.toFixed(2);

        // Reset Klassen
        profitEl.classList.remove('text-primary', 'text-danger');

        // Rot bei negativem Profit
        if (profitValue < 0) {
            profitEl.classList.add('text-danger');
        } else {
            profitEl.classList.add('text-primary');
        }

        // Rank
        const rankSpan = document.getElementById('productRank');
        if (rankSpan) {
            const rank = result.rank || "–";
            rankSpan.textContent = rank;
            rankSpan.classList.toggle('text-warning', rank !== "–");
        }


        // Effektanzeige
        const replacedListHTML = Array.isArray(result.replaced_from_to) ?
            result.replaced_from_to.map(e => createReplaceBadgePair(e)).join(" ") :
            "-";


        const effectsListHTML = Array.isArray(result.effects) ?
            result.effects.map(e => createEffectBadge(e)).join(" ") :
            "-";


        document.getElementById('productEffects').innerHTML = `
            <div style="text-align:center;">
                <strong style="font-size: 1rem;">Replaces</strong>
                <div style="height:1px;background:white;margin:4px auto 10px;width:100px;"></div>
                ${replacedListHTML !== '-' ? `<div class="row">><strong>Changes:</strong><br><br>${replacedListHTML}</div><br>` : ''}
                <div><strong>Effect List:</strong><br><br>${effectsListHTML}</div>
            </div>
        `;


    });
</script>
<!-- Tailwind CDN Link einbinden / Tailwind are for Substnaze Dropwdown/Menü -->
<!-- <script src="https://cdn.tailwindcss.com"></script> -->