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