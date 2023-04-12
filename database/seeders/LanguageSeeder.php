<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [["Abkhazian", "ab"], ["Afar", "aa"], ["Afrikaans", "af"], ["Akan", "ak"], ["Albanian", "sq"], ["Amharic", "am"], ["Arabic", "ar"], ["Aragonese", "an"], ["Armenian", "hy"], ["Assamese", "as"], ["Avaric", "av"], ["Avestan", "ae"], ["Aymara", "ay"], ["Azerbaijani", "az"], ["Bambara", "bm"], ["Bashkir", "ba"], ["Basque", "eu"], ["Belarusian", "be"], ["Bengali", "bn"], ["Bislama", "bi"], ["Bosnian", "bs"], ["Breton", "br"], ["Bulgarian", "bg"], ["Burmese", "my"], ["Catalan, Valencian", "ca"], ["Chamorro", "ch"], ["Chechen", "ce"], ["Chichewa, Chewa, Nyanja", "ny"], ["Chinese", "zh"], ["Church Slavonic, Old Slavonic, Old Church Slavonic", "cu"], ["Chuvash", "cv"], ["Cornish", "kw"], ["Corsican", "co"], ["Cree", "cr"], ["Croatian", "hr"], ["Czech", "cs"], ["Danish", "da"], ["Divehi, Dhivehi, Maldivian", "dv"], ["Dutch, Flemish", "nl"], ["Dzongkha", "dz"], ["English", "en"], ["Esperanto", "eo"], ["Estonian", "et"], ["Ewe", "ee"], ["Faroese", "fo"], ["Fijian", "fj"], ["Finnish", "fi"], ["French", "fr"], ["Western Frisian", "fy"], ["Fulah", "ff"], ["Gaelic, Scottish Gaelic", "gd"], ["Galician", "gl"], ["Ganda", "lg"], ["Georgian", "ka"], ["German", "de"], ["Greek, Modern (1453–)", "el"], ["Kalaallisut, Greenlandic", "kl"], ["Guarani", "gn"], ["Gujarati", "gu"], ["Haitian, Haitian Creole", "ht"], ["Hausa", "ha"], ["Hebrew", "he"], ["Herero", "hz"], ["Hindi", "hi"], ["Hiri Motu", "ho"], ["Hungarian", "hu"], ["Icelandic", "is"], ["Ido", "io"], ["Igbo", "ig"], ["Indonesian", "id"], ["Interlingua (International Auxiliary Language Association)", "ia"], ["Interlingue, Occidental", "ie"], ["Inuktitut", "iu"], ["Inupiaq", "ik"], ["Irish", "ga"], ["Italian", "it"], ["Japanese", "ja"], ["Javanese", "jv"], ["Kannada", "kn"], ["Kanuri", "kr"], ["Kashmiri", "ks"], ["Kazakh", "kk"], ["Central Khmer", "km"], ["Kikuyu, Gikuyu", "ki"], ["Kinyarwanda", "rw"], ["Kirghiz, Kyrgyz", "ky"], ["Komi", "kv"], ["Kongo", "kg"], ["Korean", "ko"], ["Kuanyama, Kwanyama", "kj"], ["Kurdish", "ku"], ["Lao", "lo"], ["Latin", "la"], ["Latvian", "lv"], ["Limburgan, Limburger, Limburgish", "li"], ["Lingala", "ln"], ["Lithuanian", "lt"], ["Luba-Katanga", "lu"], ["Luxembourgish, Letzeburgesch", "lb"], ["Macedonian", "mk"], ["Malagasy", "mg"], ["Malay", "ms"], ["Malayalam", "ml"], ["Maltese", "mt"], ["Manx", "gv"], ["Maori", "mi"], ["Marathi", "mr"], ["Marshallese", "mh"], ["Mongolian", "mn"], ["Nauru", "na"], ["Navajo, Navaho", "nv"], ["North Ndebele", "nd"], ["South Ndebele", "nr"], ["Ndonga", "ng"], ["Nepali", "ne"], ["Norwegian", "no"], ["Norwegian Bokmål", "nb"], ["Norwegian Nynorsk", "nn"], ["Sichuan Yi, Nuosu", "ii"], ["Occitan", "oc"], ["Ojibwa", "oj"], ["Oriya", "or"], ["Oromo", "om"], ["Ossetian, Ossetic", "os"], ["Pali", "pi"], ["Pashto, Pushto", "ps"], ["Persian", "fa"], ["Polish", "pl"], ["Portuguese", "pt"], ["Punjabi, Panjabi", "pa"], ["Quechua", "qu"], ["Romanian, Moldavian, Moldovan", "ro"], ["Romansh", "rm"], ["Rundi", "rn"], ["Russian", "ru"], ["Northern Sami", "se"], ["Samoan", "sm"], ["Sango", "sg"], ["Sanskrit", "sa"], ["Sardinian", "sc"], ["Serbian", "sr"], ["Shona", "sn"], ["Sindhi", "sd"], ["Sinhala, Sinhalese", "si"], ["Slovak", "sk"], ["Slovenian", "sl"], ["Somali", "so"], ["Southern Sotho", "st"], ["Spanish, Castilian", "es"], ["Sundanese", "su"], ["Swahili", "sw"], ["Swati", "ss"], ["Swedish", "sv"], ["Tagalog", "tl"], ["Tahitian", "ty"], ["Tajik", "tg"], ["Tamil", "ta"], ["Tatar", "tt"], ["Telugu", "te"], ["Thai", "th"], ["Tibetan", "bo"], ["Tigrinya", "ti"], ["Tonga (Tonga Islands)", "to"], ["Tsonga", "ts"], ["Tswana", "tn"], ["Turkish", "tr"], ["Turkmen", "tk"], ["Twi", "tw"], ["Uighur, Uyghur", "ug"], ["Ukrainian", "uk"], ["Urdu", "ur"], ["Uzbek", "uz"], ["Venda", "ve"], ["Vietnamese", "vi"], ["Volapük", "vo"], ["Walloon", "wa"], ["Welsh", "cy"], ["Wolof", "wo"], ["Xhosa", "xh"], ["Yiddish", "yi"], ["Yoruba", "yo"], ["Zhuang, Chuang", "za"], ["Zulu", "zu"]];

        foreach ($languages as $language) {
            Language::factory()->create([
                'name' => $language[0],
                'acronym' => $language[1],
            ]);
        }
    }
}
