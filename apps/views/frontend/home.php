<!DOCTYPE html>
<html lang="es">
    <head>
        
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
        
        <meta charset="utf-8"/>
        <title>Conquistadores Rejas Sur</title>
        
        <!--FavoIcon-->
        <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico"/>
        
        <link href='http://fonts.googleapis.com/css?family=Spirax|Cinzel|Handlee|Sail' rel='stylesheet' type='text/css'>
        
        <style type="text/css">            
            .clear{
                clear: both;
            }
            html, body {
                height: 100%;
                width: 100%;
                padding: 0;
                margin: 0;
            }

            #full-screen-background-image {
                height: 100%;
                left: 0;
                min-height: 800px;
                min-width: 1200px;
                position: fixed;
                top: 0;
                width: 100%;
                z-index: -999;
            }
            header h1{
                color: #10162C;
                font-family: 'Cinzel',cursive;
                font-size: 35px;
                font-weight: bold;
                margin-left: 4%;
            }
            header #logo{
                display: block;
                margin: 0 auto;
                opacity: 0.7;
                width: 340px;
            }
            footer #social-extra{
                margin: 0 auto;
                width: 110px;
            }
            #main-content{
                height: 100%;
                position: relative;
                width: 100%;
            }
            #main-content #center-content{
                display: block;
                height: auto;
                margin: 0 auto;
                /*min-width: 400px;*/
                position: relative;
                width: 45%;
            }
            #main-content #center-content #bckg-content{
                background: none repeat scroll 0 0 #DDDDDD;
                border: 1px solid;
                border-radius: 15px 15px 15px 15px;
                height: 355px;
                opacity: 0.7;
                padding: 0 3%;
                position: absolute;
                width: 95%;
                z-index: 1;
            }
            #main-content #center-content #content{
                color: #222222;
                font-family: 'Cinzel',cursive;
                height: auto;
                padding: 0 3%;
                position: absolute;
                width: 95%;
                z-index: 10;
            }
            #content #social-bar{
                display: block;
                margin: 0 auto;
                padding: 0;
                width: 32px;
            }
            #content #social-bar li{
                display: block;
                float: left;
                list-style: none outside none;
            }
            #content #social-bar li a{
                background: url(/images/facebook-logox32.png);
                display: block;
                height: 32px;
                outline: none;
                width: 32px;
            }
            #subtitulo h2{
                margin-bottom: 0;
                text-align: center;
            }
            #subtitulo h3{
                margin: 0 auto;
                width: 100px;
            }
            section #text{
                text-align: justify;
                font-size: 1.0em;
            }
            
            
            @media screen and (max-width:640px){
                #main-content #center-content{
                    min-width: 85%;
                    padding: 0 10px;
                    width: 90%;
                }
                #main-content #center-content #content{
                    width: 90%;
                }
                #main-content #center-content #bckg-content{
                    width: 90%;
                }
                #full-screen-background-image {
                    
                }
            }
            @media screen and (max-width:360px){
                #main-content #center-content{
                    min-width: 85%;
                    padding: 0 10px;
                    width: 90%;
                }
                #main-content #center-content #content{
                    width: 90%;
                }
                #main-content #center-content #bckg-content{
                    width: 90%;
                }
                #full-screen-background-image {
                    
                }
            }  
            @media screen and (max-width:320px){
                img#logo{
                    width: 150px;
                }
            }
        </style>
        
        <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
        
        <script>
            function resizeBckg(){
                var alto = $("#content").height();
                $("#bckg-content").height(alto+10);
            }
            
            $(window).load(function(){
                resizeBckg();
                $(window).resize(function(){
                    resizeBckg();
                })
            })
        </script>
    </head>
    <body>
        <img alt="full screen background image" src="/images/frontend/dia0_1_.jpg" id="full-screen-background-image" />
        
        <header>
            <img id="logo" src='/images/logo-completo2.png'/>
            <img style="display: none" id="logo2" src='/images/logo-completo.png'/>
        </header>
        
        <section id="main-content">
            
            <section id="center-content">
                <div id="content">
                    <section id="subtitulo">
                        <h2>Web Site Conquistadores Rejas Sur 2.0</h2>
                        <h3>PRONTO!!!</h3>
                    </section>

                    <section id="text">
                        <p>
                            Te Invitamos a participar de nuestro Club de Conquistadores, somos
                            de la Iglesia Adventista del Septimo Día (IASD) Rejas Sur y pertenecemos
                            a la Zona Poniente de la Asociación Metropolitana de Chile (AMCH).
                        </p>

                        <p>
                            <strong>Reuniones :</strong>
                            <br/>
                            Domingos 10:30 hrs<br/>
                        </p>

                        <p>
                            Nos juntamos todas las semanas a compartir, aprendemos cosas
                            nuevas, participamos de campamentos y muchas actividades entretenidas.
                        </p>
                        
                    </section>
                    
                    <ul id="social-bar">
                        <li><a href="https://www.facebook.com/conquistadores.rejassur" target="_blank"><!--<img alt="FaceBook" src="" />--></a></li>
                    </ul>
                    
                </div><!--Content-->
                <div id="bckg-content"></div>
                <div class="clear"></div>                
            </section><!--Center Content-->
        </section><!--Main Content-->
        
        <footer>
            <div id="social-extra">
                <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fconquistadoresrejassur.cl%2F&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
            </div>
        </footer>
        
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-45653917-1', 'conquistadoresrejassur.cl');
            ga('send', 'pageview');
        </script>
    </body>
</html>