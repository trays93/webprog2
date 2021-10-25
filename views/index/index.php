<style>
.col-sm-12.countdown {
  background-color: #e9ecef;
  margin: 0 auto;
  padding: 10px 0px;
  text-align: center;
}

.col-sm-12 {
    margin: 20px 0;
}


h2 {
  font-weight: normal;
  letter-spacing: .125rem;
  text-transform: uppercase;
}

.timer.li {
  display: inline-block;
  font-size: 1.5em;
  list-style-type: none;
  padding: 1em;
  text-transform: uppercase;
}

.timer.span {
  display: block;
  font-size: 4.5rem;
}

@media all and (max-width: 768px) {
h2 {
    font-size: calc(1.5rem * var(--smaller));
  }
  
.timer.li {
    font-size: calc(1.125rem * var(--smaller));
  }
  
.timer.span {
    font-size: calc(3.375rem * var(--smaller));
  }
}
</style>

<div class="jumbotron text-center">
  <h1>Hatoslottó</h1>
</div>
<div class="container">
  <div class="row" style="margin: 20px 0px;">
    <div class="col-sm-12">
        <h3 style="text-align: center;">Weboldalak célja</h3>
        <p>Ezen weboldalak egyetemi projektmunka keretein belül készültek el Lovas Bálint és Fekete Zoltán által. Témaválasztásunk a Hatoslottóra esett, melyet a Szerencsejáték Zrt. Hatoslottó weboldala alapján építettünk fel <a href="https://bet.szerencsejatek.hu/jatekok/hatoslotto">(eredeti honlap)</a>.</p>
    </div>
    <div class="col-sm-12 countdown">
        <h2 id="headline" style="margin: 20px 0 0 0;">A következő sorsolás: vasárnap 16:00 (DUNA TV)</h2>
        <div id="countdown">
            <ul>
                <li class="timer li"><span id="days" class="timer span"></span>days</li>
                <li class="timer li"><span id="hours" class="timer span"></span>Hours</li>
                <li class="timer li"><span id="minutes" class="timer span"></span>Minutes</li>
                <li class="timer li"><span id="seconds" class="timer span"></span>Seconds</li>
            </ul>
            <p id="demo"></p>
        </div>
    </div> 
  </div>
</div>

<script type="text/javascript">
        window.onload = counter;

        //Egy visszaszámláló függvény, ami minden vasárnap délután 4 óráig számol vissza
        function counter() {
            setInterval(function()
            {   
                //Alapértékek meghatározása
                const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;
                const now = new Date();

                //Mostani és cél idő összesítve egy hétre milisecundumban
                goal = 6*day + 16*hour;
                today = (now.getDay()-1)*day + now.getHours()*hour + now.getMinutes()*minute + now.getSeconds()*second;
                distance = goal - today;

                //A különbség visszaosztása és kiíratása
                document.getElementById("days").innerText = Math.floor(distance / (day)) < 10 ? "0" + String(Math.floor(distance / (day))) : Math.floor(distance / (day)),
                document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)) < 10 ? "0" + Math.floor((distance % (day)) / (hour)) : Math.floor((distance % (day)) / (hour)),
                document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)) < 10 ? "0" + Math.floor((distance % (hour)) / (minute)) : Math.floor((distance % (hour)) / (minute)),
                document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second) < 10 ? "0" + Math.floor((distance % (minute)) / second) : Math.floor((distance % (minute)) / second);

        
            }, 1)
        };
</script>