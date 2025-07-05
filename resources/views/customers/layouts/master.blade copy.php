<!doctype html>
<html class="no-js" lang="zxx">
<head>
    @include('customers.partials.head')
</head>
<body>
    @include('customers.partials.preloader')
    
    <header>
        @include('customers.partials.body.header')
    </header>
    
    <main>
        <!--? slider Area Start-->
            @include('customers.partials.body.slider')
        <!-- slider Area End-->

        <!--? About Area Start -->
            @include('customers.partials.body.about')
        <!-- About-2 Area End -->

        <!--? Services Area Start -->
            @include('customers.partials.body.services')
        <!-- Services Area End -->

        <!--? Team Start -->
            @include('customers.partials.body.team')
        <!-- Team End -->

        <!-- Best Pricing Area Start -->
            @include('customers.partials.body.pricing')
        <!-- Best Pricing Area End -->
        
        <!--? Gallery Area Start -->
            @include('customers.partials.body.gallery')
        <!-- Gallery Area End -->

        <!-- Cut Details Start -->
            @include('customers.partials.body.cut_details')
        <!-- Cut Details End -->

        <!--? Blog Area Start -->
            @include('customers.partials.body.blog')
        <!-- Blog Area End -->
    </main>

    <footer>
        <!--? Footer Start-->
            @include('customers.partials.footer')
        <!-- Footer End-->
    </footer>

    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->
        @include('customers.scripts')
    
    </body>
</html>