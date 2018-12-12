<!DOCTYPE html>

<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="CSS/home.css" type="text/css">
   <link href="CSS/footer.css" rel="stylesheet">
    <link href="CSS/header.css" rel="stylesheet">



    <title>Style Editor</title>


    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body>

  <?php include "header.html";?>



    <main>
          <div class="slideshow">


        <div class="slide fade">

            <a href="eventstyling.html"> <img src="img/event-03.png" alt=""></a>

        </div>
        <div class="slide fade">

            <a href="boligstyling.html"><img src="img/bolig-01.png" alt=""></a>

        </div>
        <div class="slide fade">

            <a href="webshop.html"> <img src="img/shop-02.png" alt=""></a>

        </div>

    </div>


        <button onclick="topFunction()" id="button" title="Go to top">⥣</button>

        <section class="intro" data-container></section>






        <template data-template>
            <article class="stylingeventListview">
                <h1 class="heading" data-title></h1>

                <p class="description" data-text></p>






            </article>
        </template>

        <section class="nyt_event" data-container1></section>
        <template data-template1>
            <article class="projektListview">

                <div class="row1">

                    <div class="column1">
                        <img src="" alt="">


                    </div>

                    <div class="column">
                        <h1 class="heading_events" data-title1></h1>
                        <p class="description" data-text></p>

                    </div>


                </div>



            </article>
        </template>




        <section class="container2" data-container2></section>
        <template data-template2>

            <article class="videoListview">
                <!--INTERAKTIV SVG   -->

                <div id="santa_container">

                    <div class="tooltip">
                        <span class="tooltiptext">Har du husket alle julegaverne? - nej! så tryk på mig og jeg vil hjælpe dig til at finde de sidste par gaver. </span>
                        <a href="webshop.html">
                            <div id="santa_sprite"></div>
                        </a>

                    </div>




                </div>


                <a href="om.html">
                    <p data-title2></p>
                    <video data-video src="" type=""></video>
                </a>
            </article>
        </template>


    </main>


    <script>
        let slideNumber = 1;
        let slides = document.querySelectorAll(".slide");

        function showSlides(n) {
            let i;
            if (n > slides.length) {
                slideNumber = 1
            }
            if (n < 1) {
                slideNumber = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideNumber - 1].style.display = "block";
        }
        showSlides(slideNumber);
        console.log(slides.length);

        function plusOne(n) {
            showSlides(slideNumber += n);
        }

        function autoSlide() {
            console.log(slideNumber);
            if (slideNumber <= slides.length) {
                slideNumber++;
            }
            if (slideNumber > slides.length) {
                slideNumber = 1;
            }
            showSlides(slideNumber);
        }
        setInterval(autoSlide, 4000);


        //        OM side


        document.addEventListener("DOMContentLoaded", getJson);

        let intro;

        let introTemplate = document.querySelector("[data-template]");
        let introContainer = document.querySelector("[data-container]");

        let allEvents;

        let eventTemplate = document.querySelector("[data-template1]");
        let eventContainer =
            document.querySelector("[data-container1]");


        let youtubevideo;

        let videoTemplate = document.querySelector("[data-template2]");
        let videoContainer = document.querySelector("[data-container2]");

        //---------Hent Json------------

        async function getJson() {
            let jsonData = await fetch("http://milleprintzlau.dk/2.semester/styleeditor_site/wordpress/wp-json/wp/v2/forside?slug=style-editor-tekst");
            intro = await jsonData.json();
            visIntro();
            console.log(intro);

            let jsonData1 = await fetch("http://milleprintzlau.dk/2.semester/styleeditor_site/wordpress/wp-json/wp/v2/forside?slug=71")
            allEvents = await jsonData1.json();
            visEvents();
            console.log(allEvents);

            let jsonData2 = await fetch("http://milleprintzlau.dk/2.semester/styleeditor_site/wordpress/wp-json/wp/v2/forside?slug=74")
            youtubevideo = await jsonData2.json();
            visVideo();
            console.log(youtubevideo);



        }

        //-------functions--------------

        function visIntro() {
            console.log(intro);
            intro.forEach(intro => {
                let klon = introTemplate.cloneNode(true).content;
                klon.querySelector("[data-title]").textContent = intro.title.rendered;
                klon.querySelector("[data-text]").innerHTML = intro.content.rendered;
                introContainer.appendChild(klon);
            })
        }

        function visEvents() {
            console.log(allEvents);
            allEvents.forEach(events => {
                let klon = eventTemplate.cloneNode(true).content;
                klon.querySelector("[data-title1]").textContent = events.title.rendered;
                klon.querySelector("[data-text]").innerHTML = events.content.rendered;
                klon.querySelector("img").src = events.acf.image;
                eventContainer.appendChild(klon);
            })
        }

        function visVideo() {
            console.log(youtubevideo);
            youtubevideo.forEach(youtubevideo => {
                let klon = videoTemplate.cloneNode(true).content;
                klon.querySelector("[data-title2]").innerHTML = youtubevideo.content.rendered;

                klon.querySelector("[data-video]").content = youtubevideo.content.rendered;

                videoContainer.appendChild(klon);
            })
        }

        //-----------til toppen knappen-----------

        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("button").style.display = "block";
            } else {
                document.getElementById("button").style.display = "none";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

    </script>


    <?php include "footer.html";?>





</body>

</html>
