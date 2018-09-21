</main>

<!-- main end -->

<!-- footer start -->

<footer>
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
            <!-- <li>
                <a href="">
                    instagram
                </a>
            </li>
            <li>
                <a href="">
                    youtube
                </a>
            </li> -->
        </ul>
    </div>
</footer>

<!-- footer end -->