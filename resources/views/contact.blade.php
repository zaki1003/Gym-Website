@extends('layouts.home-layout')
@section('content')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>AIDE & CONTACT</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
           
                <div class="col-lg-6">
                    <div class="section-title contact-title">
                        <span>Contactez-nous</span>
                        <h2>ENTRER EN CONTACT</h2>
                    </div>
                    <div class="contact-widget">
                        <div class="cw-text">
                            <i class="fa fa-map-marker"></i>
                            <p>30 Av. Jean Jaurès, <br/> 30900 Nîmes</p>
                        </div>
                        <div class="cw-text">
                            <i class="fa fa-mobile"></i>
                            <ul>
                                <li>04.86.12.00.00</li>
                            </ul>
                        </div>
                        <div class="cw-text email">
                            <i class="fa fa-envelope"></i>
                            <p>support@gymup.com</p>
                        </div>
                    </div>
                </div>
              
      
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2877.967598358079!2d4.348002115503666!3d43.83576977911555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b42da43f330847%3A0xbe493d18e2368b43!2s30%20Av.%20Jean%20Jaur%C3%A8s%2C%2030900%20N%C3%AEmes!5e0!3m2!1sfr!2sfr!4v1642444400148!5m2!1sfr!2sfr"
                    height="550" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection