@extends('layouts.home-layout')
@section('content')


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb-bg.jpg"></section>
<!-- Breadcrumb Section End -->

    <!-- About US Section Begin -->
    <section class="aboutus-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="about-video set-bg" data-setbg="img/about-us.jpg">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="about-text">
                        <div class="section-title">
                            <span>À PROPOS DE NOUS</span>
                            <h2>Ce que nous avons fait</h2>
                        </div>
                        <div class="at-desc">
                            <p>La douleur est l'amour même
                                comme la fatigue et l'obésité. Qui suspend l'enfant vengeur. Rire s'il vous plait
                                le lac ou la facilité il est important d'atteindre les objectifs de la marchandise
                                les principaux problèmes écologiques, mais je lui donne du temps.</p>
                        </div>
                        <div class="about-bar">
                            <div class="ab-item">
                                <p>Body building</p>
                                <div id="bar1" class="barfiller">
                                    <span class="fill" data-percentage="80"></span>
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="ab-item">
                                <p>Entraînement</p>
                                <div id="bar2" class="barfiller">
                                    <span class="fill" data-percentage="85"></span>
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="ab-item">
                                <p>Fitness</p>
                                <div id="bar3" class="barfiller">
                                    <span class="fill" data-percentage="75"></span>
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About US Section End -->


    <!-- Banner Section Begin -->
    <section class="banner-section set-bg" data-setbg="img/banner-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="bs-text">
                        <h2>TA PREMIÈRE SÉANCE OFFERTE !</h2>
                        <div class="bt-tips">L’équipe de votre salle <strong>GYM UP</strong> vous souhaite la bienvenue.</div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Vos avis comptent</span>
                        <h2>Bienvenue</h2>
                    </div>
                </div>
            </div>
            <div class="ts_slider owl-carousel">
                <div class="ts_item">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="ti_pic">
                                <img src="img/testimonial/testimonial-1.jpg" alt="">
                            </div>
                            <div class="ti_text">
                                <p>Salle de sport très bien agencée.
                                    Personnel très sympathique.
                                    Manque peut-être une deuxième machine pour les squats car très souvent occupée et une machine pour les mollets mais très bien dans l&apos;ensemble.
                                    Le samedi la salle ferme un peu tôt.
                                    A part ça je ne vois pas de point négatif.
                                    Vive le sport, que du bonheur.<br /> Vive le sport, que du bonheur.</p>
                                <h5>Lee Stokes</h5>
                                <div class="tt-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ts_item">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="ti_pic">
                                <img src="img/testimonial/testimonial-2.jpg" alt="">
                            </div>
                            <div class="ti_text">
                                <p>Équipe très sympa et toujours disponible. Salle toujours très propre même si certains adhérents ne désinfectent pas toujours les machines derrière eux (et oublient de porter le masque). Présence du personnel sur de grandes amplitudes horaires (cela est rassurant).</p>
                                <h5>Wayne Aufderhar</h5>
                                <div class="tt-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->
@endsection