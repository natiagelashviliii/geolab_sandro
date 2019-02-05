</main>



<!-- main end -->



<!-- footer start -->



<footer @if (Request::is('/') || Request::is('main') || Request::is('contact') || Request::is('404')) class="footer-main-fixed" @endif  data-aos="fade-up" data-aos-delay="10" data-aos-duration="1000" data-aos-offset="10">

    @if (!Request::is('works'))

    <div class="socials container right-align hidden">

        <ul>

            @foreach (config('constants.socials') as $SocKey => $Soc)

                @if($Socials[$SocKey])

                    <li>

                        <a href="{{ $Socials[$SocKey] }}" target="_blank">

                            {{ $Soc }}

                        </a>

                    </li>

                @endif

            @endforeach

        </ul>

    </div>

    @endif

</footer>



<!-- footer end -->