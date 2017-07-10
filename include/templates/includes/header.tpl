<header>
    <div class="the-outer-limits container row">
        <a href="{$site_domain}" data-event="logo">
            <?xml version="1.0" standalone="no"?>
            <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
            "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                 width="2900.000000pt" height="1000.000000pt" viewBox="0 0 2900.000000 1000.000000"
                 preserveAspectRatio="xMidYMid meet">
                <title>Serious Business, Since 1999</title>
                <description>ChristopherL Logo</description>
                <g transform="translate(0.000000,1000.000000) scale(0.100000,-0.100000)"
                   fill="#000000" stroke="none">
                    <path d="M0 5000 l0 -5000 14500 0 14500 0 0 5000 0 5000 -14500 0 -14500 0 0
-5000z m9500 2375 l0 -2125 -2250 0 -2250 0 0 -250 0 -250 2250 0 2250 0 0
-2125 0 -2125 -4500 0 -4500 0 0 4500 0 4500 4500 0 4500 0 0 -2125z m4790
-220 l0 -2345 2355 0 2355 0 0 -2155 0 -2155 -4500 0 -4500 0 0 4500 0 4500
2145 0 2145 0 0 -2345z m4700 225 l0 -2120 -2125 0 -2125 0 0 2120 0 2120
2125 0 2125 0 0 -2120z m9510 -5 l0 -2125 -2250 0 -2250 0 0 -250 0 -250 2250
0 2250 0 0 -2125 0 -2125 -4500 0 -4500 0 0 4500 0 4500 4500 0 4500 0 0
-2125z"/>
                </g>
            </svg>
        </a>
        <nav>
            <ul>
                <li{if $active_nav == 'home'} class="active"{/if}><a href="{$site_root}/" data-event="top-nav"><span>Home</span></a></li>
                <li{if $active_nav == 'development'} class="active"{/if}><a href="{$site_root}/development" data-event="top-nav"><span>Development</span></a></li>
                <li{if $active_nav == 'marketing'} class="active"{/if}><a href="{$site_root}/marketing" data-event="top-nav"><span>Marketing</span></a></li>
                <li{if $active_nav == 'about'} class="active"{/if}><a href="{$site_root}/about" data-event="top-nav"><span>About</span></a></li>
                <li{if $active_nav == 'contact'} class="active"{/if}><a href="{$site_root}/contact" data-event="top-nav"><span>Contact</span></a></li>
            </ul>
        </nav>
    </div>
</header>
