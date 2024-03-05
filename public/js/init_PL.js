ct_$('html').ultimateGDPR({
    popup_style: {
        position: 'bottom-panel', // bottom-left, bottom-right, bottom-panel, top-left, top-right, top-panel
        distance: '20px', // distance betwen popup and window border
        box_style: 'classic', // classic, modern
        box_shape: 'rounded', // rounded, squared
        background_color: '#fff584', // color in hex
        text_color: '#542d04', // color in hex
        button_shape: 'rounded', // squared, rounded
        button_color: '#e1e1e1', // color in hex
        button_size: 'normal', // normal, large
        box_skin: 'skin-dark-theme', // skin-default-theme, skin-dark-theme, skin-light-theme
        gear_icon_position: 'bottom-left', // top-left, top-center, top-right, center-left, center-right, bottom-left, bottom-center, bottom-right
        gear_icon_color: '#6a8ee7', //color in hex
    },
    popup_options: {
        parent_container: 'body', // append plugin html to this element selector
        always_show: false, // true, false, when true popup is displayed always even when consent is given
        gear_display: true, // true, false when true displays icon with cookie settings
        popup_title: 'Pliki cookie', // title for popup
        popup_text: 'Aby ta strona działała poprawnie, czasami umieszczamy na urządzeniu małe pliki z danymi zwane plikami cookie. Większość dużych witryn również to robi.', // text for popup
        accept_button_text: 'Zaakceptuj', // string, text for accept button
        read_button_text: 'Czytaj więcej', // string, text for read more button
        read_more_link: '', // string, link to the Read More page
        advenced_button_text: 'Zmień ustawienia', // string, text for advenced button
        grouped_popup: true, // true, false, when true cookies are grouped
        default_group: 'group_2', // string: name, select group that will be selected by default
        content_before_slider: '<h2>Ustawienia prywatności</h2><div class="ct-ultimate-gdpr-cookie-modal-desc"><p>Zdecyduj, które pliki cookie chcesz zezwolić.</p><p>Możesz zmienić te ustawienia w dowolnym momencie. Może to jednak spowodować, że niektóre funkcje będą niedostępne. Aby uzyskać informacje na temat usuwania plików cookie, skorzystaj z funkcji pomocy przeglądarki.</p> <span>Dowiedz się więcej o plikach cookie, z których korzystamy.</span></div><h3>Za pomocą suwaka można włączać i wyłączać różne rodzaje plików cookie:</h3>',
        // string: this content will be displayed before cookies slider, html tags alowed
        accepted_text: 'Ta strona będzie:',
        declined_text: "Ta strona internetowa nie będzie:",
        save_btn: 'Zapisz i zamknij', // string, text for modal close btn
        prevent_cookies_on_document_write: false, // prevent cookies on document write when there is no agreement for cookies
        check_country: false,
        countries_prefixes: ['AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'GB'],
        cookies_expire_time: 30, // set number of days, you can use 0 for session only or 'unlimited'
        cookies_path: '/', // sets custom path use / for global, '/your_path' for custom path or 'current' for current path
        reset_link_selector: '.ct-uGdpr-reset',
        first_party_cookies_whitelist: [],
        third_party_cookies_whitelist: [],
        cookies_groups_design: 'skin-1', // skin-1, skin-2, skin-3
        assets_path : '/assets', // absolute path to directory with assets
        video_blocked: 'Ta zawartość jest zablokowana!',
        iframe_blocked: false,
        cookie_popup_close_color:'#fff',
        close_popup_text: '', // Close popup text (If empty, button X(close) will display. If not, it will display the text)
        cookies_groups: {
            group_1: {
                name: 'Istotny', // string: name
                enable: true, // true, false, you can disable this group by using false
                icon: 'fas fa-check', // string icon class from font-awesome see -> http://fontawesome.io
                list: ['Zapamiętaj ustawienie uprawnień do plików cookie', 'Zezwalaj na pliki cookie sesji', 'Zbierz informacje, które wprowadzisz do formularza kontaktowego, biuletynu i innych formularzy na wszystkich stronach', 'Śledzić, co wpisujesz w koszyku', 'Uwierzytelnij się, że jesteś zalogowany na swoje konto użytkownika', 'Zapamiętaj wybraną wersję językową'], // array list of options
                blocked_url: [], // array list of url blocked scripts
                local_cookies_name: [], // array, list of local cookies names
            },
            group_2: {
                name: 'Funkcjonalność', // string: name
                enable: true, // true, false, you can disable this group by using false
                icon: 'fas fa-cog', // string icon class from font-awesome see -> http://fontawesome.io
                list: ['Zapamiętaj ustawienia mediów społecznościowych', 'Zapamiętaj wybrany region i kraj',],
                blocked_url: [], // array list of url blocked scripts
                local_cookies_name: [], // array, list of local cookies names
            },
            group_3: {
                name: 'Analityka', // string: name
                enable: true, // true, false, you can disable this group by using false
                icon: 'fas fa-chart-bar', // string icon class from font-awesome see -> http://fontawesome.io
                list: ['Śledź odwiedzane strony i interakcje', 'Śledź swoją lokalizację i region na podstawie Twojego numeru IP', 'Śledź czas spędzony na każdej stronie', 'Zwiększ jakość danych funkcji statystycznych'],
                blocked_url: [], // array list of url blocked scripts
                local_cookies_name: [], // array, list of local cookies names
            },
            group_4: {
                name: 'Reklama', // string: name
                enable: true, // true, false, you can disable this group by using false
                icon: 'fas fa-exchange-alt', // string icon class from font-awesome see -> http://fontawesome.io
                list: ['Używaj informacji do dostosowanej reklamy ze stronami trzecimi', 'Pozwala łączyć się z serwisami społecznościowymi', 'Znajdź urządzenie, z którego korzystasz', 'Zbierz dane osobowe, takie jak imię i nazwisko oraz lokalizację'],
                blocked_url: [], // array list of url blocked scripts
                local_cookies_name: [], // array, list of local cookies names
            },
        },
    },
    age_popup_style: {
        position: 'top-panel', // bottom-left, bottom-right, bottom-panel, top-left, top-right, top-panel
        distance: '20px', // distance between popup and window border
        box_style: 'classic', // classic, modern
        box_shape: 'rounded', // rounded, squared
        background_color: '#fff584', // color in hex
        text_color: '#542d04', // color in hex
        button_shape: 'rounded', // squared, rounded
        button_color: '#e1e1e1', // color in hex
        box_skin: 'skin-dark-theme', // skin-default-theme, skin-dark-theme, skin-light-theme
    },
    age_popup_options: {
        parent_container: 'body', // append plugin html to this element selector
        always_show: false, // true, false, when true popup is displayed always even when consent is given
        popup_title: 'Age verification', // title for popup
        popup_text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', // text for popup
        age_limit: 13, // age limit to enter
        assets_path : 'assets', // absolute path to directory with assets
        disable_popup: true, // true/false, when true popup will be disabled and hidden on the website
    },
    forms: {
        prevent_forms_send: false, // true, false, when enabled forms get checkbox with info that need to be checked for form send
        prevent_forms_text: 'I consent to the storage of my data according to the Privacy Policy', // string: information for checkbox info
        prevent_forms_exclude: [], // array of selectors (classes, id), this forms will be excluded from prevent
    },
    configure_mode: {
        on: true,
        parametr: '?configure123456',
        dependencies: [ 'assets/css/ct-ultimate-gdpr.min.css', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css'],
        debug: false, // bool: true false, debug mode on/off (showing all 3rd party cookies urls, blockes urls names of all local cookies and names of blocked local cookies )
    }
});