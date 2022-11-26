<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $language_items = [
            ' ' => 'Choose a language',
            'En'=>'English',
            'Fr'=>'French',
            'De'=>'German',
            'It'=>'Italian'
        ];

        $country_items = [
           " "=>"Choose a country",
           "AFG"=>"Afghanistan",
           "ALA"=>"Aland Islands",
           "ALB"=>"Albania",
           "DZA"=>"Algeria",
           "ASM"=>"American Samoa",
           "AND"=>"Andorra",
           "AGO"=>"Angola",
           "AIA"=>"Anguilla",
           "ATA"=>"Antarctica",
           "ATG"=>"Antigua and Barbuda",
           "ARG"=>"Argentina",
           "ARM"=>"Armenia",
           "ABW"=>"Aruba",
           "AUS"=>"Australia",
           "AUT"=>"Austria",
           "AZE"=>"Azerbaijan",
           "BHS"=>"Bahamas",
           "BHR"=>"Bahrain",
           "BGD"=>"Bangladesh",
           "BRB"=>"Barbados",
           "BLR"=>"Belarus",
           "BEL"=>"Belgium",
           "BLZ"=>"Belize",
           "BEN"=>"Benin",
           "BMU"=>"Bermuda",
           "BTN"=>"Bhutan",
           "BOL"=>"Bolivia",
           "BES"=>"Bonaire, Sint Eustatius and Saba",
           "BIH"=>"Bosnia and Herzegovina",
           "BWA"=>"Botswana",
           "BVT"=>"Bouvet Island",
           "BRA"=>"Brazil",
           "IOT"=>"British Indian Ocean Territory",
           "BRN"=>"Brunei Darussalam",
           "BGR"=>"Bulgaria",
           "BFA"=>"Burkina Faso",
           "BDI"=>"Burundi",
           "KHM"=>"Cambodia",
           "CMR"=>"Cameroon",
           "CAN"=>"Canada",
           "CPV"=>"Cape Verde",
           "CYM"=>"Cayman Islands",
           "CAF"=>"Central African Republic",
           "TCD"=>"Chad",
           "CHL"=>"Chile",
           "CHN"=>"China",
           "CXR"=>"Christmas Island",
           "CCK"=>"Cocos (Keeling) Islands",
           "COL"=>"Colombia",
           "COM"=>"Comoros",
           "COG"=>"Congo",
           "COD"=>"Congo, Democratic Republic of the Congo",
           "COK"=>"Cook Islands",
           "CRI"=>"Costa Rica",
           "CIV"=>"Cote D'Ivoire",
           "HRV"=>"Croatia",
           "CUB"=>"Cuba",
           "CUW"=>"Curacao",
           "CYP"=>"Cyprus",
           "CZE"=>"Czech Republic",
           "DNK"=>"Denmark",
           "DJI"=>"Djibouti",
           "DMA"=>"Dominica",
           "DOM"=>"Dominican Republic",
           "ECU"=>"Ecuador",
           "EGY"=>"Egypt",
           "SLV"=>"El Salvador",
           "GNQ"=>"Equatorial Guinea",
           "ERI"=>"Eritrea",
           "EST"=>"Estonia",
           "ETH"=>"Ethiopia",
           "FLK"=>"Falkland Islands (Malvinas)",
           "FRO"=>"Faroe Islands",
           "FJI"=>"Fiji",
           "FIN"=>"Finland",
           "FRA"=>"France",
           "GUF"=>"French Guiana",
           "PYF"=>"French Polynesia",
           "ATF"=>"French Southern Territories",
           "GAB"=>"Gabon",
           "GMB"=>"Gambia",
           "GEO"=>"Georgia",
           "DEU"=>"Germany",
           "GHA"=>"Ghana",
           "GIB"=>"Gibraltar",
           "GRC"=>"Greece",
           "GRL"=>"Greenland",
           "GRD"=>"Grenada",
           "GLP"=>"Guadeloupe",
           "GUM"=>"Guam",
           "GTM"=>"Guatemala",
           "GGY"=>"Guernsey",
           "GIN"=>"Guinea",
           "GNB"=>"Guinea-Bissau",
           "GUY"=>"Guyana",
           "HTI"=>"Haiti",
           "HMD"=>"Heard Island and Mcdonald Islands",
           "VAT"=>"Holy See (Vatican City State)",
           "HND"=>"Honduras",
           "HKG"=>"Hong Kong",
           "HUN"=>"Hungary",
           "ISL"=>"Iceland",
           "IND"=>"India",
           "IDN"=>"Indonesia",
           "IRN"=>"Iran, Islamic Republic of",
           "IRQ"=>"Iraq",
           "IRL"=>"Ireland",
           "IMN"=>"Isle of Man",
           "ISR"=>"Israel",
           "ITA"=>"Italy",
           "JAM"=>"Jamaica",
           "JPN"=>"Japan",
           "JEY"=>"Jersey",
           "JOR"=>"Jordan",
           "KAZ"=>"Kazakhstan",
           "KEN"=>"Kenya",
           "KIR"=>"Kiribati",
           "PRK"=>"Korea, Democratic People's Republic of",
           "KOR"=>"Korea, Republic of",
           "XKX"=>"Kosovo",
           "KWT"=>"Kuwait",
           "KGZ"=>"Kyrgyzstan",
           "LAO"=>"Lao People's Democratic Republic",
           "LVA"=>"Latvia",
           "LBN"=>"Lebanon",
           "LSO"=>"Lesotho",
           "LBR"=>"Liberia",
           "LBY"=>"Libyan Arab Jamahiriya",
           "LIE"=>"Liechtenstein",
           "LTU"=>"Lithuania",
           "LUX"=>"Luxembourg",
           "MAC"=>"Macao",
           "MKD"=>"Macedonia, the Former Yugoslav Republic of",
           "MDG"=>"Madagascar",
           "MWI"=>"Malawi",
           "MYS"=>"Malaysia",
           "MDV"=>"Maldives",
           "MLI"=>"Mali",
           "MLT"=>"Malta",
           "MHL"=>"Marshall Islands",
           "MTQ"=>"Martinique",
           "MRT"=>"Mauritania",
           "MUS"=>"Mauritius",
           "MYT"=>"Mayotte",
           "MEX"=>"Mexico",
           "FSM"=>"Micronesia, Federated States of",
           "MDA"=>"Moldova, Republic of",
           "MCO"=>"Monaco",
           "MNG"=>"Mongolia",
           "MNE"=>"Montenegro",
           "MSR"=>"Montserrat",
           "MAR"=>"Morocco",
           "MOZ"=>"Mozambique",
           "MMR"=>"Myanmar",
           "NAM"=>"Namibia",
           "NRU"=>"Nauru",
           "NPL"=>"Nepal",
           "NLD"=>"Netherlands",
           "ANT"=>"Netherlands Antilles",
           "NCL"=>"New Caledonia",
           "NZL"=>"New Zealand",
           "NIC"=>"Nicaragua",
           "NER"=>"Niger",
           "NGA"=>"Nigeria",
           "NIU"=>"Niue",
           "NFK"=>"Norfolk Island",
           "MNP"=>"Northern Mariana Islands",
           "NOR"=>"Norway",
           "OMN"=>"Oman",
           "PAK"=>"Pakistan",
           "PLW"=>"Palau",
           "PSE"=>"Palestinian Territory, Occupied",
           "PAN"=>"Panama",
           "PNG"=>"Papua New Guinea",
           "PRY"=>"Paraguay",
           "PER"=>"Peru",
           "PHL"=>"Philippines",
           "PCN"=>"Pitcairn",
           "POL"=>"Poland",
           "PRT"=>"Portugal",
           "PRI"=>"Puerto Rico",
           "QAT"=>"Qatar",
           "REU"=>"Reunion",
           "ROM"=>"Romania",
           "RUS"=>"Russian Federation",
           "RWA"=>"Rwanda",
           "BLM"=>"Saint Barthelemy",
           "SHN"=>"Saint Helena",
           "KNA"=>"Saint Kitts and Nevis",
           "LCA"=>"Saint Lucia",
           "MAF"=>"Saint Martin",
           "SPM"=>"Saint Pierre and Miquelon",
           "VCT"=>"Saint Vincent and the Grenadines",
           "WSM"=>"Samoa",
           "SMR"=>"San Marino",
           "STP"=>"Sao Tome and Principe",
           "SAU"=>"Saudi Arabia",
           "SEN"=>"Senegal",
           "SRB"=>"Serbia",
           "SCG"=>"Serbia and Montenegro",
           "SYC"=>"Seychelles",
           "SLE"=>"Sierra Leone",
           "SGP"=>"Singapore",
           "SXM"=>"Sint Maarten",
           "SVK"=>"Slovakia",
           "SVN"=>"Slovenia",
           "SLB"=>"Solomon Islands",
           "SOM"=>"Somalia",
           "ZAF"=>"South Africa",
           "SGS"=>"South Georgia and the South Sandwich Islands",
           "SSD"=>"South Sudan",
           "ESP"=>"Spain",
           "LKA"=>"Sri Lanka",
           "SDN"=>"Sudan",
           "SUR"=>"Suriname",
           "SJM"=>"Svalbard and Jan Mayen",
           "SWZ"=>"Swaziland",
           "SWE"=>"Sweden",
           "CHE"=>"Switzerland",
           "SYR"=>"Syrian Arab Republic",
           "TWN"=>"Taiwan, Province of China",
           "TJK"=>"Tajikistan",
           "TZA"=>"Tanzania, United Republic of",
           "THA"=>"Thailand",
           "TLS"=>"Timor-Leste",
           "TGO"=>"Togo",
           "TKL"=>"Tokelau",
           "TON"=>"Tonga",
           "TTO"=>"Trinidad and Tobago",
           "TUN"=>"Tunisia",
           "TUR"=>"Turkey",
           "TKM"=>"Turkmenistan",
           "TCA"=>"Turks and Caicos Islands",
           "TUV"=>"Tuvalu",
           "UGA"=>"Uganda",
           "UKR"=>"Ukraine",
           "ARE"=>"United Arab Emirates",
           "GBR"=>"United Kingdom",
           "USA"=>"United States",
           "UMI"=>"United States Minor Outlying Islands",
           "URY"=>"Uruguay",
           "UZB"=>"Uzbekistan",
           "VUT"=>"Vanuatu",
           "VEN"=>"Venezuela",
           "VNM"=>"Viet Nam",
           "VGB"=>"Virgin Islands, British",
           "VIR"=>"Virgin Islands, U.s.",
           "WLF"=>"Wallis and Futuna",
           "ESH"=>"Western Sahara",
           "YEM"=>"Yemen",
           "ZMB"=>"Zambia",
           "ZWE"=>"Zimbabwe",
        ];

        return view('profile', compact('language_items','country_items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required','string','max:255'],
            'lastname' => ['required','string','max:255'],
            'username' => ['required','string','max:255','unique:users,username,'.auth()->user()->id],
            'email' => ['required','string','email','max:255','unique:users,email,'.auth()->user()->id],
            'language'=> ['required'],
            'country'=> ['required'],
            'old_password' => ['nullable'],
            'new_password' => ['nullable','min:8','different:old_password'],
        ]);

        /* #Match The Old Password
        if($request->old_password != null && $request->new_password != null) {
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("alert", [
                    'message' => "Old Password Doesn't match!",
                    'type'    => 'danger', 
                ]);
            }

            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->new_password)
            ]);
        }
        else { */
        User::whereId(auth()->user()->id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'language' => $request->language,
            'country' => $request->country
        ]);   
        //}

        App::setLocale($request->language);             
        
        return back()->with('alert',[
            'message' => 'Profile updated successfully !',
            'type'    => 'success', 
        ]);
    }

    function admin()
    {
        if(Auth::user()->username == "TheRedRacing"){

            $nbuser = DB::table('users')->count();
            $nbevent = DB::table('events')->count();

            return view('admin', compact('nbuser','nbevent'));
        }
        else {
            return view('profile')->with('alert',[
                'message' => "You don't have access !",
                'type'    => 'Danger', 
            ]);
        }
    }
}
