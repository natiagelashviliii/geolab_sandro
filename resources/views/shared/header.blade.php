<!-- header start -->



<header>

    <div class="container">

        <nav class="right hide-on-med-and-down" data-aos="fade-down" data-aos-delay="10" data-aos-duration="1000" data-aos-offset="10">

            <ul>

                <li  {{ setActive('/') }}>

                    <a href="{{ url('/') }}" class="hidden">

                        home

                    </a>

                </li>

                <li {{ setActive('works',true) }}>

                    <a href="{{ url('works') }}" class="hidden">

                        works

                    </a>

                </li>

                <li {{ setActive('about') }}>

                    <a href="{{ url('about') }}" class="hidden">

                        about

                    </a>

                </li>

                <li {{ setActive('contact') }}>

                    <a href="{{ url('contact') }}" class="hidden">

                        contact

                    </a>

                </li>

            </ul>

        </nav>

        <button class="burger-bar right hide-on-lg-and-up" data-aos="fade-in" data-aos-delay="100" data-aos-offset="10">

            <img src="{{ asset('img/menu-black.svg') }}" alt="menu icon">

        </button>

        <div class="responsive-menu" data-aos="fade-in" data-aos-delay="100" data-aos-offset="10">

            <button class="close"></button>

            <ul>

                <li {{ setActive('') }}>

                    <a href="{{ url('/') }}" class="hidden">

                        home

                    </a>

                </li>

                <li {{ setActive('works') }}>

                    <a href="{{ url('works') }}" class="hidden">

                        works

                    </a>

                </li>

                <li {{ setActive('about') }}>

                    <a href="{{ url('about') }}" class="hidden">

                        about

                    </a>

                </li>

                <li {{ setActive('contact') }}>

                    <a href="{{ url('contact') }}" class="hidden">

                        contact

                    </a>

                </li>

            </ul>

            <div class="change-mode" data-aos="fade-in" data-aos-delay="100" data-aos-offset="10">

                <div class="mode-inside hidden">

                    <a class="white-mode left @if (!$Mode || $Mode == 'white') active @endif">white</a>

                    <a class="mode-button left @if ($Mode == 'black') active @endif"></a>

                    <a class="black-mode left @if ($Mode == 'black') active @endif">black</a>

                    <div class="clear"></div>

                </div>

            </div>

        </div>

        <div class="clear"></div>

    </div>

    <div class="change-mode not-resp hide-on-med-and-down" data-aos="fade-in" data-aos-delay="100" data-aos-offset="10">

        <div class="mode-inside hidden">

            <a class="white-mode left @if (!$Mode || $Mode == 'white') active @endif">white</a>

            <a class="mode-button left @if ($Mode == 'black') active @endif"></a>

            <a class="black-mode left @if ($Mode == 'black') active @endif">black</a>

            <div class="clear"></div>

        </div>

    </div>



</header>



<div class="night @if (!$Mode || $Mode == 'white') active @endif"></div>



<!-- header end -->



<!-- main start -->



<main>