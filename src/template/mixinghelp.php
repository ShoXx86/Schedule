<?php
// mixinghelp.php (direkt einbindbar, ohne <html> und <body>)
?>
<!-- Mixing Help Styles: BEGIN -->
<style>
      /* Container zentriert und optisch abgesetzt */
      .mixinghelp-container {
            max-width: 1100px;
            margin: 44px auto 48px auto;
            background: #151815;
            border-radius: 16px;
            box-shadow: 0 0 32px #0005;
            padding: 36px 28px 28px 28px;
      }

      .mixinghelp-container h1 {
            text-align: center;
            color: #fd9d42;
            margin-bottom: 28px;
            font-size: 2.2rem;
            letter-spacing: 1.5px;
      }

      .mixinghelp-container h2 {
            color: #4ade80;
            margin-top: 34px;
            margin-bottom: 15px;
            font-size: 1.15rem;
      }

      .mixinghelp-container p,
      .mixinghelp-container li {
            color: #d5e7c0;
            line-height: 1.6;
      }

      .mixinghelp-infobox {
            background: #202620;
            border-left: 6px solid #4ade80;
            padding: 12px 18px;
            margin-bottom: 22px;
            border-radius: 8px;
      }

      .mixinghelp-infobox.orange {
            border-color: #fd9d42;
      }

      .mixinghelp-cardrow {
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
            margin-bottom: 24px;
            justify-content: center;
      }

      .mixinghelp-minicard {
            background: #161d16;
            border: 1.5px solid #232823;
            border-radius: 12px;
            padding: 14px 21px;
            color: #fd9d42;
            font-weight: 600;
            font-size: 1.06rem;
            box-shadow: 0 2px 16px #0003;
            text-align: center;
            min-width: 125px;
      }

      .mixinghelp-effectlist {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 10px 0 18px 0;
            justify-content: center;
      }

      .mixinghelp-effectbox {
            border: 1px solid #4ade80;
            border-radius: 8px;
            background: #181e18;
            color: #8cbc73;
            padding: 7px 14px 6px 14px;
            font-size: 0.97rem;
            margin-bottom: 2px;
            min-width: 145px;
            display: flex;
            align-items: center;
            justify-content: space-between;
      }

      .mixinghelp-formula,
      .mixinghelp-container code {
            background: #232823;
            color: #4ade80;
            border-radius: 4px;
            padding: 2px 7px;
            font-size: 1.04em;
            font-family: 'Consolas', monospace;
      }

      .mixinghelp-subgrid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 22px;
            margin-top: 22px;
      }

      .mixinghelp-subcard {
            background: #191c19;
            border-radius: 9px;
            border: 1px solid #232823;
            padding: 14px 13px 9px 16px;
            color: #fff;
            box-shadow: 0 2px 13px #0002;
            margin-bottom: 7px;
      }

      .mixinghelp-subcard h3 {
            color: #4da3ff;
            font-size: 1.02rem;
            margin: 0 0 7px 0;
            font-weight: 700;
      }

      .mixinghelp-subcard ul {
            margin: 0 0 0 18px;
            padding: 0;
            color: #ddeee5;
            font-size: 0.97rem;
      }

      .mixinghelp-subcard ul li {
            margin-bottom: 3px;
            line-height: 1.5;
      }

      @media (max-width: 820px) {
            .mixinghelp-container {
                  padding: 7vw 2vw 8vw 2vw;
            }

            .mixinghelp-effectbox {
                  min-width: 85px;
                  font-size: 0.96rem;
            }

            .mixinghelp-subgrid {
                  grid-template-columns: 1fr;
            }

            .mixinghelp-container h1 {
                  font-size: 1.23rem;
            }
      }
</style>
<!-- Mixing Help Styles: END -->

