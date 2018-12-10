<!DOCTYPE html>

<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css" type="text/css">
    <title>Style Editor forside</title>
</head>

<body>
    <?php include "header.html";?>

    <div class="slideshow">


        <div class="slide fade">

            <img src="img/event-01.png" alt="">

        </div>
        <div class="slide fade">

            <img src="img/bolig-02.png" alt="">

        </div>
        <div class="slide fade">

            <img src="img/shop-03.png" alt="">

        </div>

    </div>


    <main>

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
                <p data-title2></p>
                <video data-video src="" type=""></video>
            </article>
        </template>

    </main>

    <?php include "footer.html";?>



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
    </script>

</body>

</html>