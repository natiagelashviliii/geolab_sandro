<!-- header start -->

<header>
    <div class="container">
        <nav class="right hide-on-med-and-down">
            <ul>
                <li class="active">
                    <a href="{{ url('works') }}" class="hidden">
                        works
                    </a>
                </li>
                <li>
                    <a href="{{ url('about') }}" class="hidden">
                        about
                    </a>
                </li>
                <li>
                    <a href="{{ url('contact') }}" class="hidden">
                        contact
                    </a>
                </li>
            </ul>
        </nav>
        <button class="burger-bar right hide-on-lg-and-up">
            <img src="{{ asset('img/menu-black.svg') }}" alt="menu icon">
        </button>
        <div class="responsive-menu">
            <button class="close"></button>
            <ul>
                <li class="active">
                    <a href="{{ url('works') }}" class="hidden">
                        works
                    </a>
                </li>
                <li>
                    <a href="{{ url('about') }}" class="hidden">
                        about
                    </a>
                </li>
                <li>
                    <a href="{{ url('contact') }}" class="hidden">
                        contact
                    </a>
                </li>
            </ul>
            <div class="change-mode">
                <div class="mode-inside hidden">
                    <a class="white-mode active left">white</a>
                    <a class="mode-button left"></a>
                    <a class="black-mode left">black</a>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="change-mode not-resp hide-on-med-and-down">
        <div class="mode-inside hidden">
            <a class="white-mode active left">white</a>
            <a class="mode-button left"></a>
            <a class="black-mode left">black</a>
            <div class="clear"></div>
        </div>
    </div>

</header>

<div class="night active"></div>

<!-- header end -->

<!-- main start -->

<main>