<div class="mixinghelp-container">
      <h1>How Mixing Works</h1>

      <div class="mixinghelp-infobox">
            <strong>Jede Substanz bringt einen einzigartigen Effekt in den Mix.</strong><br>
            Es gibt feste Regeln, wie Substanzen und ihre Effekte miteinander interagieren.<br>
            <br>
            <b>Ablauf beim Mixen:</b>
            <ul>
                  <li>Die Substanz gibt vor, wie Effekte transformiert/ersetzt werden.</li>
                  <li>Nach Abschluss des Mixes fügt die Basissubstanz ggf. ihren <b>Default</b>-Effekt hinzu (nur wenn noch Platz ist).</li>
                  <li>Jeder „Strain“ (Mix) kann maximal <b>8 Effekte</b> gleichzeitig besitzen.</li>
            </ul>
      </div>

      <h2>How Pricing Works</h2>
      <div style="color: #8bc9a1ff" class="mixinghelp-infobox orange">
            <b>Preisberechnung:</b><br>
            <span class="mixinghelp-formula">Final Price = Base Price × (1 + total effect multiplier)</span>
            <br><br>
            <b>Base Prices:</b> Weed: <span class="mixinghelp-formula">$35</span>,
            Meth: <span class="mixinghelp-formula">$70</span>,
            Cocaine: <span class="mixinghelp-formula">$150</span><br>
            <b>Effect Multiplier:</b> Jeder Effekt addiert einen Multiplikator auf den Grundpreis.<br>
            <b>Beispiel:</b> Enthält ein Mix die Effekte <b>Athletic</b> (<span class="mixinghelp-formula">0.32</span>) und <b>Tropic Thunder</b> (<span class="mixinghelp-formula">0.46</span>):<br>
            <span class="mixinghelp-formula">$35 × (1 + 0.32 + 0.46) = $62</span>
      </div>

      <h2>Effekte und ihre Multiplikatoren</h2>
      <div class="mixinghelp-cardrow">
            <div class="mixinghelp-minicard">Weed<br><span style="color:#4ade80;">Base Price: $35</span></div>
            <div class="mixinghelp-minicard">Meth<br><span style="color:#4ade80;">Base Price: $70</span></div>
            <div class="mixinghelp-minicard">Cocaine<br><span style="color:#4ade80;">Base Price: $150</span></div>
      </div>
      <div class="mixinghelp-effectlist">
            <div class="mixinghelp-effectbox">Anti-Gravity <span>x0.54</span></div>
            <div class="mixinghelp-effectbox">Athletic <span>x0.32</span></div>
            <div class="mixinghelp-effectbox">Balding <span>x0.30</span></div>
            <div class="mixinghelp-effectbox">Bright-Eyed <span>x0.40</span></div>
            <div class="mixinghelp-effectbox">Calming <span>x0.10</span></div>
            <div class="mixinghelp-effectbox">Calorie-Dense <span>x0.28</span></div>
            <div class="mixinghelp-effectbox">Cyclopean <span>x0.56</span></div>
            <div class="mixinghelp-effectbox">Disorienting <span>x0.00</span></div>
            <div class="mixinghelp-effectbox">Electrifying <span>x0.50</span></div>
            <div class="mixinghelp-effectbox">Energizing <span>x0.22</span></div>
            <div class="mixinghelp-effectbox">Euphoric <span>x0.18</span></div>
            <div class="mixinghelp-effectbox">Explosive <span>x0.00</span></div>
            <div class="mixinghelp-effectbox">Focused <span>x0.16</span></div>
            <div class="mixinghelp-effectbox">Foggy <span>x0.36</span></div>
            <div class="mixinghelp-effectbox">Gingeritis <span>x0.20</span></div>
            <div class="mixinghelp-effectbox">Glowing <span>x0.48</span></div>
            <div class="mixinghelp-effectbox">Jennerising <span>x0.42</span></div>
            <div class="mixinghelp-effectbox">Laxative <span>x0.00</span></div>
            <div class="mixinghelp-effectbox">Long Faced <span>x0.52</span></div>
            <div class="mixinghelp-effectbox">Munchies <span>x0.12</span></div>
            <div class="mixinghelp-effectbox">Paranoia <span>x0.00</span></div>
            <div class="mixinghelp-effectbox">Refreshing <span>x0.14</span></div>
            <div class="mixinghelp-effectbox">Schizophrenia <span>x0.00</span></div>
            <div class="mixinghelp-effectbox">Sedating <span>x0.26</span></div>
            <div class="mixinghelp-effectbox">Seizure-Inducing <span>x0.00</span></div>
            <div class="mixinghelp-effectbox">Shrinking <span>x0.60</span></div>
            <div class="mixinghelp-effectbox">Slippery <span>x0.34</span></div>
            <div class="mixinghelp-effectbox">Smelly <span>x0.00</span></div>
            <div class="mixinghelp-effectbox">Sneaky <span>x0.24</span></div>
            <div class="mixinghelp-effectbox">Spicy <span>x0.38</span></div>
            <div class="mixinghelp-effectbox">Thought-Provoking <span>x0.44</span></div>
            <div class="mixinghelp-effectbox">Toxic <span>x0.00</span></div>
            <div class="mixinghelp-effectbox">Tropic Thunder <span>x0.46</span></div>
            <div class="mixinghelp-effectbox">Zombifying <span>x0.58</span></div>
      </div>

      <h2>Substanzen mit besonderen Wechselwirkungen</h2>
      <div class="mixinghelp-subgrid">
            <div class="mixinghelp-subcard">
                  <h3>Cuke <span style="color:#fd9d42;">Energizing — Weed: ~$43, Meth: ~$85, Cocaine: ~$183</span></h3>
                  <ul>
                        <li>If Euphoric present, then replace Euphoric with Laxative.</li>
                        <li>If Foggy present, then replace Foggy with Cyclopean.</li>
                        <li>If Gingeritis present, then replace Gingeritis with Thought-Provoking.</li>
                        <li>If Munchies present, then replace Munchies with Athletic.</li>
                        <li>If Slippery present, then replace Slippery with Munchies.</li>
                        <li>If Sneaky present, then replace Sneaky with Paranoia.</li>
                        <li>If Toxic present, then replace Toxic with Euphoric.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Flu Medicine <span style="color:#fd9d42;">Sedating — Weed: ~$44, Meth: ~$88, Cocaine: ~$189</span></h3>
                  <ul>
                        <li>If Athletic present, then replace Athletic with Munchies.</li>
                        <li>If Calming present, then replace Calming with Bright-Eyed.</li>
                        <li>If Cyclopean present, then replace Cyclopean with Foggy.</li>
                        <li>If Electrifying present, then replace Electrifying with Refreshing.</li>
                        <li>If Euphoric present, then replace Euphoric with Toxic.</li>
                        <li>If Focused present, then replace Focused with Calming.</li>
                        <li>If Laxative present, then replace Laxative with Euphoric.</li>
                        <li>If Munchies present, then replace Munchies with Slippery.</li>
                        <li>If Shrinking present, then replace Shrinking with Paranoia.</li>
                        <li>If Thought-Provoking present, then replace Thought-Provoking with Gingeritis.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Gasoline <span style="color:#fd9d42;">Toxic — Weed: ~$35, Meth: ~$70, Cocaine: ~$150</span></h3>
                  <ul>
                        <li>If Disorienting present, then replace Disorienting with Glowing.</li>
                        <li>If Electrifying present, then replace Electrifying with Disorienting.</li>
                        <li>If Energizing present, then replace Energizing with Euphoric.</li>
                        <li>If Euphoric present, then replace Euphoric with Spicy.</li>
                        <li>If Gingeritis present, then replace Gingeritis with Smelly.</li>
                        <li>If Jennerising present, then replace Jennerising with Sneaky.</li>
                        <li>If Laxative present, then replace Laxative with Foggy.</li>
                        <li>If Munchies present, then replace Munchies with Sedating.</li>
                        <li>If Paranoia present, then replace Paranoia with Calming.</li>
                        <li>If Shrinking present, then replace Shrinking with Focused.</li>
                        <li>If Sneaky present, then replace Sneaky with Tropic Thunder.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Donut <span style="color:#fd9d42;">Calorie-Dense — Weed: ~$45, Meth: ~$90, Cocaine: ~$192</span></h3>
                  <ul>
                        <li>If Anti-Gravity present, then replace Anti-Gravity with Slippery.</li>
                        <li>If Balding present, then replace Balding with Sneaky.</li>
                        <li>If Calorie-Dense present, then replace Calorie-Dense with Explosive.</li>
                        <li>If Focused present, then replace Focused with Euphoric.</li>
                        <li>If Jennerising present, then replace Jennerising with Gingeritis.</li>
                        <li>If Munchies present, then replace Munchies with Calming.</li>
                        <li>If Shrinking present, then replace Shrinking with Energizing.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Energy Drink <span style="color:#fd9d42;">Athletic — Weed: ~$46, Meth: ~$92, Cocaine: ~$198</span></h3>
                  <ul>
                        <li>If Disorienting present, then replace Disorienting with Electrifying.</li>
                        <li>If Euphoric present, then replace Euphoric with Energizing.</li>
                        <li>If Focused present, then replace Focused with Shrinking.</li>
                        <li>If Foggy present, then replace Foggy with Laxative.</li>
                        <li>If Glowing present, then replace Glowing with Disorienting.</li>
                        <li>If Schizophrenia present, then replace Schizophrenia with Balding.</li>
                        <li>If Sedating present, then replace Sedating with Munchies.</li>
                        <li>If Spicy present, then replace Spicy with Euphoric.</li>
                        <li>If Tropic Thunder present, then replace Tropic Thunder with Sneaky.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Mouth Wash <span style="color:#fd9d42;">Balding — Weed: ~$46, Meth: ~$91, Cocaine: ~$195</span></h3>
                  <ul>
                        <li>If Calming present, then replace Calming with Anti-Gravity.</li>
                        <li>If Calorie-Dense present, then replace Calorie-Dense with Sneaky.</li>
                        <li>If Explosive present, then replace Explosive with Sedating.</li>
                        <li>If Focused present, then replace Focused with Jennerising.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Motor Oil <span style="color:#fd9d42;">Slippery — Weed: ~$47, Meth: ~$94, Cocaine: ~$201</span></h3>
                  <ul>
                        <li>If Energizing present, then replace Energizing with Munchies.</li>
                        <li>If Euphoric present, then replace Euphoric with Sedating.</li>
                        <li>If Foggy present, then replace Foggy with Toxic.</li>
                        <li>If Munchies present, then replace Munchies with Schizophrenia.</li>
                        <li>If Paranoia present, then replace Paranoia with Anti-Gravity.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Banana <span style="color:#fd9d42;">Gingeritis — Weed: ~$42, Meth: ~$84, Cocaine: ~$180</span></h3>
                  <ul>
                        <li>If Calming present, then replace Calming with Sneaky.</li>
                        <li>If Cyclopean present, then replace Cyclopean with Energizing.</li>
                        <li>If Disorienting present, then replace Disorienting with Focused.</li>
                        <li>If Energizing present, then replace Energizing with Thought-Provoking.</li>
                        <li>If Focused present, then replace Focused with Seizure-Inducing.</li>
                        <li>If Long Faced present, then replace Long Faced with Refreshing.</li>
                        <li>If Paranoia present, then replace Paranoia with Jennerising.</li>
                        <li>If Smelly present, then replace Smelly with Anti-Gravity.</li>
                        <li>If Toxic present, then replace Toxic with Smelly.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Chili <span style="color:#fd9d42;">Spicy — Weed: ~$48, Meth: ~$97, Cocaine: ~$207</span></h3>
                  <ul>
                        <li>If Anti-Gravity present, then replace Anti-Gravity with Tropic Thunder.</li>
                        <li>If Athletic present, then replace Athletic with Euphoric.</li>
                        <li>If Laxative present, then replace Laxative with Long Faced.</li>
                        <li>If Munchies present, then replace Munchies with Toxic.</li>
                        <li>If Shrinking present, then replace Shrinking with Refreshing.</li>
                        <li>If Sneaky present, then replace Sneaky with Bright-Eyed.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Iodine <span style="color:#fd9d42;">Jennerising — Weed: ~$50, Meth: ~$99, Cocaine: ~$213</span></h3>
                  <ul>
                        <li>If Calming present, then replace Calming with Balding.</li>
                        <li>If Calorie-Dense present, then replace Calorie-Dense with Gingeritis.</li>
                        <li>If Euphoric present, then replace Euphoric with Seizure-Inducing.</li>
                        <li>If Foggy present, then replace Foggy with Paranoia.</li>
                        <li>If Refreshing present, then replace Refreshing with Thought-Provoking.</li>
                        <li>If Toxic present, then replace Toxic with Sneaky.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Paracetamol <span style="color:#fd9d42;">Sneaky — Weed: ~$43, Meth: ~$87, Cocaine: ~$186</span></h3>
                  <ul>
                        <li>If Calming present, then replace Calming with Slippery.</li>
                        <li>If Electrifying present, then replace Electrifying with Athletic.</li>
                        <li>If Energizing present, then replace Energizing with Paranoia.</li>
                        <li>If Focused present, then replace Focused with Gingeritis.</li>
                        <li>If Foggy present, then replace Foggy with Calming.</li>
                        <li>If Glowing present, then replace Glowing with Toxic.</li>
                        <li>If Munchies present, then replace Munchies with Anti-Gravity.</li>
                        <li>If Paranoia present, then replace Paranoia with Balding.</li>
                        <li>If Spicy present, then replace Spicy with Bright-Eyed.</li>
                        <li>If Toxic present, then replace Toxic with Tropic Thunder.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Viagra <span style="color:#fd9d42;">Tropic Thunder — Weed: ~$51, Meth: ~$102, Cocaine: ~$219</span></h3>
                  <ul>
                        <li>If Athletic present, then replace Athletic with Sneaky.</li>
                        <li>If Disorienting present, then replace Disorienting with Toxic.</li>
                        <li>If Euphoric present, then replace Euphoric with Bright-Eyed.</li>
                        <li>If Laxative present, then replace Laxative with Calming.</li>
                        <li>If Shrinking present, then replace Shrinking with Gingeritis.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Horse Semen <span style="color:#fd9d42;">Long Faced — Weed: ~$53, Meth: ~$106, Cocaine: ~$228</span></h3>
                  <ul>
                        <li>If Anti-Gravity present, then replace Anti-Gravity with Calming.</li>
                        <li>If Gingeritis present, then replace Gingeritis with Refreshing.</li>
                        <li>If Seizure-Inducing present, then replace Seizure-Inducing with Energizing.</li>
                        <li>If Thought-Provoking present, then replace Thought-Provoking with Electrifying.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Mega Bean <span style="color:#fd9d42;">Foggy — Weed: ~$48, Meth: ~$95, Cocaine: ~$204</span></h3>
                  <ul>
                        <li>If Athletic present, then replace Athletic with Laxative.</li>
                        <li>If Calming present, then replace Calming with Glowing.</li>
                        <li>If Energizing present, then replace Energizing with Cyclopean.</li>
                        <li>If Focused present, then replace Focused with Disorienting.</li>
                        <li>If Jennerising present, then replace Jennerising with Paranoia.</li>
                        <li>If Seizure-Inducing present, then replace Seizure-Inducing with Focused.</li>
                        <li>If Shrinking present, then replace Shrinking with Electrifying.</li>
                        <li>If Slippery present, then replace Slippery with Toxic.</li>
                        <li>If Sneaky present, then replace Sneaky with Calming.</li>
                        <li>If Thought-Provoking present, then replace Thought-Provoking with Energizing.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Addy <span style="color:#fd9d42;">Thought-Provoking — Weed: ~$50, Meth: ~$101, Cocaine: ~$216</span></h3>
                  <ul>
                        <li>If Explosive present, then replace Explosive with Euphoric.</li>
                        <li>If Foggy present, then replace Foggy with Energizing.</li>
                        <li>If Glowing present, then replace Glowing with Refreshing.</li>
                        <li>If Long Faced present, then replace Long Faced with Electrifying.</li>
                        <li>If Sedating present, then replace Sedating with Gingeritis.</li>
                  </ul>
            </div>
            <div class="mixinghelp-subcard">
                  <h3>Battery <span style="color:#fd9d42;">Bright-Eyed — Weed: ~$49, Meth: ~$98, Cocaine: ~$210</span></h3>
                  <ul>
                        <li>If Cyclopean present, then replace Cyclopean with Glowing.</li>
                        <li>If Electrifying present, then replace Electrifying with Euphoric.</li>
                        <li>If Euphoric present, then replace Euphoric with Zombifying.</li>
                        <li>If Laxative present, then replace Laxative with Calorie-Dense.</li>
                        <li>If Munchies present, then replace Munchies with Tropic Thunder.</li>
                        <li>If Shrinking present, then replace Shrinking with Munchies.</li>
                  </ul>
            </div>
      </div>


</div>