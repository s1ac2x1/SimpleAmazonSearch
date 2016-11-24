<?php
require_once("core/WSRequest.php");
include("db.php");

class TopItem
{
    public $asin;
    public $imgUrl;
    public $imgH;
    public $imgW;
    public $title;
    public $subCategory;
    public $index;
    public $price;
    public $review;
    public $detailsLink;
}

$part = $_GET['part'];

if ($part) {
    if ($part == 1) {
        workWith('Books', 'Arts & Photography');
        workWith('Books', 'Biographies and Memoirs');
        workWith('Books', 'Business & Investing');
        workWith('Books', 'Calendars');
    }
    if ($part == 2) {
        workWith('Books', 'Childrens');
        workWith('Books', 'Comics & Graphic Novels');
        workWith('Books', 'Computer & Internet');
        workWith('Books', 'Cooking, Food & Wine');
    }
    if ($part == 3) {
        workWith('Books', 'Entertainment');
        workWith('Books', 'Gay & Lesbian');
        workWith('Books', 'Health, Mind and Body');
        workWith('Books', 'History');
    }
    if ($part == 4) {
        workWith('Books', 'Home & Garden');
        workWith('Books', 'Law');
        workWith('Books', 'Literature & Fiction');
        workWith('Books', 'Medicine');
    }
    if ($part == 5) {
        workWith('Books', 'Mystery & Thrillers');
        workWith('Books', 'Nonfiction');
        workWith('Books', 'Outdoors & Nature');
        workWith('Books', 'Parenting & Families');
    }
    if ($part == 6) {
        workWith('Books', 'Politics & Social Sciences');
        workWith('Books', 'Professional & Technical');
        workWith('Books', 'Reference');
        workWith('Books', 'Religion & Spirituality');
    }
    if ($part == 7) {
        workWith('Books', 'Romance');
        workWith('Books', 'Science');
        workWith('Books', 'Science Fiction and Fantasy');
        workWith('Books', 'Sports');
    }
    if ($part == 8) {
        workWith('Books', 'Teens');
        workWith('Books', 'Travel');
    }
    if ($part == 9) {
        workWith('Appliances', 'Air Conditioners');
        workWith('Appliances', 'Air Purifiers');
        workWith('Appliances', 'Cooktops');
        workWith('Appliances', 'Dehumidifiers');
    }
    if ($part == 10) {
        workWith('Appliances', 'Dishwashers');
        workWith('Appliances', 'Freezers');
        workWith('Appliances', 'Home Appliance Installation Services');
        workWith('Appliances', 'Humidifiers');
    }
    if ($part == 11) {
        workWith('Appliances', 'Parts & Accessories');
        workWith('Appliances', 'Ranges');
        workWith('Appliances', 'Wall Ovens');
    }
    if ($part == 12) {
        workWith('Appliances', 'Warming Drawers');
        workWith('Appliances', 'Washers & Dryers');
    }
    if ($part == 26) {
        workWith('Beauty', 'Bath');
        workWith('Beauty', 'Bath Sets');
        workWith('Beauty', 'Bathing Accessories');
        workWith('Beauty', 'Cleansers');
    }
    if ($part == 27) {
        workWith('Beauty', 'Scrubs & Body Treatments');
        workWith('Beauty', 'Bags & Cases');
        workWith('Beauty', 'Cotton & Swabs');
        workWith('Beauty', 'Facial Steamers');
    }
    if ($part == 28) {
        workWith('Beauty', 'Hair Coloring Tools');
        workWith('Beauty', 'Makeup Brushes & Tools');
        workWith('Beauty', 'Mirrors');
        workWith('Beauty', 'Nail Tools');
    }
    if ($part == 29) {
        workWith('Beauty', 'Styling Tools');
        workWith('Beauty', 'Body, Face and Hand Lotions');
        workWith('Beauty', 'Antiaging Creams');
        workWith('Beauty', 'Cleansers');
    }
    if ($part == 30) {
        workWith('Beauty', 'Massage Oils');
        workWith('Beauty', 'Baby Oils');
        workWith('Beauty', 'Exfoliators');
        workWith('Beauty', 'Toners');
    }
    if ($part == 31) {
        workWith('Beauty', 'Sun Tan Products');
        workWith('Beauty', 'Fragrance');
        workWith('Beauty', 'Gift Sets');
        workWith('Beauty', 'Body Paint');
    }
    if ($part == 32) {
        workWith('Beauty', 'Bronzing Powder');
        workWith('Beauty', 'Body Glitter');
        workWith('Beauty', 'Concealer');
        workWith('Beauty', 'Temporary Tattoos');
    }
    if ($part == 33) {
        workWith('Beauty', 'Henna');
        workWith('Beauty', 'Eyes Makeup');
        workWith('Beauty', 'Face Makeup');
        workWith('Beauty', 'Lips Makeup');
    }
    if ($part == 34) {
        workWith('Beauty', 'Makeup Palettes');
        workWith('Beauty', 'Makeup Remover');
        workWith('Beauty', 'Makeup Sets');
    }
    if ($part == 35) {
        workWith('Beauty', 'Nails');
        workWith('Beauty', 'Mens Grooming');
        workWith('Collectibles', 'Collectibles');
    }
    if ($part == 36) {
        workWith('Apparel', 'Belts');
        workWith('Apparel', 'Cold Weather');
        workWith('Apparel', 'Girls Fashion Scarves');
        workWith('Apparel', 'Girls Hats & Caps');
    }
    if ($part == 37) {
        workWith('Apparel', 'Vests');
        workWith('Apparel', 'Cardigans');
        workWith('Apparel', 'Bras');
        workWith('Apparel', 'Swimwear');
    }
    if ($part == 38) {
        workWith('Apparel', 'Socks');
        workWith('Apparel', 'Hosiery');
        workWith('Apparel', 'Tights');
        workWith('Apparel', 'Sweaters');
    }
    if ($part == 39) {
        workWith('Apparel', 'Sleepwear');
        workWith('Apparel', 'Pajamas');
        workWith('Apparel', 'Robes');
        workWith('Apparel', 'Night gowns');
    }
    if ($part == 40) {
        workWith('Apparel', 'Tank Tops');
        workWith('Apparel', 'Turtlenecks');
        workWith('Apparel', 'Shorts');
        workWith('Apparel', 'Skirts');
    }
    if ($part == 41) {
        workWith('Apparel', 'Jeans');
        workWith('Apparel', 'Coats');
        workWith('Apparel', 'Raincoats');
        workWith('Apparel', 'Polos');
    }
    if ($part == 42) {
        workWith('Apparel', 'Jackets');
        workWith('Apparel', 'Parkas');
        workWith('Apparel', 'Windbreakers');
        workWith('Apparel', 'Outerwear');
    }
    if ($part == 43) {
        workWith('Apparel', 'Sweatshirts');
        workWith('Apparel', 'Dresses');
        workWith('Apparel', 'Jumpers');
        workWith('Apparel', 'Formals');
    }
    if ($part == 44) {
        workWith('Apparel', 'Shirts');
        workWith('Apparel', 'Pants');
        workWith('Apparel', 'Underwear');
        workWith('Apparel', 'Athletic clothing');
    }
    if ($part == 45) {
        workWith('Apparel', 'Visors');
        workWith('Apparel', 'Scarves');
        workWith('Apparel', 'Ties');
        workWith('Apparel', 'Baby clothes');
    }
    if ($part == 46) {
        workWith('Apparel', 'Sunglasses');
        workWith('Apparel', 'Glasses cases');
        workWith('Apparel', 'Hats');
        workWith('Apparel', 'Caps');
    }
    if ($part == 47) {
        workWith('Apparel', 'Girls Sunglasses');
        workWith('Apparel', 'Eyewear');
        workWith('Apparel', 'Glasses');
        workWith('Apparel', 'Reading glasses');
    }
    if ($part == 48) {
        workWith('Music', 'R&B');
        workWith('Music', 'Rock');
        workWith('Music', 'Soundtracks');
        workWith('Music', 'World Music');
    }
    if ($part == 49) {
        workWith('Music', 'Latin Music');
        workWith('Music', 'Miscellaneous');
        workWith('Music', 'New Age');
        workWith('Music', 'Pop');
    }
    if ($part == 50) {
        workWith('Music', 'Folk');
        workWith('Music', 'Gospel');
        workWith('Music', 'Hard Rock & Metal');
        workWith('Music', 'Jazz');
    }
    if ($part == 51) {
        workWith('Music', 'Classic Rock');
        workWith('Music', 'Classical');
        workWith('Music', 'Country');
        workWith('Music', 'Dance & Electronic');
    }
    if ($part == 52) {
        workWith('Music', 'Broadway & Vocalists');
        workWith('Music', 'Childrens Music');
        workWith('Music', 'Christian');
    }
    if ($part == 53) {
        workWith('Music', 'Alternative Rock');
        workWith('Music', 'Blues');
        workWith('HealthPersonalCare', 'Nutrition Bars & Drinks');
        workWith('HealthPersonalCare', 'Sports Supplements');
    }
    if ($part == 54) {
        workWith('Electronics', 'Printers & Ink');
        workWith('Electronics', 'Scanners');
        workWith('Electronics', 'Tablets');
        workWith('Electronics', 'Motorcycle Electronics');
    }
    if ($part == 55) {
        workWith('Electronics', 'Laptops');
        workWith('Electronics', 'Netbooks');
        workWith('Electronics', 'PDAs');
        workWith('Electronics', 'Handhelds');
    }
    if ($part == 56) {
        workWith('Electronics', 'Desktops');
        workWith('Electronics', 'Servers');
        workWith('Electronics', 'External Components');
        workWith('Electronics', 'External Data Storage');
    }
    if ($part == 57) {
        workWith('Electronics', 'Solid-State Drives');
        workWith('Electronics', 'Power Supplies');
        workWith('Electronics', 'Sound Cards');
        workWith('Electronics', 'Cas');
    }
    if ($part == 58) {
        workWith('Electronics', 'Video Cards');
        workWith('Electronics', 'Graphics Cards');
        workWith('Electronics', 'Hard Drives');
        workWith('Electronics', 'Bare Drives');
    }
    if ($part == 59) {
        workWith('Electronics', 'CPUs');
        workWith('Electronics', 'Motherboards');
        workWith('Electronics', 'PC Memory');
        workWith('Electronics', 'DRAM');
    }
    if ($part == 60) {
        workWith('Electronics', 'Computer Accessories & Peripherals');
        workWith('Electronics', 'Computer Network Accessories');
        workWith('Electronics', 'Computer Parts & Components');
        workWith('Electronics', 'Computer Warranties & Services');
    }
    if ($part == 61) {
        workWith('Electronics', 'Portable Audio & Video');
        workWith('Electronics', 'Security & Surveillance');
        workWith('Electronics', 'Service & Replacement Plans');
        workWith('Electronics', 'Television & Video');
    }
    if ($part == 62) {
        workWith('Electronics', 'eBook Readers & Accessories');
        workWith('Electronics', 'Electronic Equipment Warranties');
        workWith('Electronics', 'GPS & Navigation');
        workWith('Electronics', 'Home Audio');
    }
    if ($part == 63) {
        workWith('Electronics', 'Telephone Accessories');
        workWith('Electronics', 'Boat Electronics');
        workWith('Electronics', 'Car Electronics');
        workWith('Electronics', 'Cell Phones & Accessories');
    }
    if ($part == 64) {
        workWith('Electronics', 'Consumer Electronics Installation Services');
        workWith('Electronics', 'Mounts');
        workWith('Electronics', 'Office Electronics Accessories');
        workWith('Electronics', 'Power Protection');
    }
    if ($part == 65) {
        workWith('Electronics', 'Batteries, Chargers & Accessories');
        workWith('Electronics', 'Blank Media');
        workWith('Electronics', 'Cables');
        workWith('Electronics', 'Car Electronics Accessories');
    }
    if ($part == 66) {
        workWith('Electronics', 'Underwater Camera Housings');
        workWith('Electronics', 'Underwater Photography Cameras');
        workWith('Electronics', 'Underwater Photography Lighting');
        workWith('Electronics', 'Audio & Video Accessories');
    }
    if ($part == 67) {
        workWith('Electronics', 'Tripod Heads');
        workWith('Electronics', 'Tripod Legs');
        workWith('Electronics', 'Tripods');
        workWith('Electronics', 'Underwater Camcorders');
    }
    if ($part == 68) {
        workWith('Electronics', 'Bullet Cameras');
        workWith('Electronics', 'Dome Cameras');
        workWith('Electronics', 'Dummy Cameras');
        workWith('Electronics', 'Monopods');
    }
    if ($part == 69) {
        workWith('Electronics', 'Digital Cameras');
        workWith('Electronics', 'Film Cameras');
        workWith('Electronics', 'Lenses');
        workWith('Electronics', 'Projectors');
    }
    if ($part == 70) {
        workWith('Electronics', 'Microscopes');
        workWith('Electronics', 'Monoculars');
        workWith('Electronics', 'Telescopes');
        workWith('Electronics', 'Camcorders ');
    }
    if ($part == 71) {
        workWith('Electronics', 'Projector Accessories');
        workWith('Electronics', 'Telescope Accessories');
        workWith('Electronics', 'Tripod & Monopod Accessories');
        workWith('Electronics', 'Binoculars');
    }
    if ($part == 72) {
        workWith('Electronics', 'Color Calibration Charts');
        workWith('Electronics', 'Grey Cards');
        workWith('Electronics', 'Photographic Studio Equipment');
        workWith('Electronics', 'Professional Video Accessories');
    }
    if ($part == 73) {
        workWith('Electronics', 'Lighting');
        workWith('Electronics', 'Photographic Equipment Rain Covers');
        workWith('Electronics', 'Photographic Film');
        workWith('Electronics', 'Light Meters');
    }
    if ($part == 74) {
        workWith('Electronics', 'Filters');
        workWith('Electronics', 'Flash Accessories');
        workWith('Electronics', 'Lens Accessories');
        workWith('Electronics', 'Light Boxes & Loupes');
    }
    if ($part == 75) {
        workWith('Electronics', 'Cases & Bags');
        workWith('Electronics', 'Cleaners');
        workWith('Electronics', 'Darkroom Supplies');
        workWith('Electronics', 'Film Camera Accessories');
    }
    if ($part == 76) {
        workWith('Electronics', 'Blank Media');
        workWith('Electronics', 'Cables & Cords');
        workWith('Electronics', 'Camcorder Accessories');
        workWith('Electronics', 'Camera & Photo Installation Services');
    }
    if ($part == 77) {
        workWith('Electronics', 'Batteries & Chargers');
        workWith('Electronics', 'Binocular Accessories');
        workWith('Electronics', 'Binocular, Camera & Camcorder Straps');
    }
    if ($part == 78) {
        workWith('Grocery', 'Seafood');
        workWith('Grocery', 'Snack Food');
        workWith('Grocery', 'Vegetables');
        workWith('Grocery', 'Wine, Beer & Spirits');
    }
    if ($part == 79) {
        workWith('Grocery', 'Oils, Vinegars & Salad Dressings');
        workWith('Grocery', 'Pasta');
        workWith('Grocery', 'Prepared Food');
        workWith('Grocery', 'Sauces & Dips');
    }
    if ($part == 80) {
        workWith('Grocery', 'Home Brewing & Wine Making');
        workWith('Grocery', 'Jams, Jellies & Spreads');
        workWith('Grocery', 'Meat & Poultry');
        workWith('Grocery', 'Noodles');
    }
    if ($part == 81) {
        workWith('Grocery', 'Fresh Flowers & Indoor Plants');
        workWith('Grocery', 'Fruits');
        workWith('Grocery', 'Gourmet Gifts');
        workWith('Grocery', 'Herbs, Spices & Seasonings');
    }
    if ($part == 82) {
        workWith('Grocery', 'Chocolate');
        workWith('Grocery', 'Condiments');
        workWith('Grocery', 'Cooking & Baking Supplies');
        workWith('Grocery', 'Dairy & Eggs');
    }
    if ($part == 83) {
        workWith('Grocery', 'Breads & Bakery');
        workWith('Grocery', 'Breakfast Foods');
        workWith('Grocery', 'Candy');
    }
    if ($part == 84) {
        workWith('Grocery', 'Baby Food');
        workWith('Grocery', 'Beans & Grains');
        workWith('Grocery', 'Beverages');
    }
    if ($part == 85) {
        workWith('HealthPersonalCare', 'Sexual Enhancers');
        workWith('HealthPersonalCare', 'Gift Wrapping Supplies');
        workWith('HealthPersonalCare', 'Party Supplies');
        workWith('HealthPersonalCare', 'Stationery');
    }
    if ($part == 86) {
        workWith('HealthPersonalCare', 'Bondage Gear & Accessories');
        workWith('HealthPersonalCare', 'Fetish Wear');
        workWith('HealthPersonalCare', 'Safer Sex');
        workWith('HealthPersonalCare', 'Sensual Delights');
    }
    if ($part == 87) {
        workWith('HealthPersonalCare', 'Lip Care Products');
        workWith('HealthPersonalCare', 'Oral Hygiene');
        workWith('HealthPersonalCare', 'Shaving & Hair Removal');
        workWith('HealthPersonalCare', 'Adult Toys & Games');
    }
    if ($part == 88) {
        workWith('HealthPersonalCare', 'Ear Care');
        workWith('HealthPersonalCare', 'Eye Care');
        workWith('HealthPersonalCare', 'Feminine Hygiene');
        workWith('HealthPersonalCare', 'Foot Care');
    }
    if ($part == 89) {
        workWith('HealthPersonalCare', 'Mobility Aids & Equipment');
        workWith('HealthPersonalCare', 'Occupational & Physical Therapy Aids');
        workWith('HealthPersonalCare', 'Body Art Supplies');
        workWith('HealthPersonalCare', 'Deodorants & Antiperspirants');
    }
    if ($part == 90) {
        workWith('HealthPersonalCare', 'Beds & Accessories');
        workWith('HealthPersonalCare', 'Braces & Supports');
        workWith('HealthPersonalCare', 'Daily Living Aids');
        workWith('HealthPersonalCare', 'Health Monitors');
    }
    if ($part == 91) {
        workWith('HealthPersonalCare', 'Laundry');
        workWith('HealthPersonalCare', 'Lighters');
        workWith('HealthPersonalCare', 'Paper & Plastic');
        workWith('HealthPersonalCare', 'Bathroom Aids & Safety');
    }
    if ($part == 92) {
        workWith('HealthPersonalCare', 'Cleaning Tools');
        workWith('HealthPersonalCare', 'Dishwashing');
        workWith('HealthPersonalCare', 'Household Batteries');
        workWith('HealthPersonalCare', 'Household Cleaners');
    }
    if ($part == 93) {
        workWith('HealthPersonalCare', 'Thermometers');
        workWith('HealthPersonalCare', 'Women Health');
        workWith('HealthPersonalCare', 'Men Health');
        workWith('HealthPersonalCare', 'Air Fresheners');
    }
    if ($part == 94) {
        workWith('HealthPersonalCare', 'Stimulants');
        workWith('HealthPersonalCare', 'Stress Reduction Products');
        workWith('HealthPersonalCare', 'Therapeutic Skin Care Products');
        workWith('HealthPersonalCare', 'Thermometer Accessories');
    }
    if ($part == 95) {
        workWith('HealthPersonalCare', 'Massage & Relaxation');
        workWith('HealthPersonalCare', 'Pain Relief');
        workWith('HealthPersonalCare', 'Sleep & Snoring');
        workWith('HealthPersonalCare', 'Smoking Cessation');
    }
    if ($part == 96) {
        workWith('HealthPersonalCare', 'Family Planning & Birth Control Products');
        workWith('HealthPersonalCare', 'First Aid Supplies');
        workWith('HealthPersonalCare', 'Foot Health Care Products');
        workWith('HealthPersonalCare', 'Incontinence');
    }
    if ($part == 97) {
        workWith('HealthPersonalCare', 'Alternative Medicine');
        workWith('HealthPersonalCare', 'Cough & Cold Medicine');
        workWith('HealthPersonalCare', 'Diabetes');
        workWith('HealthPersonalCare', 'Digestion & Nausea');
    }
    if ($part == 98) {
        workWith('HealthPersonalCare', 'Vitamins & Supplements');
        workWith('HealthPersonalCare', 'Weight Loss Products');
        workWith('HealthPersonalCare', 'Allergy, Sinus & Asthma Medicine');
    }
    if ($part == 99) {
        workWith('HomeGarden', 'Steamers');
        workWith('HomeGarden', 'Storage & Organization');
        workWith('HomeGarden', 'Vacuums & Floor Care');
        workWith('HomeGarden', 'Water Coolers & Filters');
    }
    if ($part == 100) {
        workWith('HomeGarden', 'Air Quality');
        workWith('HomeGarden', 'Lighting');
        workWith('HomeGarden', 'Cleaning Supplies');
        workWith('HomeGarden', 'Irons');
    }
    if ($part == 101) {
        workWith('HomeGarden', 'Garden Markdowns');
        workWith('HomeGarden', 'Patio');
        workWith('HomeGarden', 'Space Heaters');
        workWith('HomeGarden', 'Cooling');
    }
    if ($part == 102) {
        workWith('HomeGarden', 'Hammocks');
        workWith('HomeGarden', 'Plants');
        workWith('HomeGarden', 'Home Decor');
        workWith('HomeGarden', 'Wall Decor');
    }
    if ($part == 103) {
        workWith('HomeGarden', 'Bedding & Bath');
        workWith('HomeGarden', 'Furniture');
        workWith('HomeGarden', 'Grills');
        workWith('HomeGarden', 'Fire pits');
    }
    if ($part == 104) {
        workWith('HomeGarden', 'Cutting');
        workWith('HomeGarden', 'Measuring & Layout');
        workWith('HomeGarden', 'Shaping');
        workWith('HomeGarden', 'Woodworking');
    }
    if ($part == 105) {
        workWith('HomeGarden', 'Cordless Staplers');
        workWith('HomeGarden', 'Drills');
        workWith('HomeGarden', 'Saws');
        workWith('HomeGarden', 'Assembly');
    }
    if ($part == 106) {
        workWith('HomeGarden', 'Cordless In-Line Screwdrivers');
        workWith('HomeGarden', 'Cordless Nailers');
        workWith('HomeGarden', 'Cordless Rotary Hammers');
        workWith('HomeGarden', 'Cordless Rotary Tools');
    }
    if ($part == 107) {
        workWith('HomeGarden', 'Air Screwdrivers');
        workWith('HomeGarden', 'Sanders & Grinders');
        workWith('HomeGarden', 'Combo Packs');
        workWith('HomeGarden', 'Cordless Impact Drivers & Wrenches');
    }
    if ($part == 108) {
        workWith('HomeGarden', 'Air Chisels');
        workWith('HomeGarden', 'Air Combo Packs');
        workWith('HomeGarden', 'Air Ratchet Wrenches');
        workWith('HomeGarden', 'Air Saws');
    }
    if ($part == 109) {
        workWith('Industrial', 'Retaining Compounds');
        workWith('Industrial', 'Threadlocking Adhesives');
        workWith('Industrial', 'Urea Resin Adhesives');
        workWith('Industrial', 'Urethane Adhesives');
    }
    if ($part == 110) {
        workWith('Industrial', 'Industrial Lubricants');
        workWith('Industrial', 'Industrial Sealants');
        workWith('Industrial', 'Polyvinyl Acetate Adhesives');
        workWith('Industrial', 'Resorcinol Adhesives');
    }
    if ($part == 111) {
        workWith('Industrial', 'Epoxy Adhesives');
        workWith('Industrial', 'Ethylene Vinyl Acetate Adhesives');
        workWith('Industrial', 'Hot Melt Adhesives');
        workWith('Industrial', 'Industrial Coatings');
    }
    if ($part == 112) {
        workWith('Industrial', 'Aerosol Adhesives');
        workWith('Industrial', 'Caulk');
        workWith('Industrial', 'Contact Cements');
        workWith('Industrial', 'Cyanoacrylate Adhesives');
    }
    if ($part == 113) {
        workWith('Industrial', 'Adhesive Dispensers');
        workWith('Industrial', 'Adhesive Dots');
        workWith('Industrial', 'Adhesive Primers');
        workWith('Industrial', 'Adhesive Tapes');
    }
    if ($part == 114) {
        workWith('Industrial', 'Shafting');
        workWith('Industrial', 'Springs');
        workWith('Industrial', 'Science Education');
        workWith('Industrial', 'Adhesive Accelerators');
    }
    if ($part == 115) {
        workWith('Industrial', 'Mechanical Gearboxes');
        workWith('Industrial', 'Pulleys');
        workWith('Industrial', 'Ratchets & Pawls');
        workWith('Industrial', 'Roller Chain Sprockets');
    }
    if ($part == 116) {
        workWith('Industrial', 'Enclosures & Cases');
        workWith('Industrial', 'Gears');
        workWith('Industrial', 'Industrial Fluids');
        workWith('Industrial', 'Linear Motion Products');
    }
    if ($part == 117) {
        workWith('Industrial', 'Brakes & Clutches');
        workWith('Industrial', 'Chains');
        workWith('Industrial', 'Control Cables');
        workWith('Industrial', 'Couplings, Collars & Universal Joiners');
    }
    if ($part == 118) {
        workWith('Industrial', 'Industrial Power Tools');
        workWith('Industrial', 'Workholding');
        workWith('Industrial', 'Bearings');
        workWith('Industrial', 'Belts');
    }
    if ($part == 119) {
        workWith('Industrial', 'Industrial Warning Signs');
        workWith('Industrial', 'Lockout Tagout Locks & Tags');
        workWith('Industrial', 'Personal Protective Equipment');
        workWith('Industrial', 'Industrial Hand Tools');
    }
    if ($part == 120) {
        workWith('Industrial', 'Video Inspection Equipment');
        workWith('Industrial', 'Emergency Response Equipment');
        workWith('Industrial', 'Hazardous Material Handling');
        workWith('Industrial', 'Industrial Warning Alarms');
    }
    if ($part == 121) {
        workWith('Industrial', 'Surface Roughness Comparators');
        workWith('Industrial', 'Surface Roughness Gauges');
        workWith('Industrial', 'Torque Gauges');
        workWith('Industrial', 'V Blocks');
    }
    if ($part == 122) {
        workWith('Industrial', 'Roughness Tester');
        workWith('Industrial', 'Snap Gauges');
        workWith('Industrial', 'Space Blocks');
        workWith('Industrial', 'Straight Edges');
    }
    if ($part == 123) {
        workWith('Industrial', 'Optical Inspection Apparatus');
        workWith('Industrial', 'Optical Measurement Apparatus');
        workWith('Industrial', 'Replicating Materials');
        workWith('Industrial', 'Ring Gauges');
    }
    if ($part == 124) {
        workWith('Industrial', 'Industrial Tools Protractors');
        workWith('Industrial', 'Linear Distance Indicators');
        workWith('Industrial', 'Magnetic Bases');
        workWith('Industrial', 'Micrometers');
    }
    if ($part == 125) {
        workWith('Industrial', 'Gage Blocks & Accessories');
        workWith('Industrial', 'Gauge Balls');
        workWith('Industrial', 'Hardware Pin Gauges');
        workWith('Industrial', 'Height Gauges');
    }
    if ($part == 126) {
        workWith('Industrial', 'Countersink Gauges');
        workWith('Industrial', 'Depth Gauges');
        workWith('Industrial', 'Dimensional Measurement');
        workWith('Industrial', 'Force Gauges');
    }
    if ($part == 127) {
        workWith('Industrial', 'Borescopes');
        workWith('Industrial', 'Calibration Standard Rods');
        workWith('Industrial', 'Calipers');
        workWith('Industrial', 'Chamfer Gauges');
    }
    if ($part == 128) {
        workWith('Industrial', 'Metals & Alloys');
        workWith('Industrial', 'Rubber');
        workWith('Industrial', 'Wood');
        workWith('Industrial', 'Material Handling Products');
    }
    if ($part == 129) {
        workWith('Industrial', 'Microbiology Supplies');
        workWith('Industrial', 'Ceramics');
        workWith('Industrial', 'Fabrics, Fibers & Textiles');
        workWith('Industrial', 'Glass');
    }
    if ($part == 130) {
        workWith('Industrial', 'Lab Furniture');
        workWith('Industrial', 'Lab Instruments');
        workWith('Industrial', 'Lab Utensils');
        workWith('Industrial', 'Labware');
    }
    if ($part == 131) {
        workWith('Industrial', 'Lab Chemicals');
        workWith('Industrial', 'Lab Cleaning Brushes');
        workWith('Industrial', 'Lab Consumabless');
        workWith('Industrial', 'Lab Equipment');
    }
    if ($part == 132) {
        workWith('Industrial', 'Science Lab Disposable Wipes');
        workWith('Industrial', 'Science Lab Glassware Washing Solutions');
        workWith('Industrial', 'Waste Receptacles & Liners');
        workWith('Industrial', 'Wire Brushes');
    }
    if ($part == 133) {
        workWith('Industrial', 'Personal Care Products');
        workWith('Industrial', 'Restroom Fixtures');
        workWith('Industrial', 'Science Lab Detergents');
        workWith('Industrial', 'Science Lab Disinfectants');
    }
    if ($part == 134) {
        workWith('Industrial', 'Industrial Lavatory Baby Changing Stations');
        workWith('Industrial', 'Industrial Lavatory Stall Parts');
        workWith('Industrial', 'Odor & Drain Maintainers');
        workWith('Industrial', 'Paper Products');
    }
    if ($part == 135) {
        workWith('Industrial', 'Plumbing');
        workWith('Industrial', 'Cleaning Chemicals');
        workWith('Industrial', 'Cleaning Tools');
        workWith('Industrial', 'Floor Care');
    }
    if ($part == 136) {
        workWith('Industrial', 'Latches');
        workWith('Industrial', 'Snaps');
        workWith('Industrial', 'Hydraulics');
        workWith('Industrial', 'Pneumatics');
    }
    if ($part == 137) {
        workWith('Industrial', 'Hardware Support Arms');
        workWith('Industrial', 'Hinges');
        workWith('Industrial', 'Hooks');
        workWith('Industrial', 'Knobs & Hand Wheels');
    }
    if ($part == 138) {
        workWith('Industrial', 'Handles & Pulls');
        workWith('Industrial', 'Hardware Braces');
        workWith('Industrial', 'Hardware Drawer Slides');
        workWith('Industrial', 'Hardware Lock Bolts');
    }
    if ($part == 139) {
        workWith('Industrial', 'Bumpers');
        workWith('Industrial', 'Catches');
        workWith('Industrial', 'Chains');
        workWith('Industrial', 'Grommets');
    }
    if ($part == 140) {
        workWith('Industrial', 'Threaded Rods & Studs');
        workWith('Industrial', 'Washers');
        workWith('Industrial', 'Filtration');
        workWith('Industrial', 'Food Service');
    }
    if ($part == 141) {
        workWith('Industrial', 'Rivets');
        workWith('Industrial', 'Screws');
        workWith('Industrial', 'Spacers & Standoffs');
        workWith('Industrial', 'Threaded Inserts');
    }
    if ($part == 142) {
        workWith('Industrial', 'Industrial Tolerance Rings');
        workWith('Industrial', 'Nuts');
        workWith('Industrial', 'Pins');
        workWith('Industrial', 'Retaining Rings');
    }
    if ($part == 143) {
        workWith('Industrial', 'Anchors');
        workWith('Industrial', 'Bolts');
        workWith('Industrial', 'Hardware Biscuits');
        workWith('Industrial', 'Industrial Expansion Plugs');
    }
    if ($part == 144) {
        workWith('Industrial', 'Attenuators');
        workWith('Industrial', 'Semiconductor Products');
        workWith('Industrial', 'Sensors');
        workWith('Industrial', 'Thermal Management Products');
    }
    if ($part == 145) {
        workWith('Industrial', 'Resistors');
        workWith('Industrial', 'Inductors');
        workWith('Industrial', 'Transducers');
        workWith('Industrial', 'Transformers');
    }
    if ($part == 146) {
        workWith('Industrial', 'Fiber Optic Products');
        workWith('Industrial', 'Interconnects');
        workWith('Industrial', 'Optoelectronic Products');
        workWith('Industrial', 'Capacitors');
    }
    if ($part == 147) {
        workWith('Industrial', 'Cutting Tools');
        workWith('Industrial', 'Circuit Protection Products');
        workWith('Industrial', 'Electromechanical Products');
        workWith('Industrial', 'Electronic Decade Boxes');
    }
    if ($part == 148) {
        workWith('HomeGarden', 'Air Blowguns');
        workWith('Industrial', 'Abrasive');
        workWith('Industrial', 'Finishing Products');
    }
    if ($part == 149) {
        workWith('Jewelry', 'Eternity Rings');
        workWith('Jewelry', 'Promise Rings');
        workWith('Jewelry', 'Wedding Bands');
        workWith('Jewelry', 'Wedding Ring Sets');
    }
    if ($part == 150) {
        workWith('Jewelry', 'Religious Earrings');
        workWith('Jewelry', 'Religious Necklaces and Pendants');
        workWith('Jewelry', 'Anniversary Rings');
        workWith('Jewelry', 'Engagement Rings');
    }
    if ($part == 151) {
        workWith('Jewelry', 'Novelty Jewelry Necklaces & Pendants');
        workWith('Jewelry', 'Novelty Jewelry Rings');
        workWith('Jewelry', 'Religious Bracelets');
        workWith('Jewelry', 'Religious Brooches and Pins');
    }
    if ($part == 152) {
        workWith('Jewelry', 'Novelty Body Jewelry');
        workWith('Jewelry', 'Novelty Bracelets');
        workWith('Jewelry', 'Novelty Brooches & Pins');
        workWith('Jewelry', 'Novelty Earrings');
    }
    if ($part == 153) {
        workWith('Jewelry', 'Pendant Enhancers');
        workWith('Jewelry', 'Pendants');
        workWith('Jewelry', 'Strand Necklaces');
        workWith('Jewelry', 'Y Necklaces');
    }
    if ($part == 154) {
        workWith('Jewelry', 'Tie Pins');
        workWith('Jewelry', 'Choker Necklaces');
        workWith('Jewelry', 'Lockets');
        workWith('Jewelry', 'Pearl Necklace');
    }
    if ($part == 155) {
        workWith('Jewelry', 'Cuff Links');
        workWith('Jewelry', 'Men Necklaces');
        workWith('Jewelry', 'Mens Earrings');
        workWith('Jewelry', 'Tie Clip');
    }
    if ($part == 156) {
        workWith('Jewelry', 'Hoop Earrings');
        workWith('Jewelry', 'Stud Earrings');
        workWith('Jewelry', 'Gemstones');
        workWith('Jewelry', 'Bracelets');
    }
    if ($part == 157) {
        workWith('Jewelry', 'Dangle Earrings');
        workWith('Jewelry', 'Diamond Earrings');
        workWith('Jewelry', 'Ear Cuffs & Wrap');
        workWith('Jewelry', 'Earring Jackets');
    }
    if ($part == 158) {
        workWith('Jewelry', 'Brooches and Pins');
        workWith('Jewelry', 'Charms');
        workWith('Jewelry', 'Children Jewelry');
        workWith('Jewelry', 'Clip-On Earrings');
    }
    if ($part == 159) {
        workWith('Jewelry', 'Link Bracelet');
        workWith('Jewelry', 'Stretch Bracelets');
        workWith('Jewelry', 'Tennis Bracelet');
        workWith('Jewelry', 'Wrap');
    }
    if ($part == 160) {
        workWith('Jewelry', 'Beaded Bracelets');
        workWith('Jewelry', 'Charm Bracelet');
        workWith('Jewelry', 'Cuff Bracelets');
        workWith('Jewelry', 'ID Bracelets');
    }
    if ($part == 161) {
        workWith('Jewelry', 'Piercing Jewelry');
        workWith('Jewelry', 'Toe Rings');
        workWith('Jewelry', 'Bangles');
    }
    if ($part == 162) {
        workWith('Jewelry', 'Boxes & Organizers');
        workWith('Jewelry', 'Cleaning & Care Products');
        workWith('Jewelry', 'Belly Chains');
    }
    if ($part == 163) {
        workWith('KindleStore', 'Kindle Newspapers');
        workWith('KindleStore', 'Kindle Singles');
        workWith('KindleStore', 'Kindles');
        workWith('KindleStore', 'Audible');
    }
    if ($part == 164) {
        workWith('KindleStore', 'Kindle Accessories');
        workWith('KindleStore', 'Kindle Blogs');
        workWith('KindleStore', 'Kindle eBooks');
        workWith('KindleStore', 'Kindle Magazines & Journals');
    }
    if ($part == 165) {
        workWith('Kitchen', 'Bake & Serve Sets');
        workWith('Kitchen', 'Bakers & Casseroles');
        workWith('Kitchen', 'Bakeware Sets');
        workWith('Kitchen', 'Baking & Cookie Sheets');
    }
    if ($part == 166) {
        workWith('Kitchen', 'Bread & Loaf Pans');
        workWith('Kitchen', 'Cake Pans');
        workWith('Kitchen', 'Candy Making Supplies');
        workWith('Kitchen', 'Decorating Tools');
    }
    if ($part == 167) {
        workWith('Kitchen', 'Mixing Bowls');
        workWith('Kitchen', 'Muffin & Popover Pans');
        workWith('Kitchen', 'Pie, Tart & Quiche Pans');
        workWith('Kitchen', 'Pizza Pans & Stones');
    }
    if ($part == 168) {
        workWith('Kitchen', 'Small Pastry Molds');
        workWith('Kitchen', 'Jelly-Roll Pans');
        workWith('Kitchen', 'Bar & Wine Glass Markers');
        workWith('Kitchen', 'Bar Sets');
    }
    if ($part == 169) {
        workWith('Kitchen', 'Coasters');
        workWith('Kitchen', 'Cocktail Napkins');
        workWith('Kitchen', 'Cocktail Picks');
        workWith('Kitchen', 'Cocktail Shakers');
    }
    if ($part == 170) {
        workWith('Kitchen', 'Flasks');
        workWith('Kitchen', 'Glass Rimming Salts & Sugars');
        workWith('Kitchen', 'Ice Buckets & Tongs');
        workWith('Kitchen', 'Ice Crushers');
    }
    if ($part == 171) {
        workWith('Kitchen', 'Muddlers');
        workWith('Kitchen', 'Swizzle Sticks');
        workWith('Kitchen', 'Wine Stoppers & Pourers');
        workWith('Kitchen', 'Coffee Grinders');
    }
    if ($part == 172) {
        workWith('Kitchen', 'Coffee Presses');
        workWith('Kitchen', 'Coffee Scoops - Coffee, Tea & Espresso');
        workWith('Kitchen', 'Drip Coffee Machines');
        workWith('Kitchen', 'Espresso Machine & Coffeemaker Combos');
    }
    if ($part == 173) {
        workWith('Kitchen', 'Percolators');
        workWith('Kitchen', 'Single-Serve Brewers');
        workWith('Kitchen', 'Stovetop Espresso Pots');
        workWith('Kitchen', 'Tea Accessories');
    }
    if ($part == 174) {
        workWith('Kitchen', 'Canning');
        workWith('Kitchen', 'Casseroles');
        workWith('Kitchen', 'Chefs Pans');
        workWith('Kitchen', 'Cookware & Bakeware Lids');
    }
    if ($part == 175) {
        workWith('Kitchen', 'Cookware Accessories');
        workWith('Kitchen', 'Cookware Sets');
        workWith('Kitchen', 'Double Boilers');
        workWith('Kitchen', 'Dutch Ovens');
    }
    if ($part == 176) {
        workWith('Kitchen', 'Griddles');
        workWith('Kitchen', 'Grill Pans');
        workWith('Kitchen', 'Multipots & Pasta Cookers');
        workWith('Kitchen', 'Pot Racks');
    }
    if ($part == 177) {
        workWith('Kitchen', 'Roasting Pans');
        workWith('Kitchen', 'Saucepans');
        workWith('Kitchen', 'Sauciers');
        workWith('Kitchen', 'Skillets: Omelet Pans');
    }
    if ($part == 178) {
        workWith('Kitchen', 'Steamer Cookware');
        workWith('Kitchen', 'Stockpots');
        workWith('Kitchen', 'Teakettles');
        workWith('Kitchen', 'Toaster Oven Cookware');
    }
    if ($part == 179) {
        workWith('Kitchen', 'Beer Glasses');
        workWith('Kitchen', 'Beer Mugs');
        workWith('Kitchen', 'Champagne Glasses');
        workWith('Kitchen', 'Collins Glasses');
    }
    if ($part == 180) {
        workWith('Kitchen', 'Goblets: Wine Goblets');
        workWith('Kitchen', 'Hurricane Glasses');
        workWith('Kitchen', 'Iced Tea Glasses');
        workWith('Kitchen', 'Irish Coffee Glasses');
    }
    if ($part == 181) {
        workWith('Kitchen', 'Martini Glasses');
        workWith('Kitchen', 'Mint Julep Cups');
        workWith('Kitchen', 'Mixed Drinkware Sets');
        workWith('Kitchen', 'Old Fashioned Glasses');
    }
    if ($part == 182) {
        workWith('Kitchen', 'Sake Sets - Glassware & Drinkware');
        workWith('Kitchen', 'Shot Glasses');
        workWith('Kitchen', 'Snifter Glasses');
        workWith('Kitchen', 'Tumblers');
    }
    if ($part == 183) {
        workWith('Kitchen', 'Beer Brewing');
        workWith('Kitchen', 'Brewing & Venting Cleaning Products');
        workWith('Kitchen', 'Brewing & Venting Labeling Supplies');
        workWith('Kitchen', 'Fermentation & More');
    }
    if ($part == 184) {
        workWith('Kitchen', 'Racking & Storage');
        workWith('Kitchen', 'Wine Making');
        workWith('Kitchen', 'Aprons');
        workWith('Kitchen', 'Cloth Napkins');
    }
    if ($part == 185) {
        workWith('Kitchen', 'Kitchen Rugs & Mats');
        workWith('Kitchen', 'Place Mats');
        workWith('Kitchen', 'Potholders & Oven Mitts');
        workWith('Kitchen', 'Tablecloths');
    }
    if ($part == 186) {
        workWith('Kitchen', 'Kitchen & Table Linens');
        workWith('Kitchen', 'Asian Knives');
        workWith('Kitchen', 'Boning & Fillet Knives');
        workWith('Kitchen', 'Bread & Serrated Knives');
    }
    if ($part == 187) {
        workWith('Kitchen', 'Chefs Knives');
        workWith('Kitchen', 'Cleavers');
        workWith('Kitchen', 'Cutlery Accessories');
        workWith('Kitchen', 'Cutlery Sets');
    }
    if ($part == 188) {
        workWith('Kitchen', 'Electric Knives');
        workWith('Kitchen', 'Flatware Cake Knives');
        workWith('Kitchen', 'Knife Blocks & Storage');
        workWith('Kitchen', 'Knife Sharpeners');
    }
    if ($part == 189) {
        workWith('Kitchen', 'Shears');
        workWith('Kitchen', 'Specialty Knives');
        workWith('Kitchen', 'Steak Knives');
        workWith('Kitchen', 'Utility Knives');
    }
    if ($part == 190) {
        workWith('Kitchen', 'Can Openers');
        workWith('Kitchen', 'Cheese Tools');
        workWith('Kitchen', 'Colanders & Food Strainers');
        workWith('Kitchen', 'Cooking Utensils');
    }
    if ($part == 191) {
        workWith('Kitchen', 'Graters, Peelers & Slicers');
        workWith('Kitchen', 'Kitchen Accessories');
        workWith('Kitchen', 'Measuring Tools & Scales');
        workWith('Kitchen', 'Meat & Poultry Tools');
    }
    if ($part == 192) {
        workWith('Kitchen', 'Pasta & Pizza Tools');
        workWith('Kitchen', 'Salad Tools & Spinners');
        workWith('Kitchen', 'Salt & Pepper');
        workWith('Kitchen', 'Seasoning & Spice Tools');
    }
    if ($part == 193) {
        workWith('Kitchen', 'Thermometers & Timers');
        workWith('Kitchen', 'Tool & Gadget Sets');
        workWith('Kitchen', 'Bread Machine Parts');
        workWith('Kitchen', 'Coffee & Espresso Machine Parts');
    }
    if ($part == 194) {
        workWith('Kitchen', 'Microwave Oven Parts');
        workWith('Kitchen', 'Blenders');
        workWith('Kitchen', 'Bread Machines');
        workWith('Kitchen', 'Coffee, Tea & Espresso Appliances');
    }
    if ($part == 195) {
        workWith('Kitchen', 'Contact Grills');
        workWith('Kitchen', 'Deep Fryers');
        workWith('Kitchen', 'Electric Griddles');
        workWith('Kitchen', 'Electric Skillets');
    }
    if ($part == 196) {
        workWith('Kitchen', 'Food Processors');
        workWith('Kitchen', 'Hot Pots - Small Appliances');
        workWith('Kitchen', 'Ice-Cream Machines');
        workWith('Kitchen', 'Juicers');
    }
    if ($part == 197) {
        workWith('Kitchen', 'Mixers');
        workWith('Kitchen', 'Mixers, blenders, coffee and espresso machines');
        workWith('Kitchen', 'Ovens & Toasters');
        workWith('Kitchen', 'Rice Cookers');
    }
    if ($part == 198) {
        workWith('Kitchen', 'Small-Appliance Sets');
        workWith('Kitchen', 'Specialty Appliances');
        workWith('Kitchen', 'Steamer Appliances');
        workWith('Kitchen', 'Waffle Irons');
    }
    if ($part == 199) {
        workWith('Kitchen', 'Bread Boxes');
        workWith('Kitchen', 'Cabinet Accessories');
        workWith('Kitchen', 'Cabinet Organizers');
        workWith('Kitchen', 'Cold Beverage Koozies');
    }
    if ($part == 200) {
        workWith('Kitchen', 'Compost Bins');
        workWith('Kitchen', 'Cookie Jars');
        workWith('Kitchen', 'Dish Racks');
        workWith('Kitchen', 'Flatware Organizers');
    }
    if ($part == 201) {
        workWith('Kitchen', 'Food Savers');
        workWith('Kitchen', 'Food Tins');
        workWith('Kitchen', 'Kitchen Storage & Organization Accessories');
        workWith('Kitchen', 'Kitchen Storage & Organization Sets');
    }
    if ($part == 202) {
        workWith('Kitchen', 'Lazy Susans');
        workWith('Kitchen', 'Lunch Boxes & Bags');
        workWith('Kitchen', 'Mug Hooks');
        workWith('Kitchen', 'Pot Lid Holders');
    }
    if ($part == 203) {
        workWith('Kitchen', 'Reusable Lunch Bags');
        workWith('Kitchen', 'Rinse Baskets');
        workWith('Kitchen', 'Thermoses');
        workWith('Kitchen', 'Under Cabinet Stemware Holders');
    }
    if ($part == 204) {
        workWith('Kitchen', 'Utensil Organizers');
        workWith('Kitchen', 'Wine Racks');
        workWith('Kitchen', 'Bowls');
        workWith('Kitchen', 'Cups, Mugs & Saucers');
    }
    if ($part == 205) {
        workWith('Kitchen', 'Flatware');
        workWith('Kitchen', 'Plates');
        workWith('Kitchen', 'Saucers - Tabletop');
        workWith('Kitchen', 'Serveware');
    }
    if ($part == 206) {
        workWith('Magazines', '$10 & Under Magazines');
        workWith('Magazines', '$10 To $15 Magazines');
        workWith('Magazines', '$15 To $20 Magazines');
        workWith('Magazines', '$20 To $25 Magazines');
    }
    if ($part == 207) {
        workWith('Magazines', 'Magazines $8 or Less');
        workWith('Magazines', 'Arts & Photography');
        workWith('Magazines', 'Automotive');
        workWith('Magazines', 'Brides & Weddings');
    }
    if ($part == 208) {
        workWith('Magazines', 'Childrens');
        workWith('Magazines', 'Computers & Internet');
        workWith('Magazines', 'Cooking, Food & Wine');
        workWith('Magazines', 'Education');
    }
    if ($part == 209) {
        workWith('Magazines', 'Entertainment');
        workWith('Magazines', 'Fashion & Style');
        workWith('Magazines', 'Gay & Lesbian');
        workWith('Magazines', 'Health, Mind & Body');
    }
    if ($part == 210) {
        workWith('Magazines', 'Home & Garden');
        workWith('Magazines', 'International Publications');
        workWith('Magazines', 'Large Print');
        workWith('Magazines', 'Law');
    }
    if ($part == 211) {
        workWith('Magazines', 'Mens Interest');
        workWith('Magazines', 'Movies and Music Magazines');
        workWith('Magazines', 'News and Politics Magazine Subscriptions');
        workWith('Magazines', 'Newsletters');
    }
    if ($part == 212) {
        workWith('Magazines', 'Outdoors & Nature');
        workWith('Magazines', 'Parenting & Families');
        workWith('Magazines', 'Professional & Trade');
        workWith('Magazines', 'Reference');
    }
    if ($part == 213) {
        workWith('Magazines', 'Science Fiction & Fantasy');
        workWith('Magazines', 'Spanish-Language');
        workWith('Magazines', 'Sports & Leisure');
        workWith('Magazines', 'Teens');
    }
    if ($part == 214) {
        workWith('MobileApps', 'City Info Apps');
        workWith('MobileApps', 'Communication Apps');
        workWith('MobileApps', 'Education Apps');
        workWith('MobileApps', 'Entertainment');
    }
    if ($part == 215) {
        workWith('MobileApps', 'Games');
        workWith('MobileApps', 'Health & Fitness Apps');
        workWith('MobileApps', 'Kids');
        workWith('MobileApps', 'Magazine Apps');
    }
    if ($part == 216) {
        workWith('MobileApps', 'Novelty Apps');
        workWith('MobileApps', 'Photography Apps');
        workWith('MobileApps', 'Productivity');
        workWith('MobileApps', 'Reference Apps');
    }
    if ($part == 217) {
        workWith('MobileApps', 'Shopping Apps');
        workWith('MobileApps', 'Social Networking');
        workWith('MobileApps', 'Sports');
        workWith('MobileApps', 'Theme Apps');
    }
    if ($part == 218) {
        workWith('MP3Downloads', 'Alternative Rock');
        workWith('MP3Downloads', 'Blues');
        workWith('MP3Downloads', 'Broadway & Vocalists');
        workWith('MP3Downloads', 'Childrens Music');
    }
    if ($part == 219) {
        workWith('MP3Downloads', 'Classic Rock');
        workWith('MP3Downloads', 'Classical');
        workWith('MP3Downloads', 'Country');
        workWith('MP3Downloads', 'Dance & Electronic');
    }
    if ($part == 220) {
        workWith('MP3Downloads', 'Gospel');
        workWith('MP3Downloads', 'Hard Rock & Metal');
        workWith('MP3Downloads', 'Jazz');
        workWith('MP3Downloads', 'Latin Music');
    }
    if ($part == 221) {
        workWith('MP3Downloads', 'New Age');
        workWith('MP3Downloads', 'Pop');
        workWith('MP3Downloads', 'R&B');
        workWith('MP3Downloads', 'Rock');
    }
    if ($part == 222) {
        workWith('MusicalInstruments', 'DJ Equipment');
        workWith('MusicalInstruments', 'Electronic Music');
        workWith('MusicalInstruments', 'Karaoke Equipment');
        workWith('MusicalInstruments', 'Acoustic Basses & Acoustic-Electric Basses');
    }
    if ($part == 223) {
        workWith('MusicalInstruments', 'Electric Basses');
        workWith('MusicalInstruments', 'Autoharps');
        workWith('MusicalInstruments', 'Banjos');
        workWith('MusicalInstruments', 'Bouzoukis');
    }
    if ($part == 224) {
        workWith('MusicalInstruments', 'Lap & Pedal Steel Guitars');
        workWith('MusicalInstruments', 'Mandolins');
        workWith('MusicalInstruments', 'Ouds');
        workWith('MusicalInstruments', 'Psalteries');
    }
    if ($part == 225) {
        workWith('MusicalInstruments', 'Tamburas');
        workWith('MusicalInstruments', 'Ukuleles');
        workWith('MusicalInstruments', 'Vinas');
        workWith('MusicalInstruments', 'Zithers');
    }
    if ($part == 226) {
        workWith('MusicalInstruments', 'Fifes');
        workWith('MusicalInstruments', 'Jews Harps');
        workWith('MusicalInstruments', 'Kazoos');
        workWith('MusicalInstruments', 'Neys');
    }
    if ($part == 227) {
        workWith('MusicalInstruments', 'Ojas');
        workWith('MusicalInstruments', 'Pan Pipes');
        workWith('MusicalInstruments', 'Shakuhachis');
        workWith('MusicalInstruments', 'Shofars');
    }
    if ($part == 228) {
        workWith('MusicalInstruments', 'Zurnas');
        workWith('MusicalInstruments', 'Suonas');
        workWith('MusicalInstruments', 'Acoustic Guitars');
        workWith('MusicalInstruments', 'Acoustic-Electric Guitars');
    }
    if ($part == 229) {
        workWith('MusicalInstruments', 'Amplifier Accessories');
        workWith('MusicalInstruments', 'Drum & Percussion Accessories');
        workWith('MusicalInstruments', 'General Accessories');
        workWith('MusicalInstruments', 'Guitar & Bass Accessories');
    }
    if ($part == 230) {
        workWith('MusicalInstruments', 'Stringed Instrument Accessories');
        workWith('MusicalInstruments', 'Wind Instrument Accessories');
        workWith('MusicalInstruments', 'Accordions');
        workWith('MusicalInstruments', 'Electronic Keyboards');
    }
    if ($part == 231) {
        workWith('MusicalInstruments', 'World Instruments');
        workWith('MusicalInstruments', 'Harpsichords');
        workWith('MusicalInstruments', 'Lighting Equipment & Accessories');
        workWith('MusicalInstruments', 'Monitors, Speakers & Subwoofers');
    }
    if ($part == 232) {
        workWith('MusicalInstruments', 'Power Amplifiers');
        workWith('MusicalInstruments', 'Powered Audio Mixers');
        workWith('MusicalInstruments', 'Computer Recording');
        workWith('MusicalInstruments', 'Mastering Recorders');
    }
    if ($part == 233) {
        workWith('MusicalInstruments', 'Mixers & Accessories');
        workWith('MusicalInstruments', 'Multitrack Recorders');
        workWith('MusicalInstruments', 'Portable Recorders');
        workWith('MusicalInstruments', 'Power Conditioners');
    }
    if ($part == 234) {
        workWith('MusicalInstruments', 'Studio Environment');
        workWith('MusicalInstruments', 'Studio Monitors');
        workWith('MusicalInstruments', 'Concert Percussion');
        workWith('MusicalInstruments', 'Drum Sets & Set Components');
    }
    if ($part == 235) {
        workWith('MusicalInstruments', 'Hand Percussion');
        workWith('MusicalInstruments', 'Marching Percussion');
        workWith('MusicalInstruments', 'World Instruments');
        workWith('MusicalInstruments', 'Brass');
    }
    if ($part == 236) {
        workWith('OfficeProducts', 'Electronic Typewriters');
        workWith('OfficeProducts', 'Label Makers');
        workWith('OfficeProducts', 'Paper Shredders');
        workWith('OfficeProducts', 'Answering Devices');
    }
    if ($part == 237) {
        workWith('OfficeProducts', 'Corded Cordless Combination Telephones');
        workWith('OfficeProducts', 'Corded Telephones');
        workWith('OfficeProducts', 'Cordless Office Phones');
        workWith('OfficeProducts', 'Pagers');
    }
    if ($part == 238) {
        workWith('OfficeProducts', 'Video Telephones');
        workWith('OfficeProducts', 'VoIP');
        workWith('OfficeProducts', 'Electronic White Boards');
        workWith('OfficeProducts', 'Laminating Machines');
    }
    if ($part == 239) {
        workWith('OfficeProducts', 'Photocopiers');
        workWith('OfficeProducts', 'Fax Machines');
        workWith('OfficeProducts', 'Electronic Organizers');
        workWith('OfficeProducts', 'Electronic English Dictionaries');
    }
    if ($part == 240) {
        workWith('OfficeProducts', 'Electronic Thesauri');
        workWith('OfficeProducts', 'Foreign Language Translators');
        workWith('OfficeProducts', 'Basic Office Calculators');
        workWith('OfficeProducts', 'Financial Calculators');
    }
    if ($part == 241) {
        workWith('OfficeProducts', 'Printing Calculators');
        workWith('OfficeProducts', 'Scientific Calculators');
        workWith('OfficeProducts', 'Cabinets, Racks & Shelves');
        workWith('OfficeProducts', 'Carts & Stands');
    }
    if ($part == 242) {
        workWith('OfficeProducts', 'Desks & Workstations');
        workWith('OfficeProducts', 'Furniture Accessories');
        workWith('OfficeProducts', 'Office Lighting');
        workWith('OfficeProducts', 'Tables');
    }
    if ($part == 243) {
        workWith('OfficeProducts', 'Calendars, Planners & Personal Organizers');
        workWith('OfficeProducts', 'Carrying Cases');
        workWith('OfficeProducts', 'Cutting & Measuring Devices');
        workWith('OfficeProducts', 'Desk Accessories & Workspace Organizers');
    }
    if ($part == 244) {
        workWith('OfficeProducts', 'Envelopes, Mailers & Shipping Supplies');
        workWith('OfficeProducts', 'Filing Products');
        workWith('OfficeProducts', 'Forms, Recordkeeping & Money Handling');
        workWith('OfficeProducts', 'Labels, Indexes & Stamps');
    }
    if ($part == 245) {
        workWith('OfficeProducts', 'Presentation Boards');
        workWith('OfficeProducts', 'Staplers & Punches');
        workWith('OfficeProducts', 'Store Signs & Displays');
        workWith('OfficeProducts', 'Tape, Adhesives & Fasteners');
    }
    if ($part == 246) {
        workWith('OutdoorLiving', 'Boating');
        workWith('OutdoorLiving', 'Canoeing');
        workWith('OutdoorLiving', 'Diving & Snorkeling');
        workWith('OutdoorLiving', 'Kayaking');
    }
    if ($part == 247) {
        workWith('OutdoorLiving', 'Sailing');
        workWith('OutdoorLiving', 'Surfing');
        workWith('OutdoorLiving', 'Swimming');
        workWith('OutdoorLiving', 'Wakeboarding');
    }
    if ($part == 248) {
        workWith('OutdoorLiving', 'Windsurfing');
        workWith('OutdoorLiving', 'Athletic Sweatshirts');
        workWith('OutdoorLiving', 'Athletic Underwear');
        workWith('OutdoorLiving', 'Hoodies');
    }
    if ($part == 249) {
        workWith('OutdoorLiving', 'Shorts');
        workWith('OutdoorLiving', 'Socks');
        workWith('OutdoorLiving', 'Bandages');
        workWith('OutdoorLiving', 'Boots');
    }
    if ($part == 250) {
        workWith('OutdoorLiving', 'Helmets');
        workWith('OutdoorLiving', 'Horse Care Equipment');
        workWith('OutdoorLiving', 'Horse Driving Equipment');
        workWith('OutdoorLiving', 'Protective Gear');
    }
    if ($part == 251) {
        workWith('OutdoorLiving', 'Trailers');
        workWith('OutdoorLiving', 'Whips & Crops');
        workWith('OutdoorLiving', 'Collars');
        workWith('OutdoorLiving', 'Exercise & Fitness Warranties');
    }
    if ($part == 252) {
        workWith('OutdoorLiving', 'Exercise Bands');
        workWith('OutdoorLiving', 'Exercise Mats');
        workWith('OutdoorLiving', 'Fitness Planners');
        workWith('OutdoorLiving', 'Gloves');
    }
    if ($part == 253) {
        workWith('OutdoorLiving', 'Medicine Balls');
        workWith('OutdoorLiving', 'Protective Flooring');
        workWith('OutdoorLiving', 'Sauna Suits');
        workWith('OutdoorLiving', 'Step Platforms');
    }
    if ($part == 254) {
        workWith('OutdoorLiving', 'Trampolines');
        workWith('OutdoorLiving', 'Wraps');
        workWith('OutdoorLiving', 'Balance Boards');
        workWith('OutdoorLiving', 'Swiss Balls');
    }
    if ($part == 255) {
        workWith('OutdoorLiving', 'Auto Accessories');
        workWith('OutdoorLiving', 'Cell Phone Accessories');
        workWith('OutdoorLiving', 'Clothing & Accessories');
        workWith('OutdoorLiving', 'Electronics');
    }
    if ($part == 256) {
        workWith('OutdoorLiving', 'Home & Garden');
        workWith('OutdoorLiving', 'Jewelry');
        workWith('OutdoorLiving', 'Office Products');
        workWith('OutdoorLiving', 'Sports Collectibles');
    }
    if ($part == 257) {
        workWith('OutdoorLiving', 'Sports Equipment');
        workWith('OutdoorLiving', 'Tailgating & Stadium Gear');
        workWith('OutdoorLiving', 'Tools & Home Improvement');
        workWith('OutdoorLiving', 'Toys & Games');
    }
    if ($part == 258) {
        workWith('OutdoorLiving', 'Watches');
        workWith('OutdoorLiving', 'Golf Clothing');
        workWith('OutdoorLiving', 'Golf Footwear');
        workWith('OutdoorLiving', 'Golf Gloves');
    }
    if ($part == 259) {
        workWith('OutdoorLiving', 'Golf Cart Accessories');
        workWith('OutdoorLiving', 'Golf Carts');
        workWith('OutdoorLiving', 'Golf Club Bag Accessories');
        workWith('OutdoorLiving', 'Golf Club Bags');
    }
    if ($part == 260) {
        workWith('OutdoorLiving', 'Archery');
        workWith('OutdoorLiving', 'Fishing');
        workWith('OutdoorLiving', 'Hunting');
        workWith('OutdoorLiving', 'Tactical & Duty');
    }
    if ($part == 261) {
        workWith('OutdoorLiving', 'Disc Sports');
        workWith('OutdoorLiving', 'Game Room');
        workWith('OutdoorLiving', 'Boxing');
        workWith('OutdoorLiving', 'Dance');
    }
    if ($part == 262) {
        workWith('OutdoorLiving', 'Gymnastics');
        workWith('OutdoorLiving', 'Martial Arts');
        workWith('OutdoorLiving', 'Airsoft');
        workWith('OutdoorLiving', 'Paintball');
    }
    if ($part == 263) {
        workWith('OutdoorLiving', 'Inline & Roller Skating');
        workWith('OutdoorLiving', 'Skateboarding');
        workWith('OutdoorLiving', 'Skiing');
        workWith('OutdoorLiving', 'Snowboarding');
    }
    if ($part == 264) {
        workWith('OutdoorLiving', 'Car Sports Racks');
        workWith('OutdoorLiving', 'Coaches & Referees Gear');
        workWith('OutdoorLiving', 'Electronics & Gadgets');
        workWith('OutdoorLiving', 'Lawn Games');
    }
    if ($part == 265) {
        workWith('OutdoorLiving', 'Playing Field Equipment');
        workWith('OutdoorLiving', 'Reflective Gear');
        workWith('OutdoorLiving', 'Sports Headbands');
        workWith('OutdoorLiving', 'Sports Medicine');
    }
    if ($part == 266) {
        workWith('OutdoorLiving', 'Wristbands');
        workWith('OutdoorLiving', 'Baseball');
        workWith('OutdoorLiving', 'Basketball');
        workWith('OutdoorLiving', 'Cheerleading');
    }
    if ($part == 267) {
        workWith('OutdoorLiving', 'Field Hockey');
        workWith('OutdoorLiving', 'Football');
        workWith('OutdoorLiving', 'Ice Hockey');
        workWith('OutdoorLiving', 'Lacrosse');
    }
    if ($part == 268) {
        workWith('OutdoorLiving', 'Rugby');
        workWith('OutdoorLiving', 'Soccer');
        workWith('OutdoorLiving', 'Softball');
        workWith('OutdoorLiving', 'Track & Field');
    }
    if ($part == 269) {
        workWith('OutdoorLiving', 'Wrestling');
        workWith('OutdoorLiving', 'Badminton');
        workWith('OutdoorLiving', 'Racquetball');
        workWith('OutdoorLiving', 'Squash');
    }
    if ($part == 270) {
        workWith('PCHardware', 'Cables & Interconnects');
        workWith('PCHardware', 'Cleaning & Repair');
        workWith('PCHardware', 'Cable Adapters');
        workWith('PCHardware', 'Drive Enclosures');
    }
    if ($part == 271) {
        workWith('PCHardware', 'Speakers');
        workWith('PCHardware', 'Hard Drive Bags');
        workWith('PCHardware', 'Headsets & Microphones');
        workWith('PCHardware', 'Keyboard & Mice Accessories');
    }
    if ($part == 272) {
        workWith('PCHardware', 'Laptop & Netbook Computer Accessories');
        workWith('PCHardware', 'Memory Card Adapters');
        workWith('PCHardware', 'Memory Cards');
        workWith('PCHardware', 'Monitor Accessories');
    }
    if ($part == 273) {
        workWith('PCHardware', 'Printer Ink & Toner');
        workWith('PCHardware', 'Scanner Accessories');
        workWith('PCHardware', 'Surge Protectors');
        workWith('PCHardware', 'Touch Screen Tablet Accessories');
    }
    if ($part == 274) {
        workWith('PCHardware', 'USB Gadgets');
        workWith('PCHardware', 'Video Projector Accessories');
        workWith('PCHardware', 'Network Routers');
        workWith('PCHardware', 'Device Servers');
    }
    if ($part == 275) {
        workWith('PCHardware', 'Network Access Points');
        workWith('PCHardware', 'Network Adapters');
        workWith('PCHardware', 'Network Hubs');
        workWith('PCHardware', 'Network Switches');
    }
    if ($part == 276) {
        workWith('PCHardware', 'Print Servers');
        workWith('PCHardware', 'Graphics Cards');
        workWith('PCHardware', 'Internal Tape Drives');
        workWith('PCHardware', 'Memory');
    }
    if ($part == 277) {
        workWith('PCHardware', 'Power Supplies');
        workWith('PCHardware', 'Processors');
        workWith('PCHardware', 'Desktop Barebones');
        workWith('PCHardware', 'Desktop Computer Internal Floppy Drives');
    }
    if ($part == 278) {
        workWith('PCHardware', 'Desktop Computer Network Cards');
        workWith('PCHardware', 'Desktop Computer Sound Cards');
        workWith('PCHardware', 'Desktop Computer Video Capture Cards');
        workWith('PCHardware', 'Fans & Cooling');
    }
    if ($part == 279) {
        workWith('PCHardware', 'Internal Optical Drives');
        workWith('PCHardware', 'Laptop Computer Internal Modems');
        workWith('PCHardware', 'Laptop Computer Internal Solid State Drives');
        workWith('PCHardware', 'External Tape Drives');
    }
    if ($part == 280) {
        workWith('PCHardware', 'External Hard Drives');
        workWith('PCHardware', 'External Solid State Drives');
        workWith('PCHardware', 'Networked Attached Storage');
        workWith('PCHardware', 'USB Flash Drives');
    }
    if ($part == 281) {
        workWith('PetSupplies', 'Bird Carriers');
        workWith('PetSupplies', 'Bird Food');
        workWith('PetSupplies', 'Bird Health Supplies');
        workWith('PetSupplies', 'Bird Toys');
    }
    if ($part == 282) {
        workWith('PetSupplies', 'Cages & Accessories');
        workWith('PetSupplies', 'Feeding & Watering Supplies');
        workWith('PetSupplies', 'Cat Flaps');
        workWith('PetSupplies', 'Outdoor Pet Pens');
    }
    if ($part == 283) {
        workWith('PetSupplies', 'Carriers & Strollers');
        workWith('PetSupplies', 'Cat Apparel');
        workWith('PetSupplies', 'Cat Cages');
        workWith('PetSupplies', 'Cat Food: Wet, Dry');
    }
    if ($part == 284) {
        workWith('PetSupplies', 'Collars, Harnesses & Leashes');
        workWith('PetSupplies', 'Educational Repellents');
        workWith('PetSupplies', 'Feeding & Watering Supplies');
        workWith('PetSupplies', 'Grooming');
    }
    if ($part == 285) {
        workWith('PetSupplies', 'Litter & Housebreaking');
        workWith('PetSupplies', 'Toys');
        workWith('PetSupplies', 'Treats');
        workWith('PetSupplies', 'Dog Backpacks');
    }
    if ($part == 286) {
        workWith('PetSupplies', 'Dog Cold Weather Coats');
        workWith('PetSupplies', 'Dog Dresses');
        workWith('PetSupplies', 'Dog Hats');
        workWith('PetSupplies', 'Dog Hoodies');
    }
    if ($part == 287) {
        workWith('PetSupplies', 'Dog Necklaces');
        workWith('PetSupplies', 'Dog Raincoats');
        workWith('PetSupplies', 'Dog Sweaters');
        workWith('PetSupplies', 'Dog Sunglasses');
    }
    if ($part == 288) {
        workWith('PetSupplies', 'Dog Bed Liners');
        workWith('PetSupplies', 'Dog Bed Mats');
        workWith('PetSupplies', 'Dog Beds');
        workWith('PetSupplies', 'Dog Sofas & Chairs');
    }
    if ($part == 289) {
        workWith('PetSupplies', 'Dog Collars, Harnesses & Leashes');
        workWith('PetSupplies', 'Dog Food Dry Wet');
        workWith('PetSupplies', 'Dog Food Dry');
        workWith('PetSupplies', 'Dog Memorials');
    }
    if ($part == 290) {
        workWith('PetSupplies', 'Dog Grooming');
        workWith('PetSupplies', 'Dog Health Supplies');
        workWith('PetSupplies', 'Dog Houses, Kennels & Pens');
        workWith('PetSupplies', 'Dog Litter & Housebreaking');
    }
    if ($part == 291) {
        workWith('PetSupplies', 'Dog Training & Behavior Aids');
        workWith('PetSupplies', 'Dog Treats');
        workWith('PetSupplies', 'Aquarium Decor');
        workWith('PetSupplies', 'Aquarium Heaters');
    }
    if ($part == 292) {
        workWith('PetSupplies', 'Aquarium Lights');
        workWith('PetSupplies', 'Aquarium Stands');
        workWith('PetSupplies', 'Aquarium Starter Kits');
        workWith('PetSupplies', 'Aquarium Substrate');
    }
    if ($part == 293) {
        workWith('PetSupplies', 'Aquarium Water Treatments');
        workWith('PetSupplies', 'Aquariums');
        workWith('PetSupplies', 'Automatic Fish Feeders');
        workWith('PetSupplies', 'Cleaners');
    }
    if ($part == 294) {
        workWith('PetSupplies', 'Fish Breeding Tanks');
        workWith('PetSupplies', 'Fish Food');
        workWith('PetSupplies', 'Pumps & Filters');
        workWith('PetSupplies', 'Horse');
    }
    if ($part == 295) {
        workWith('PetSupplies', 'Reptile & Amphibian Food');
        workWith('PetSupplies', 'Reptile & Amphibian Habitat Lighting');
        workWith('PetSupplies', 'Reptile & Amphibian Health Supplies');
        workWith('PetSupplies', 'Reptile Houses');
    }
    if ($part == 296) {
        workWith('PetSupplies', 'Terrarium Heat Lamps & Mats');
        workWith('PetSupplies', 'Terrarium Thermometers');
        workWith('PetSupplies', 'Terrariums');
        workWith('PetSupplies', 'Collars, Harnesses & Leashes');
    }
    if ($part == 297) {
        workWith('PetSupplies', 'Grooming');
        workWith('PetSupplies', 'Houses & Habitats');
        workWith('PetSupplies', 'Small Animal Carriers');
        workWith('PetSupplies', 'Small Animal Exercise Wheels');
    }
    if ($part == 298) {
        workWith('ArtsAndCrafts', 'Easel Pads');
        workWith('ArtsAndCrafts', 'Loose Drawing Paper');
        workWith('ArtsAndCrafts', 'Newsprint Paper');
        workWith('ArtsAndCrafts', 'Pastel Paper');
    }
    if ($part == 299) {
        workWith('ArtsAndCrafts', 'Watercolor Paper');
        workWith('ArtsAndCrafts', 'Artists Canvas Tools & Accessories');
        workWith('ArtsAndCrafts', 'Banner & Sign Cloth');
        workWith('ArtsAndCrafts', 'Canvas Panels');
    }
    if ($part == 300) {
        workWith('ArtsAndCrafts', 'Gesso Board');
        workWith('ArtsAndCrafts', 'Hardboard');
        workWith('ArtsAndCrafts', 'Pastel Board');
        workWith('ArtsAndCrafts', 'Pre-Stretched Canvas');
    }
    if ($part == 301) {
        workWith('ArtsAndCrafts', 'Wood Art Boards');
        workWith('ArtsAndCrafts', 'Art Sets');
        workWith('ArtsAndCrafts', 'Artist Supply Erasers');
        workWith('ArtsAndCrafts', 'Artists Blenders');
    }
    if ($part == 302) {
        workWith('ArtsAndCrafts', 'Artists Fixatives');
        workWith('ArtsAndCrafts', 'Artists Manikins');
        workWith('ArtsAndCrafts', 'Artists Rubbing Supplies');
        workWith('ArtsAndCrafts', 'Drawing & Lettering Aids');
    }
    if ($part == 303) {
        workWith('ArtsAndCrafts', 'Light Boxes');
        workWith('ArtsAndCrafts', 'Airbrush Materials');
        workWith('ArtsAndCrafts', 'Art Mixing Trays');
        workWith('ArtsAndCrafts', 'Art Paint Finishes');
    }
    if ($part == 304) {
        workWith('ArtsAndCrafts', 'Art Paint Sponges');
        workWith('ArtsAndCrafts', 'Art Palette Knives');
        workWith('ArtsAndCrafts', 'Paint Primers & Sealers');
        workWith('ArtsAndCrafts', 'Paint Thinners & Reducers');
    }
    if ($part == 305) {
        workWith('ArtsAndCrafts', 'Paintbrushes');
        workWith('ArtsAndCrafts', 'Painting Kits');
        workWith('ArtsAndCrafts', 'Paints');
        workWith('ArtsAndCrafts', 'Palettes & Palette Cups');
    }
    if ($part == 306) {
        workWith('ArtsAndCrafts', 'Beading Cords & Threads');
        workWith('ArtsAndCrafts', 'Beading Hardware');
        workWith('ArtsAndCrafts', 'Beads & Bead Assortments');
        workWith('ArtsAndCrafts', 'Casting Metals');
    }
    if ($part == 307) {
        workWith('ArtsAndCrafts', 'Earring Backs');
        workWith('ArtsAndCrafts', 'Engraving Tools');
        workWith('ArtsAndCrafts', 'Jewelry & Beading Wire');
        workWith('ArtsAndCrafts', 'Jewelry Casting Machines');
    }
    if ($part == 308) {
        workWith('ArtsAndCrafts', 'Jewelry Polishing Buffing Supplies');
        workWith('ArtsAndCrafts', 'Jewelry-Making Tools & Accessories');
        workWith('ArtsAndCrafts', 'Wax Molding Materials');
        workWith('ArtsAndCrafts', 'Art Backpacks');
    }
    if ($part == 309) {
        workWith('ArtsAndCrafts', 'Art Tubes');
        workWith('ArtsAndCrafts', 'Artists Canvas Carriers');
        workWith('ArtsAndCrafts', 'Artists Portfolios');
        workWith('ArtsAndCrafts', 'Adhesives');
    }
    if ($part == 310) {
        workWith('ArtsAndCrafts', 'Ceramics & Pottery');
        workWith('ArtsAndCrafts', 'Cutting Tools');
        workWith('ArtsAndCrafts', 'Doll Making');
        workWith('ArtsAndCrafts', 'Floral Arranging');
    }
    if ($part == 311) {
        workWith('ArtsAndCrafts', 'Leathercraft');
        workWith('ArtsAndCrafts', 'Mosaic Making');
        workWith('ArtsAndCrafts', 'Paper & Paper Crafts');
        workWith('ArtsAndCrafts', 'Purse Making');
    }
    if ($part == 312) {
        workWith('ArtsAndCrafts', 'Scratchboard Art');
        workWith('ArtsAndCrafts', 'Sculpture Supplies');
        workWith('ArtsAndCrafts', 'Soap Making');
        workWith('ArtsAndCrafts', 'Weaving');
    }
    if ($part == 313) {
        workWith('ArtsAndCrafts', 'Wood Burning Tools');
        workWith('ArtsAndCrafts', 'Fabric Decorating Kits');
        workWith('ArtsAndCrafts', 'Fabric Dye Repellents');
        workWith('ArtsAndCrafts', 'Fabric Dyes');
    }
    if ($part == 314) {
        workWith('ArtsAndCrafts', 'Fabric Paint');
        workWith('ArtsAndCrafts', 'Fabric Waxes');
        workWith('ArtsAndCrafts', 'Artists Easels');
        workWith('ArtsAndCrafts', 'Artists Taborets');
    }
    if ($part == 315) {
        workWith('ArtsAndCrafts', 'Drying & Print Racks');
        workWith('ArtsAndCrafts', 'Sewing Room Furniture');
        workWith('ArtsAndCrafts', 'Crochet Hooks');
        workWith('ArtsAndCrafts', 'Knitting Kits');
    }
    if ($part == 316) {
        workWith('ArtsAndCrafts', 'Knitting Yarn');
        workWith('ArtsAndCrafts', 'Cross-Stitch');
        workWith('ArtsAndCrafts', 'Embroidery');
        workWith('ArtsAndCrafts', 'Quilting');
    }
    if ($part == 317) {
        workWith('ArtsAndCrafts', 'Craft Supplies Storage');
        workWith('ArtsAndCrafts', 'Embossing');
        workWith('ArtsAndCrafts', 'Etching & Lithography Materials');
        workWith('ArtsAndCrafts', 'Printing Presses & Accessories');
    }
    if ($part == 318) {
        workWith('ArtsAndCrafts', 'Relief Printing Materials');
        workWith('ArtsAndCrafts', 'Screen Printing');
        workWith('ArtsAndCrafts', 'Art Adhesive Removers');
        workWith('ArtsAndCrafts', 'Art Tool Cleaners');
    }
    if ($part == 319) {
        workWith('ArtsAndCrafts', 'Artists Protective Clothing & Gear');
        workWith('ArtsAndCrafts', 'Dust Control Equipment');
        workWith('ArtsAndCrafts', 'Safety Spray Booths');
        workWith('ArtsAndCrafts', 'Albums & Refills');
    }
    if ($part == 320) {
        workWith('ArtsAndCrafts', 'Die-Cuts & Die-Cut Machines');
        workWith('ArtsAndCrafts', 'Photo Mounting Corners');
        workWith('ArtsAndCrafts', 'Scrapbooking Embellishments');
        workWith('ArtsAndCrafts', 'Scrapbooking Kits');
    }
    if ($part == 321) {
        workWith('ArtsAndCrafts', 'Stencils & Templates');
        workWith('ArtsAndCrafts', 'Stickers & Sticker Machines');
        workWith('ArtsAndCrafts', 'Texture Plates');
        workWith('ArtsAndCrafts', 'Bobbins');
    }
    if ($part == 322) {
        workWith('ArtsAndCrafts', 'Embroidery Machines');
        workWith('ArtsAndCrafts', 'Hand Needles');
        workWith('ArtsAndCrafts', 'Hand Sewing Needle Threaders');
        workWith('ArtsAndCrafts', 'Machine Needles');
    }
    if ($part == 323) {
        workWith('ArtsAndCrafts', 'Pillow Forms & Foam');
        workWith('ArtsAndCrafts', 'Pins & Pincushions');
        workWith('ArtsAndCrafts', 'Sergers');
        workWith('ArtsAndCrafts', 'Sewing Machine Parts & Accessories');
    }
    if ($part == 324) {
        workWith('ArtsAndCrafts', 'Sewing Tools');
        workWith('ArtsAndCrafts', 'Thimbles');
        workWith('ArtsAndCrafts', 'Trim & Embellishments');
        workWith('ArtsAndCrafts', 'Embroidery Floss');
    }
    if ($part == 325) {
        workWith('Baby', 'Birth Announcements');
        workWith('Baby', 'Thank You Cards');
        workWith('Baby', 'Сhildren Conditioners');
        workWith('Baby', 'Aromatherapy');
    }
    if ($part == 326) {
        workWith('Baby', 'Bubble Bath');
        workWith('Baby', 'Care Gift Sets');
        workWith('Baby', 'Grooming & Health Kits');
        workWith('Baby', 'No-Slip Bath Mats');
    }
    if ($part == 327) {
        workWith('Baby', 'Travel Bathing Kits');
        workWith('Baby', 'Skin Care');
        workWith('Baby', 'Soaps & Cleansers');
        workWith('Baby', 'Washcloths & Towels');
    }
    if ($part == 328) {
        workWith('Baby', 'Car Seat Accessories');
        workWith('Baby', 'Car Seats');
        workWith('Baby', 'Rear Facing View Mirrors');
        workWith('Baby', 'Nodes:');
    }
    if ($part == 329) {
        workWith('Baby', 'Diaper Changing Pads');
        workWith('Baby', 'Diaper Changing Pads & Covers');
        workWith('Baby', 'Diaper Covers');
        workWith('Baby', 'Diaper Pails & Refills');
    }
    if ($part == 330) {
        workWith('Baby', 'Disposable Diapers');
        workWith('Baby', 'Wipes & Accessories');
        workWith('Baby', 'Vitamins');
        workWith('Baby', 'Bottle-Feeding');
    }
    if ($part == 331) {
        workWith('Baby', 'Food, Mills & Storage');
        workWith('Baby', 'Highchairs & Booster Seats');
        workWith('Baby', 'Pacifiers & Accessories');
        workWith('Baby', 'Pillows & Stools');
    }
    if ($part == 332) {
        workWith('Baby', 'Activity Centers & Entertainers');
        workWith('Baby', 'Play Mats');
        workWith('Baby', 'Seats');
        workWith('Baby', 'Shopping Cart Seat Covers');
    }
    if ($part == 333) {
        workWith('Baby', 'Backpacks & Carriers');
        workWith('Baby', 'Play Yard Gear');
        workWith('Baby', 'Swings, Jumpers & Bouncers');
        workWith('Baby', 'Albums, Frames & Journals');
    }
    if ($part == 334) {
        workWith('Baby', 'Gift Sets');
        workWith('Baby', 'Toy Banks');
        workWith('Baby', 'Nail Care');
        workWith('Baby', 'Sun Protection');
    }
    if ($part == 335) {
        workWith('Baby', 'Nasal Aspirators for Babies');
        workWith('Baby', 'Teethers');
        workWith('Baby', 'Bedding');
        workWith('Baby', 'Furniture');
    }
    if ($part == 336) {
        workWith('Baby', 'Potty Training Pants');
        workWith('Baby', 'Potty Training Seats');
        workWith('Baby', 'Potty Training Step Stools');
        workWith('Baby', 'Potty Training Toilet Seat Covers');
    }
    if ($part == 337) {
        workWith('Baby', 'Maternity Pillows');
        workWith('Baby', 'Prenatal Monitoring Devices');
        workWith('Baby', 'Bathroom Safety');
        workWith('Baby', 'Cabinet Locks & Straps');
    }
    if ($part == 338) {
        workWith('Baby', 'Electrical Safety');
        workWith('Baby', 'Gates & Door Guards');
        workWith('Baby', 'Kitchen Safety');
        workWith('Baby', 'Outdoor Safety');
    }
    if ($part == 339) {
        workWith('Baby', 'Safety Caps');
        workWith('Baby', 'Sleep Positioners');
        workWith('Baby', 'Monitors');
        workWith('Baby', 'Toddler Safety Harnesses & Leashes');
    }
    if ($part == 340) {
        workWith('Baby', 'Accessories');
        workWith('Baby', 'Jogging Strollers');
        workWith('Baby', 'Lightweight Strollers');
        workWith('Baby', 'Prams');
    }
    if ($part == 341) {
        workWith('Automotive', 'Enthusiast Apparel');
        workWith('Automotive', 'Enthusiast Bags & Accessories');
        workWith('Automotive', 'Enthusiast Home & Office');
        workWith('Automotive', 'Enthusiast Toys & Models');
    }
    if ($part == 342) {
        workWith('Automotive', 'Cleaning Kits');
        workWith('Automotive', 'Cleaning Solvents');
        workWith('Automotive', 'Glass Cleaners');
        workWith('Automotive', 'Undercoatings');
    }
    if ($part == 343) {
        workWith('Automotive', 'Finishing');
        workWith('Automotive', 'Interior Care');
        workWith('Automotive', 'Tire & Wheel Care');
        workWith('Automotive', 'Tools & Equipment');
    }
    if ($part == 344) {
        workWith('Automotive', 'Antenna Toppers');
        workWith('Automotive', 'Bumpers & Bumper Accessories');
        workWith('Automotive', 'Cargo Management');
        workWith('Automotive', 'Chrome Trim & Accessories');
    }
    if ($part == 345) {
        workWith('Automotive', 'Decals & Bumper Stickers');
        workWith('Automotive', 'Deflectors & Shields');
        workWith('Automotive', 'Emblems');
        workWith('Automotive', 'Fender Flares & Trim');
    }
    if ($part == 346) {
        workWith('Automotive', 'Grilles & Grille Guards');
        workWith('Automotive', 'Hood Scoops & Vents');
        workWith('Automotive', 'Horns & Accessories');
        workWith('Automotive', 'License Plate Covers & Frames');
    }
    if ($part == 347) {
        workWith('Automotive', 'Mirrors');
        workWith('Automotive', 'Roll Bars & Roll Cages');
        workWith('Automotive', 'Running Boards & Steps');
        workWith('Automotive', 'Safety');
    }
    if ($part == 348) {
        workWith('Automotive', 'Spoilers, Wings & Styling Kits');
        workWith('Automotive', 'Towing Products & Winches');
        workWith('Automotive', 'Trailer Accessories');
        workWith('Automotive', 'Truck Bed & Tailgate Accessories');
    }
    if ($part == 349) {
        workWith('Automotive', 'Antitheft');
        workWith('Automotive', 'Automobilia Interior Accessories');
        workWith('Automotive', 'Air Fresheners');
        workWith('Automotive', 'Ashtrays');
    }
    if ($part == 350) {
        workWith('Automotive', 'Cup Holders');
        workWith('Automotive', 'Garbage Cans');
        workWith('Automotive', 'Pedals');
        workWith('Automotive', 'Soundproofing Kits');
    }
    if ($part == 351) {
        workWith('Automotive', 'Covers');
        workWith('Automotive', 'Electrical Appliances');
        workWith('Automotive', 'Mirrors');
        workWith('Automotive', 'Safety');
    }
    if ($part == 352) {
        workWith('Automotive', 'Shift Boots & Knobs');
        workWith('Automotive', 'Steering Wheels & Accessories');
        workWith('Automotive', 'Sun Protection');
        workWith('Automotive', 'Motorcycle & ATV Vehicles');
    }
    if ($part == 353) {
        workWith('Automotive', 'Motorcycle & ATV Brush Guards');
        workWith('Automotive', 'Motorcycle & ATV Carrying Racks');
        workWith('Automotive', 'Motorcycle & ATV Enduro Computers');
        workWith('Automotive', 'Motorcycle & ATV Fast Fuelers');
    }
    if ($part == 354) {
        workWith('Automotive', 'Motorcycle & ATV Gun Racks');
        workWith('Automotive', 'Motorcycle & ATV Heel Plates');
        workWith('Automotive', 'Motorcycle & ATV Hydration Packs');
        workWith('Automotive', 'Motorcycle & ATV Loading Ramps');
    }
    if ($part == 355) {
        workWith('Automotive', 'Motorcycle & ATV Number Plates');
        workWith('Automotive', 'Motorcycle & ATV Seat Covers');
        workWith('Automotive', 'Motorcycle & ATV Stands');
        workWith('Automotive', 'Motorcycle & ATV Tie Downs');
    }
    if ($part == 356) {
        workWith('Automotive', 'Cooling System Additives');
        workWith('Automotive', 'Oil Additives');
        workWith('Automotive', 'Power Steering Additives');
        workWith('Automotive', 'Fuel System');
    }
    if ($part == 357) {
        workWith('Automotive', 'Air Conditioning Refrigerant');
        workWith('Automotive', 'Antifreeze');
        workWith('Automotive', 'Brake Fluids');
        workWith('Automotive', 'Lubricants: Lubricants, Grease, Brake Quiet');
    }
    if ($part == 358) {
        workWith('Automotive', 'Radiator Conditioners');
        workWith('Automotive', 'Body Repair & Restoration Chemicals');
        workWith('Automotive', 'Cleaners');
        workWith('Automotive', 'Flushes');
    }
    if ($part == 359) {
        workWith('Automotive', 'Sealers');
        workWith('Automotive', 'Transmission Fluids');
        workWith('Automotive', 'Windshield Washer Fluids');
        workWith('Automotive', 'Winter Products');
    }
    if ($part == 360) {
        workWith('Automotive', 'Paints & Primers');
        workWith('Automotive', 'Trim');
        workWith('Automotive', 'Batteries & Accessories');
        workWith('Automotive', 'Bearings & Seals');
    }
    if ($part == 361) {
        workWith('Automotive', 'Brake System');
        workWith('Automotive', 'Climate Control System');
        workWith('Automotive', 'Drive Train');
        workWith('Automotive', 'Emission System');
    }
    if ($part == 362) {
        workWith('Automotive', 'Engines & Engine Parts');
        workWith('Automotive', 'Exhaust System');
        workWith('Automotive', 'Filters');
        workWith('Automotive', 'Fuel System');
    }
    if ($part == 363) {
        workWith('Automotive', 'Ignition & Electrical');
        workWith('Automotive', 'Motors');
        workWith('Automotive', 'Performance Lighting');
        workWith('Automotive', 'Shocks, Struts & Suspension');
    }
    if ($part == 364) {
        workWith('Automotive', 'Steering System');
        workWith('Automotive', 'Switches & Relays');
        workWith('Automotive', 'Windshield Wipers & Washers');
        workWith('Automotive', 'Batteries & Accessories');
    }
    if ($part == 365) {
        workWith('Automotive', 'Belts, Hoses & Pulleys');
        workWith('Automotive', 'Brake System');
        workWith('Automotive', 'Cables');
        workWith('Automotive', 'Caps');
    }
    if ($part == 366) {
        workWith('Automotive', 'Engines & Engine Parts');
        workWith('Automotive', 'Exhaust & Emissions');
        workWith('Automotive', 'Filters');
        workWith('Automotive', 'Fuel System');
    }
    if ($part == 367) {
        workWith('Automotive', 'Ignition Parts');
        workWith('Automotive', 'Lighting & Electrical');
        workWith('Automotive', 'Motors');
        workWith('Automotive', 'Sensors');
    }
    if ($part == 368) {
        workWith('Automotive', 'Starters & Alternators');
        workWith('Automotive', 'Steering System');
        workWith('Automotive', 'Switches & Relays');
        workWith('Automotive', 'Transmission & Drive Train');
    }
    if ($part == 369) {
        workWith('Automotive', 'Windshield Wipers & Washers');
        workWith('Automotive', 'Awnings, Screens & Accessories');
        workWith('Automotive', 'Furnishings & Appliances');
        workWith('Automotive', 'Heating, Ventilation & Air Conditioning');
    }
    if ($part == 370) {
        workWith('Automotive', 'Jacks & Leveling');
        workWith('Automotive', 'Plumbing');
        workWith('Automotive', 'Power & Electrical');
        workWith('Automotive', 'RV Cleaning, Storage & Maintenance');
    }
    if ($part == 371) {
        workWith('Automotive', 'RV Electronics');
        workWith('Automotive', 'RV Lighting');
        workWith('Automotive', 'Air Conditioning Tools & Equipment');
        workWith('Automotive', 'Applicator Tools');
    }
    if ($part == 372) {
        workWith('Automotive', 'Electrical System Tools');
        workWith('Automotive', 'Hose Repair Kits');
        workWith('Automotive', 'Lockout Kits');
        workWith('Automotive', 'Oxygen Sensor Remover Tools');
    }
    if ($part == 373) {
        workWith('Automotive', 'Riveters');
        workWith('Automotive', 'Strut Compressors');
        workWith('Automotive', 'Water Pump Tools');
        workWith('Automotive', 'Windshield Wiper Tools');
    }
    if ($part == 374) {
        workWith('Automotive', 'Brake Repair Tools');
        workWith('Automotive', 'Brake Tools');
        workWith('Automotive', 'Bushing Tools');
        workWith('Automotive', 'Diagnostic & Test Tools');
    }
    if ($part == 375) {
        workWith('Automotive', 'Fuel System Tools');
        workWith('Automotive', 'Garage & Shop');
        workWith('Automotive', 'Hand Tools');
        workWith('Automotive', 'Impact Wrenches');
    }
    if ($part == 376) {
        workWith('Automotive', 'Measuring Tools');
        workWith('Automotive', 'Mechanics Tool Sets');
        workWith('Automotive', 'Muffler Repair Tools');
        workWith('Automotive', 'Oil System Tools');
    }
    if ($part == 377) {
        workWith('Automotive', 'Spark Plug & Ignition Tools');
        workWith('Automotive', 'Steering & Suspension Tools');
        workWith('Automotive', 'Thread Repair Kits');
        workWith('Automotive', 'Tire & Wheel Tools');
    }
    if ($part == 378) {
        workWith('Automotive', 'Lug Nuts');
        workWith('Automotive', 'Mud Guards');
        workWith('Automotive', 'Tire Adapters');
        workWith('Automotive', 'Tire Center Caps');
    }
    if ($part == 379) {
        workWith('Automotive', 'Tire Covers');
        workWith('Automotive', 'Tire Inflator Compressors');
        workWith('Automotive', 'Tire Lights');
        workWith('Automotive', 'Wheel Lug Adapters');
    }
    if ($part == 380) {
        workWith('Automotive', 'Wheel Weights');
        workWith('Automotive', 'Digital Tire Gauges');
        workWith('Automotive', 'Hub Centric Rings');
        workWith('Automotive', 'Snow Chains');
    }
    if ($part == 381) {
        workWith('Automotive', 'Wheel Seals');
        workWith('Automotive', 'Wheel Studs');
        workWith('Automotive', 'Spare Tire Carriers');
        workWith('Automotive', 'Tire & Wheel Assemblies');
    }
    if ($part == 382) {
        workWith('Shoes', 'Boys Athletic Shoes');
        workWith('Shoes', 'Boys Boots');
        workWith('Shoes', 'Boys Fashion Sneakers');
        workWith('Shoes', 'Boys Lace-Ups');
    }
    if ($part == 383) {
        workWith('Shoes', 'Boys Sandals');
        workWith('Shoes', 'Boys School Uniform Footwear');
        workWith('Shoes', 'Boys Slip-Ons');
        workWith('Shoes', 'Boys Slippers');
    }
    if ($part == 384) {
        workWith('Shoes', 'Boys Lighted Shoes');
        workWith('Shoes', 'Infant & Toddler Boots');
        workWith('Shoes', 'Crib Shoes for Baby & Toddler Boys');
        workWith('Shoes', 'First Shoes for Baby & Toddler Boys');
    }
    if ($part == 385) {
        workWith('Shoes', 'Infant & Toddler Outdoor');
        workWith('Shoes', 'Infant & Toddler Sandals');
        workWith('Shoes', 'Slip-Ons for Baby & Toddler Boys');
        workWith('Shoes', 'Slippers for Baby & Toddler Boys');
    }
    if ($part == 386) {
        workWith('Shoes', 'Fashion Sneakers for Baby & Toddler Boys');
        workWith('Shoes', 'Lace-Ups for Baby & Toddler Boys');
        workWith('Shoes', 'Sneakers');
        workWith('Shoes', 'Girls Athletic Shoes');
    }
    if ($part == 387) {
        workWith('Shoes', 'Girls Fashion Sneakers');
        workWith('Shoes', 'Girls Flats');
        workWith('Shoes', 'Girls Lace-Ups');
        workWith('Shoes', 'Girls School Uniform Footwear');
    }
    if ($part == 388) {
        workWith('Shoes', 'Girls Velcro Shoes');
        workWith('Shoes', 'Crib Shoes for Baby & Toddler Girls');
        workWith('Shoes', 'Fashion Sneakers for Baby & Toddler Girls');
        workWith('Shoes', 'First Shoes for Baby & Toddler Girls');
    }
    if ($part == 389) {
        workWith('Shoes', 'Lace-Ups for Baby & Toddler Girls');
        workWith('Shoes', 'Lighted Shoes for Baby & Toddler Girls');
        workWith('Shoes', 'Outdoor');
        workWith('Shoes', 'Sandals');
    }
    if ($part == 390) {
        workWith('Shoes', 'Velcro Shoes for Baby & Toddler Girls');
        workWith('Shoes', 'Baguettes');
        workWith('Shoes', 'Purses');
        workWith('Shoes', 'Handbags');
    }
    if ($part == 391) {
        workWith('Shoes', 'Hobos');
        workWith('Shoes', 'Oversized bags');
        workWith('Shoes', 'Special occasion handbags');
        workWith('Shoes', 'Totes');
    }
    if ($part == 392) {
        workWith('Shoes', 'Juniors Boots');
        workWith('Shoes', 'Juniors Espadrilles');
        workWith('Shoes', 'Juniors Fashion Sneakers');
        workWith('Shoes', 'Juniors Flats');
    }
    if ($part == 393) {
        workWith('Shoes', 'Juniors Loafers & Slip-Ons');
        workWith('Shoes', 'Juniors Mules & Clogs');
        workWith('Shoes', 'Juniors Pumps');
        workWith('Shoes', 'Juniors Sandals');
    }
    if ($part == 394) {
        workWith('Shoes', 'Shoe Care & Cleaning');
        workWith('Shoes', 'Womens Athletic & Outdoor Boating Shoes');
        workWith('Shoes', 'Womens Ballet & Dance Shoes');
        workWith('Shoes', 'Womens Golf Shoes');
    }
    if ($part == 395) {
        workWith('Shoes', 'Womens Running Shoes: Trail, Cross-Country, Track & Field, Spikes');
        workWith('Shoes', 'Womens Skateboard Shoes');
        workWith('Shoes', 'Womens Soccer Shoes');
        workWith('Shoes', 'Womens Tennis Shoes');
    }
    if ($part == 396) {
        workWith('Shoes', 'Womens Walking Shoes');
        workWith('Shoes', 'Womens Wheeled Heel Shoes');
        workWith('Shoes', 'Womens Flat Boots');
        workWith('Shoes', 'Womens Lace-Up Boots');
    }
    if ($part == 397) {
        workWith('Shoes', 'Womens Platform Boots');
        workWith('Shoes', 'Womens Pull-On Boots');
        workWith('Shoes', 'Womens Riding Boots');
        workWith('Shoes', 'Womens Shearling & Fur-Trimmed Boots');
    }
    if ($part == 398) {
        workWith('Shoes', 'Womens Wedge Boots');
        workWith('Shoes', 'Womens Western Boots');
        workWith('Shoes', 'Womens Zip Boots');
        workWith('Shoes', 'Womens Bridal Flats');
    }
    if ($part == 399) {
        workWith('Shoes', 'Womens Bridal Sandals');
        workWith('Shoes', 'Espadrilles');
        workWith('Shoes', 'Womens Classic Sneakers');
        workWith('Shoes', 'Womens Lace-Up Sneakers');
    }
    if ($part == 400) {
        workWith('Shoes', 'Womens Mule Sneakers');
        workWith('Shoes', 'Womens Slingback Sneakers');
        workWith('Shoes', 'Womens Velcro and Strap Sneakers');
        workWith('Shoes', 'Womens Wedge Sneakers');
    }
    if ($part == 401) {
        workWith('Shoes', 'Womens Ballet Flats');
        workWith('Shoes', 'Womens Dress & Evening Flats');
        workWith('Shoes', 'Womens Mary-Jane Flats');
        workWith('Shoes', 'Womens Slingback Flats');
    }
    if ($part == 402) {
        workWith('Shoes', 'Womens Casual Oxfords');
        workWith('Shoes', 'Loafers & Slip-Ons');
        workWith('Shoes', 'Womens Clogs');
        workWith('Shoes', 'Womens Mules');
    }
    if ($part == 403) {
        workWith('Shoes', 'Womens Outdoor Boots');
        workWith('Shoes', 'Womens Outdoor Hiking');
        workWith('Shoes', 'Womens Outdoor Sandals');
        workWith('Shoes', 'Womens Climbing Shoes');
    }
    if ($part == 404) {
        workWith('Shoes', 'Womens Water Shoes');
        workWith('Shoes', 'Womens Ankle Strap Pumps');
        workWith('Shoes', 'Womens Dress & Evening Pumps');
        workWith('Shoes', 'Womens Mary-Jane Pumps');
    }
    if ($part == 405) {
        workWith('Shoes', 'Womens Platform Pumps');
        workWith('Shoes', 'Womens Slingback Pumps');
        workWith('Shoes', 'Womens T-Strap Pumps');
        workWith('Shoes', 'Womens Wedge Pumps');
    }
    if ($part == 406) {
        workWith('Shoes', 'Womens Ankle Strap Sandals');
        workWith('Shoes', 'Womens Ankle Wrap Sandals');
        workWith('Shoes', 'Womens Dress & Evening Sandals');
        workWith('Shoes', 'Womens Fisherman Sandals');
    }
    if ($part == 407) {
        workWith('Shoes', 'Womens T-Strap Sandals');
        workWith('Shoes', 'Womens Wedge Sandals');
        workWith('Shoes', 'Womens Slingback Sandals');
        workWith('Shoes', 'Womens Boat Shoes');
    }
    if ($part == 408) {
        workWith('Software', 'Business & Office Management');
        workWith('Software', 'Business Accounting');
        workWith('Software', 'Business Database Management');
        workWith('Software', 'Business Plan');
    }
    if ($part == 409) {
        workWith('Software', 'Communication');
        workWith('Software', 'Document Management');
        workWith('Software', 'Presentation');
        workWith('Software', 'Project Management');
    }
    if ($part == 410) {
        workWith('Software', 'Schedule & Contact Management');
        workWith('Software', 'Spreadsheet');
        workWith('Software', 'Voice Recognition');
        workWith('Software', 'Word Processing');
    }
    if ($part == 411) {
        workWith('Software', 'Childrens Interactive Books');
        workWith('Software', 'Childrens Math');
        workWith('Software', 'Childrens Reading & Language Learning');
        workWith('Software', 'Childrens Reference');
    }
    if ($part == 412) {
        workWith('Software', 'Childrens Thinking & Problem Solving');
        workWith('Software', 'Childrens Virtual Pet');
        workWith('Software', 'Anti-Spyware');
        workWith('Software', 'Antivirus');
    }
    if ($part == 413) {
        workWith('Software', 'Parental Control');
        workWith('Software', 'Security Suites');
        workWith('Software', 'Encyclopedia & Dictionary');
        workWith('Software', 'Foreign Languages');
    }
    if ($part == 414) {
        workWith('Software', 'History');
        workWith('Software', 'Mapping');
        workWith('Software', 'Religious');
        workWith('Software', 'Science Learning');
    }
    if ($part == 415) {
        workWith('Software', 'Secondary Education');
        workWith('Software', 'About Arts & Culture');
        workWith('Software', 'Test Preparation');
        workWith('Software', 'Typing');
    }
    if ($part == 416) {
        workWith('Software', 'Mac Games');
        workWith('Software', 'PC Games');
        workWith('Software', 'Cooking & Health-Related');
        workWith('Software', 'Fashion & Style');
    }
    if ($part == 417) {
        workWith('Software', 'Genealogy');
        workWith('Software', 'Hobby');
        workWith('Software', 'Movies & TV Shows');
        workWith('Software', 'Scrapbooking');
    }
    if ($part == 418) {
        workWith('Software', 'Language & Travel');
        workWith('Software', 'Directory Server');
        workWith('Software', 'File Server & Print Server');
        workWith('Software', 'LAN');
    }
    if ($part == 419) {
        workWith('Software', 'Netware Networking');
        workWith('Software', 'Network & Enterprise Management');
        workWith('Software', 'Networking Security');
        workWith('Software', 'SAA Networking');
    }
    if ($part == 420) {
        workWith('Software', 'TCP-IP');
        workWith('Software', 'VPN');
        workWith('Software', 'BeOS Computer Operating Systems');
        workWith('Software', 'DOS Computer Operating Systems');
    }
    if ($part == 421) {
        workWith('Software', 'Microsoft Windows');
        workWith('Software', 'OS2 Computer Operating Systems');
        workWith('Software', 'Personal Investment Tools');
        workWith('Software', 'Personal Money Management');
    }
    if ($part == 422) {
        workWith('Software', 'Animation');
        workWith('Software', 'CAD');
        workWith('Software', 'Graphics Training & Tutorials');
        workWith('Software', 'Home Publishing');
    }
    if ($part == 423) {
        workWith('Software', 'Photo Editing');
        workWith('Software', 'Professional Design');
        workWith('Software', 'Database');
        workWith('Software', 'Development Utilities');
    }
    if ($part == 424) {
        workWith('Software', 'Training & Tutorials');
        workWith('Software', 'Tax Preparation');
        workWith('Software', 'Backup');
        workWith('Software', 'Computer Disk Partitioning');
    }
    if ($part == 425) {
        workWith('Software', 'Cross Platform Utility');
        workWith('Software', 'File Compression & Decompression');
        workWith('Software', 'File Conversion');
        workWith('Software', 'Handheld Utility');
    }
    if ($part == 426) {
        workWith('Software', 'CD Burning & Labeling');
        workWith('Software', 'Digital Video');
        workWith('Software', 'Instrument Instruction');
        workWith('Software', 'MP3 Music');
    }
    if ($part == 427) {
        workWith('Software', 'Sound Libraries');
        workWith('Software', 'e-Commerce');
        workWith('Software', 'Internet Utilities');
        workWith('Software', 'Professional Web Development');
    }
    if ($part == 428) {
        workWith('Tools', 'Appliances');
        workWith('Tools', 'Decking & Fencing');
        workWith('Tools', 'Doors');
        workWith('Tools', 'Flooring');
    }
    if ($part == 429) {
        workWith('Tools', 'Raw Building Materials');
        workWith('Tools', 'Roofing');
        workWith('Tools', 'Stair Parts');
        workWith('Tools', 'Tiles');
    }
    if ($part == 430) {
        workWith('Tools', 'Furnace Parts & Accessories');
        workWith('Tools', 'Heaters');
        workWith('Tools', 'Heating & Cooling Ducting');
        workWith('Tools', 'HVAC Controls');
    }
    if ($part == 431) {
        workWith('Tools', 'Thermostats & Accessories');
        workWith('Tools', 'Weatherproofing');
        workWith('Tools', 'Job Site Lighting');
        workWith('Tools', 'Extension Ladders');
    }
    if ($part == 432) {
        workWith('Tools', 'Stepladders');
        workWith('Tools', 'Telescoping Ladders');
        workWith('Tools', 'Drywall Lifts');
        workWith('Tools', 'Hand Trucks');
    }
    if ($part == 433) {
        workWith('Tools', 'Workbenches');
        workWith('Tools', 'Scaffolding');
        workWith('Tools', 'Circuit Breakers');
        workWith('Tools', 'Cord Reels');
    }
    if ($part == 434) {
        workWith('Tools', 'Doorbells');
        workWith('Tools', 'Electric Motors');
        workWith('Tools', 'Electrical Boxes');
        workWith('Tools', 'Electrical Cable Ties');
    }
    if ($part == 435) {
        workWith('Tools', 'Electrical Conduit');
        workWith('Tools', 'Electrical Panel');
        workWith('Tools', 'Electrical Switches');
        workWith('Tools', 'Electrical Wire');
    }
    if ($part == 436) {
        workWith('Tools', 'Fuses');
        workWith('Tools', 'Light Bulbs');
        workWith('Tools', 'Light Sockets');
        workWith('Tools', 'Outdoor Lighting Parts');
    }
    if ($part == 437) {
        workWith('Tools', 'Power Strips');
        workWith('Tools', 'Recessed Lighting');
        workWith('Tools', 'Timers');
        workWith('Tools', 'Tools & Testers');
    }
    if ($part == 438) {
        workWith('Tools', 'Adhesives & Sealers');
        workWith('Tools', 'Bathroom Hardware');
        workWith('Tools', 'Cabinet Hardware');
        workWith('Tools', 'Door Hardware & Locks');
    }
    if ($part == 439) {
        workWith('Tools', 'Garage Door Hardware');
        workWith('Tools', 'Gate Hardware');
        workWith('Tools', 'Hooks');
        workWith('Tools', 'House Numbers');
    }
    if ($part == 440) {
        workWith('Tools', 'Nails, Screws & Fasteners');
        workWith('Tools', 'Padlocks & Hasps');
        workWith('Tools', 'Tarps & Tie-Downs');
        workWith('Tools', 'Window Hardware');
    }
    if ($part == 441) {
        workWith('Tools', 'Construction Machinery');
        workWith('Tools', 'Hydraulics');
        workWith('Tools', 'Bathroom Fixtures');
        workWith('Tools', 'Kitchen Fixtures');
    }
    if ($part == 442) {
        workWith('Tools', 'Water Filtration & Softeners');
        workWith('Tools', 'Paint Rollers');
        workWith('Tools', 'Paint Sprayers');
        workWith('Tools', 'Paint, Stain & Solvents');
    }
    if ($part == 443) {
        workWith('Tools', 'Prep Materials');
        workWith('Tools', 'Wall Repair');
        workWith('Tools', 'Wall Stickers & Murals');
        workWith('Tools', 'Wallpaper');
    }
    if ($part == 444) {
        workWith('Tools', 'Measuring & Layout Tools');
        workWith('Tools', 'Power Tool Accessories');
        workWith('Tools', 'Power Tools');
        workWith('Tools', 'Tool Organizers');
    }
    if ($part == 445) {
        workWith('Tools', 'Faucet Parts');
        workWith('Tools', 'Food Disposers & Parts');
        workWith('Tools', 'Pipes, Pipe Fittings & Accessories');
        workWith('Tools', 'Toilet Parts');
    }
    if ($part == 446) {
        workWith('Tools', 'Water Heaters');
        workWith('Tools', 'Water Heater Parts');
        workWith('Tools', 'Water Pumps & Accessories');
        workWith('Tools', 'Fire Safety');
    }
    if ($part == 447) {
        workWith('Tools', 'Household Sensors & Alarms');
        workWith('Tools', 'Safes');
        workWith('Tools', 'Security Lighting');
        workWith('Tools', 'Survival Kits');
    }
    if ($part == 448) {
        workWith('Toys', 'Figures');
        workWith('Toys', 'Playset Figures');
        workWith('Toys', 'Statues, Maquettes & Busts');
        workWith('Toys', 'Aprons & Smocks');
    }
    if ($part == 449) {
        workWith('Toys', 'Blackboards & Whiteboards');
        workWith('Toys', 'Clay & Dough');
        workWith('Toys', 'Craft Kits');
        workWith('Toys', 'Decorative Stickers');
    }
    if ($part == 450) {
        workWith('Toys', 'Easel Craft Kits');
        workWith('Toys', 'Fuse Beads');
        workWith('Toys', 'Glue, Paste & Tape');
        workWith('Toys', 'Kids Bendable Sculpting Sticks');
    }
    if ($part == 451) {
        workWith('Toys', 'Sketching Pads');
        workWith('Toys', 'Baby Activity Toys');
        workWith('Toys', 'Baby Block Toys');
        workWith('Toys', 'Stroller Toys');
    }
    if ($part == 452) {
        workWith('Toys', 'Baby Mirrors');
        workWith('Toys', 'Baby Musical Toys');
        workWith('Toys', 'Baby Push Toys & Baby Pull Toys');
        workWith('Toys', 'Baby Stacking Toys');
    }
    if ($part == 453) {
        workWith('Toys', 'Baby Toy Gift Sets');
        workWith('Toys', 'Balls for Babies & Toddlers');
        workWith('Toys', 'Bath Toys');
        workWith('Toys', 'Crib Toys & Musical Mobiles');
    }
    if ($part == 454) {
        workWith('Toys', 'Kids Gym Sets');
        workWith('Toys', 'Rocking & Spring Ride-Ons');
        workWith('Toys', 'Shape Sorting Toys');
        workWith('Toys', 'Spinning Tops');
    }
    if ($part == 455) {
        workWith('Toys', 'Teaching Clocks');
        workWith('Toys', 'Teethers & Rattles');
        workWith('Toys', 'Battle Tops');
        workWith('Toys', 'Kids Play Bracelets');
    }
    if ($part == 456) {
        workWith('Toys', 'Kids Play Rings');
        workWith('Toys', 'Makeup');
        workWith('Toys', 'Music Boxes');
        workWith('Toys', 'Purses');
    }
    if ($part == 457) {
        workWith('Toys', 'Balance Bikes');
        workWith('Toys', 'Electric Ride On Toys');
        workWith('Toys', 'Pedal Ride On Toys');
        workWith('Toys', 'Ride On Toys');
    }
    if ($part == 458) {
        workWith('Toys', 'Wagons');
        workWith('Toys', 'Building Sets');
        workWith('Toys', 'Stacking Blocks');
        workWith('Toys', 'Childrens Die-Cast Vehicles');
    }
    if ($part == 459) {
        workWith('Toys', 'Pull Back Vehicles');
        workWith('Toys', 'Radio & Remote Control');
        workWith('Toys', 'Slot Cars, Race Tracks & Accessories');
        workWith('Toys', 'Toy Garages');
    }
    if ($part == 460) {
        workWith('Toys', 'Vehicle Playsets');
        workWith('Toys', 'Baby Dolls');
        workWith('Toys', 'Clothing & Shoes');
        workWith('Toys', 'Baby Doll Accessories');
    }
    if ($part == 461) {
        workWith('Toys', 'Toddler Doll Accessories');
        workWith('Toys', 'Doll Strollers');
        workWith('Toys', 'Dollhouse Accessories');
        workWith('Toys', 'Dollhouse Dolls');
    }
    if ($part == 462) {
        workWith('Toys', 'Dollhouses');
        workWith('Toys', 'Dollhouses Decor');
        workWith('Toys', 'Fashion Dolls');
        workWith('Toys', 'Furniture');
    }
    if ($part == 463) {
        workWith('Toys', 'Rag Dolls');
        workWith('Toys', 'Construction Tools');
        workWith('Toys', 'Cooking & Housekeeping');
        workWith('Toys', 'Grocery Shopping');
    }
    if ($part == 464) {
        workWith('Toys', 'Paper & Magnetic Dolls');
        workWith('Toys', 'Toy Medical Kits');
        workWith('Toys', 'Hair and Nails');
        workWith('Toys', 'Cameras & Camcorders');
    }
    if ($part == 465) {
        workWith('Toys', 'Educational Computers & Accessories');
        workWith('Toys', 'Electronic Pets');
        workWith('Toys', 'Handheld Games');
        workWith('Toys', 'Karaoke');
    }
    if ($part == 466) {
        workWith('Toys', 'Plug and Play Video Games');
        workWith('Toys', 'Radios, MP3 & CD Players');
        workWith('Toys', 'Walkie Talkies');
        workWith('Toys', 'Bingo Board Games');
    }
    if ($part == 467) {
        workWith('Toys', 'Card Games');
        workWith('Toys', 'Checkers');
        workWith('Toys', 'Classic Games');
        workWith('Toys', 'Collectible Card Games');
    }
    if ($part == 468) {
        workWith('Toys', 'Packs & Sets');
        workWith('Toys', 'DVD Games');
        workWith('Toys', 'Educational Games');
        workWith('Toys', 'Floor Games');
    }
    if ($part == 469) {
        workWith('Toys', 'Game Room Games');
        workWith('Toys', 'Stacking Games');
        workWith('Toys', 'Standard Card Decks');
        workWith('Toys', 'Travel Games');
    }
    if ($part == 470) {
        workWith('Toys', 'Die-Cast & Toy Vehicles');
        workWith('Toys', 'Games - Grown-Ups');
        workWith('Toys', 'Hobbies');
        workWith('Toys', 'Novelty & Gag Toys');
    }
    if ($part == 471) {
        workWith('Toys', 'Coin Collecting');
        workWith('Toys', 'Model Building Kits');
        workWith('Toys', 'Model Rockets & Rocket Kits');
        workWith('Toys', 'Radio Control');
    }
    if ($part == 472) {
        workWith('Toys', 'Stamp Collecting');
        workWith('Toys', 'Trains');
        workWith('Toys', 'Kids Outdoor Furniture');
        workWith('Toys', 'Toy Chests & Toy Storage');
    }
    if ($part == 473) {
        workWith('Toys', 'Flash Cards');
        workWith('Toys', 'Geography & Globes');
        workWith('Toys', 'Habitats');
        workWith('Toys', 'Life Skills Toys');
    }
    if ($part == 474) {
        workWith('Toys', 'Reading & Writing');
        workWith('Toys', 'Science');
        workWith('Toys', 'Solar Power Kits');
        workWith('Toys', 'Special Needs Multi-sensory Toys');
    }
    if ($part == 475) {
        workWith('Toys', 'Instrument Accessories');
        workWith('Toys', 'Kids Guitars & Kids Guitar Strings');
        workWith('Toys', 'Pianos and Keyboards');
        workWith('Toys', 'Wind and Brass Instruments');
    }
    if ($part == 476) {
        workWith('Toys', 'Finger Boards & Finger Bikes');
        workWith('Toys', 'Flying Toys');
        workWith('Toys', 'Gags & Practical Joke Toys');
        workWith('Toys', 'Kids Money Banks');
    }
    if ($part == 477) {
        workWith('Toys', 'Magic Kits & Accessories');
        workWith('Toys', 'Magnet Toys');
        workWith('Toys', 'Miniatures and Keychains');
        workWith('Toys', 'Nesting Dolls');
    }
    if ($part == 478) {
        workWith('Toys', 'Shaped Rubber Wristbands');
        workWith('Toys', 'Slime & Putty Toys');
        workWith('Toys', 'Spy Gadgets');
        workWith('Toys', 'Temporary Tattoos');
    }
    if ($part == 479) {
        workWith('Toys', 'Wind-up Toys');
        workWith('Toys', 'Balloons');
        workWith('Toys', 'Banners, Streamers & Confetti');
        workWith('Toys', 'Cake Supplies');
    }
    if ($part == 480) {
        workWith('Toys', 'Noisemakers');
        workWith('Toys', 'Party Favors');
        workWith('Toys', 'Party Games and Crafts');
        workWith('Toys', 'Party Hats');
    }
    if ($part == 481) {
        workWith('Toys', 'Party Tableware');
        workWith('Toys', 'Tablecovers & Centerpieces');
        workWith('Toys', 'Finger Puppets');
        workWith('Toys', 'Hand Puppets');
    }
    if ($part == 482) {
        workWith('Toys', '3-D Puzzles');
        workWith('Toys', 'Brain Teasers');
        workWith('Toys', 'Floor Puzzles');
        workWith('Toys', 'Jigsaw Puzzles');
    }
    if ($part == 483) {
        workWith('Toys', 'Puzzle Play Mats');
        workWith('Toys', 'Puzzle Storage and Accessories');
        workWith('Toys', 'Sudoku Puzzles');
        workWith('Toys', 'Activity Tables');
    }
    if ($part == 484) {
        workWith('Toys', 'Beanbags & Foot Bags');
        workWith('Toys', 'Bubbles Toys');
        workWith('Toys', 'Dice Games & Marble Games');
        workWith('Toys', 'Fitness Equipment');
    }
    if ($part == 485) {
        workWith('Toys', 'Gym Sets & Swings');
        workWith('Toys', 'Kickball & Playground Balls');
        workWith('Toys', 'Kites & Wind Spinners');
        workWith('Toys', 'Lawn Games');
    }
    if ($part == 486) {
        workWith('Toys', 'Pools & Water Fun');
        workWith('Toys', 'Sandboxes & Accessories');
        workWith('Toys', 'Slumber Bags');
        workWith('Toys', 'Sports');
    }
    if ($part == 487) {
        workWith('Toys', 'Yoyos');
        workWith('Toys', 'Plush Backpacks & Purses');
        workWith('Toys', 'Plush Pillows');
        workWith('Toys', 'Plush Puppets');
    }
    if ($part == 488) {
        workWith('Video', 'Action');
        workWith('Video', 'Adventure');
        workWith('Video', 'Animation');
        workWith('Video', 'Biography');
    }
    if ($part == 489) {
        workWith('Video', 'Crime');
        workWith('Video', 'Documentary');
        workWith('Video', 'Drama');
        workWith('Video', 'Family');
    }
    if ($part == 490) {
        workWith('Video', 'Film-Noir');
        workWith('Video', 'Game-Show');
        workWith('Video', 'History');
        workWith('Video', 'Horror');
    }
    if ($part == 491) {
        workWith('Video', 'Musical');
        workWith('Video', 'Mystery');
        workWith('Video', 'News');
        workWith('Video', 'Reality-TV');
    }
    if ($part == 492) {
        workWith('Video', 'Sci-Fi');
        workWith('Video', 'Sport');
        workWith('Video', 'Talk-Show');
        workWith('Video', 'Thriller');
    }
    if ($part == 493) {
        workWith('VideoGames', 'Mac Action games');
        workWith('VideoGames', 'Mac Arcade games');
        workWith('VideoGames', 'Mac Board games');
        workWith('VideoGames', 'Mac Casino games');
    }
    if ($part == 494) {
        workWith('VideoGames', 'Mac Word Games');
        workWith('VideoGames', 'Mac Racing & Flying Games');
        workWith('VideoGames', 'Mac Rhythm');
        workWith('VideoGames', 'Mac Role Playing Games');
    }
    if ($part == 495) {
        workWith('VideoGames', 'Mac Sports games');
        workWith('VideoGames', 'Mac Strategy games');
        workWith('VideoGames', 'Atari 5200 games');
        workWith('VideoGames', 'Atari 7800 games');
    }
    if ($part == 496) {
        workWith('VideoGames', 'Atari Lynx games');
        workWith('VideoGames', 'ColecoVision games');
        workWith('VideoGames', 'Commodore 64 games');
        workWith('VideoGames', 'Commodore Amiga games');
    }
    if ($part == 497) {
        workWith('VideoGames', 'Game Boy Advance games');
        workWith('VideoGames', 'Game Boy Color games');
        workWith('VideoGames', 'GameCube games');
        workWith('VideoGames', 'Intellivision games');
    }
    if ($part == 498) {
        workWith('VideoGames', 'NEOGEO Pocket games');
        workWith('VideoGames', 'Nintendo 64 games');
        workWith('VideoGames', 'Nintendo NES games');
        workWith('VideoGames', 'PDA Video Games');
    }
    if ($part == 499) {
        workWith('VideoGames', 'PlayStation games');
        workWith('VideoGames', 'Sega CD games');
        workWith('VideoGames', 'Sega Dreamcast games');
        workWith('VideoGames', 'Sega Game Gear games');
    }
    if ($part == 500) {
        workWith('VideoGames', 'Sega Master System games');
        workWith('VideoGames', 'Sega Saturn games');
        workWith('VideoGames', 'Super Nintendo games');
        workWith('VideoGames', 'TurboGrafx 16 games');
    }
    if ($part == 501) {
        workWith('VideoGames', 'Nintendo 3DS Action games');
        workWith('VideoGames', 'Nintendo 3DS Adventure Games');
        workWith('VideoGames', 'Nintendo 3DS Arcade Games');
    }
    if ($part == 502) {
        workWith('VideoGames', 'Nintendo 3DS Puzzle Games');
        workWith('VideoGames', 'Nintendo 3DS Racing Games');
        workWith('VideoGames', 'Nintendo 3DS Rhythm Games');
        workWith('VideoGames', 'Nintendo 3DS Role-Playing Games');
    }
    if ($part == 503) {
        workWith('VideoGames', 'Nintendo 3DS Simulation games');
        workWith('VideoGames', 'Nintendo 3DS Sports games');
        workWith('VideoGames', 'Nintendo 3DS Strategy games');
        workWith('VideoGames', 'Nintendo Wii Air Racing & Flying Games');
    }
    if ($part == 504) {
        workWith('VideoGames', 'Nintendo Wii Board Games');
        workWith('VideoGames', 'Nintendo Wii Card Games');
        workWith('VideoGames', 'Nintendo Wii Casino Games');
    }
    if ($part == 505) {
        workWith('VideoGames', 'Nintendo Wii Rhythm games');
        workWith('VideoGames', 'Nintendo Wii Role Playing Games');
        workWith('VideoGames', 'Nintendo Wii Simulation games');
        workWith('VideoGames', 'Nintendo Wii Strategy games');
    }
    if ($part == 506) {
        workWith('VideoGames', 'Nintendo Wii Adventure Games');
        workWith('VideoGames', 'PC Action games');
        workWith('VideoGames', 'PC Adventure games');
        workWith('VideoGames', 'PC Air Racing & Flying games');
    }
    if ($part == 507) {
        workWith('VideoGames', 'PC BoardPC Games');
        workWith('VideoGames', 'PC Card games');
        workWith('VideoGames', 'PC Casino games');
        workWith('VideoGames', 'PC Hardware games');
    }
    if ($part == 508) {
        workWith('VideoGames', 'PC Racing games');
        workWith('VideoGames', 'PC Simulation games');
        workWith('VideoGames', 'PC Sports games');
        workWith('VideoGames', 'PC Strategy games');
    }
    if ($part == 509) {
        workWith('VideoGames', 'PC Word games');
        workWith('VideoGames', 'PS3 Adventure Games');
        workWith('VideoGames', 'PS3 Games');
        workWith('VideoGames', 'PS3 Racing Games & PS3 Flying Games');
    }
    if ($part == 510) {
        workWith('VideoGames', 'PS3 Rhythm games');
        workWith('VideoGames', 'PS3 Sports games');
        workWith('VideoGames', 'PS3 Strategy games');
        workWith('VideoGames', 'PS3 Trivia Games');
    }
    if ($part == 511) {
        workWith('VideoGames', 'PlayStation Vita Fighting games');
        workWith('VideoGames', 'PlayStation Vita Shooter games');
        workWith('VideoGames', 'PlayStation Vita Military games');
        workWith('VideoGames', 'PlayStation Vita Espionage games');
    }
    if ($part == 512) {
        workWith('VideoGames', 'PlayStation Vita Games');
        workWith('VideoGames', 'PlayStation Vita Racing & Flying Games');
        workWith('VideoGames', 'Xbox 360 Action Games');
        workWith('VideoGames', 'Xbox 360 Arcade Games');
    }
    if ($part == 513) {
        workWith('VideoGames', 'Xbox 360 Puzzle Games');
        workWith('VideoGames', 'Xbox 360 Racing & Flying Games');
        workWith('VideoGames', 'Xbox 360 Rhythm games');
    }
    if ($part == 514) {
        workWith('Watches', 'Casual Watches');
        workWith('Watches', 'Dress Watches');
        workWith('Watches', 'Fashion Watches');
        workWith('Watches', 'Luxury Watches');
    }
    if ($part == 515) {
        workWith('Watches', 'Wrist Watches');
        workWith('Watches', 'Pocket Watches');
        workWith('Watches', 'Watch Bands');
        workWith('Watches', 'Accessories');
    }
    if ($part == 516) {
        workWith('Watches', 'Automatic Self-Wind');
        workWith('Watches', 'Mechanical Hand Wind');
        workWith('Watches', 'Quartz');
        workWith('Watches', '01TheOne');
    }
    if ($part == 517) {
        workWith('Watches', 'Accutron');
        workWith('Watches', 'Activa');
        workWith('Watches', 'Adee Kaye');
        workWith('Watches', 'ADOLFO');
    }
    if ($part == 518) {
        workWith('Watches', 'Akribos XXIV');
        workWith('Watches', 'Andre Giroud');
        workWith('Watches', 'Andrew Marc');
        workWith('Watches', 'Anne Klein');
    }
    if ($part == 519) {
        workWith('Watches', 'Andy Warhol');
        workWith('Watches', 'Android');
        workWith('Watches', 'Angry Birds');
        workWith('Watches', 'Armitron');
    }
    if ($part == 520) {
        workWith('Watches', 'August Steiner');
        workWith('Watches', 'Avio Milano');
        workWith('Watches', 'Badgley Mischka');
        workWith('Watches', 'Ball');
    }
    if ($part == 521) {
        workWith('Watches', 'BCBGirls');
        workWith('Watches', 'BCBGMAXAZRIA');
        workWith('Watches', 'Bedat & Co.');
        workWith('Watches', 'Bell & Ross');
    }
    if ($part == 522) {
        workWith('Watches', 'Ben Sherman');
        workWith('Watches', 'Betsey Johnson');
        workWith('Watches', 'Black Dice');
        workWith('Watches', 'Blancpain');
    }
    if ($part == 523) {
        workWith('Watches', 'Bombshell');
        workWith('Watches', 'Breda');
        workWith('Watches', 'Breitling');
        workWith('Watches', 'Breo');
    }
    if ($part == 524) {
        workWith('Watches', 'Brillier');
        workWith('Watches', 'Bulova');
        workWith('Watches', 'Burberry');
        workWith('Watches', 'Burgi');
    }
    if ($part == 525) {
        workWith('Watches', 'Burett');
        workWith('Watches', 'Bvlgari');
        workWith('Watches', 'Calvin Klein');
        workWith('Watches', 'Caravelle by Bulova');
    }
    if ($part == 526) {
        workWith('Watches', 'Carriage by Timex');
        workWith('Watches', 'Cartier');
        workWith('Watches', 'Casio');
        workWith('Watches', 'Caterpillar');
    }
    if ($part == 527) {
        workWith('Watches', 'Cerentino');
        workWith('Watches', 'Chanel');
        workWith('Watches', 'Charles-Hubert, Paris');
        workWith('Watches', 'Chase-Durer');
    }
    if ($part == 528) {
        workWith('Watches', 'Christian Audigier');
        workWith('Watches', 'Christian Dior');
        workWith('Watches', 'Citizen');
        workWith('Watches', 'Claude Bernard');
    }
    if ($part == 529) {
        workWith('Watches', 'Coleman');
        workWith('Watches', 'Colibri');
        workWith('Watches', 'Columbia Sportswear');
        workWith('Watches', 'Concord');
    }
    if ($part == 530) {
        workWith('Watches', 'Corum');
        workWith('Watches', 'Corvette');
        workWith('Watches', 'Croton');
        workWith('Watches', 'Cvstos');
    }
    if ($part == 531) {
        workWith('Watches', 'Danish Designs');
        workWith('Watches', 'David & Goliath');
        workWith('Watches', 'Deep Blue');
        workWith('Watches', 'Deuce Brand');
    }
    if ($part == 532) {
        workWith('Watches', 'D&G Dolce & Gabbana');
        workWith('Watches', 'Diadora');
        workWith('Watches', 'Diesel');
        workWith('Watches', 'Diplomat');
    }
    if ($part == 533) {
        workWith('Watches', 'DKNY');
        workWith('Watches', 'DROPS');
        workWith('Watches', 'Ebel');
        workWith('Watches', 'Ed Hardy');
    }
    if ($part == 534) {
        workWith('Watches', 'Elgin');
        workWith('Watches', 'ELLETIME');
        workWith('Watches', 'Emporio Armani');
        workWith('Watches', 'English Laundry');
    }
    if ($part == 535) {
        workWith('Watches', 'Eric Edelhausen');
        workWith('Watches', 'ESPRIT');
        workWith('Watches', 'ESQ by Movado');
        workWith('Watches', 'Eterna');
    }
    if ($part == 536) {
        workWith('Watches', 'EWatchFactory');
        workWith('Watches', 'Fancy Face');
        workWith('Watches', 'Fendi');
        workWith('Watches', 'Ferragamo');
    }
    if ($part == 537) {
        workWith('Watches', 'Fila');
        workWith('Watches', 'Flud');
        workWith('Watches', 'Fortis');
        workWith('Watches', 'Fossil');
    }
    if ($part == 538) {
        workWith('Watches', 'Freelook');
        workWith('Watches', 'Freestyle');
        workWith('Watches', 'French Connection');
        workWith('Watches', 'Frenzy');
    }
    if ($part == 539) {
        workWith('Watches', 'FujiTime');
        workWith('Watches', 'Game Time');
        workWith('Watches', 'Geneve');
        workWith('Watches', 'Gevril');
    }
    if ($part == 540) {
        workWith('Watches', 'gino franco');
        workWith('Watches', 'Girard-Perregaux');
        workWith('Watches', 'Giulio Romano');
        workWith('Watches', 'Glam Rock');
    }
    if ($part == 541) {
        workWith('Watches', 'Golana');
        workWith('Watches', 'Golden Classic');
        workWith('Watches', 'Grovana');
        workWith('Watches', 'GUCCI');
    }
    if ($part == 542) {
        workWith('Watches', 'GV2 by Gevril');
        workWith('Watches', 'H3 Tactical');
        workWith('Watches', 'Hadley-Roma');
        workWith('Watches', 'Haemmer');
    }
    if ($part == 543) {
        workWith('Watches', 'Hamlin');
        workWith('Watches', 'Haurex');
        workWith('Watches', 'HD3');
        workWith('Watches', 'Hector');
    }
    if ($part == 544) {
        workWith('Watches', 'HOT WHEELS');
        workWith('Watches', 'Hugo Boss');
        workWith('Watches', 'Hype');
        workWith('Watches', 'Ice-Watch');
    }
    if ($part == 545) {
        workWith('Watches', 'Ingersoll');
        workWith('Watches', 'Invicta');
        workWith('Watches', 'Issey Miyake');
        workWith('Watches', 'IWC');
    }
    if ($part == 546) {
        workWith('Watches', 'Jacques Farel');
        workWith('Watches', 'Jacques Lemans');
        workWith('Watches', 'Jaeger-LeCoultre');
        workWith('Watches', 'JBW');
    }
    if ($part == 547) {
        workWith('Watches', 'Joe Rodeo');
        workWith('Watches', 'Johan Eric');
        workWith('Watches', 'Joshua & Sons');
        workWith('Watches', 'Jowissa');
    }
    if ($part == 548) {
        workWith('Watches', 'Jules Jurgensen');
        workWith('Watches', 'Just Bling');
        workWith('Watches', 'Justin Bieber');
        workWith('Watches', 'K&BROS');
    }
    if ($part == 549) {
        workWith('Watches', 'Kenneth Jay Lane');
        workWith('Watches', 'Kienzle');
        workWith('Watches', 'Klaus Kobec');
        workWith('Watches', 'KR3W');
    }
    if ($part == 550) {
        workWith('Watches', 'L.A.M.B.');
        workWith('Watches', 'Lancaster');
        workWith('Watches', 'La Mer Collections');
        workWith('Watches', 'La Vie');
    }
    if ($part == 551) {
        workWith('Watches', 'LEGO');
        workWith('Watches', 'Le Vian');
        workWith('Watches', 'Lip');
        workWith('Watches', 'Locman');
    }
    if ($part == 552) {
        workWith('Watches', 'Lorenz');
        workWith('Watches', 'Lorus');
        workWith('Watches', 'Louis Erard');
        workWith('Watches', 'Love Peace and Hope');
    }
    if ($part == 553) {
        workWith('Watches', 'Lucky Brand');
        workWith('Watches', 'Luminox');
        workWith('Watches', 'Manhattan');
        workWith('Watches', 'Marc by Marc Jacobs');
    }
    if ($part == 554) {
        workWith('Watches', 'Marcel Drucker');
        workWith('Watches', 'Mattel');
        workWith('Watches', 'Marvel Comics');
        workWith('Watches', 'Maurice Lacroix');
    }
    if ($part == 555) {
        workWith('Watches', 'Michele');
        workWith('Watches', 'Milus');
        workWith('Watches', 'Momentum');
        workWith('Watches', 'Mondaine');
    }
    if ($part == 556) {
        workWith('Watches', 'Montrek');
        workWith('Watches', 'Montres De Luxe');
        workWith('Watches', 'Morgan');
        workWith('Watches', 'MOSCHINO');
    }
    if ($part == 557) {
        workWith('Watches', 'Movado');
        workWith('Watches', 'MULCO');
        workWith('Watches', 'Nautica');
        workWith('Watches', 'NEFF');
    }
    if ($part == 558) {
        workWith('Watches', 'Nexus');
        workWith('Watches', 'Nickelodeon');
        workWith('Watches', 'Nike');
        workWith('Watches', 'Nina Ricci');
    }
    if ($part == 559) {
        workWith('Watches', 'Nixon');
        workWith('Watches', 'Nooka');
        workWith('Watches', 'noon copenhagen');
        workWith('Watches', 'Oakley');
    }
    if ($part == 560) {
        workWith('Watches', 'o.d.m.');
        workWith('Watches', 'Officina Del Tempo');
        workWith('Watches', 'Omega');
        workWith('Watches', 'Oniss');
    }
    if ($part == 561) {
        workWith('Watches', 'Orient');
        workWith('Watches', 'Oris');
        workWith('Watches', 'Panerai');
        workWith('Watches', 'Pedre');
    }
    if ($part == 562) {
        workWith('Watches', 'Peugeot');
        workWith('Watches', 'Philip Stein');
        workWith('Watches', 'Phosphor');
        workWith('Watches', 'Piaget');
    }
    if ($part == 563) {
        workWith('Watches', 'Pierre Petit');
        workWith('Watches', 'Police');
        workWith('Watches', 'Pulsar');
        workWith('Watches', 'PUMA');
    }
    if ($part == 564) {
        workWith('Watches', 'Raymond Weil');
        workWith('Watches', 'REACTOR');
        workWith('Watches', 'Red Line');
        workWith('Watches', 'Revue Thommen');
    }
    if ($part == 565) {
        workWith('Watches', 'Rip Curl');
        workWith('Watches', 'Ritmo Mundo');
        workWith('Watches', 'Roamer of Switzerland');
        workWith('Watches', 'Roberto Bianci');
    }
    if ($part == 566) {
        workWith('Watches', 'Roger Dubuis');
        workWith('Watches', 'Rolex');
        workWith('Watches', 'Rotary');
        workWith('Watches', 'Roxy');
    }
    if ($part == 567) {
        workWith('Watches', 'Rudiger');
        workWith('Watches', 'RumbaTime');
        workWith('Watches', 'Saint Honore');
        workWith('Watches', 'Sanrio');
    }
    if ($part == 568) {
        workWith('Watches', 'Sector');
        workWith('Watches', 'Seiko');
        workWith('Watches', 'Sesame Street');
        workWith('Watches', 'Shocking Goat');
    }
    if ($part == 569) {
        workWith('Watches', 'Soleus');
        workWith('Watches', 'Soma');
        workWith('Watches', 'South Park');
        workWith('Watches', 'Speedo');
    }
    if ($part == 570) {
        workWith('Watches', 'Star Wars');
        workWith('Watches', 'Staurino Fratelli');
        workWith('Watches', 'Steiner');
        workWith('Watches', 'Steinhausen');
    }
    if ($part == 571) {
        workWith('Watches', 'Stuhrling Original');
        workWith('Watches', 'Suunto');
        workWith('Watches', 'Swatch');
        workWith('Watches', 'Swiss Legend');
    }
    if ($part == 572) {
        workWith('Watches', 'Swiss Military Hanowa');
        workWith('Watches', 'Swisstek');
        workWith('Watches', 'Shashi');
        workWith('Watches', 'Swistar');
    }
    if ($part == 573) {
        workWith('Watches', 'Tapout');
        workWith('Watches', 'TechnoMarine');
        workWith('Watches', 'Ted Baker');
        workWith('Watches', 'Tendence');
    }
    if ($part == 574) {
        workWith('Watches', 'The P.S. Collection by Arjang & Co.');
        workWith('Watches', 'Thierry Mugler');
        workWith('Watches', 'Timex');
        workWith('Watches', 'Tissot');
    }
    if ($part == 575) {
        workWith('Watches', 'TKO Orlogi');
        workWith('Watches', 'Tocs');
        workWith('Watches', 'tokidoki');
        workWith('Watches', 'Tommy Bahama');
    }
    if ($part == 576) {
        workWith('Watches', 'Torgoen');
        workWith('Watches', 'Torgoen Swiss');
        workWith('Watches', 'Toy Watch');
        workWith('Watches', 'Trax');
    }
    if ($part == 577) {
        workWith('Watches', 'TX');
        workWith('Watches', 'U-Boat');
        workWith('Watches', 'Ulysse Nardin');
        workWith('Watches', 'UNIONBAY');
    }
    if ($part == 578) {
        workWith('Watches', 'Vernier');
        workWith('Watches', 'Versace');
        workWith('Watches', 'Versus by Versace');
        workWith('Watches', 'Vestal');
    }
    if ($part == 579) {
        workWith('Watches', 'Victorinox Swiss Army');
        workWith('Watches', 'Vostok Europe');
        workWith('Watches', 'Welder');
        workWith('Watches', 'Wenger');
    }
    if ($part == 580) {
        workWith('Watches', 'Whimsical Watches');
        workWith('Watches', 'Wittnauer');
        workWith('Watches', 'Wize & Ope');
        workWith('Watches', 'Wolf Designs');
    }
    if ($part == 581) {
        workWith('Watches', 'XOXO');
        workWith('Watches', 'Zanheadgear');
        workWith('Watches', 'Zenith');
        workWith('Watches', 'Zeno');
    }
    if ($part == 582) {
        workWith('Jewelry', 'Emerald cut engagement rings');
        workWith('Beauty', 'Makeup brushes set');
        workWith('Jewelry', 'Silver rings for women');
        workWith('Jewelry', 'Pearl engagement rings');
    }
    if ($part == 583) {
        workWith('Beauty', 'Makeup palettes');
        workWith('Electronics', 'WD Caviar Blue 500 GB');
        workWith('All', 'Horse head mask');
    }
}

