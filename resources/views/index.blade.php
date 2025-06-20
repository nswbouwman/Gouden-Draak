<!doctype html>
<html>
<head>
    <title>The Golden Dragon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'chinese': ['chinese_takeawayregular', 'sans-serif']
                    },
                    colors: {
                        'darkred': '#8B0000',
                        'floralwhite': '#FFFAF0'
                    }
                }
            }
        }
    </script>
    <style>
        @font-face {
            font-family: 'chinese_takeawayregular';
            src: url('fonts/chinesetakeaway-webfont.woff2') format('woff2'),
                 url('fonts/chinesetakeaway-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        
        .font-chinese {
            font-family: 'chinese_takeawayregular', sans-serif;
        }
        
        /* Custom marquee animation */
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .marquee {
            animation: marquee 15s linear infinite;
            white-space: nowrap;
        }
    </style>
</head>

<body class="bg-darkred m-4 mx-12">
    <table class="p-1 w-full border-collapse">
        <tr class="h-12 bg-red-600"> 
            <td class="text-center w-3/10 text-yellow-400 text-3xl">
                <img class="align-middle inline h-12" src="pictures/dragon-small.png" alt="Golden Dragon">
                <span class="font-chinese">De Gouden Draak</span>
                <img class="align-middle inline h-12" src="pictures/dragon-small-flipped.png" alt="Golden Dragon">
            </td>
            <td class="overflow-hidden">
                <a href="paginas/aanbiedingen.html" class="text-yellow-400 font-bold no-underline">
                    <div class="marquee">
                        Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!
                    </div>
                </a>
            </td>
            <td class="text-center w-3/10 text-yellow-400 text-3xl">
                <img class="align-middle inline h-12" src="pictures/dragon-small.png" alt="Golden Dragon">
                <span class="font-chinese">De Gouden Draak</span>
                <img class="align-middle inline h-12" src="pictures/dragon-small-flipped.png" alt="Golden Dragon">
            </td>
        </tr>
    </table>
    
    <table class="p-1 w-full border-collapse">
        <tr class="h-2 bg-red-600">
            <td colspan="9"></td>
        </tr>
        
        <tr class="h-6 bg-red-600">
            <td class="w-2"></td>
            <td class="w-6 border-l-4 border-t-4 border-yellow-400"></td>
            <td class="w-6 border-r-4 border-t-4 border-yellow-400"></td>
            <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
            <td class="border-t-4 border-b-4 border-yellow-400"></td>
            <td class="w-6 border-l-4 border-b-4 border-yellow-400"></td>
            <td class="w-6 border-l-4 border-t-4 border-yellow-400"></td>
            <td class="w-6 border-r-4 border-t-4 border-yellow-400"></td>
            <td class="w-2"></td>
        </tr>
        
        <tr class="h-6 bg-red-600">
            <td class="w-2"></td>
            <td class="w-6 border-l-4 border-b-4 border-yellow-400"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
            <td class="w-2"></td>
        </tr>
        
        <tr class="h-6 bg-red-600">
            <td class="w-2"></td>
            <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6"></td>
            <td></td>
            <td class="w-6"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6 border-b-4 border-yellow-400"></td>
            <td class="w-2"></td>
        </tr>
        
        <tr class="h-12 bg-red-600"> 
            <td class="w-2"></td>
            <td class="w-6 border-r-4 border-l-4 border-yellow-400"></td>
            <td class="w-6"></td>
            <td class="w-6"></td>
            <td class="text-center">
                <!-- CONTENT HERE! -->
                <table class="w-full">
                    <tr>
                        <td colspan='3'>
                            <p class="relative">
                                <img src="pictures/dragon-small.png" class="float-left h-48" alt="Golden Dragon"> 
                                <img src="pictures/dragon-small-flipped.png" class="float-right h-48" alt="Golden Dragon"> 
                                <span class="text-4xl font-bold text-yellow-400 font-chinese">Chinees Indische Specialiteiten</span><br>
                                <span class="text-5xl font-bold text-yellow-400 font-chinese">De Gouden Draak</span><br>
                            </p>
                            <p>
                                <table class="mx-auto text-xl text-white border border-white">
                                    <tr style="background-image: url('pictures/menu_bg_gradient.png');">
                                        <td class="align-middle">
                                            <a href="{{ route('menu') }}" class="text-white no-underline px-6">
                                                Menukaart
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('news') }}" class="text-white no-underline px-6">
                                                Nieuws
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('contact') }}" class="text-white no-underline px-6">
                                                Contact
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </p>
                        </td>
                    </tr>
                    <tr class="pt-12">
                        <td colspan="3" class="h-12"></td>
                    </tr>
                    <tr class="pt-12">
                        <td class="w-12"></td>
                        <td class="text-center text-xs border border-black bg-floralwhite p-4">
                            <h3 class="text-base mb-4">Al jaren is De Gouden Draak een begrip als het gaat om de beste afhaalgerechten in 's-Hertogenbosch.<br>
                            Graag trakteren we u op authentieke gerechten uit de Cantonese keuken.</h3>
                            
                            <h2 class="text-xl underline mb-2">Speciale Studentenaanbieding</h2>
                            <h1 class="text-2xl mb-4">Chinese Rijsttafel (2 personen)</h1>
                            <h3 class="text-base mb-4">
                                Maak een keuze uit 3 van onderstaande keuzegerechten:<br><br>
                                <table class="w-3/5 mx-auto">
                                    <tr>
                                        <td class="w-2/5 text-right">Koe Loe Yuk</td>
                                        <td class="w-1/5"></td>
                                        <td class="w-2/5">Foe Yong Hai</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Tjap Tjoy</td>
                                        <td></td>
                                        <td>Garnalen met Gebakken Knoflook</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Babi Pangang</td>
                                        <td></td>
                                        <td>Kipfilet in Zwarte Bonen saus</td>
                                    </tr>
                                </table>
                                <br>
                                Met witte rijst. (Nasi of bami voor meerprijs mogelijk.)
                            </h3>
                            <h1 class="text-2xl">Prijs: €21,00</h1>
                        </td>
                        <td class="w-12"></td>
                    </tr>
                </table>
                <br>
                <div class="text-center"><a href="paginas/contact_new.html" class="text-yellow-400 no-underline">Naar Contact</a></div>
            </td>
            <td class="w-6"></td>
            <td class="w-6"></td>
            <td class="w-6 border-r-4 border-l-4 border-yellow-400"></td>
            <td class="w-2"></td>
        </tr>
        
        <tr class="h-6 bg-red-600">
            <td class="w-2"></td>
            <td class="w-6 border-r-4 border-t-4 border-yellow-400"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6"></td>
            <td></td>
            <td class="w-6"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6 border-t-4 border-yellow-400"></td>
            <td class="w-2"></td>
        </tr>
        
        <tr class="h-6 bg-red-600">
            <td class="w-2"></td>
            <td class="w-6 border-l-4 border-t-4 border-yellow-400"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6 border-4 border-yellow-400"></td>
            <td class="w-6 border-r-4 border-t-4 border-yellow-400"></td>
            <td class="w-2"></td>
        </tr>
        
        <tr class="h-6 bg-red-600">
            <td class="w-2"></td>
            <td class="w-6 border-l-4 border-b-4 border-yellow-400"></td>
            <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
            <td class="w-6 border-r-4 border-yellow-400"></td>
            <td class="border-t-4 border-b-4 border-yellow-400"></td>
            <td class="w-6 border-l-4 border-yellow-400"></td>
            <td class="w-6 border-l-4 border-b-4 border-yellow-400"></td>
            <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
            <td class="w-2"></td>
        </tr>
        
        <tr class="h-2 bg-red-600">
            <td colspan="9"></td>
        </tr>
    </table>
</body>
</html>