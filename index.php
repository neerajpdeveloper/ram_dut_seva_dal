<?php
// PHP Backend: Form submission handler
$success_message = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Server-side validation
    if (empty($name) || empty($phone)) {
        $error_message = "कृपया नाम और मोबाइल नंबर अनिवार्य रूप से भरें।";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_message = "कृपया 10 अंकों का वैध मोबाइल नंबर दर्ज करें।";
    } else {
        // Format inquiry entry
        $timestamp = date("Y-m-d H:i:s");
        $entry = "----------------------------------------\n";
        $entry .= "Date/Time: " . $timestamp . "\n";
        $entry .= "Name: " . $name . "\n";
        $entry .= "Phone: " . $phone . "\n";
        $entry .= "Address: " . ($address ? $address : 'N/A') . "\n";
        $entry .= "Message: " . ($message ? $message : 'N/A') . "\n";
        $entry .= "----------------------------------------\n\n";

        // Save to inquiries.txt file automatically
        $file = 'inquiries.txt';
        if (file_put_contents($file, $entry, FILE_APPEND | LOCK_EX)) {
            $success_message = true;
        } else {
            $error_message = "डेटा सेव करने में समस्या आई। कृपया पुनः प्रयास करें।";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ram Dut Seva Dal | Modinagar - Seva Param Dharm</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        saffron: { 50: '#fff7ed', 100: '#ffedd5', 500: '#f97316', 600: '#ea580c', 700: '#c2410c' },
                        maroon: { 800: '#7f1d1d', 900: '#580c0f', 950: '#380406' },
                        gold: { 400: '#facc15', 500: '#eab308', 600: '#ca8a04' }
                    },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-saffron-50 text-gray-800 font-sans antialiased selection:bg-saffron-500 selection:text-white">

    <!-- Top Info Bar -->
    <div class="bg-maroon-950 text-gold-400 text-xs sm:text-sm py-2 px-4 border-b border-maroon-900">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-location-dot text-saffron-500"></i>
                <span>Modinagar, Uttar Pradesh • Seva Param Dharm</span>
            </div>
            <div class="flex items-center space-x-4">
                <span><i class="fa-solid fa-phone-volume mr-1 text-saffron-500"></i> Seva Helpline Active</span>
                <span class="hidden md:inline">|</span>
                <span class="hidden md:inline"><i class="fa-solid fa-shield-halved mr-1 text-saffron-500"></i> Sanatan Seva Abhiyan</span>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <nav class="bg-maroon-900 text-white shadow-xl sticky top-0 z-50 border-b-2 border-gold-500/80 backdrop-blur-md bg-opacity-95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">
                <!-- Brand Logo -->
                <div class="flex items-center space-x-3.5 group cursor-pointer" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-gold-500 via-saffron-500 to-amber-400 p-0.5 shadow-xl flex items-center justify-center">
                        <div class="w-full h-full bg-maroon-950 rounded-[14px] overflow-hidden flex items-center justify-center">
                            <img src="jaishriram.jpeg" alt="Logo" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center space-x-1.5">
                            <span class="text-xl sm:text-2xl font-black tracking-wider text-gold-400 block leading-tight">राम दूत सेवा दल</span>
                            <span class="bg-gold-500 text-maroon-950 text-[10px] font-extrabold px-1.5 py-0.5 rounded shadow">MODINAGAR</span>
                        </div>
                        <span class="text-xs text-saffron-100 tracking-widest font-semibold uppercase block mt-0.5">॥ सेवा परम धर्मः ॥</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6 font-medium text-sm lg:text-base">
                    <a href="#home" class="hover:text-gold-400 transition py-2 border-b-2 border-transparent hover:border-gold-400">मुखपृष्ठ</a>
                    <a href="#about" class="hover:text-gold-400 transition py-2 border-b-2 border-transparent hover:border-gold-400">हमारे बारे में</a>
                    <a href="#seva" class="hover:text-gold-400 transition py-2 border-b-2 border-transparent hover:border-gold-400">सेवा कार्य</a>
                    <a href="#stotra" class="hover:text-gold-400 transition py-2 border-b-2 border-transparent hover:border-gold-400">पाठ व स्तोत्र</a>
                    <a href="#gallery" class="hover:text-gold-400 transition py-2 border-b-2 border-transparent hover:border-gold-400">गैलरी</a>
                    <a href="#contact" class="bg-gradient-to-r from-saffron-500 to-amber-500 hover:from-saffron-600 hover:to-amber-600 text-maroon-950 px-5 py-2.5 rounded-full shadow-lg transition transform hover:-translate-y-0.5 font-bold border border-gold-400">जुड़ें / संपर्क</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="menu-btn" class="text-gold-400 focus:outline-none p-2.5 text-2xl bg-maroon-950 rounded-xl border border-maroon-800">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-maroon-950 border-t border-maroon-800 px-6 pt-4 pb-6 space-y-3 shadow-2xl">
            <a href="#home" class="block py-2.5 hover:text-gold-400 transition border-b border-maroon-900 font-medium">मुखपृष्ठ</a>
            <a href="#about" class="block py-2.5 hover:text-gold-400 transition border-b border-maroon-900 font-medium">हमारे बारे में</a>
            <a href="#seva" class="block py-2.5 hover:text-gold-400 transition border-b border-maroon-900 font-medium">सेवा कार्य</a>
            <a href="#stotra" class="block py-2.5 hover:text-gold-400 transition border-b border-maroon-900 font-medium">पाठ व स्तोत्र</a>
            <a href="#gallery" class="block py-2.5 hover:text-gold-400 transition border-b border-maroon-900 font-medium">गैलरी</a>
            <a href="#contact" class="block text-center bg-gradient-to-r from-gold-500 to-amber-500 text-maroon-950 py-3 rounded-xl font-bold shadow-md mt-2">जुड़ें / संपर्क करें</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="home" class="relative bg-gradient-to-b from-maroon-950 via-maroon-900 to-saffron-700 text-white overflow-hidden py-20 lg:py-28">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#facc15_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center space-x-2.5 bg-maroon-900/90 border border-gold-400/60 px-5 py-2 rounded-full text-gold-400 text-sm font-bold mb-8 shadow-2xl backdrop-blur-md">
                <i class="fa-solid fa-om text-saffron-500 animate-spin" style="animation-duration: 8s;"></i>
                <span>श्री हनुमान जी की असीम कृपा से संचालित</span>
            </div>
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight mb-6 text-gold-400 drop-shadow-lg">
                राम दूत सेवा दल
            </h1>
            <div class="inline-block bg-black/30 border border-gold-500/40 py-3 px-8 rounded-2xl backdrop-blur-md mb-6 shadow-xl">
                <p class="text-xl sm:text-2xl font-bold text-saffron-100 tracking-wide">
                    "सेवा परम धर्म - नि:स्वार्थ मानव व जीव सेवा"
                </p>
            </div>
            <p class="text-base sm:text-lg text-gray-200 max-w-2xl mx-auto mb-10 leading-relaxed">
                मोदीनगर क्षेत्र में सनातन संस्कृति के प्रचार-प्रसार, धार्मिक आयोजनों और बेसहारा जीवों व जरूरतमंदों की सेवा के लिए समर्पित युवाओं का पावन संगठन।
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-5">
                <a href="#seva" class="w-full sm:w-auto bg-gradient-to-r from-gold-500 via-amber-500 to-gold-600 hover:from-gold-600 hover:to-amber-600 text-maroon-950 font-extrabold px-9 py-4 rounded-2xl shadow-xl transition transform hover:-translate-y-1 flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-hands-praying text-lg"></i>
                    <span>हमारे सेवा कार्य देखें</span>
                </a>
                <a href="#stotra" class="w-full sm:w-auto bg-gradient-to-r from-saffron-600 to-amber-600 hover:from-saffron-700 hover:to-amber-700 text-white font-extrabold px-9 py-4 rounded-2xl shadow-xl transition transform hover:-translate-y-1 flex items-center justify-center space-x-2 border border-gold-400/50">
                    <i class="fa-solid fa-book-open text-lg text-gold-300"></i>
                    <span>हनुमान चालीसा व पाठ</span>
                </a>
                <a href="#contact" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 text-white font-bold px-9 py-4 rounded-2xl border border-white/30 transition backdrop-blur-md flex items-center justify-center space-x-2 shadow-lg">
                    <i class="fa-solid fa-user-plus text-lg text-gold-400"></i>
                    <span>सेवा दल से जुड़ें</span>
                </a>
            </div>
        </div>
    </header>

    <!-- AUTO SLIDER BANNER SECTION -->
    <section class="py-16 bg-maroon-950 relative overflow-hidden border-b-2 border-gold-500/30">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="text-gold-400 font-extrabold tracking-widest uppercase text-xs bg-maroon-900 px-4 py-1.5 rounded-full border border-gold-500/30">
                    <i class="fa-solid fa-award mr-1.5"></i> आधिकारिक बैनर गैलरी
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-white mt-3">राम दूत सेवा दल, मोदीनगर</h2>
                <div class="w-20 h-1 bg-gold-500 mx-auto mt-3 rounded-full"></div>
            </div>

            <!-- Slider Container -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-gold-500/60 bg-black group">
                
                <!-- Slides Wrapper -->
                <div id="banner-slider" class="relative w-full h-auto flex transition-transform duration-700 ease-in-out">
                    
                    <!-- Slide 1 -->
                    <div class="w-full flex-shrink-0">
                        <img src="banner.png" alt="Banner 1" class="w-full h-auto object-cover">
                    </div>
					 <div class="w-full flex-shrink-0">
                        <img src="banner2.png" alt="Banner 2" class="w-full h-auto object-cover">
                    </div>

                </div>
				
				

                <!-- Slider Navigation Buttons -->
                <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-maroon-900/80 hover:bg-maroon-900 text-gold-400 w-12 h-12 rounded-full border border-gold-500/50 flex items-center justify-center shadow-lg transition z-20">
                    <i class="fa-solid fa-chevron-left text-lg"></i>
                </button>
                <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-maroon-900/80 hover:bg-maroon-900 text-gold-400 w-12 h-12 rounded-full border border-gold-500/50 flex items-center justify-center shadow-lg transition z-20">
                    <i class="fa-solid fa-chevron-right text-lg"></i>
                </button>

                <!-- Slider Dots Indicator -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
                    <button onclick="currentSlide(0)" class="w-3 h-3 rounded-full bg-gold-400 transition dot-indicator" data-index="0"></button>
                    <button onclick="currentSlide(1)" class="w-3 h-3 rounded-full bg-white/50 transition dot-indicator" data-index="1"></button>
                </div>

            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-saffron-600 font-extrabold tracking-widest uppercase text-sm bg-saffron-100 px-3 py-1 rounded-full">हमारे बारे में</span>
                <h2 class="text-3xl sm:text-5xl font-black text-maroon-900 mt-3">निःस्वार्थ सेवा ही हमारा संकल्प है</h2>
                <div class="w-28 h-1.5 bg-gradient-to-r from-gold-500 to-saffron-500 mx-auto mt-4 rounded-full"></div>
            </div>
           <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Block 1: आध्यात्मिक चेतना -->
    <div class="bg-gradient-to-b from-saffron-50 to-white p-8 rounded-3xl shadow-xl border border-orange-200 text-center">
        <div class="w-20 h-20 bg-maroon-900 text-gold-400 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg border border-gold-500/30">
            <i class="fa-solid fa-om"></i>
        </div>
        <h3 class="text-2xl font-bold text-maroon-900 mb-4">आध्यात्मिक चेतना</h3>
        <p class="text-gray-600 leading-relaxed">श्री हनुमान चालीसा वितरण, धार्मिक अनुष्ठान और सनातन संस्कृति के प्रचार-प्रसार के माध्यम से समाज में आध्यात्मिक ऊर्जा का संचार करना।</p>
    </div>

    <!-- Block 2: मानव व जीव सेवा -->
    <div class="bg-gradient-to-b from-saffron-50 to-white p-8 rounded-3xl shadow-xl border border-orange-200 text-center">
        <div class="w-20 h-20 bg-maroon-900 text-gold-400 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg border border-gold-500/30">
            <i class="fa-solid fa-hand-holding-heart"></i>
        </div>
        <h3 class="text-2xl font-bold text-maroon-900 mb-4">मानव व जीव सेवा</h3>
        <p class="text-gray-600 leading-relaxed">मोदीनगर व आसपास के क्षेत्रों में जरूरतमंदों की सहायता, गरीबों की सेवा और बेजुबान जीवों की देखभाल के लिए हमेशा तत्पर रहना।</p>
    </div>

    <!-- Block 3: युवा संगठन -->
    <div class="bg-gradient-to-b from-saffron-50 to-white p-8 rounded-3xl shadow-xl border border-orange-200 text-center">
        <div class="w-20 h-20 bg-maroon-900 text-gold-400 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg border border-gold-500/30">
            <i class="fa-solid fa-users"></i>
        </div>
        <h3 class="text-2xl font-bold text-maroon-900 mb-4">युवा संगठन</h3>
        <p class="text-gray-600 leading-relaxed">मोदीनगर के ऊर्जावान युवाओं को एकजुट कर समाजहित और राष्ट्रहित के रचनात्मक कार्यों में सक्रिय सहभागिता सुनिश्चित करना।</p>
    </div>

    <!-- Block 4: संस्कार व शिक्षा -->
    <div class="bg-gradient-to-b from-saffron-50 to-white p-8 rounded-3xl shadow-xl border border-orange-200 text-center">
        <div class="w-20 h-20 bg-maroon-900 text-gold-400 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg border border-gold-500/30">
            <i class="fa-solid fa-book-open-reader"></i>
        </div>
        <h3 class="text-2xl font-bold text-maroon-900 mb-4">संस्कार व शिक्षा</h3>
        <p class="text-gray-600 leading-relaxed">नई पीढ़ी में नैतिक मूल्यों, भारतीय संस्कृति और संस्कारों की नींव मजबूत करना ताकि वे देश के जिम्मेदार नागरिक बन सकें।</p>
    </div>

    <!-- Block 5: सामाजिक एकता -->
    <div class="bg-gradient-to-b from-saffron-50 to-white p-8 rounded-3xl shadow-xl border border-orange-200 text-center">
        <div class="w-20 h-20 bg-maroon-900 text-gold-400 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg border border-gold-500/30">
            <i class="fa-solid fa-handshake-angle"></i>
        </div>
        <h3 class="text-2xl font-bold text-maroon-900 mb-4">सामाजिक एकता</h3>
        <p class="text-gray-600 leading-relaxed">समाज के सभी वर्गों को आपस में जोड़कर भाईचारे, आपसी सौहार्द और सामूहिक सहयोग की भावना को बढ़ावा देना।</p>
    </div>

    <!-- Block 6: सेवा समर्पण -->
    <div class="bg-gradient-to-b from-saffron-50 to-white p-8 rounded-3xl shadow-xl border border-orange-200 text-center">
        <div class="w-20 h-20 bg-maroon-900 text-gold-400 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg border border-gold-500/30">
            <i class="fa-solid fa-fire-flame-curved"></i>
        </div>
        <h3 class="text-2xl font-bold text-maroon-900 mb-4">निस्वार्थ सेवा</h3>
        <p class="text-gray-600 leading-relaxed">बिना किसी भेदभाव के पूरी निष्ठा और समर्पण भाव से धर्म, समाज और राष्ट्र की सेवा के लिए निरंतर कार्य करना।</p>
    </div>
</div>
        </div>
    </section>

    <!-- Seva Karya Section -->
    <section id="seva" class="py-24 bg-saffron-100/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-saffron-600 font-extrabold tracking-widest uppercase text-sm bg-white px-3 py-1 rounded-full shadow-sm">विशेष सेवा कार्य</span>
                <h2 class="text-3xl sm:text-5xl font-black text-maroon-900 mt-3">हाल ही में संपन्न प्रमुख सेवाएँ</h2>
                <div class="w-28 h-1.5 bg-gradient-to-r from-gold-500 to-saffron-500 mx-auto mt-4 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-orange-200 flex flex-col">
                    <div class="bg-gradient-to-r from-maroon-900 to-maroon-950 p-6 text-white relative">
                        <h3 class="text-2xl font-bold text-gold-400 mb-1">मोदी मंदिर में विशेष सेवा</h3>
                        <p class="text-xs text-saffron-100"><i class="fa-solid fa-location-dot mr-1"></i> स्थान: मोदीनगर</p>
                    </div>
                    <div class="p-7 flex-1 flex flex-col justify-between">
                        <p class="text-gray-700 leading-relaxed mb-6">श्री राम दूत सेवा दल की ओर से ऐतिहासिक <strong>मोदी मंदिर</strong> में श्री बालाजी महाराज के चरणों में 11 हनुमान चालीसा, 2 मंजीरा और 2 झुंझुना अर्पित किए गए।</p>
                        <div class="flex items-center text-sm font-bold text-saffron-700 bg-saffron-50 p-3.5 rounded-2xl border border-saffron-200">
                            <i class="fa-solid fa-circle-check text-gold-500 mr-2 text-lg"></i> सफलतापूलर्वक संपन्न
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-orange-200 flex flex-col">
                    <div class="bg-gradient-to-r from-maroon-900 to-maroon-950 p-6 text-white relative">
                        <h3 class="text-2xl font-bold text-gold-400 mb-1">हनुमान चालीसा वितरण</h3>
                        <p class="text-xs text-saffron-100"><i class="fa-solid fa-location-dot mr-1"></i> स्थान: क्षेत्र के मंदिर</p>
                    </div>
                    <div class="p-7 flex-1 flex flex-col justify-between">
                        <p class="text-gray-700 leading-relaxed mb-6">युवाओं और श्रद्धालुओं के बीच धार्मिक पुस्तकों का नियमित वितरण ताकि घर-घर में राम नाम व हनुमान चालीसा का पाठ गूंजे।</p>
                        <div class="flex items-center text-sm font-bold text-saffron-700 bg-saffron-50 p-3.5 rounded-2xl border border-saffron-200">
                            <i class="fa-solid fa-circle-check text-gold-500 mr-2 text-lg"></i> निरंतर जारी अभियान
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-orange-200 flex flex-col">
                    <div class="bg-gradient-to-r from-maroon-900 to-maroon-950 p-6 text-white relative">
                        <h3 class="text-2xl font-bold text-gold-400 mb-1">निःस्वार्थ जीव व गौ सेवा</h3>
                        <p class="text-xs text-saffron-100"><i class="fa-solid fa-location-dot mr-1"></i> स्थान: मोदीनगर</p>
                    </div>
                    <div class="p-7 flex-1 flex flex-col justify-between">
                        <p class="text-gray-700 leading-relaxed mb-6">"सेवा परम धर्म" के सिद्धांत पर चलते हुए बेसहारा पशुओं और पक्षियों के लिए चारे-पानी की व्यवस्था करना हमारी दैनिक प्राथमिकता है।</p>
                        <div class="flex items-center text-sm font-bold text-saffron-700 bg-saffron-50 p-3.5 rounded-2xl border border-saffron-200">
                            <i class="fa-solid fa-circle-check text-gold-500 mr-2 text-lg"></i> दैनिक सेवा संकल्प
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STOTRA & PAATH SECTION (Hanuman Chalisa, Bajrang Baan, Ashtak, Aarti) -->
    <section id="stotra" class="py-24 bg-white relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-saffron-600 font-extrabold tracking-widest uppercase text-sm bg-saffron-100 px-3 py-1 rounded-full">पवित्र धार्मिक पाठ</span>
                <h2 class="text-3xl sm:text-5xl font-black text-maroon-900 mt-3">श्री हनुमान स्तोत्र व चालीसा संग्रह</h2>
                <div class="w-28 h-1.5 bg-gradient-to-r from-gold-500 to-saffron-500 mx-auto mt-4 rounded-full"></div>
                <p class="text-gray-600 mt-4 max-w-xl mx-auto">नीचे दिए गए बटनों पर क्लिक करें और सीधे संबंधित पाठन पर पहुँचें:</p>
                
                <!-- Quick Navigation Buttons -->
                <div class="flex flex-wrap justify-center gap-3 mt-8">
                    <a href="#chalisa" class="bg-maroon-900 hover:bg-maroon-950 text-gold-400 font-bold px-5 py-2.5 rounded-xl shadow border border-gold-500/40 transition">श्री हनुमान चालीसा</a>
                    <a href="#bajrangbaan" class="bg-maroon-900 hover:bg-maroon-950 text-gold-400 font-bold px-5 py-2.5 rounded-xl shadow border border-gold-500/40 transition">बज्रङ्ग बाण</a>
                    <a href="#ashtak" class="bg-maroon-900 hover:bg-maroon-950 text-gold-400 font-bold px-5 py-2.5 rounded-xl shadow border border-gold-500/40 transition">संकटमोचन हनुमान अष्टक</a>
                    <a href="#aarti" class="bg-maroon-900 hover:bg-maroon-950 text-gold-400 font-bold px-5 py-2.5 rounded-xl shadow border border-gold-500/40 transition">श्री हनुमान जी की आरती</a>
                </div>
            </div>

            <!-- 1. SHRI HANUMAN CHALISA -->
            <div id="chalisa" class="bg-gradient-to-b from-saffron-50 to-white border-2 border-gold-400/60 rounded-3xl p-6 sm:p-10 shadow-xl mb-16">
                <div class="text-center mb-8 border-b border-orange-200 pb-6">
                    <span class="bg-gold-500 text-maroon-950 text-xs font-black px-3 py-1 rounded-full uppercase">महामंत्र</span>
                    <h3 class="text-3xl font-black text-maroon-900 mt-3">श्री हनुमान चालीसा</h3>
                    <p class="text-xs text-gray-500 mt-1">॥ दोहा ॥</p>
                </div>
                <div class="text-center space-y-4 text-gray-800 font-medium text-base sm:text-lg leading-relaxed">
                    <p>श्रीगुरु चरन सरोज रज निज मनु मुकुर सुधारि।<br>बरनउँ रघुबर बिमल सुजोकु जो दायकु फल चारि॥<br>बुद्धिहीन तनु जानिकै सुमौं पवन-कुमार।<br>बल बुद्धि बिद्या देहु मोहि हरहु कलेस विकार॥</p>
                    <div class="w-16 h-0.5 bg-gold-500 mx-auto my-6"></div>
                    <p><strong>चौपाई</strong></p>
                    <p>जय हनुमान ज्ञान गुन सागर। जय कपीस तिहुँ लोक उजागर॥<br>राम दूत अतुलित बल धामा। अंजनि-पुत्र पनामा नाम महावीरा॥<br>महाबीर बिक्रम बजरंगी। कुमति निवार सुमति के संगी॥<br>कंचन बरन बिराज सुबेसा। कानन कुंडल कुंचित केसा॥<br>हाथ बज्र औ ध्वजा बिराजै। काँधे मुंज जनेऊ साजै॥<br>संकर सुवन केसरीनंदन। तेज प्रताप महा जग बन्दन॥<br>बिद्यावान गुनी अति चातुर। राम काज करिबे को आतुर॥<br>प्रभु चरित्र सुनिबे को रसिया। राम लखन सीता मन बसिया॥<br>सूक्ष्म रूप धरि सियहि दिखावा। बिकट रूप धरि लंका जरावा॥<br>भीम रूप धरि असुर संहारये। रामचन्द्र के काज संवारे॥<br>लाय सजीवन लखन जियाये। श्री रघुबीर हरषि उर लाये॥<br>रघुपति की बहुत बड़ाई की मम प्रिय भरत समहि भाई॥<br>सहस बदन तुम्हरो जस गावैं। अस कहि श्रीपति कंठ लगावैं॥<br>सनकादिक ब्रह्मा मुनीसा। नारद सारद सहित अहीसा॥<br>जम कुबेर दिक्पाल जहाँ ते। कवि कोविद कहि सके कहाँ ते॥<br>तुम उपकार सुग्रीवहि कीन्हा। राम मिलाय राज पद दीन्हा॥<br>तुम्हरो मन्त्र विभीषन माना। लंक भए सब जग सहि जाना॥<br>युग सहस्र योजन पर भानु। लील्यो ताहि मधुर फल जानू॥<br>प्रभु बरिधि काठि अचर है गारा। दुर्ग काज जगत के आरा॥<br>राम दुआरे तुम रखवारे। होत न आज्ञा बिनु पैसारे॥<br>सब सुख लहै तुम्हारी सरना। तुम रक्षक काहू को डर ना॥<br>आपन तेज संहारो आपै। तीनों लोक हाँक ते काँपै॥<br>भूत पिसाच निकट नहिं आवै। महाबीर जब नाम सुनावै॥<br>नासै रोग हरै सब पीड़ा। जपत निरंतर हनुमान बीड़ा॥<br>संकट तें हनुमान छुड़ावै। मन क्रम बचन ध्यान जो लावै॥<br>सब पर राम तपस्वी राजा। तिन के काज सकल तुम साजा॥<br>और मनोरथ जो कोई लावै। सोइ अमित जीवन फल पावै॥<br>चारों जुग परताप तुम्हारा। है परसिद्ध जगत उजियारा॥<br>साधु संत के तुम रखवारे। असुर निकंदन राम दुलारे॥<br>अष्ट सिद्धि नौ निधि के दाता। अस बर दीन जानकी माता॥<br>राम रसायन तुम्हारे पासा। सदा रहो रघुपति के दासा॥<br>तुम्हरे भजन राम को पावै। जन्म जन्म के दुख बिसरावै॥<br>अंत काल रघुबर पुर जाई।जहाँ जन्म हरि-भक्त कहाई॥<br>और देवता चित्त न धरै। हनुमान सेइ सर्व सुख करै॥<br>संकट कटै मिटै सब पीड़ा। जो सुमिरै हनुमंत बलबीरा॥<br>जै जै जै हनुमान गोसाईं। कृपा करहु गुरुदेव की नाँई॥<br>जो शत बार पाठ कर कोई। छूटहि बन्दी महासुख होई॥<br>जो यह पढ़ै हनुमान चालीसा। होय सिद्धि साखी गौरीसा॥<br>तुलसीदास सदा हरि चेरा। कीजै नाथ हृदय महँ डेरा॥</p>
                    <div class="w-16 h-0.5 bg-gold-500 mx-auto my-6"></div>
                    <p class="text-sm font-bold text-maroon-900">॥ दोहा ॥</p>
                    <p>पवन तनय संकट हरन, मंगल मूरति रूप।<br>राम लखन सीता सहित, हृदय बसहु सुर भूप॥</p>
                </div>
            </div>

            <!-- 2. BAJRANG BAAN -->
            <div id="bajrangbaan" class="bg-gradient-to-b from-saffron-50 to-white border-2 border-gold-400/60 rounded-3xl p-6 sm:p-10 shadow-xl mb-16">
                <div class="text-center mb-8 border-b border-orange-200 pb-6">
                    <span class="bg-gold-500 text-maroon-950 text-xs font-black px-3 py-1 rounded-full uppercase">उग्र स्तोत्र</span>
                    <h3 class="text-3xl font-black text-maroon-900 mt-3">बज्रङ्ग बाण</h3>
                    <p class="text-xs text-gray-500 mt-1">॥ दोहा ॥</p>
                </div>
                <div class="text-center space-y-4 text-gray-800 font-medium text-base sm:text-lg leading-relaxed">
                    <p>निस्चय प्रेम प्रतीति ते, बिनय करैं संमान।<त्यी>तेहि के कारज सकल सिद्ध करै हनुमान्॥</p>
                    <div class="w-16 h-0.5 bg-gold-500 mx-auto my-6"></div>
                    <p>जय हनुमंत संत हितकारी। सुनि लीजै प्रभु अरज हमारी॥<br>जन के काज बिलंब न कीजै। आतुर दौरि महा सुख दीजै॥<br>जैसे बालि बाधि को मारा।हिन्दू धर्म रच्छक रखवारा॥<br>जय कपि सुग्रीव महादेवा। तुरत करहु मोइ प्रभु की सेवा॥<br>खूब बज्र बाण बहत त्रिशूला। मोहि उबारि हरहु सब शूला॥<br>बनकटि काटि खर्ज कर डारा। जय जय जय कपि सूर अपारा॥<br>स्वर्ण थार सुभग धरि थापा। रक्षक रामदूत भव बापा॥<br>उठि चलु तोहि राम दुहाई। पांय परों कर जोरि मनाई॥<br>काज कवन ते मोहि बिसारा। सुर निकंदन राम दुलारा॥<br>जय गजेंद्र बंध छुड़ावा। भवसागर से पार लगावा॥<br>लखन मूर्छित परयो जब भारी। आणि सजीवन प्रान उबारी॥<br>पैठि पाताल तोरि यम काना। अहिरावण की भुजा बखाना॥<br>बाँय भुजा असुर दल मारे। दाहिने हाथ राम संवारे॥<br>सुर मुनि बन्दि संकट हर डारा। दास जनन का प्राण उबारा॥<br>अब तोहि बिनु कौन संवारे। संकट मोचन नाम तिहारे॥<br>जो यह पढ़ै बज्रङ्ग बाण पाठा। छूटै बंधन होय सुख साटा॥<br>जय हनुमंत जयति बलसीमा। कृपा करहु हे राम हनूमा॥</p>
                    <div class="w-16 h-0.5 bg-gold-500 mx-auto my-6"></div>
                    <p class="text-sm font-bold text-maroon-900">॥ दोहा ॥</p>
                    <p>भूत पिसाच निकट नहिं आवै, महावीर जब नाम सुनावै।<br>नासै रोग हरै सब पीड़ा, जपत निरंतर हनुमान बीड़ा॥</p>
                </div>
            </div>

            <!-- 3. SANKATMOCHAN HANUMAN ASHTAK -->
            <div id="ashtak" class="bg-gradient-to-b from-saffron-50 to-white border-2 border-gold-400/60 rounded-3xl p-6 sm:p-10 shadow-xl mb-16">
                <div class="text-center mb-8 border-b border-orange-200 pb-6">
                    <span class="bg-gold-500 text-maroon-950 text-xs font-black px-3 py-1 rounded-full uppercase">अष्टक स्तोत्र</span>
                    <h3 class="text-3xl font-black text-maroon-900 mt-3">संकटमोचन हनुमान अष्टक</h3>
                </div>
                <div class="text-center space-y-4 text-gray-800 font-medium text-base sm:text-lg leading-relaxed">
                    <p>बाल समय रवि भयो इच्छा, लिन्यो तिनि भुवन भयो भिक्षा।<br>तेहि असुर समाज डरायो, तिन लोक में त्रास बढ़ायो॥<br>देव संकट कियो पुकारा, तिनहि काज महाप्रभु पधारा।<br>बाल समय रबि भयो भक्ष्यो तिनि लोक भयो अंधियारो भारा॥<br><strong>बाल समय रवि भयो भक्ष्यो तिनि लोक भयो अंधियारो भारा।<br>को नहिं जानत है जग में संकटमोचन नाम तिहारा॥</strong></p>
                    <p>बाली की त्रास भयोजन भारी, संकट हरन कियो मंगलकारी।<br>जा कहुँ प्रभु कीन्हा कृपा अपारा, तिनि काज सफल भयो संसारा॥<br>रावण भुज काढ़ि गयो जब भारी, लागी आगि लंका सुख सारी।<br><strong>बेगि द्यौ आनि सजीवन भारी, को नहिं जानत है जग में संकटमोचन नाम तिहारा॥</strong></p>
                    <p>जाि समय राम लक्षण वनवासी, व्याकुल भए देखि सुत दासी।<br>आनि सजीवन लखन जियाये, श्री रघुबीर हरषि उर लाएँ॥<br>रावण युद्ध अपार मचायो, अहिरावण पाताल पठायो।<br><strong>आहिरावण की भुजा उखारा, को नहिं जानत है जग में संकटमोचन नाम तिहारा॥</strong></p>
                    <p>काज किए सुरन के भारी, संकट हरन कियो सुखकारी।<br>देवन बंदि छुड़ायो जबहीं, त्रैलोक भय दूर कियो तबहीं॥<br>लाय संजीवन लखन जियाये, भक्तन के संकट सब नाशै।<br><strong>सुनि प्रभु बचन हरषि मन मारा, को नहिं जानत है जग में संकटमोचन नाम तिहारा॥</strong></p>
                    <p>बजे ढोल मृदंग निशान, जय जय धुनि होइ भोर विहान।<br>बालक वृद्ध सबै मिलि गावैं, संकटमोचन महिमा पावैं॥<br>जो यह पड़े अष्टक मन लावै, ताके सकल मनोरथ पावै।<br><strong>बाल समय रबि भयो अउरा, को नहिं जानत है जग में संकटमोचन नाम तिहारा॥</strong></p>
                </div>
            </div>

            <!-- 4. HANUMAN JI KI AARTI -->
            <div id="aarti" class="bg-gradient-to-b from-saffron-50 to-white border-2 border-gold-400/60 rounded-3xl p-6 sm:p-10 shadow-xl">
                <div class="text-center mb-8 border-b border-orange-200 pb-6">
                    <span class="bg-gold-500 text-maroon-950 text-xs font-black px-3 py-1 rounded-full uppercase">आरती</span>
                    <h3 class="text-3xl font-black text-maroon-900 mt-3">श्री हनुमान जी की आरती</h3>
                </div>
                <div class="text-center space-y-4 text-gray-800 font-medium text-base sm:text-lg leading-relaxed">
                    <p>आरती कीजै हनुमान लला की। दुष्ट दलन रघुनाथ कला की॥<br>जाके बल से गिरिवर काँपै। रोग बलग दोष निकट न झाँपै॥<br>अंजनि पुत्र महाबलदायी। सन्तन के प्रभु सदा सहाई॥<br>दे बीरा रघुनाथ पठाए। लंका जारि सिया सुधि लाए॥<br>लंक जराइ असुर संहारे। सियाराम जी के काज संवारे॥<br>लक्ष्मण मूर्छित पड़े सजीवन लाए। आनि सुसेन बैद्य प्रगटाए॥<br>पैठि पाताल तोरि यम कारा। अहिरावण की भुजा उखारा॥<br>बाँये भुजा असुर दल मारे। दाहिने हाथ संत उबारे॥<br>सुता सुमन माल गले बिराजै। कानन कुंडल कुंचित साजै॥<br>तुम पाँय पड़ों कर जोरि मनाई। आस पूरु मोहि देव गोसाईं॥<br>आरती कीजै हनुमान लला की। दुष्ट दलन रघुनाथ कला की॥</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-saffron-600 font-extrabold tracking-widest uppercase text-sm bg-saffron-100 px-3 py-1 rounded-full">झांकी एवं दर्शन</span>
                <h2 class="text-3xl sm:text-5xl font-black text-maroon-900 mt-3">सेवा दल गैलरी</h2>
                <div class="w-28 h-1.5 bg-gradient-to-r from-gold-500 to-saffron-500 mx-auto mt-4 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="relative overflow-hidden rounded-3xl shadow-xl group h-80 bg-maroon-950 border border-gold-500/40 flex items-center justify-center p-6 text-center">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent z-10"></div>
                    <img src="banner.png" alt="Modi Mandir Seva" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-70">
                    <div class="relative z-20 text-white">
                        <h4 class="text-2xl font-bold text-gold-400 mb-1">मुख्य बैनर</h4>
                        <p class="text-sm text-saffron-100">राम दूत सेवा दल, मोदीनगर</p>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-3xl shadow-xl group h-80 bg-maroon-950 border border-gold-500/40 flex items-center justify-center p-6 text-center">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent z-10"></div>
                    <img src="jaishriram.jpeg" alt="Logo" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-70">
                    <div class="relative z-20 text-white">
                        <h4 class="text-2xl font-bold text-gold-400 mb-1">संगठन लोगो</h4>
                        <p class="text-sm text-saffron-100">सेवा परम धर्मः</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact / Join Us Section with PHP Validation & File Saving -->
    <section id="contact" class="py-24 bg-saffron-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-2xl border border-orange-200 overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-900 to-maroon-950 text-white p-8 sm:p-12 text-center relative">
                    <h2 class="text-3xl sm:text-4xl font-black text-gold-400 mb-3">राम दूत सेवा दल से जुड़ें</h2>
                    <p class="text-saffron-100 text-base">अपना विवरण भेजें और मोदीनगर के हमारे सेवा अभियानों का हिस्सा बनें।</p>
                </div>
                <div class="p-8 sm:p-12">
                    
                    <!-- PHP Success/Error Notification -->
                    <?php if ($success_message): ?>
                        <div class="mb-8 bg-emerald-50 border border-emerald-300 text-emerald-900 p-6 rounded-2xl text-center font-bold text-lg shadow-inner">
                            जय श्री राम! आपका संदेश सफलतापूर्वक सबमिट हो गया है और डेटा **inquiries.txt** फाइल में सेव कर दिया गया है। 🙏
                        </div>
                    <?php elseif (!empty($error_message)): ?>
                        <div class="mb-8 bg-red-50 border border-red-300 text-red-900 p-6 rounded-2xl text-center font-bold text-lg shadow-inner">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <form id="seva-form" action="#contact" method="POST" onsubmit="return validateForm()" class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">आपका पूरा नाम *</label>
                                <input type="text" id="name" name="name" required class="w-full px-4.5 py-3.5 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:outline-none transition" placeholder="उदा. राहुल शर्मा">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">मोबाइल नंबर *</label>
                                <input type="tel" id="phone" name="phone" required class="w-full px-4.5 py-3.5 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:outline-none transition" placeholder="10 अंकों का मोबाइल नंबर">
                                <span id="phone-error" class="text-red-600 text-xs mt-1 hidden">कृपया सही 10 अंकों का मोबाइल नंबर दर्ज करें।</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">क्षेत्र / पता (मोदीनगर)</label>
                            <input type="text" id="address" name="address" class="w-full px-4.5 py-3.5 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:outline-none transition" placeholder="उदा. मोदी मंदिर के पास, मोदीनगर">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">आप किस प्रकार सेवा करना चाहते हैं?</label>
                            <textarea id="message" name="message" rows="3" class="w-full px-4.5 py-3.5 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:outline-none transition" placeholder="अपने सुझाव या सेवा इच्छा लिखें..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-saffron-600 via-saffron-700 to-amber-600 hover:from-saffron-700 hover:to-amber-700 text-white font-extrabold py-4 rounded-2xl shadow-xl transition transform hover:-translate-y-0.5 text-lg">
                            <i class="fa-solid fa-paper-plane mr-2"></i> संदेश भेजें / जुड़ें
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-maroon-950 text-gray-300 py-14 border-t-2 border-gold-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center items-center space-x-3 mb-6">
                <div class="w-12 h-12 rounded-2xl overflow-hidden bg-gradient-to-tr from-gold-500 to-saffron-500 p-0.5 shadow-lg flex items-center justify-center">
                    <img src="jaishriram.jpeg" alt="Logo" class="w-full h-full object-cover rounded-xl">
                </div>
                <span class="text-2xl font-black text-gold-400">राम दूत सेवा दल</span>
            </div>
            <p class="text-sm text-saffron-100 mb-8 max-w-md mx-auto leading-relaxed font-medium">
                "नि:स्वार्थ मानव व जीव सेवा" • मोदीनगर - 2026<br><span class="text-gold-400 font-bold">॥ सेवा परम धर्मः ॥</span>
            </p>
            <div class="flex justify-center space-x-6 mb-8 text-2xl">
                <a href="#" class="text-gold-400 hover:text-white transition transform hover:scale-110"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="text-gold-400 hover:text-white transition transform hover:scale-110"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="text-gold-400 hover:text-white transition transform hover:scale-110"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
            <p class="text-xs text-gray-500 border-t border-maroon-900 pt-8">
                &copy; 2026 Ram Dut Seva Dal, Modinagar. All Rights Reserved.
            </p>
        </div>
    </footer>

    <!-- JavaScript for Mobile Menu, Form Validation, and Auto Banner Slider -->
    <script>
        // Mobile Menu Toggle
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Form Validation
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const phoneError = document.getElementById('phone-error');
            const phoneRegex = /^[0-9]{10}$/;

            if (name === "") {
                alert("कृपया अपना पूरा नाम दर्ज करें।");
                return false;
            }

            if (!phoneRegex.test(phone)) {
                phoneError.classList.remove('hidden');
                document.getElementById('phone').focus();
                return false;
            } else {
                phoneError.classList.add('hidden');
            }

            return true;
        }

        // Banner Slider Logic
        let currentIndex = 0;
        const slider = document.getElementById('banner-slider');
        const totalSlides = slider.children.length;
        const dots = document.querySelectorAll('.dot-indicator');

        function updateSlider() {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
            dots.forEach((dot, idx) => {
                if (idx === currentIndex) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-gold-400', 'w-6');
                } else {
                    dot.classList.remove('bg-gold-400', 'w-6');
                    dot.classList.add('bg-white/50', 'w-3');
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlider();
        }

        function currentSlide(index) {
            currentIndex = index;
            updateSlider();
        }

        // Auto Slide every 3.5 seconds
        let slideInterval = setInterval(nextSlide, 3500);

        // Pause auto-slide on mouse hover over slider
        const sliderContainer = slider.parentElement;
        sliderContainer.addEventListener('mouseenter', () => clearInterval(slideInterval));
        sliderContainer.addEventListener('mouseleave', () => {
            slideInterval = setInterval(nextSlide, 3500);
        });
    </script>
</body>
</html>