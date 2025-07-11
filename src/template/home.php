<?php
require_once(__DIR__ . '/../../App/Config/dbcon.php');
require_once(__DIR__ . '/../claas/backend_allmixes.php');
require_once(__DIR__ . '/../claas/backend_baseproducts.php');

$allBaseProducts = BaseProducts::GetAllBaseProducts();
$baseProductNames = array_map(fn($bp) => $bp->getBaseProduct(), $allBaseProducts);
$allTopMixes = AllMixes::GetTopProfitMixesByBaseProduct($baseProductNames);
?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">


<style>
  .schedulecontent {
    background-image: url("assits/img/homebackroundimg1.webp");
    background-size: cover;
    background-position: center;
    height: 100vh;
  }

  .textcontent {
    padding-top: 60px;
    padding-bottom: 40px;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 48px;
  }

  .custom-card {
    background-color: rgba(26, 26, 24, 0.75);
    /* #1A1A18 mit 75% Deckkraft */
    border: 2px solid #8CBC73;
    border-radius: 16px;
    padding: 2rem 1rem;
    transition: transform 0.3s ease;
    width: 270px;
    height: 370px;
    flex: 0 1 auto;
  }

  .custom-card-row {
    gap: 79px;
    /* Abstand zwischen den Cards */
    padding: 10px;
  }

  .custom-card:hover {
    transform: scale(1.05);
  }

  .card-icon {
    width: 180px;
    height: auto;
    margin-bottom: 1rem;
  }

  .custom-title {
    font-family: 'Body', sans-serif;
    color: #8CBC73;
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }

  .custom-btn {
    background-color: #8CBC73;
    color: #1A1A18;
    padding: 0.5rem 1.5rem;
    text-decoration: none;
    font-weight: bold;
    border-radius: 6px;
    display: inline-block;
    margin-top: 1rem;
    transition: background-color 0.3s ease;
  }

  .custom-btn:hover {
    background-color: #77995e;
    color: #fff;
  }

  .full-line {
    border-top: 1px solid #53773D;
    /* margin: 20px auto; */
    width: 100% !important;

  }
</style>

<div class="container-fluid py-5 schedulecontent">
  <!-- Titelbereich -->
  <div class="textcontent text-center">
    <p>Schedule1 - Helper</p>
  </div>

  <!-- Card-Bereich mit flexbox -->
  <div class="d-flex justify-content-center flex-wrap custom-card-row">
    <!-- Card: All Mixes -->
    <div class="custom-card text-center">
      <img src="assits/img/schedule_icons/All_Mixes.png" alt="All Mixes Icon" class="card-icon">
      <h4 class="custom-title">All Mixes</h4>
      <a href="index.php?page=allmixes" class="custom-btn">Explore Now</a>
    </div>

    <!-- Card: Mix Calculator -->
    <div class="custom-card text-center">
      <img src="assits/img/schedule_icons/All_Mixes.png" alt="Mix Calculator Icon" class="card-icon">
      <h4 class="custom-title">Mix Calculator</h4>
      <a href="index.php?page=mixcalculator" class="custom-btn">Explore Now</a>
    </div>

    <!-- Card: Reverse Calculator -->
    <div class="custom-card text-center">
      <img src="assits/img/schedule_icons/All_Mixes.png" alt="Reverse Calculator Icon" class="card-icon">
      <h4 class="custom-title">Reverse Calculator</h4>
      <a href="index.php?page=reversecalculator" class="custom-btn">Explore Now</a>
    </div>

    <!-- Card: Map -->
    <div class="custom-card text-center">
      <img src="assits/img/schedule_icons/All_Mixes.png" alt="Map Icon" class="card-icon">
      <h4 class="custom-title">Map</h4>
      <a href="#" class="custom-btn">Explore Now</a>
    </div>
  </div>
</div>


<div class="full-line"></div>
<!-- ---------------------------------------------------------------------------------------------- -->

<style>
.full-product-section {
    background: #1f1f1f;
    padding: 60px 0;
    color: #fff;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    justify-items: center;
}

@media (min-width: 1400px) {
    .full-product-section {
        grid-template-columns: repeat(6, 1fr);
    }
}

