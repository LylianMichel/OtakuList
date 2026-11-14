<nav class="navigation" aria-label="Navigation principale">
    <a class="brand" href="{{ route('home') }}" aria-label="OtakuList — retour à l'accueil">OtakuList<small>LE MANGA AUTREMENT</small></a>
    <div class="navigation-links">
        <x-site.navigation-links />
    </div>
    <div class="navigation-actions">
        <x-site.authentication-links />
    </div>
    <details class="mobile-menu">
        <summary><i class="fa-solid fa-bars" aria-hidden="true"></i> Menu</summary>
        <div class="mobile-links">
            <x-site.navigation-links />
            <x-site.authentication-links />
        </div>
    </details>
</nav>
