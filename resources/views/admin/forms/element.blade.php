@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dodawanie / edycja elementu {{ $menu->name }}</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Tablica</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Elementy</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (isset($element))

                            <form method="post" action="{{ route('admin.forms.element.update', ['slug' => $menu->slug, 'id' => $element->element_id]) }}">

                                @method('POST')

                            @else
                            <form method="post" action="{{ route('admin.forms.element.store', $menu->slug) }}">
                            @endif
                            
                                @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-body row">
                                    @foreach($attributes as $attr)
                                        @include('admin.forms.attributes.'.$attr->slug)   
                                    @endforeach
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary">Zapisz</button>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts2')
<script>
    if($('input[name=author]').length > 0) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: 'POST',
            url: '{{ url("/chat/participants/get") }}',
            success: function (data){
                var new_data = [];
                for(var i in data) {
                    new_data.push(data[i].friendly_name);
                }
                var input = document.querySelector('input[name=author]');
                new Tagify(input,
                    {whitelist: new_data, enforceWhitelist: false, maxTags: 1});
            },
            error: function(e) {
               console.log(e);
            }
        });  
    }
    
    if($('input[name=tag_tags]').length > 0) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: 'GET',
            url: '{{ url("admin/tag/get/tag") }}',
            success: function (data){
                var new_data = [];
                for(var i in data) {
                    new_data.push(data[i].name);
                }
                var input = document.querySelector('input[name=tag_tags]');
                new Tagify(input,
                    {whitelist: new_data, enforceWhitelist: true});
            },
            error: function(e) {
               console.log(e);
            }
        });  
    }
    
    if($('input[name=region_tags]').length > 0) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: 'GET',
            url: '{{ url("admin/tag/get/region") }}',
            success: function (data){
                var new_data = [];
                for(var i in data) {
                    new_data.push(data[i].name);
                }
                var input = document.querySelector('input[name=region_tags]');
                new Tagify(input,
                    {whitelist: new_data, enforceWhitelist: true});
            },
            error: function(e) {
               console.log(e);
            }
        });  
    }
    
    if($('input[name=space_tags]').length > 0) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: 'GET',
            url: '{{ url("admin/tag/get/space") }}',
            success: function (data){
                var new_data = [];
                for(var i in data) {
                    new_data.push(data[i].name);
                }
                var input = document.querySelector('input[name=space_tags]');
                new Tagify(input,
                    {whitelist: new_data, enforceWhitelist: true});
            },
            error: function(e) {
               console.log(e);
            }
        });  
    }
    
    if($('input[name=flag]').length > 0) {
      
        var input = document.querySelector('input[name=flag]');
        tagify = new Tagify(input,
         {whitelist: [
                { value:'Afganistan', code:'AF' },
                { value:'Wyspy Alandzkie', code:'AX' },
                { value:'Albania', code:'AL' },
                { value:'Algieria', code:'DZ' },
                { value:'Samoa Amerykańskie', code:'AS' },
                { value:'Andora', code:'AD' },
                { value:'Angola', code:'AO' },
                { value:'Anguilla', code:'AI' },
                { value:'Antarktyda', code:'AQ' },
                { value:'Antigua i Barbuda', code:'AG' },
                { value:'Argentyna', code:'AR' },
                { value:'Armenia', code:'AM' },
                { value:'Aruba', code:'AW' },
                { value:'Australia', code:'AU' },
                { value:'Austria', code:'AT' },
                { value:'Azerbejdżan', code:'AZ' },
                { value:'Bahamy', code:'BS' },
                { value:'Bahrajn', code:'BH' },
                { value:'Bangladesz', code:'BD' },
                { value:'Barbados', code:'BB' },
                { value:'Białoruś', code:'BY' },
                { value:'Belgia', code:'BE' },
                { value:'Belize', code:'BZ' },
                { value:'Benin', code:'BJ' },
                { value:'Bermudy', code:'BM' },
                { value:'Bhutan', code:'BT' },
                { value:'Boliwia', code:'BO' },
                { value:'Bośnia i Hercegowina', code:'BA' },
                { value:'Botswana', code:'BW' },
                { value:'Wyspa Bouveta', code:'BV' },
                { value:'Brazylia', code:'BR' },
                { value:'Brytyjskie Terytorium Oceanu Indyjskiego', code:'IO' },
                { value:'Brunei Darussalam', code:'BN' },
                { value:'Bułgaria', code:'BG' },
                { value:'Burkina Faso', code:'BF' },
                { value:'Burundi', code:'BI' },
                { value:'Kambodża', code:'KH' },
                { value:'Kamerun', code:'CM' },
                { value:'Kanada', code:'CA' },
                { value:'Republika Zielonego Przylądka', code:'CV' },
                { value:'Kajmany', code:'KY' },
                { value:'Republika Środkowoafrykańska', code:'CF' },
                { value:'Czad', code:'TD' },
                { value:'Chile', code:'CL' },
                { value:'Chiny', code:'CN' },
                { value:'Wyspa Bożego Narodzenia', code:'CX' },
                { value:'Wyspy Kokosowe', code:'CC' },
                { value:'Kolumbia', code:'CO' },
                { value:'Komory', code:'KM' },
                { value:'Kongo', code:'CG' },
                { value:'Kongo, Demokratyczna Republika', code:'CD' },
                { value:'Wyspy Cooka', code:'CK' },
                { value:'Kostaryka', code:'CR' },
                { value:'Wybrzeże Kości Słoniowej', code:'CI' },
                { value:'Chorwacja', code:'HR' },
                { value:'Kuba', code:'CU' },
                { value:'Cypr', code:'CY' },
                { value:'Czechy', code:'CZ' },
                { value:'Dania', code:'DK' },
                { value:'Dżibuti', code:'DJ' },
                { value:'Dominika', code:'DM' },
                { value:'Dominikana', code:'DO' },
                { value:'Ekwador', code:'EC' },
                { value:'Egipt', code:'EG' },
                { value:'Salwador', code:'SV' },
                { value:'Gwinea Równikowa', code:'GQ' },
                { value:'Erytrea', code:'ER' },
                { value:'Estonia', code:'EE' },
                { value:'Eswatini', code:'SZ' },
                { value:'Etiopia', code:'ET' },
                { value:'Falklandy (Malwiny)', code:'FK' },
                { value:'Fidżi', code:'FJ' },
                { value:'Finlandia', code:'FI' },
                { value:'Francja', code:'FR' },
                { value:'Gujana Francuska', code:'GF' },
                { value:'Polinezja Francuska', code:'PF' },
                { value:'Francuskie Terytoria Południowe i Antarktyczne', code:'TF' },
                { value:'Gabon', code:'GA' },
                { value:'Gambia', code:'GM' },
                { value:'Gruzja', code:'GE' },
                { value:'Niemcy', code:'DE' },
                { value:'Ghana', code:'GH' },
                { value:'Gibraltar', code:'GI' },
                { value:'Grecja', code:'GR' },
                { value:'Grenada', code:'GD' },
                { value:'Gwadelupa', code:'GP' },
                { value:'Gwam', code:'GU' },
                { value:'Gwatemala', code:'GT' },
                { value:'Gwinea', code:'GN' },
                { value:'Gwinea-Bissau', code:'GW' },
                { value:'Gujana', code:'GY' },
                { value:'Haiti', code:'HT' },
                { value:'Wyspy Heard i McDonalda', code:'HM' },
                { value:'Stolica Apostolska (Watykan)', code:'VA' },
                { value:'Honduras', code:'HN' },
                { value:'Hongkong', code:'HK' },
                { value:'Węgry', code:'HU' },
                { value:'Islandia', code:'IS' },
                { value:'Indie', code:'IN' },
                { value:'Indonezja', code:'ID' },
                { value:'Iran', code:'IR' },
                { value:'Irak', code:'IQ' },
                { value:'Irlandia', code:'IE' },
                { value:'Wyspa Man', code:'IM' },
                { value:'Izrael', code:'IL', searchBy:'ziemia święta, pustynia' },
                { value:'Włochy', code:'IT' },
                { value:'Jamajka', code:'JM' },
                { value:'Japonia', code:'JP' },
                { value:'Jersey', code:'JE' },
                { value:'Jordania', code:'JO' },
                { value:'Kazachstan', code:'KZ' },
                { value:'Kenia', code:'KE' },
                { value:'Kiribati', code:'KI' },
                { value:'Korea Północna', code:'KP' },
                { value:'Korea Południowa', code:'KR' },
                { value:'Kuwejt', code:'KW' },
                { value:'Kirgistan', code:'KG' },
                { value:'Laos', code:'LA' },
                { value:'Łotwa', code:'LV' },
                { value:'Liban', code:'LB' },
                { value:'Lesotho', code:'LS' },
                { value:'Liberia', code:'LR' },
                { value:'Libia', code:'LY' },
                { value:'Liechtenstein', code:'LI' },
                { value:'Litwa', code:'LT' },
                { value:'Luksemburg', code:'LU' },
                { value:'Makau', code:'MO' },
                { value:'Macedonia Północna', code:'MK' },
                { value:'Madagaskar', code:'MG' },
                { value:'Malawi', code:'MW' },
                { value:'Malezja', code:'MY' },
                { value:'Malediwy', code:'MV' },
                { value:'Mali', code:'ML' },
                { value:'Malta', code:'MT' },
                { value:'Wyspy Marshalla', code:'MH' },
                { value:'Martynika', code:'MQ' },
                { value:'Mauretania', code:'MR' },
                { value:'Mauritius', code:'MU' },
                { value:'Majotta', code:'YT' },
                { value:'Meksyk', code:'MX' },
                { value:'Mikronezja', code:'FM' },
                { value:'Mołdawia', code:'MD' },
                { value:'Monako', code:'MC' },
                { value:'Mongolia', code:'MN' },
                { value:'Czarnogóra', code:'ME' },
                { value:'Montserrat', code:'MS' },
                { value:'Maroko', code:'MA' },
                { value:'Mozambik', code:'MZ' },
                { value:'Myanmar', code:'MM' },
                { value:'Namibia', code:'NA' },
                { value:'Nauru', code:'NR' },
                { value:'Nepal', code:'NP' },
                { value:'Holandia', code:'NL' },
                { value:'Antyle Holenderskie', code:'AN' },
                { value:'Nowa Kaledonia', code:'NC' },
                { value:'Nowa Zelandia', code:'NZ' },
                { value:'Nikaragua', code:'NI' },
                { value:'Niger', code:'NE' },
                { value:'Nigeria', code:'NG' },
                { value:'Niu', code:'NU' },
                { value:'Wyspa Norfolk', code:'NF' },
                { value:'Mariany Północne', code:'MP' },
                { value:'Norwegia', code:'NO' },
                { value:'Oman', code:'OM' },
                { value:'Pakistan', code:'PK' },
                { value:'Palau', code:'PW' },
                { value:'Palestyna', code:'PS' },
                { value:'Panama', code:'PA' },
                { value:'Papua-Nowa Gwinea', code:'PG' },
                { value:'Paragwaj', code:'PY' },
                { value:'Peru', code:'PE' },
                { value:'Filipiny', code:'PH' },
                { value:'Pitcairn', code:'PN' },
                { value:'Polska', code:'PL' },
                { value:'Portugalia', code:'PT' },
                { value:'Portoryko', code:'PR' },
                { value:'Katar', code:'QA' },
                { value:'Reunion', code:'RE' },
                { value:'Rumunia', code:'RO' },
                { value:'Rosja', code:'RU' },
                { value:'Rwanda', code:'RW' },
                { value:'Saint Helena', code:'SH' },
                { value:'Saint Kitts i Nevis', code:'KN' },
                { value:'Saint Lucia', code:'LC' },
                { value:'Saint Pierre i Miquelon', code:'PM' },
                { value:'Saint Vincent i Grenadyny', code:'VC' },
                { value:'Samoa', code:'WS' },
                { value:'San Marino', code:'SM' },
                { value:'Wyspy Świętego Tomasza i Książęca', code:'ST' },
                { value:'Arabia Saudyjska', code:'SA' },
                { value:'Senegal', code:'SN' },
                { value:'Serbia', code:'RS' },
                { value:'Seszele', code:'SC' },
                { value:'Sierra Leone', code:'SL' },
                { value:'Singapur', code:'SG' },
                { value:'Słowacja', code:'SK' },
                { value:'Słowenia', code:'SI' },
                { value:'Wyspy Salomona', code:'SB' },
                { value:'Somalia', code:'SO' },
                { value:'Republika Południowej Afryki', code:'ZA' },
                { value:'Georgia Południowa i Sandwich Południowy', code:'GS' },
                { value:'Hiszpania', code:'ES' },
                { value:'Sri Lanka', code:'LK' },
                { value:'Sudan', code:'SD' },
                { value:'Surinam', code:'SR' },
                { value:'Svalbard i Jan Mayen', code:'SJ' },
                { value:'Szwajcaria', code:'CH' },
                { value:'Szwecja', code:'SE' },
                { value:'Syria', code:'SY' },
                { value:'Tajwan', code:'TW' },
                { value:'Tadżykistan', code:'TJ' },
                { value:'Tanzania', code:'TZ' },
                { value:'Tajlandia', code:'TH' },
                { value:'Timor Wschodni', code:'TL' },
                { value:'Togo', code:'TG' },
                { value:'Tokelau', code:'TK' },
                { value:'Tonga', code:'TO' },
                { value:'Trynidad i Tobago', code:'TT' },
                { value:'Tunezja', code:'TN' },
                { value:'Turcja', code:'TR' },
                { value:'Turkmenistan', code:'TM' },
                { value:'Wyspy Turks i Caicos', code:'TC' },
                { value:'Tuvalu', code:'TV' },
                { value:'Uganda', code:'UG' },
                { value:'Ukraina', code:'UA' },
                { value:'Zjednoczone Emiraty Arabskie', code:'AE' },
                { value:'Wielka Brytania', code:'GB' },
                { value:'Stany Zjednoczone', code:'US' },
                { value:'Mniejsze Wyspy Dziewicze Stanów Zjednoczonych', code:'UM' },
                { value:'Urugwaj', code:'UY' },
                { value:'Uzbekistan', code:'UZ' },
                { value:'Vanuatu', code:'VU' },
                { value:'Wenezuela', code:'VE' },
                { value:'Wietnam', code:'VN' },
                { value:'Brytyjskie Wyspy Dziewicze', code:'VG' },
                { value:'Wyspy Dziewicze Stanów Zjednoczonych', code:'VI' },
                { value:'Wallis i Futuna', code:'WF' },
                { value:'Sahara Zachodnia', code:'EH' },
                { value:'Jemen', code:'YE' },
                { value:'Zambia', code:'ZM' },
                { value:'Zimbabwe', code:'ZW' }
              ],
                     enforceWhitelist: true,
                    delimiters : null,
                    maxTags: 1,
    templates : {
        tag : function(tagData){
            try{
                return `<tag title='${tagData.country}' contenteditable='false' spellcheck="false" class='tagify__tag ${tagData.class ? tagData.class : ""}' ${this.getAttributes(tagData)}>
                        <x title='remove tag' class='tagify__tag__removeBtn'></x>
                        <div>
                            ${tagData.code ?
                            `<img onerror="this.style.visibility='hidden'" src='https://flagicons.lipis.dev/flags/4x3/${tagData.code.toLowerCase()}.svg'>` : ''
                            }
                        </div>
                    </tag>`
            }
            catch(err){}
        },

        dropdownItem : function(tagData){
            try{
                return `<div ${this.getAttributes(tagData)} class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}' >
                            <img onerror="this.style.visibility = 'hidden'"
                                src='https://flagicons.lipis.dev/flags/4x3/${tagData.code.toLowerCase()}.svg'>
                            <span>${tagData.value}</span>
                        </div>`
            }
            catch(err){ console.error(err)}
        }
    },
    dropdown : {
        enabled: 1, // suggest tags after a single character input
        classname : 'extra-properties' // custom class for the suggestions dropdown
    }});
          
    @if(isset($element))        
    const flag = tagify.whitelist.find(({ code }) => code === "{{ $element->flag }}");
    tagify.addTags([flag]);
    @endif
    }
</script>
@endsection
@section('styles')
<style>
    .tagify__dropdown.extra-properties .tagify__dropdown__item > img{
    display: inline-block;
    vertical-align: middle;
    height: 20px;
    transform: scale(.75);
    margin-right: 5px;
    border-radius: 2px;
    transition: .12s ease-out;
}

.tagify__dropdown.extra-properties .tagify__dropdown__item--active > img,
.tagify__dropdown.extra-properties .tagify__dropdown__item:hover > img{
    transform: none;
    margin-right: 12px;
}

.tagify.countries .tagify__input{ min-width:175px; }

.tagify.countries tag{ white-space:nowrap; }
.tagify.countries tag img{
    display: inline-block;
    height: 16px;
    margin-right: 3px;
    border-radius: 2px;
    pointer-events: none;
}
</style>
@endsection