.product-card-modern {
    background: #0A0E0A;
    border-radius: 16px;
    box-shadow: 0 0 20px #0006;
    color: #fff;
    max-width: 300px;
    width: 100%;
    font-family: 'Inter', Arial, sans-serif;
    overflow: hidden;
    border: 1px solid #232823;
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

.card-content {
    padding: 20px;
}

.product-title {
    font-size: 1.75rem;
    font-weight: bold;
    color: #fd9d42;
    margin-bottom: 12px;
    margin-top: 0;
    letter-spacing: -0.5px;
}

.chip-row {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    margin-bottom: 14px;
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
    margin-bottom: 14px;
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
</style>

<div class="full-product-section">
<?php foreach ($allTopMixes as $mix): ?>
    <?php
        $baseName = $mix->getBaseProduct();
        $cost = number_format($mix->getCost(), 2);
        $sell = number_format($mix->getSell(), 2);
        $profit = number_format($mix->getProfit(), 2);
        $profitMargin = $mix->getProfitMargin();
        $effects = json_decode($mix->getEffects(), true);
        $substances = $mix->getSubstances();

        $productImg = '';
        $baseProduct = BaseProducts::getByName($baseName);
        if ($baseProduct) {
            $productImg = $baseProduct->getProductImg();
        }

        if ($profitMargin >= 50) {
            $gradient = "linear-gradient(90deg,#4ade80 70%,#22d3ee 100%)";
        } elseif ($profitMargin >= 25) {
            $gradient = "linear-gradient(90deg,#fd9d42 70%,#fdba74 100%)";
        } else {
            $gradient = "linear-gradient(90deg,#ef4444 70%,#ff4d4f 100%)";
        }
    ?>
    <div class="product-card-modern">
        <img src="<?= htmlspecialchars($productImg) ?>" alt="<?= htmlspecialchars($baseName) ?>">
        <div class="card-content">
            <h3 class="product-title"><?= htmlspecialchars($baseName) ?></h3>
            <div class="chip-row">
                <?php foreach ($effects as $e): ?>
                    <span class="chip"><?= htmlspecialchars($e) ?></span>
                <?php endforeach; ?>
            </div>
            <div class="grid-pricing">
                <div class="price-box">
                    <div class="price-title">Cost</div>
                    <div class="price-cost">\$<?= $cost ?></div>
                </div>
                <div class="price-box">
                    <div class="price-title">Sell</div>
                    <div class="price-price">\$<?= $sell ?></div>
                </div>
                <div class="price-box">
                    <div class="price-title">Profit</div>
                    <div class="price-profit">\$<?= $profit ?></div>
                </div>
            </div>
            <div class="profit-margin-label">
                <span>Profit Margin:</span>
                <span><?= $profitMargin ?>%</span>
            </div>
            <div class="profit-bar-bg">
                <div class="profit-bar-fill" style="width: <?= min($profitMargin, 100) ?>%; background: <?= $gradient ?>;"></div>
            </div>
            <div class="substances-label">Substances</div>
            <div class="chip-row">
                <?php foreach ($substances as $s): ?>
                    <span class="chip more"><?= htmlspecialchars($s) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>


  <!-- ---------------------------------------------------------------------------------------------- -->

  <style>
    .faq-section {
      background-image: url("assits/img/faq-background.jpg");
      background-size: cover;
      background-position: center;
      padding: 80px 0;
      position: relative;
      overflow: hidden;
    }

    .faq-content {
      background-color: rgba(26, 38, 24, 0.75);
      color: white;
      max-width: 800px;
    }

    .accordion-button {
      background-color: transparent;
      color: #8CBC73;
      border: 1px solid #8CBC73;
      border-radius: 8px !important;
      margin-bottom: 15px;
      font-weight: bold;
    }

    .accordion-button::after {
      filter: brightness(0) invert(1);
    }

    .accordion-body {
      background-color: rgba(255, 255, 255, 0.05);
      color: white;
      border-radius: 0 0 8px 8px;
    }

    .see-all-btn {
      background-color: #8CBC73;
      color: #1A1A18;
      font-weight: bold;
      border-radius: 8px;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .see-all-btn:hover {
      background-color: #77995e;
      color: white;
    }

    /* Figur */
    .faq-character {
      position: absolute;
      width: 338px;
      height: auto;
      bottom: 0;
      right: 40px;
      z-index: 2;
    }

    /* Sprechblase */
    .speech-bubble {
      position: absolute;
      width: 160px;
      bottom: 180px;
      /* feinjustiert */
      right: 220px;
      z-index: 1;
    }
  </style>


  <div class="container-fluid faq-section position-relative">
    <div class="container faq-content rounded-4 py-5 px-4">
      <h2 class="text-center text-white mb-4">Häufig gestellte Fragen</h2>

      <div class="accordion" id="faqAccordion">
        <!-- FAQ Items -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Let's embody your beautiful ideas together, simplify the way you visualize your next big things.
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Hier steht die Antwort oder Erklärung zu dieser Frage.
            </div>
          </div>
        </div>

        <!-- Kopiere für weitere Fragen -->
        <!-- FAQ 2, 3, 4 ... -->
      </div>

      <!-- Button unten -->
      <div class="text-center mt-4">
        <a href="#" class="btn see-all-btn px-5 py-2">More Questions</a>
      </div>
    </div>

    <!-- Figur + Sprechblase -->
    <img src="assits/img/opa.png" alt="FAQ Character" class="faq-character">
    <img src="assits/img/speech-bubble.svg" alt="Speech Bubble" class="speech-bubble">
  </div>
</div>


<div class="full-line"></div>
<!-- ---------------------------------------------------------------------------------------------- -->

<!-- 
<style>
  .updates-section {
    background-color: #151614;
    padding: 100px 40px 80px 40px;
    /* vorher 100px 0 80px 0 */
    margin-top: 60px;
  }


  .updates-heading h2 {
    color: white;
    font-size: 36px;
    font-weight: bold;
  }

  .update-card {
    background-color: #3f5535;
    border-radius: 16px;
    color: white;
    height: 100%;
  }

  .update-image {
    width: 100%;
    border-radius: 12px;
    object-fit: cover;
  }

  .update-text {
    color: #d3d3d3;
    font-size: 14px;
    margin-top: 10px;
  }
</style> -->



<!-- <div class="container-fluid updates-section">
  <div class="text-center updates-heading mb-5">
    <h2>Schedule One - <strong>Updates</strong></h2>
  </div> -->

  <!-- <div class="row justify-content-center g-4 px-5"> -->
    <!-- Card 1 -->
    <!-- <div class="col-md-4">
      <div class="update-card text-center p-4">
        <img src="assits/img/server-image.jpg" alt="Server" class="update-image mb-3">
        <h5 class="text-white mb-2">Lorem Ipsum</h5>
        <p class="update-text">During this process, some features are disabled, but all calculators...</p>
      </div>
    </div> -->

    <!-- Card 2 -->
    <!-- <div class="col-md-4">
      <div class="update-card text-center p-4">
        <img src="assits/img/server-image.jpg" alt="Server" class="update-image mb-3">
        <h5 class="text-white mb-2">Lorem Ipsum</h5>
        <p class="update-text">During this process, some features are disabled, but all calculators...</p>
      </div>
    </div> -->

    <!-- Card 3 -->
    <!-- <div class="col-md-4">
      <div class="update-card text-center p-4">
        <img src="assits/img/server-image.jpg" alt="Server" class="update-image mb-3">
        <h5 class="text-white mb-2">Lorem Ipsum</h5>
        <p class="update-text">During this process, some features are disabled, but all calculators...</p>
      </div>
    </div>
  </div>
</div> -->


<div class="full-line"></div>
<!-- ---------------------------------------------------------------------------------------------- -->

<style>
  .forum-highlight {
    position: relative;
    width: 100vw;
    /* ganze Viewport-Breite */
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    /* negiert zentrierendes Verhalten */
    margin-right: -50vw;

    height: 500px;
    background-image: url('assits/img/homebackroundimg2.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    display: flex;
    align-items: center;
    justify-content: center;
  }

  .overlay-content {
    width: 100%;
    max-width: 1200px;
    padding: 0 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .left-box {
    background-color: rgba(0, 0, 0, 0.6);
    padding: 30px;
    border-radius: 12px;
    color: white;
    max-width: 500px;
  }

  .left-box h2 {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .login-btn {
    background-color: #1A0D06;
    color: white;
    border: none;
    padding: 10px 30px;
    border-radius: 4px;
    font-weight: bold;
    text-decoration: none;
  }

  .login-btn:hover {
    background-color: #3a1a0c;
  }

  /* Rechte Box */
  .right-box {
    width: 200px;
    height: 250px;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 16px;
  }
</style>


<div class="forum-highlight">
  <div class="overlay-content">
    <div class="left-box">
      <h2>Explore most Viewed<br>Topics in our Forum</h2>
      <a href="index.php?page=login" class="btn login-btn">Login</a>
    </div>
    <div class="right-box"></div>
  </div>
</div>

<div class="full-line"></div>


<!-- ---------------------------------------------------------------------------------------------- -->

<style>
  .newsletter-section {
    background-color: #000;
    padding: 60px 20px;
    color: white;
  }

  .newsletter-heading {
    color: #8CBC73;
    font-weight: 600;
  }

  .newsletter-subtext {
    color: #aaa;
    font-size: 16px;
    margin-bottom: 30px;
  }

  .newsletter-form {
    gap: 10px;
    max-width: 500px;
    margin: 0 auto;
  }

  .email-input {
    border-radius: 6px;
    padding: 10px 15px;
    width: 70%;
    max-width: 300px;
  }

  .submit-btn {
    background-color: #53773D;
    color: white;
    font-weight: 500;
    padding: 10px 20px;
    border-radius: 6px;
    border: none;
  }

  .submit-btn:hover {
    background-color: #6b9151;
  }
</style>


<div class="newsletter-section">
  <div class="text-center mb-4">
    <h4 class="newsletter-heading">Follow to stay Updated</h4>
    <p class="newsletter-subtext">With our Weekly Newsletter</p>
  </div>
  <form class="newsletter-form d-flex justify-content-center">
    <input type="email" class="form-control email-input" placeholder="you@example.com" required>
    <button type="submit" class="btn submit-btn">Submit</button>
  </form>
</div>



<!-- ---------------------------------------------------------------------------------------------- -->