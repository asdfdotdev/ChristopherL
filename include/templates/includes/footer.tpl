<footer>
    <div class="the-outer-limits row">

        <div class="three columns">
            <h4>Look Around</h4>
            <ul>
                <li><a href="{$site_root}/development" data-event="footer"><span class="hidden-phone">Web </span>
                        Development</a></li>
                <li><a href="{$site_root}/marketing" data-event="footer"><span class="hidden-phone">Digital </span>
                        Marketing</a></li>
                <li><a href="{$site_root}/about" data-event="footer">About Us</a></li>
                <li><a href="{$site_root}/contact" data-event="footer">Contact Us</a></li>
            </ul>
        </div>
        <div class="three columns">
            <h4>Make Friends</h4>
            <ul>
                <li><a href="https://somafm.com" target="_blank" data-event="footer">Soma FM</a></li>
                <li><a href="https://www.linode.com/?r=88b68c8e7a56c761ed65918e5cce6acd78e1c598" target="_blank"
                       data-event="footer">Linode</a></li>
                <li><a href="https://www.mozilla.org" target="_blank" data-event="footer">Mozilla</a></li>
                <li><a href="https://www.canonical.com/" target="_blank" data-event="footer">Canonical</a></li>
            </ul>
        </div>
        <div class="three columns">
            <h4>Waste Time</h4>
            <ul>
                <li><a href="http://creasedcomics.com/videos" target="_blank" data-event="footer">Laugh</a></li>
                <li><a href="http://christopherl.com/m2/" target="_blank" data-event="footer">Do Math</a></li>
                <li><a href="https://christophurl.co/officialshirt" target="_blank" data-event="footer">Go Shopping</a>
                </li>
                <li><a href="https://howtohardrefresh.com/" target="_blank" data-event="footer">Hard Refresh</a></li>
            </ul>
        </div>
        <div class="three columns">
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_horizontal_follow_toolbox"></div>
        </div>

        <div class="copyright"><span>&copy;</span> <span class="hidden-phone">1999 &ndash;</span> {date("Y")} <a
                href="{$site_root}/" title="Chris Carlevato">ChristopherL</a> [ <a
                href="https://github.com/christopherldotcom/ChristopherL" target="_blank" title="Download This Website"
                class="github">Code</a> ]
        </div>

        <img src="{$image_root}/img/footer-head.png"
             alt="ChristopherLs Head"
             title="Our Mascot"
             class="head">

        {if $addthis_id}
            <div class="addthis-mobile-shim hidden-desktop"></div>
        {/if}

    </div>
</footer>
