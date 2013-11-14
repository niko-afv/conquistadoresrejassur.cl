<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Conquistadores Rejas Sur</title>
        
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
            #main-content{
                height: 100%;
                width: 100%;
            }
            #main-content #center-content{
                display: block;
                height: auto;
                margin: 0 auto;
                min-width: 400px;
                position: relative;
                width: 50%;
            }
            #main-content #center-content #bckg-content{
                background: none repeat scroll 0 0 #DDDDDD;
                border: 1px solid;
                border-radius: 15px 15px 15px 15px;
                height: 355px;
                opacity: 0.7;
                position: absolute;
                width: 100%;
                z-index: 1;
            }
            #main-content #center-content #content{
                color: #222222;
                font-family: 'Cinzel',cursive;
                height: auto;
                padding: 0 0 0 25px;
                position: absolute;
                width: 92%;
                z-index: 10;
            }
            
            #subtitulo h2{
                margin-bottom: 0;
            }
            #subtitulo h3{
                margin: 0 auto;
                width: 100px;
            }
        </style>
    </head>
    <body>
        <img alt="full screen background image" src="/images/frontend/dia0_1_.jpg" id="full-screen-background-image" />
        
        <header>
            <img id="logo" src='/images/logo-completo2.png'/>
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
                            <strong>Reuniones :</strong><br/>
                            Sábados 16:30 hrs - 18:30 hrs.<br/>
                        </p>

                        <p>
                            Nos juntamos todas las semanas y compartimos, aprendemos cosas
                            nuevas, participamos de campamentos y muchas actividades entretenidas
                        </p>

                    </section>
                </div><!--Content-->
                <div id="bckg-content"></div>
                <div class="clear"></div>
            </section><!--Center Content-->
        </section><!--Main Content-->
        
        <footer>
            
        </footer>
    </body>
</html>