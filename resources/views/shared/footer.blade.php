</main>

<!-- main end -->

<!-- footer start -->

<footer>
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