function workWith($index, $subCategory)
{
    $topItems = array();
    $topItems = load($index, $subCategory);
    save($topItems);
}

function save($topItems)
{
    global $db;
    if (count($topItems) >= 8) {
        $index = $topItems[0]->index;
        $subCategory = $topItems[0]->subCategory;
        $db->exec("DELETE FROM best_cat WHERE cat_index = '$index' AND subCategory = '$subCategory'");
        foreach ($topItems as $item) {
            $db->exec("INSERT INTO best_cat (cat_index, img_url, img_h, img_w, asin, title, subCategory, price, review, details) VALUES ('$index', '" . $item->imgUrl . "', " . $item->imgH . ", " . $item->imgW . ", '" . $item->asin . "', '" . $item->title . "', '" . $item->subCategory . "', '" . $item->price . "', '" . $item->review . "', '" . $item->detailsLink . "')");
        }
        prepareCachedPage($subCategory);
    }
}

function prepareCachedPage($subCategory)
{
    global $db;
    $content = "<div id=\"top-items-content-div\">";
    $table = "<div id=\"top-item-content-1\"><br><table width=\"85%\"><tr>";
    $tdCounter = 0;
    foreach ($db->query("SELECT * FROM best_cat WHERE subCategory = '$subCategory'") as $row) {
        $tdCounter++;
        $title = base64_decode($row['title']);
        $top = 90 - ($row['img_h'] / 2);
        $left = ($row['img_w'] / 25) - 2;
        $asin = ($row['asin'] / 25) - 2;
        $imgUrl = $row['img_url'];
        $price = $row['price'];
        $price = "$" . number_format($price / 100, 2, '.', ',');
        $price = str_replace(".00", "", $price);
        $review = base64_decode($row['review']);
        $detailsLink = base64_decode($row['details']);
        $table .= "<td width=\"50%\" valign=\"top\" align=\"left\" onmouseover=\"document.getElementById('buy-$tdCounter').style.display='inline';\" onmouseout=\"document.getElementById('buy-$tdCounter').style.display='none'\">" .
            "<a href=\"$detailsLink\" target=\"_blank\" rel=\"nofollow\"><div id=\"top-item-td-$tdCounter\" class=\"top-items\">" .
            "<span style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\"><img src='$imgUrl' border=\"0\"></span>" .
            "</div></a>" .
            "<span class=\"item-title\">$title</span><br><br>" .
            "<p class=\"today\">$title</p>" .
            "><img src=></a></div>" .
            "</td>";
        if ($tdCounter % 2 == 0) {
            $table .= "</tr><tr>";
        }
    }
    $table .= "</tr></table></div>";
    $content .= $table;
    $today = date('l, jS \of F, Y');
    $page = "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
			<html>
			<head>
			<title>Amazon today's best offers for " . base64_decode($subCategory) . "</title>
			<meta name=\"keywords\" content=\"" . base64_decode($subCategory) . "\"/>
			<meta name=\"description\" content=\"Today's best offers for " . base64_decode($subCategory) . ". Up to 10 most relevant and popular " . base64_decode($subCategory) . "\">
			<style type=\"text/css\">
			body {
				background: url(\"http://simpleamazonsearch.com/img/bg.png\") repeat scroll 0 0 rgb(223, 223, 223);
			}

			.top-items {
				border: 1px solid #346789;
				box-shadow: 2px 2px 19px #e0e0e0;
				-o-box-shadow: 2px 2px 19px #e0e0e0;
				-webkit-box-shadow: 2px 2px 19px #e0e0e0;
				-moz-box-shadow: 2px 2px 19px #e0e0e0;
				-moz-border-radius: 0.5em;
				border-radius: 0.5em;
				height: 180px;
				width: 180px;
				line-height: 5em;
				text-align: center;
				background-color: white;
				color: black;
				padding: 5px;
				margin: 5px;
				position:relative;
				float:left;
			}
			
			.image-page-button {
				-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
				-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
				box-shadow:inset 0px 1px 0px 0px #ffffff;
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #dedede) );
				background:-moz-linear-gradient( center top, #ffffff 5%, #dedede 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dedede');
				background-color:#ffffff;
				-moz-border-radius:6px;
				-webkit-border-radius:6px;
				border-radius:6px;
				border:1px solid #dcdcdc;
				display:inline-block;
				color:#000000;
				font-family:arial;
				font-size:17px;
				font-weight:bold;
				padding:9px 36px;
				text-decoration:none;
				text-shadow:1px 1px 0px #ffffff;
			}.image-page-button:hover {
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dedede), color-stop(1, #ffffff) );
				background:-moz-linear-gradient( center top, #dedede 5%, #ffffff 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dedede', endColorstr='#ffffff');
				background-color:#dedede;
			}.image-page-button:active {
				position:relative;
				top:1px;
			}
			
			.title {
				font-family: georgia, serif; color: black; font-size: 18pt;
			}
			
			.item-title {
				font-family: georgia, serif; color: black; font-size: 16pt;position:relative;top:8px;
			}
			
			.today {
				font-family: verdana,arial,helvetica,sans-serif;font-size: small;color: #000000;
			}
			
			.top-items:hover {
				box-shadow: 2px 2px 19px #444;
				-o-box-shadow: 2px 2px 19px #444;
				-webkit-box-shadow: 2px 2px 19px #444;
				-moz-box-shadow: 2px 2px 19px #fff;
			}
			
			</style>
			</head>
			<body>
			<center>
			<a href=\"http://simpleamazonsearch.com\" target=\"_blank\"><font face=\"Lucida Console\" style=\"font-size: 24pt\">Simple Amazon Search</font></a><br>
			<font face=\"Lucida Console\" style=\"font-size: 12pt\">presents</font><br><br>
			<font class=\"title\">" . base64_decode($subCategory) . ". Today's best offers.</font><br>
			<font class=\"today\">" . $today . "</font><br><br>" . $content . "
			<br><br><center>2012-2013, <a href=\"http://kishlaly.com\" target=\"_blank\">Vladimir Kishlaly</a></center>
			</body>
			</html>";
    $cachedFileName = str_replace("&", "and", base64_decode($subCategory));
    $cachedFileName = str_replace(" ", "-", $cachedFileName);
    $fh = fopen(dirname(__FILE__) . "/today/" . $cachedFileName . ".html", "w");
    fwrite($fh, $page);
    fclose($fh);
}

function load($index, $keyword)
{
    $currentArray = array();
    $wsRequest = new WSRequest();
    $configuration = array(
        'Operation' => 'ItemSearch',
        'Keywords' => $keyword,
        'SearchIndex' => $index,
        'ResponseGroup' => 'Large'
    );
    $wsRequest->configure($configuration);
    $xml = $wsRequest->xml(false);
    foreach ($xml->Items->Item as $item) {
        $topItem = new TopItem();
        $topItem->asin = $item->ASIN;
        $topItem->imgUrl = $item->ImageSets->ImageSet->MediumImage->URL;
        $topItem->imgH = $item->ImageSets->ImageSet->MediumImage->Height;
        $topItem->imgW = $item->ImageSets->ImageSet->MediumImage->Width;
        $topItem->title = base64_encode($item->ItemAttributes->Title);
        $topItem->subCategory = base64_encode($keyword);
        $topItem->index = $index;

        $topItem->price = getItemMinPrice($item);
        $topItem->review = base64_encode($item->EditorialReviews->EditorialReview->Content);

        $topItem->detailsLink = base64_encode($item->ItemLinks->ItemLink[0]->URL);

        array_push($currentArray, $topItem);
    }
    return $currentArray;
}

function shortenTitle($title)
{
    if (strlen($title) > 55) {
        $result = substr($title, 0, 55);
        $result .= "...";
    } else {
        $result = $title;
    }
    return $result;
}

function getItemMinPrice($item)
{
    if ($item->OfferSummary->LowestNewPrice->Amount) {
        $lowestNewPrice = $item->OfferSummary->LowestNewPrice->Amount;
    } else if ($item->OfferSummary->LowestUsedPrice->Amount) {
        $lowestNewPrice = $item->OfferSummary->LowestUsedPrice->Amount;
    } else if ($item->OfferSummary->LowestRefurbishedPrice->Amount) {
        $lowestNewPrice = $item->OfferSummary->LowestRefurbishedPrice->Amount;
    } else if ($item->OfferSummary->TotalCollectiblePrice->Amount) {
        $lowestNewPrice = $item->OfferSummary->TotalCollectiblePrice->Amount;
    }
    $price = $item->Offers->Offer[0]->OfferListing->Price->Amount;
    $minPrice = 0;
    if ($lowestNewPrice && $price) {
        $minPrice = min($lowestNewPrice, $price);
    } else {
        if (!$lowestNewPrice && $price) {
            $minPrice = $price;
        }
        if ($lowestNewPrice && !$price) {
            $minPrice = $lowestNewPrice;
        }
    }
    return $minPrice;
}


$db = null;

// 13-17 absent!
// 22-25 absent!
// 18-21 absent!
?>
