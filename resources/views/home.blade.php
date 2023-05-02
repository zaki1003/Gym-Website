@extends('layouts.home-layout')
@section('content')


    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hs-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                            <div class="hi-text">
                                <span>VOTRE SALLE DE SPORT À NIMES</span>
                                <h1>L’équipe de votre salle <strong>GYM UP</strong> vous souhaite la bienvenue.</h1>
           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hs-item set-bg" data-setbg="img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                            <div class="hi-text">
                                
                                <h1>Le <strong>Fitness</strong> C’EST ESSENTIEL !</h1>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- ChoseUs Section Begin -->
    <section class="choseus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>POURQUOI GYM UP ?</span>
                        <h2>REPOUSSER VOS LIMITES</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-034-stationary-bike"></span>
                        <h4>Équipement moderne</h4>
                        <p>Dans notre club, vous pouvez trouver les équipements les plus récents de Matrix et TechnoGym</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-033-juice"></span>
                        <h4>YANGA Sports Water</h4>
                        <p>La boisson sportive YANGA Sports Water est une eau sans sucre et enrichie en vitamines essentielles.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-002-dumbell"></span>
                        <h4>Plan d'entrainement professionnel</h4>
                        <p>Quel que soit votre niveau d'expérience, c'est toujours agréable de pouvoir demander de l'aide.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-014-heart-beat"></span>
                        <h4>Unique à vos besoins</h4>
                        <p>Tout ce dont vous avez besoin pour un entraînement parfait !</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->

    <!-- Classes Section Begin -->
    <section class="classes-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>REPOUSSER VOS LIMITES</span>
                        <h2>EQUIPEMENT & STUDIO</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/accueil/salle-cardio.jpg" usemap="#cardios" alt="ESPACE CARDIO">
                            <map name="cardios">
                                <area shape="rect" coords="4,7,609,439" href="class-details.html" alt="ESPACE CARDIO">
                            </map>
                        </div>
                        <div class="ci-text">
                            <span>Espace</span>
                            <h5>Cardio</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/accueil/salle-renfo.jpg" usemap="#renfos" alt="">
                            <map name="renfos">
                                <area shape="rect" coords="4,7,609,439" href="class-details.html" alt="">
                            </map>
                        </div>
                        <div class="ci-text">
                            <span>Espace</span>
                            <h5>Renforcement</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/accueil/salle-stretching.jpg" usemap="#stretchs" alt="">
                            <map name="stretchs">
                                <area shape="rect" coords="4,7,609,439" href="class-details.html" alt="">
                            </map>
                        </div>
                        <div class="ci-text">
                            <span>Espace</span>
                            <h5>Stretching</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/accueil/salle-studiogym.jpg" usemap="#studios"alt="">
                            <map name="studios">
                                <area shape="rect" coords="4,7,609,439" href="class-details.html" alt="">
                            </map>
                        </div>
                        <div class="ci-text">
                            <span>Studio</span>
                            <h4>Gym</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="img/accueil/salle-bike.jpg" usemap="#salles" alt="">
                            <map name="salles">
                                <area shape="rect" coords="4,7,609,439" href="class-details.html" alt="">
                            </map>
                        </div>
                        <div class="ci-text">
                            <span>Studio</span>
                            <h4>Bike</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->

@endsection