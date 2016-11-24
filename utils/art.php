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
        workWith('Automotive', 'rear view mirror');
        workWith('Automotive', 'side view mirror');
        workWith('Jewelry', 'pearl pendant');
        workWith('Jewelry', 'black pearl necklace');
    }
    if ($part == 2) {
        workWith('Jewelry', 'freshwater pearl necklace');
        workWith('Jewelry', 'pearl necklace urban');
        workWith('Jewelry', 'black pearl earrings');
        workWith('Jewelry', 'pearl stud earrings');
    }
    if ($part == 3) {
        workWith('Jewelry', 'opal jewelry');
        workWith('Jewelry', 'amethyst jewelry');
        workWith('Jewelry', 'ruby jewelry');
        workWith('Jewelry', 'silver charm bracelet');
    }
    if ($part == 4) {
        workWith('Jewelry', 'leather bracelets for women');
        workWith('Jewelry', 'leather wrap bracelet');
        workWith('Jewelry', 'handmade beaded jewelry');
        workWith('Jewelry', 'silver bangle bracelets');
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
    $itemsArray = array();
    foreach ($db->query("SELECT * FROM best_cat WHERE subCategory = '$subCategory'") as $row) {
        $title = base64_decode($row['title']);
        $top = 90 - ($row['img_h'] / 2);
        $left = ($row['img_w'] / 25) - 2;
        $asin = ($row['asin'] / 25) - 2;
        $imgUrl = $row['img_url'];
        $price = $row['price'];
        $price = "$" . number_format($price / 100, 2, '.', ',');
        $price = str_replace(".00", "", $price);
        $detailsLink = base64_decode($row['details']);
        array_push($itemsArray, "<a href=\"$detailsLink\" target=\"_blank\" rel=\"nofollow\"><div id=\"top-item-td-$tdCounter\" class=\"top-items\">
							     <span style=\"position:relative; top:" . $top . "px;left:" . $left . "px;\"><img src='$imgUrl' border=\"0\"></span>
						        </a>");
    }
    $table1 = "<center><table><tr>";
    $table2 = "<center><table><tr>";
    $counter = 1;
    foreach ($itemsArray as $item) {
        if ($counter <= 5) {
            $table1 .= "<td>$item</td>";
        } else {
            $table2 .= "<td>$item</td>";
        }
        $counter++;
    }
    $table1 .= "</tr></table></center>";
    $table2 .= "</tr></table></center>";
    $titleSubcategory = ucfirst(base64_decode($subCategory));
    $article = getArticle(base64_decode($subCategory));
    $articleTitle = getArticleTitle(base64_decode($subCategory));
    $h2 = ucwords(base64_decode($subCategory));
    $page = "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
			<script type=\"text/javascript\">
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-7412096-39']);
			  _gaq.push(['_trackPageview']);
			
			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
			</script>				
			<title>$h2 - Popular filtered offers</title>
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
			
			.top-items:hover {
				box-shadow: 2px 2px 19px #444;
				-o-box-shadow: 2px 2px 19px #444;
				-webkit-box-shadow: 2px 2px 19px #444;
				-moz-box-shadow: 2px 2px 19px #fff;
			}
			
			.mine {
				font-family: georgia, serif;
				color: black;
				font-size: 12pt;
				padding: 0 20px 15px;
			}
			
			
			</style>
			</head>
			<body>
			<!-- Quantcast Tag -->
			<script type=\"text/javascript\">
			var _qevents = _qevents || [];
			
			(function() {
			var elem = document.createElement('script');
			elem.src = (document.location.protocol == \"https:\" ? \"https://secure\" : \"http://edge\") + \".quantserve.com/quant.js\";
			elem.async = true;
			elem.type = \"text/javascript\";
			var scpt = document.getElementsByTagName('script')[0];
			scpt.parentNode.insertBefore(elem, scpt);
			})();
			
			_qevents.push({
			qacct:\"p-nFGwPq224qBaR\"
			});
			
			</script>
			<!-- End Quantcast tag -->
			<noscript>
			<div style=\"display:none;\">
			<img src=\"//pixel.quantserve.com/pixel/p-nFGwPq224qBaR.gif\" border=\"0\" height=\"1\" width=\"1\" alt=\"Quantcast\">
			</div>
			</noscript>
			<div id=\"external-shared-image\">
				<center>
					<a href=\"http://simpleamazonsearch.com\"><font face=\"Lucida Console\" style=\"font-size: 24pt\">Simple Amazon Search</font></a>
					<h2>$articleTitle</h2>
					<h3>$h2</h3>
				</center>
				$table1
				<center><div style=\"width:80%;text-align:left;\">$article</div></center>
				$table2
			</div>
			<br><br><center>2012-2013, <a href=\"http://kishlaly.com\" target=\"_blank\">Vladimir Kishlaly</a></center>
			</body>
			</html>";
    $fileNameToSave = str_replace(" ", "-", base64_decode($subCategory));
    $fh = fopen(dirname(__FILE__) . "/articles/" . $fileNameToSave . ".html", "w");
    fwrite($fh, $page);
    fclose($fh);
}

function getArticle($title)
{
    if ($title == 'rear view mirror') {
        return "
<p class=\"mine\">
Have you wished that you could deal with car issues more effectively? Have you thought about doing auto repairs and labor yourself? Maybe you just want to know how to choose a little more about what you can do to find a good mechanic. Read on and learn more regarding these choices.
After you pay the mechanic to replace older parts with newer ones, make sure the mechanic gives you the old ones that were removed. If he cannot provide this, then they may not have replaced anything. This is not a definite red flag and you should confront him out on it.
</p>
<p class=\"mine\">
Replacing a burnt-out headlight or headlights yourself can save you both time and money. It's simpler in some vehicles than others, but it's more cost effective than hiring a mechanic. Ask someone you know if they can teach you on how to fix these problems.
Ask to have your old parts to be returned to you when a mechanic replaces a part. This helps you know whether the repairs were actually been done. This is not important if you get your exhaust system replacement.You can see whether you have installed a brand new exhaust system installed.
Don't think that convenience when deciding which repair shop to choose. Some garages or dealerships offer free shuttle service to drive you home after dropping your car off and pick you up.
</p>
<p class=\"mine\">
Ask as many questions before letting a mechanic work on your car. Any decent company will gladly answer all questions.
Put your car on a jack stands if you're storing it.
AAA is an excellent ally to have on your side when you've got auto repair. You can even get discounts on an annual AAA membership if you shop around.
</p>
<p class=\"mine\">
If you wish to figure out what kinds of problems are happening to your vehicle, you can't recognize if something is going wrong. You might even consider taking a class on auto repair if you are unfamiliar with automobile basics. This will enable you to better service your vehicle lasts longer.
Always listen for any sounds that your vehicle is making. Noises can be a problem.
</p>
<p class=\"mine\">
This can prevent your carpet staining from mud and dirt. These are a major must have item for the winter seasons or difficult weather patterns.
Watch out for obvious warning signs that your mechanic is not to be trusted. If they tend to talk in circles or ignore your questions, they are probably not the mechanic for you. You need to be able to trust the person doing your repairs, so go elsewhere.
Speak with friends about where they get their auto shop recommendations before you pick a shop. They have used mechanics before and can help point you in on their experiences. You should still do some research however. At least look for reviews on the shops that they recommend.
</p>
<p class=\"mine\">
Test drive your vehicle after repairs before paying for its repairs.
Keep in mind that any DIY auto repairs. Always have someone to be near you in case there is an emergency were to happen. Buy good quality tools that will last and not break under pressure. This is the tools you are investing in equipment to change your tires. The jack needs to be reliable so you are safe when you go under the car secure above you. That's why sometimes it's smart to use a good hydraulic floor jack with approved jack stands that are approved.
Don't underestimate how important it is to keep an emergency kit within your car. You ought to assemble a kit consisting of tire change tools, add gas or charge the battery.
</p>
<p class=\"mine\">
Always think of how to fix your car before trying to get it repaired. You probably know that some mechanics will come with lies to charge you more.
You do not necessarily have to visit the dealer in order to get your auto repairs done. There are many technicians all over the place. Find a mechanic who is certified and stick with them.
Get a reliable battery charger to keep in your car. Learn how to connect your car to the points where the battery charger connects.
</p>
<p class=\"mine\">
There may not be noticeable issues with the car, but it's still smart to have a pro take a close look. If nothing is wrong, you might need to get the dashboard computer checked.
Assemble a DIY auto repair kit to keep in the trunk of your trunk. Your tool kit should have equipment needed for changing a tire and other necessary items. You need to get a lug wrench and a jack if you do not have them. You should probably get a Phillips and flat head screwdriver and several types of wrenches.
You can conquer auto repairs. You've got to use the tips given in this article and start fixing the problem right away. Educating yourself with the basics means that you can handle problems when they occur.
</p>					
";
    }
    if ($title == 'side view mirror') {
        return "
<p class=\"mine\">
Nothing is worse than experiencing a breakdown while you are driving. This kind of situation is dangerous and now you a mechanic who is able to repair your car. How do you be sure of which mechanic is best? The following advice will help you find the best service.
Don't buy into the theory that you need a tuneup at 10000 miles. This is simply a rule of thumb that actually depends on the make and should not be followed religiously. You would better off if you followed the maintenance schedule recommended by the manual that came with your car.
Some unscrupulous body shops may replace your tires with older models. They do this to gain money from you being ignorant. Mark your tires with some chalks before taking your car off. If you find the chalk is missing later on, talk to the mechanic.
</p><p class=\"mine\">
Keep a record when your vehicle. If you have more problems later, these records can come in handy.
There are a few different kinds of the part. New parts are brand new and made to the manufacturer. Refurbished parts are ones that these parts have been restored. \"Salvage\" means that the parts are used and hasn't been fixed.
Just because it is winter does not mean you should avoid washing your vehicle. Winter can ruin the quality of your car. Sand and salt is something that can cause rust and corrosion.
</p><p class=\"mine\">
Always ask plenty of questions when speaking with a mechanic. How long will the repair it? What is the work will be done? How much do the parts cost? Ask anything else that concerns you about the work being done.
Don't fear asking questions when getting your vehicle repaired. A reputable mechanic will take the time to answer all your questions.
Try looking for someone who works from their own property. If they have auto repair experience they can provide quality work, they can typically do jobs for far less cost. You may save tons of money by going down this route.
</p><p class=\"mine\">
Referrals will lead you to a trustworthy mechanic.Ask the people you know for recommendations. You can gain information about prices and value that way. People will let you what type of things they had to deal with and if the mechanic was honest.
This means that the technician has completed a test and has more than two years of experience under his or her belt. This will ensure that you have the wheat from the chaff when picking a good mechanic.
Ask someone you trust to recommend a good mechanic to you. This is a mechanic because his skills have been proven based on your friend has personal experience with them. This gives you much better than randomly risking your vehicle with mechanics who have no recommendations from trusted individuals.
</p><p class=\"mine\">
You can either trust a small garage or a dealership to get your car fixed. Garages will cost a little bit less, but you may end up dealing with someone dishonest.
If you see a small problem in your vehicle, it is smart to get it checked right away. A seemingly small problem can become a major one if it is left unchecked.
Check the drive axle boots often for leaks. These protect the axle joints (which are behind your tires). Turn the wheels and this part will become easy to access.
</p><p class=\"mine\">
Take multiple pictures of your entire vehicle before taking it to the shop to get repaired. Some shops strip parts off your vehicle and resell the newer parts. You should document the vehicle in case you experience this terrible thing.
Be careful of mechanics who make unnecessary work on your vehicle. A good mechanic should let you know if they noticed parts that are starting to get worn down and will never perform work without getting your approval. Never bring your repeat business to a auto technician who preforms unnecessary repairs.
</p><p class=\"mine\">
Pay attention to your car's wiper blades. You may need new blades if they are making noises and leaving streaks on the glass.
Assemble a DIY auto repair kit to keep in the trunk of your car. Your tool kit should have equipment to change a tire. A lug wrench and jack are essential. You should probably get a Phillips and flat head screwdriver and several types of wrenches.
</p><p class=\"mine\">
Once you figure out what you can do to fix your automobile, use the Internet to look at spare parts and compare prices. There are may websites that exist just for your vehicle. Compare this estimate with the quotes you receive from auto repair shops give you.
Pay attention to any unusual sounds you hear when starting your vehicle. Noises can be a problem.
</p><p class=\"mine\">
The first hurdle you have to get over when your car fixed is finding a mechanic. You never want to work with a shady mechanic. Watch for negative body language like lack of eye contact, talk fast, or talking too fast.
After paying to replace old parts, ask if you can get the old part back. If they refuse, it could be that he never replaced any part. This is a red flag that should confront him about it.
Selecting the best mechanic is not easy. Knowledge is power, though. You will have an advantage if you know the right questions to ask and what to look out for. Remember to use the tips in this article when you need to find someone to work on your car.			
</p>";
    }
    if ($title == 'pearl pendant') {
        return "
			<p class=\"mine\">The idea behind jewelery is almost as stunning as physical jewelry is alone. Jewelry can signify an important relationship or make a joyous and happy occasions and pays respect to the owner and giver's relationship. Learning more about jewelry can help you in preserving it for a longer time.
			Take a moment to consider how your jewelry in the same place. It is best to use holders, compartments, boxes, and hooks for keeping pieces separate. Resist the temptation to jumble all your pieces together in one box or basket.This can hurt very fragile jewelry, and create a tangled mess.
</p><p class=\"mine\">			
			Untangle your knotted messes of delicate loops. It's easy to get frustrated with tangled necklaces, but try using some plastic wrap before you call it quits. Put the necklace on the plastic wrap and add a little baby oil.Use small needles to untangle the necklace. Use a mild liquid soap to remove the mineral oil and then pat dry with a towel.
			If you want to continue to wear necklaces you wore when you were a child, wear them layered with trendy, more modern necklaces to create a grouped look.
			If you are seeking a grand diamond effect in your ring, consider an illusion setting. Illusion settings have a small mirrored plate under your diamond. The mirror makes the diamond is mirrored when on your hand so that it appears larger and more sparkly. The only caveat is that repairs on a mirrored setting comes at repair time as it can cause some challenges.
</p><p class=\"mine\">			
			If you are presenting a gift to someone who has their own unusual style, you should consider purchasing an item that is made specifically for this person. This shows that you are both thoughtful and creative, just the kind of sentiment you want to show your special friends.
			You can earn a little cash from your gold jewelry without sacrificing the pieces. If you can do this with several chains made of real gold, you can earn a couple hundred dollars with this method.
</p><p class=\"mine\">			
			Rubies have been a popular stones for a long time for good reason. While the rubies most are familiar with have deep red color, there are a myriad shades of red from vivid deep rose pinks to nearly maroon. Rubies are very durable and can withstand exposure to most chemicals and other types of damage. Their ability to last many years make them some of the best choices for jewelry.
			Each diamond is unique with its different flaws. Some flaws may not seem that critical to you once you actually see the diamond in person.
			A jewelry set is a no-fail gift for any woman on your list. You can often find great deals when you purchase sets of jewelry. You can separate pieces of the sets up and gift a piece to your loved one every holiday season. This is a fabulous way to give something every holiday season without having to worry that someone will love.
</p><p class=\"mine\">			
			Before you buy any gemstone, determine what, and if so, treatment it received. The type of care for a stone differs greatly depending on how it was treated.
			If you wear loose rings, take them off before doing things that could dislodge them, doing laundry or taking a shower or bath.
			Always check with your jeweler about insurance policy before buying a new piece of jewelry. If you can get insurance, you can come back to the store and have it repaired or replaced. Some jewelers even offer insurance on jewelry pieces that might have been misplaced or stolen.
</p><p class=\"mine\">			
			When creating jewelry for selling at craft sales, craft sales and holiday sales, you probably do not know methods of displaying it in a beautiful fashion. When looking for materials that you can use in your jewelry, also look for items that you could display it on. You can make attractive jewelry displays out of virtually anything, like boxes, mirrors, etc.
			You could save big money with the right sale. Check for great sales online, the Internet, and in the paper for the greatest sales. If you buy the older fashions that are from the previous season, you can get it for almost 50 percent off of its original price.
			You can always add that special ring to your finger on an anniversary, or another momentous occasion.
</p><p class=\"mine\">			
			If you are selling your jewelry online, ensure that the photos you use make the piece look attractive. This is quite key since your customer can not physically see and feel the jewelry in an online transaction.
			A small but well-cut diamond with high clarity are often times more important than its size. You want the personality and preferences of the gift recipient.
			Use a polishing cloth on your jewelry clean and free from damage. This is a chemical-free method ensures your fine jewelry. Use the dual-sided cloth on your jewelry as though you would a delicate glass. Use one side for polishing and the other to polish it.
</p><p class=\"mine\">			
			Buying jewelry can be extremely cost effective. You generally can't tell the difference between brand new and used in items of jewelry, but at a fraction of the cost.
			Whether you are buying or selling or just own jewelry, it is a priceless investment. Each piece of jewelry is filled with emotion. It may be the celebration of a child's birth or the promise of a lifetime of happiness ahead, but each item will invoke a memory each time it is viewed.
</p>			";
    }
    if ($title == 'black pearl necklace') {
        return "<p class=\"mine\">
			It takes a lot of homework to buy or sell jewelery and get the best jewelry pieces. It can be puzzling to know exactly where to start.
			Never clean jewelry in a sink unless the drain is securely plugged.It is very common for people to lose expensive jewelry to fall from your hands and into the sink's drain. By placing a stop in the drain, you'll prevent your jewelry from getting sucked up in it.
			Take a good look at all the pieces that you like, then put it next to other pieces you are interested in. Be aware that jewelers use to make a diamond look bigger or better.
</p><p class=\"mine\">			
			Take the image to a specialist jewelry store.
			Wear the jewelry piece for a day so to be sure that it fits right and is comfortable. This will also help you see whether the piece is sufficiently durable.
</p><p class=\"mine\">			
			Costume jewelry is pricey and can retain its value in many cases, but an item that shows major signs of usage will be a poor investment of your time and money. A piece that is in excellent condition will be much more resourceful to you in the future.
			The color gemstones are an important part of a piece of jewelry so should be considered carefully.The gemstone you choose should work with your skin tone and make a statement about your personality.Neutral colored stones will work better to match all your closet.
</p><p class=\"mine\">			
			When looking for a choker necklace in the jewelry store, look for a necklace that is sixteen inches long. This length is the average, if it is not just right for you, measure your neck and subtract an inch from the circumference. This should give you a great fit for your choker.
			The high price of purchasing gold can interfere with your fine jewelry purchases. An 18 karat piece is comprised of no less than 75 percent of pure gold, which has been considered the best combination of price and quality.
</p><p class=\"mine\">			
			This will result in damage to both the stones and eat away their enamel.
			This is particularly important in caring for necklaces or earrings.
</p><p class=\"mine\">			
			Pay attention if they usually wear studs or hoop earrings, sizes, and colors of jewelry that the person wears. This will help you get started in your search for the perfect item of where to start when purchasing that special item.
			You need to know how to care for each piece in your jewelry. What works for one piece of precious stone may actually harm another. Ask a jeweler to make sure you know how to maintain your jewelry.
			Many have begun to start wearing yellow gold and silver jewelry pieces together. The best way to try this trend is with a single piece that uses both metals in its construction. If you do not do this, it seems unstylish or mismatched.
</p><p class=\"mine\">			
			If you are wearing a simple outfit, don't wear a gaudy outfit to match. Try wearing something simple black dress for a gorgeous and classy outfit.
			A strong clasp is essential to any form of bracelet or bracelet. If your jewelry items have unreliable clasps, you might end up losing your jewelry. You can purchase a safety clasp on any expensive jewelry pieces. Some people may even choose to put a second or three clasps on their priceless pieces of jewelry so that they stay safe during wear.
			This charge is literally a magnet for dust and dirt. Because of this, tourmaline needs to be frequently cleaned.
</p><p class=\"mine\">			
			It can be very hard to tell natural ruby or sapphire from a synthetic one. The artificial stones are nearly identical both physically and chemically to their natural counterparts, but the man-made ones are manufactured for a small percentage of the price of a natural flawless gem.
			A piece of jewelery can last you your whole life. When choosing jewelry, focus on buying a quality, ensuring that the piece you choose is of high-quality. A high-quality piece of jewelry will be well-made and show superior craftsmanship. A jeweler should know about each piece he sells, including the person that made it, where it was manufactured, such as previous owners for antique or estate pieces. It is important that your pieces are high-quality if you want it to become a long time.
			A brooch can add a little character to your belt. Pin it near your hip or your hip.
</p><p class=\"mine\">			
			Brand name should not be the primary concern when purchasing jewelry. There are excellent quality jewelry available for purchase.
			Keep your jewelry from getting tarnished to preserve its best. Try to keep your jewelry when you are around water. Water can cause some types of metal if it is exposed to it too often.If you must take your jewelry somewhere wet, coat it thinly with clear nail polish.
			Clean your copper jewelry using a lemon juice solution. Copper tends to tarnish over time and this will clean it. Some people like the patina it gets, but if you would like it to remain shiny, a little lemon juice is all it takes.
</p><p class=\"mine\">		
			Have a purpose in mind for a piece of jewelry before you purchase. There is no need to purchase a large amount of jewelry if you never wear it. Think about your most-worn wardrobe pieces when choosing a piece of jewelry.
			This article has now showed you how important it is to put effort into your research, when looking to buy or sell any jewelry. This article has provided you with important techniques to ensure your success.
</p>			";
    }
    if ($title == 'freshwater pearl necklace') {
        return "<p class=\"mine\">
			No matter who you are buying jewelry for or why you are buying it, you must know how to responsibly purchase, it is important to know the proper way to care for jewelry as well as buy and sell it responsibly. This article will teach you how to keep your jewelry and care for it effectively.
			The strength of chlorine means it can hurt the shine of your jewelry and decrease its shine. Salt water is equally damaging over time. Taking jewelry off before getting in the water will protect it and extend their life.
			Shopping for diamonds is a diamond can be an emotional experience.
</p><p class=\"mine\">			
			Some men need guidance when they should wear cufflinks.Cufflinks complement such garments if you make sure that they match well with the shirt and/or suit you're wearing.
			If you are seeking a grand diamond effect in your ring, consider going for an illusion setting. An illusion setting involves placing a mirrored plate placed on your ring prior to the diamond is set. The diamond is mirrored when on your hand so that it appears larger because it is reflecting in the mirror. The only downside to this type of setting is that they can cause some challenges.
			Brand should not be the primary concern when buying jewelry.There are excellent quality brands.
</p><p class=\"mine\">			
			If you want to continue to wear necklaces you wore when you were a child, layer it with larger, more modern necklaces to create a grouped look.
			A brooch can add a little character to your belt. Pin it near your waist or your waist's center.
			You could save huge amounts of money if you take the time to look for better prices. Check the newspaper, on the Internet, and in store windows. If you buy the older fashions that are from the previous season, you might save 50% or more off the original purchase price.
</p><p class=\"mine\">			
			Jewelry is something that can last forever. When choosing jewelry, focus on buying a quality, well-made piece. A valuable piece of jewelry will be well-made and show superior craftsmanship. Ask the jeweler about the history behind the piece and learn more about who made it, like the maker and the origin of the stones. It is essential to purchase high-quality if you want it to become a long time.
			The color gemstones are an important part of a piece of jewelry so should be considered carefully.The right stone will enhance your skin tone and suit your personality. Neutral colored stones go well with any outfit in your closet.
</p><p class=\"mine\">			
			Take the photo to a jeweler or replica specialist.
			Before committing yourself to a piece, research the latest trends. The one thing that can make picking out a fantastic piece of jewelry better is if you get it at a discount.
</p><p class=\"mine\">			
			Costume jewelry make good investments and they can be costly, but pieces that are damaged aren't worth much and aren't worth the time to restore. A piece that is in good condition will increase in the future.
			Synthetic or laboratory-made gemstones are becoming a whole new dimension to buying jewelry. These stones look almost exactly like their natural counterparts. The main difference is the cost; because these stones are not very rare, since synthetic stones are created in the laboratory rather then uncovered during the mining process.
</p><p class=\"mine\">			
			Be cautious of the way all your personal jewelry gets stored together. It is better to use boxes, compartments, boxes, and hooks for keeping pieces separate. Do not just throw them in a box. This can damage the finer and more fragile pieces, and tangle necklaces or bracelets.
			If you plan on buying a piece of jewelry which is very expensive, make sure your jewelry will last as long as you would like for it to! Although you'll almost always get high quality when the item is expensive, there are other factors to consider. A modern cut may look wonderful with your style now but clash terribly with your timeless investment pieces several years down the future. Look into buying something that will stand the test of time and trends.
</p><p class=\"mine\">			
			A diamond's cut and clarity may be more attractive than how big it is. You must think about who will be wearing the jewelry.
			While this type of cleaner is not the safest choice for silver jewelry, you can make it work when it's your only option. Apply a very small amount of toothpaste using a lint-free cloth or paper towel. Use the cloth and paste to gently rub the tarnished areas, then rinse the remaining residue off. It may not be exactly like new, but it will do until you can use a better tarnish remover.
</p><p class=\"mine\">			
			You need to take special care when you are buying costume jewelry. Many of their settings are glued rather than set. Don't immerse costume jewelry in water or clean it with abrasives. The best care is to wipe with a warm damp cloth and then dry immediately with another cloth. This will make your current costume jewelry will continue looking great.
			This gives you sell your item at the right price as you now have an honest opinion of what that is.
			Jewelry that is well-cared for is important, both for its monetary worth and its sentimental value. If you take care of your jewelry, you can have it last longer. When you educate yourself on everything there is to know about jewelry you learn what it takes to get the most from your jewelry.
</p>";
    }
    if ($title == 'pearl necklace urban') {
        return "<p class=\"mine\">
			Have you ever seen yourself in a mirror and feel like there is just something that is missing? Your clothes look fabulous, your aren't wearing odd socks, and you are sporting freshly polished shoes, but something is off. The solution is probably jewelry. Even simpler pieces of jewelry can unite your outfit.
			Onyx or crystal can make their own statement. Be kinder to your wallet and you may just like the results are gorgeous.
</p><p class=\"mine\">			
			A jewelry set is a no-fail gift for any woman on your list. You can often get a great deal of stores offer discounts when you buy an entire set. You could always break the pieces and give them as individual gifts. This is a fabulous way to give something every holiday season without having to worry that someone will love.
			Wear the jewelry around for a day or so to be sure that you can get an idea of how comfortable it is and is comfortable. This will also help you see whether the piece is sufficiently durable.
			Have a use in mind for the jewelry before you buy. You should not have a huge box of jewelery that you will never going to put on. Think about your most-worn wardrobe pieces when choosing a piece of jewelry.
</p><p class=\"mine\">			
			The high price of gold can be a hindrance to owning that piece you really desire. An 18 karat piece is comprised of no less than 75 percent of pure gold, which has been considered the best combination of price and quality.
			Before cleaning your jewelry, make sure there are no loose gemstones or breaks that will suffer from cleaning the piece. If you do discover damage, take them to a gemologist or local jeweler so that they can effectively clean them.
			When selling jewelry on the Internet, be sure to develop attractive and persuasive imagery of the pieces. This is very important because the potential buyer can not handle the item that is being sold.
</p><p class=\"mine\">			
			Every diamond varies and imperfections. Some flaws may not bother you.
			You can get that new ring on a special occasion in the future, such as an anniversary.
			Keep jewelry stored somewhere that is free from both air and humidity. Air and humidity can tarnish metals that the jewelry are made of to tarnish.Precious metals can easily be polished, but non-precious metals coated with a finish will never get back to their previous state.
</p><p class=\"mine\">			
			When shopping for sterling silver jewelry, you need both a discerning eye and a small magnet. You are able to detect fake pieces of sterling jewelry with a magnet, since non-precious metals are drawn to magnets. You will always find a hallmark stamp such as \".925\" or \"STER.\" on genuine sterling, or alternately,\" \"ster, \"STERLING\". If you don't see a stamp of any sort on a piece, it may not be sterling silver.
			This rule applies to dry saunas that are steam ones. The moisture and high temperatures in saunas can cause your jewelry.
</p><p class=\"mine\">			
			You should sometimes put lemon juice to clean your copper jewelry. Copper will develop a tarnish over time. Some people like the patina, but if you would like it to remain shiny, lemon juice will easily accomplish that.
			When looking for a choker necklace in the jewelry store, the standard length is sixteen inches. This size fits most people, but for a more specific number you can measure your neck and subtract up to one inch. This will leave you a perfect fit.
</p><p class=\"mine\">			
			You need to know how to best care for your jewelry. What can be beneficial to one material could damage another. Ask a jeweler to make sure you do not know how to take care of your items.
			Always stay within your budget when you are buying jewelry. A young couple may want to choose a less expensive ring at first. You can always add to the ring when finances are a nice ring guard as an anniversary present.
</p><p class=\"mine\">			
			Shopping for that special diamond is an emotionally charged experience.
			When you make jewelry to sell at flea markets, craft sales and holiday sales, you probably do not know methods of displaying it in a beautiful fashion. When you are shopping for materials to make your jewelry, also be on the lookout for creative display materials. All types of things, baskets, cigar boxes and racks can turn into incredible jewelry display cases by adding some creativity.
</p><p class=\"mine\">			
			Keep your fashion and costume jewelry away from steam cleaners or powerful chemicals.
			It is hard to tell a natural stone. These beautiful stones are chemically and physically identical, but synthetic stones are available at a much lower cost than naturally flawless stones.
</p><p class=\"mine\">			
			This is extra important with necklaces and earrings.
			Many have begun to start wearing yellow gold and silver jewelry pieces together. The easiest way to approach this trend is with jewelry that contains both metals in its construction. If you do not do this, you'll have a mismatched appearance.
</p><p class=\"mine\">
			Always check with your jeweler about insurance policy before buying a new piece of jewelry. If you can get insurance, you can return it to the source and have it repaired. Some stores even offer insurance for jewelry against loss or stolen.
			As you can see, jewelry can complement your look and add pizzazz to any outfit. There are many different styles of jewelry to make you look classy, professional or fun. Then, next time when you're deciding what to wear, remember to add some jewelry to your outfit.
</p>";
    }
    if ($title == 'black pearl earrings') {
        return "<p class=\"mine\">
			Even just a modest gift of jewelry will always be remembered and loved. Read this article to consolidate your own or a gift to someone else.
			Surprise the ones you love with a thoughtful piece of jewelry.Every lady loves to get a piece of jewelry. You can see someone's face light up with joy when she opens her box.
</p><p class=\"mine\">			
			Know the distinctions between kinds of stone you are buying with your jewelry.Gems are divided into three main categories: imitation, imitation or synthetic.Natural and synthetic are both real, while an imitation gemstone is just a plastic mold made to look like a gemstone. Natural stones are dug up out of the ground and synthetic ones are created in a lab.
			Use a polishing cloth to keep your jewelry as often as you want. This will allow your jewelry to shine without chemicals and solvents. Use this two-sided cloth on your jewelry just as you would clean a glass. Use one side to shine it and the other for improving its shine.
</p><p class=\"mine\">			
			Attach this hardware to the inside of your closet door or on your bedroom wall, and drape necklaces across them in compatible groups.This little display looks appealing and help you select the best necklace for your outfit.
			If your rings are loose, it is best if you remove them before washing dishes, like dishes or taking a bath.
</p><p class=\"mine\">			
			Don't fall for fancy names in jewelry. While you've heard of these famous jewelers, this does not necessarily imply that their jewelry is of a finer quality than other less known brands. Browse through a catalog or website of a designer jeweler and identify the styles you prefer, then compare it to more affordable pieces until you find a match.
			Rubies have always been known to be a very popular gemstone. While true rubies are always red, rubies also come in a variety of shades ranging from deep rose to almost maroon. Rubies are very durable and can withstand considerable wear and tear. Their ability to last many years make them an excellent choice for jewelry.
			Keep your jewelry from getting tarnished to preserve its best as you can. Try not to wear jewelry away from water.Water can cause some types of metal if it is exposed to it too often.If you want to give your jewelry a measure of protection from this element, prepare it by adding some clear nail polish on the surface.
</p><p class=\"mine\">			
			If you wear a diamonds on a day to day basis, have them cleaned at least two times every year, preferably every six months, even when they are new. The gemologist will clean your diamond and check it closely for damage.
			Alexandrite is a beautiful and unique stone that is often overlooked for jewelry. Depending upon the lighting levels, an Alexandrite stone will change colors from green to purple. It is common in many types of jewelry, rings and bracelets.
			This will result in damage to both the stones and eat away their enamel.
</p><p class=\"mine\">			
			This electrical charge will attract dust and dirt. This causes the tourmaline to get dirtier easier than other stones, so frequent cleaning is needed.
			Untangle knotted messes of delicate chains and necklaces. It's easy to give up on some knotted metal mass; however, but try using some plastic wrap before you call it quits. Put the necklace on the plastic wrap and cover it with a little mineral oil or baby oil. Use small needles to untangle the knot.Wash with dish soap and then pat dry.
</p><p class=\"mine\">			
			Buying jewelry can be extremely cost effective. You generally can't tell the difference between brand new and used in items of jewelry, but at a fraction of the cost.
			Take a very close look at the piece you like, examining them and comparing them to each other. Be aware that some dealers will use cheap tactics to make a diamond look bigger or better.
</p><p class=\"mine\">			
			If you are wearing a simple outfit, don't wear a gaudy outfit to match. Try wearing a simple or solid color to bring attention to jewelery.
			A strong clasp is important for any form of bracelet or bracelet. If your jewelry items have unreliable clasps, you may lose them. You should add a safety clasp to secure expensive jewelry pieces. Some opt for two or third clasp on their priceless pieces of jewelry so that they stay safe while wearing them.
			Never clean jewelry in a sink unless the drain first. It's easy to lose that precious piece as it slips from your soapy hands. If you cover your drain, put a plug in it!
</p><p class=\"mine\">			
			Before purchasing a gemstone, find out if it has been treated, and if so, treatment it received. The kind of care your stone differs greatly depending on how it was treated with.
			If your \"giftee\" is a unique person, look for an item of jewelry that is in line with their clothing and lifestyle choices. This shows that you are both thoughtful and creative, just the kind of sentiment you want to show your special friends.
</p><p class=\"mine\">
			The chlorine in pool water will corrode your jewelry and remove its life. Salt water can be equally damaging over time too.Taking these off before you swim will protect their beauty and keep it looking beautiful for years to come.
			Jewelry is an indicated gift in a lot of occasions. Even a small piece of jewelery can mean so much! There are also many things to remember about keeping your own jewelry in good shape. Use these suggestions to find better pleasures in jewelery.	
</p>";
    }
    if ($title == 'pearl stud earrings') {
        return "<p class=\"mine\">
			While it can be fun to shop for jewelry, it can be difficult if you are not sure how to choose expensive pieces. An uneducated customer might end up paying too much. This article will show you make a wise jewelry purchases wisely.
			You can actually earn money off of your gold bracelets and necklaces without sacrificing the pieces. With real gold and several chains, you can pull in hundreds by just clipping off parts that no one notices anyway.
</p><p class=\"mine\">			
			Pay attention to the types, sizes, and any other typical jewelry that they wear. This will give you a good idea of jewelry for your loved one.
			To protect your rings from going down the drain, take yours off before doing dishes or showering.
</p><p class=\"mine\">			
			Clean your copper jewelry regularly using a lemon juice. Copper tends to tarnish over time and this will clean it. Some people like the patina, but if you prefer your copper jewelry to have a shine or look new, use lemon juice or vinegar to clear the patina and make your jewelry look new.
			This will result in damage to both the stones and eat away their enamel.
</p><p class=\"mine\">			
			If you're shopping for a choker, choosing one that is 16 inches long is best. This size fits most people, but if you want a more specific length you can take the measurement of your neck and subtract an inch. This will leave you a great fit for your choker.
			Shopping for diamonds is a diamond is an emotionally charged experience.
			Rubies have always been known to be a very popular gemstone. While the rubies most are familiar with have deep red color, there are a myriad shades of red from vivid deep rose pinks to nearly maroon. Rubies are very durable and can withstand considerable wear and other types of damage. Their beauty and strength make them a wonderful choice for jewelry.
</p><p class=\"mine\">			
			This tip especially applies to necklaces or earrings.
			Onyx and crystal jewelry looks beautiful and can make their own statement. You may find some other type of stone that saving money and finding great jewelry go hand in hand.
</p><p class=\"mine\">			
			When you go shopping for sterling silver jewelry pieces, it is a good idea to bring a small magnet along with you. If an item of jewelry is attracted by a magnet, it will be attracted to the magnet.You will always find a hallmark stamp such as \".925\" or \"STER.\" on genuine sterling, or alternately, \"ster,\" or \".925.\" If you cannot find a stamp, then be wary of whether it is actually silver or not.
			Untangle your knotted messes of delicate loops. It's easy to get frustrated when trying to get the knots out of a badly tangled necklace, you should instead use plastic wrap. Put the necklace on the plastic wrap and add a little baby oil.Use a straight pin to untangle the necklace. Wash it gently with a bit of dish soap and pat it dry.
			Know which kind of gems before you are buying with your jewelry. The three different types of stones are natural, imitation and natural. Synthetic stones are lab created jewels, while the imitation ones are plastic that is colored. Natural stones are dug up out of the ground and synthetic gems are grown in a lab.
</p><p class=\"mine\">			
			Don't fall for fancy names in jewelry. While these retailers boast name recognition, this does not necessarily imply that their jewelry is of a finer quality than other less known brands. Browse through a catalog or website of a designer jeweler and identify the styles you prefer, then compare it to more affordable pieces until you find a match.
			If you create jewelry to sell, holiday markets and such, you may have trouble coming up with ways to properly display it. When you are out looking for materials to create your jewelry, don't forget about creative displays. All types of things, baskets, cigar-boxes and even oddball things like wig stands can be transformed into jewelry display cases with just a little creativity!
</p><p class=\"mine\">			
			Bring the picture to a jeweler.
			Never clean jewelry in a sink unless the drain is securely plugged.It is all too easy for people to lose expensive jewelry to fall from your hands and into the sink's drain. By plugging up the drain in advance, you'll prevent your jewelry from getting sucked up in it.
</p><p class=\"mine\">			
			Buying jewelry sets is worth considering when you want to give that special someone a gift. You can often find some really great deals when you purchase sets of jewelry. You could always break the set and gift a piece to your loved one every holiday season. This is a fabulous way to always have a gift that someone will forget.
			Always be mindful of your budget when purchasing jewelry. A young couple just starting out may need to buy a less expensive ring at first. You can always add to the ring when you are better or add a nice ring guard as an anniversary present.
</p><p class=\"mine\">	
			You can always purchase the ring for a future occasion, like an anniversary.
			The increasing cost of purchasing gold can interfere with your fine jewelry purchases. An 18 karat gold piece is made up of at least 75 percent pure gold, which is generally considered by many to be the most optimal combination of quality and price.
			Whatever type of jewelry you are planning to buy, be sure to research it properly. You will now know the key to success having read this article. You will be able to use these tips to save a good amount of time as well as money.
</p>";
    }
    if ($title == 'opal jewelry') {
        return "<p class=\"mine\">
			Here are some suggestions on how to pick the right jewel for any type of woman.
</p><p class=\"mine\">			
			Chlorine can damage the life and luster of your valuable pieces because it's such a strong chemical. Salt water is equally damaging over time. Taking these off before you swim will protect your jewelry and keep it looking beautiful for years to come.
			Have a use in mind for every piece of jewelry you purchase. You don't need a lot of jewelery that you are never going to put on. Think about the outfits you can wear the jewelry with when you are choosing jewelry.
</p><p class=\"mine\">			
			Wear the jewelry around for a day so to be sure that you can get an idea of how comfortable it is and is comfortable. This also let you to see its durability.
			Consider stones when you buy jewelry. The gemstone you choose should work with your skin tone and make a statement about your personality.Neutral colored stones will work better to match all your clothing.
</p><p class=\"mine\">			
			A clasp is essential to any necklace or bracelet. Without something that is solid, your pendant, pendants and costly stones could be lost. You can have a safety clasp to keep costly necklaces and bracelets from falling off and becoming lost.Some opt for two or three clasps on their priceless pieces to keep them safe while wearing them.
			Some men do not be sure when they should wear cufflinks. Cufflinks provide a striking finish to an elegant look; wear cufflinks in a similar style to the shirt and suit.
</p><p class=\"mine\">			
			Don't use steam cleaners or any kind of harsh chemicals on costume or fashion jewelry.
			Be careful when storing all your jewelry storage. It is better to use boxes, compartments, boxes, and hooks for keeping pieces separate. Do not just throw them in a pile. Not only can this harm the fine and fragile pieces, you risk harming any fragile pieces as they bump and scrape against each other as you search the box.
			A lot of people enjoy wearing yellow gold and silver jewelery at the same time.The easiest way to try this trend is with a single piece that uses both metals. If you do not do this, your look will appear uncoordinated.
</p><p class=\"mine\">			
			Before buying a new item of jewelry, learn the latest styles that are trending. The one thing that makes a fantastic piece of jewelry better is if you get it at a discount.
			When investing in a costly item from the jewelry department, you should remind yourself that this is an investment that you will want to wear for many years. You should be getting a quality item because of the price, but think about styles too. A modern cut may look wonderful with your style now but lose its appeal in the future. Look into buying something that will stand the test of style.
			Keep jewelry stored somewhere that is free from humidity or air.Air and humidity can tarnish metals of to tarnish. Precious metal jewelry can be polished to fix tarnish, but non-precious metal needs a special polish.
</p><p class=\"mine\">			
			The gemstones charge that this heat generates can cause dirt and dust to collect on it. This makes the tourmaline get dirty more easily than other gemstones, so it needs to be cleaned frequently.
			Take a look at the diamonds up close, and then hold everything else you consider to that standard. Be careful of tricks that some dealers will use cheap tactics to make a diamond look better than it is.
			Costume jewelry make good investments and they can be costly, but also a costly one; keep in mind the pieces you wish to add to your collection don't show too much wear. A piece that is in excellent condition will be much more resourceful to you in value.
</p><p class=\"mine\">			
			Every single diamond is unique and has its own set of flaws. Some flaws may not bother you.
			You can make some extra cash from your solid gold jewelry without sacrificing the pieces.With real gold necklaces and bracelets, you could shorten the pieces to get hundreds of dollars.
			This gives you sell your item at the right price against which you now have an honest opinion of what that is.
</p><p class=\"mine\">			
			You should carefully consider how to care for your jewelry collection. A treatment that is effective for one type of stone may scratch another stone. Ask a jeweler when you know how to take care of your jewelry.
			Before beginning to clean any of your jewelry pieces, make sure to check for any loose gemstones or breaks that could get worse. If you find any, take the piece or pieces to a gemologist or a local jeweler and they can clean it for you.
			It can be very hard to tell a natural rubies and sapphires from artificial ones. The artificial stones are nearly identical both physically and chemically to their natural counterparts, but cost just a fraction.
</p><p class=\"mine\">
			If you wear a diamonds on a day to day basis, the pieces should cleaned by a professional on a biannual basis, try doing this every six months, starting from the date you purchased or received the items. The gemologist will clean and make the item shine as though it were new.
			You have plenty of options when it comes to buying, giving, selling, and caring for jewelry. You need not let the wealth of different opportunities overwhelm you! If you follow the guidelines from this article, you will be better prepared to select a thoughtful and lovely gift for anyone in your life.
</p>";
    }
    if ($title == 'amethyst jewelry') {
        return "<p class=\"mine\">
			It can be hard to gather jewelry information that is meaningful and advice on jewelry. There is a plethora of information currently available which can confuse you.The good news is that some of the best tips you can get are here; read them right here.
			If you're going to wear gaudy jewelry, wear bigger jewelery.Try wearing something simple black dress for a gorgeous and classy outfit.
</p><p class=\"mine\">
			Show your sweetheart how much you love her by surprising them with jewelry. Every woman loves to get a piece of jewelery from the one they love. You are sure to cherish that moment of surprise and happiness as you hand them a gift.
			Synthetic or man-made gemstones are a popular alternative to natural gemstones. These man-made stones are nearly indistinguishable from natural stone counterparts. The main difference is the cost; because these stones are not very rare, since synthetic stones are created in the laboratory rather then uncovered during the mining process.
			While it is not the first choice for cleaning silver jewelry, you can make it work when it's your only option. Apply a very small dab of toothpaste using a microfiber cloth. Rub the toothpaste on the jewelry for a bit, and then rinse or wipe off with water. The result won't be perfect, but it will no longer look tarnished either.
</p><p class=\"mine\">			
			Before you buy a gemstone, ask the jeweler if and how the gemstone was treated. The way to care your stone differs greatly depending on how it was treated.
			If you are buying jewelry for someone who values her individuality, consider choosing a one-of-a-kind piece crafted specifically for them. A unique piece like this that matches their personality appears creative and thoughtful, which is exactly what you want to express to a person you care enough about to buy jewelry for.
			A brooch can add a little character to your belt. Pin it near your waist or your hip.
</p><p class=\"mine\">			
			If you want to continue to wear necklaces you wore when you were a child, layer it with larger, more modern necklaces to create a grouped look.
			Keep your jewelry pieces looking beautiful by protecting them from getting tarnished in order to keep it looking it's best. Try to keep your jewelry when you are around water. Water can dull and rust some metals to lose their luster or to become tarnished or rusty. If you want to give your jewelry a measure of protection from this element, prepare it by adding some clear nail polish on the surface.
</p><p class=\"mine\">			
			Pay attention to the types, sizes, and any other typical jewelry that they wear. This will give you a good idea of where to start when picking out that special item.
			Brand should not be the primary concern when buying jewelry.It is not difficult to find quality pieces from a variety of brands.
</p><p class=\"mine\">			
			Jewelry is an investment that should last a life-time. When you look for a piece of jewelry, you should always buy from a reputable store or dealer, well-made piece. High-quality jewelry is durable and good manufacture. The jeweler should be able to give you a history on the piece, including who made it and the source of the stones. It is essential to purchase high-quality jewelry if you want it to become a long time.
			You need to take special attention when caring for costume jewelery! Many costume jewelry are only secured with glue rather than set into the piece. Don't immerse costume jewelry in water or clean it with abrasives. The best care is to wipe with a warm damp cloth and dry immediately with another cloth. This will make your current costume jewelry to continue looking great.
</p><p class=\"mine\">			
			Purchasing pre-owned or second-hand jewelry can save you a great deal of money.You generally can't tell the difference between brand new and used in items of jewelry, but at a fraction of the cost.
			Always ask the jeweler about an insurance policy options before buying a new piece of jewelry. If your jewelry gets damaged or broken, you can take it back and see if they will fix it!Some stores even insure jewelry that might have been stolen or lost.
</p><p class=\"mine\">			
			Use a polishing cloth to keep your jewelry as often as you want. This is a natural way to achieve shine without relying on abrasives or other harsh chemicals. Use the two-sided cloth on your jewelry as if you were cleaning glass. Use one side for polishing and the other to polish it.
			You could save big money if you take the right sale. Check ads in the newspaper, online, and in store windows. If you wait to buy jewelry until that particular style is going out of fashion, you can save up to 50%.
</p><p class=\"mine\">			
			This rule applies to dry and steam ones. The moisture and high temperatures in saunas can damage to your jewelry.
			If you are trying to sell jewelry online, you should present these pieces as attractively as possible. This is extra important to remember because the potential buyer can not handle the item that is being sold.
</p><p class=\"mine\">	
			A diamond's cut and clarity are often times more important than a bigger diamond of lower quality. You must think of the person who is going to receive this ring.
			Stay educated so that you can put forth your best effort when wearing, caring for or purchasing jewelry. Now you can spend much more time doing things instead of searching for information, all thanks to these tips. Remember the tips that you have read today, and you will only find success in your jewelry endeavors.
</p>";
    }
    if ($title == 'ruby jewelry') {
        return "<p class=\"mine\">
			Jewelry has been a part of this world for an extremely long time and there are a lot of designs to choose from. The tips below are a great starting point to help you out jewelry that you are sure to love.
			Attach this hardware to the inside of your closet door or on your bedroom wall, and drape necklaces across them in compatible groups.This can make your bedroom look more stylish and keeps chains from tangling at the best necklace for your outfit.
</p><p class=\"mine\">
			If you are seeking a grand diamond effect in your ring, consider purchasing an illusion setting. An illusion setting is created by using a mirrored plate on your ring prior to the diamond is set. The mirror makes the diamond will look much bigger and magnifies the amount of light it reflects. The only problem with this setting is that repairs can cause some challenges.
			A beautiful stone that people do not often think of is Alexandrite. Depending upon the lighting levels, an Alexandrite stone will change colors from green to purple. It looks stunning in necklaces, like rings or earrings.
</p><p class=\"mine\">			
			Avoid steam saunas and dry saunas. The amount of moisture and heat can damage the jewelry.
			Always ask the jeweler about insurance policy before buying a new piece of jewelry. If your jewelry gets damaged or broken, you know that you will be covered if something happens to your jewelry. Some stores even insure jewelry that might have been stolen or lost.
</p><p class=\"mine\">			
			A brooch will add visual interest and an accent to an otherwise dull belt.Pin it near your waist or your hip.
			If you wear any of your diamond jewelry nearly every day, you may want to consider getting the jewelery professionally cleaned about every six months. The gemologist will clean your item and inspect it for damage.
			When selling jewelry on the Internet, you should try to show it off in an attractive way. This is very important to remember because the jewelry when purchasing it online.
</p><p class=\"mine\">			
			Onyx or crystal can be wonderful jewelry options. You don't have to waste money and finding great results.
			Surprise the ones you love with a thoughtful piece of jewelry.Every lady loves receiving an unexpected gift of jewelry. You can see someone's face light up and her eyes open wide in surprise as you hand them a gift.
</p><p class=\"mine\">			
			The stone is an important consideration when shopping for new jewelry. The right stone will enhance your skin tone and suit your personality. Neutral colors work well with any outfit in your closet.
			Take a very close look at the piece you like, examining them and comparing them to each other. Be careful of tricks that jewelers use cheap tactics to make a diamond look bigger or better.
			Keep your jewelry stored safely and away from humidity or air. Certain metals will be tarnished when exposed to humidity. Precious metal jewelry can be polished to fix tarnish, but non-precious metal needs a special polish.
</p><p class=\"mine\">			
			While it is not the first choice for cleaning silver jewelry, toothpaste will get the job done in a pinch. Apply a small amount of toothpaste onto a microfiber cloth. Rub the toothpaste on the jewelry for a bit, and then rinse or wipe off with water. It may not be exactly like new, but it will have less tarnish.
			If you have a piece of jewelry you like from your childhood, layer them with more mature pieces.
</p><p class=\"mine\">			
			A lot of people wear gold and silver jewelry at the same time. The best way to try this is with a single piece that contains both metals. If you do not, your look will appear uncoordinated.
			Before you buy any gemstone, determine what, and if so, treatment it received. The kind of care your stone needs is dependent on what it was treated.
			You need to take special care when caring for costume jewelery! A fair amount of the stones in costume jewelery are glued in and not set in. Don't submerge costume jewelry in water or use chemicals on it. The best way to clean these pieces are to wipe with a warm damp cloth and then dry with another cloth. This will help your costume jewelry looks perfect.
</p><p class=\"mine\">			
			Brand should not be the primary concern when buying jewelry.There are thousands of quality jewelry pieces from various brands.
			It is very hard to tell a natural sapphires and rubies from a synthetic one. The artificial stones are nearly identical both physically and chemically to their natural counterparts, but cost just a fraction.
</p><p class=\"mine\">			
			This can dull your stones and the metal of the piece.
			A diamond's cut and clarity are often times more important than a bigger diamond of lower quality. You must think about who will be wearing the jewelry.
			Pay attention to the types, sizes, and any other typical jewelry that they wear. This is a good idea of where to start when picking out that special item.
</p><p class=\"mine\">
			Some men might not be sure when considering cufflinks. Cufflinks complement such garments if you make sure that they match well with the shirt and/or suit you're wearing.
			Untangle knotted necklaces with delicate chains and necklaces. It's easy to get frustrated with tangled necklaces, but try using some plastic wrap before you call it quits. Put the necklace on the plastic wrap and add a little baby oil.Use a sewing needle to untangle the necklaces. Wash with dishwashing liquid then pat it dry.
			The preceding jewelry tips will help when you are looking for pieces that are just right for you. Getting the facts on jewelry can help you narrow down the millions of choices.
</p>";
    }
    if ($title == 'silver charm bracelet') {
        return "<p class=\"mine\">
			Whether you inherited some jewelry, bought a piece for yourself or received one as a gift, the world of jewelry can be a little confusing.Where can you find quality information about jewelry in relation to artistic tradition?This article is going to outline a few pieces of advice that will help you on your quest to be a better educated consumer.
			You can save a lot of money if you are savvy. Check online, the Internet, and signs in store windows to find the best sales. If you buy fashion items at the end of their season, you might save 50% or more off the original purchase price.
</p><p class=\"mine\">			
			When shopping for a choker at the jewelry store, you should ideally select a 16-inch choker. This is the usually accepted amount, but if you want a more specific length you can take the measurement of your neck and subtract an inch. This should give you a great fit for your choker.
			Have a purpose in mind for the jewelry before you purchase. You do not have a huge box of jewelery that you will never going to put on. Think about your most-worn wardrobe pieces when choosing a piece of jewelry.
			When you make jewelry to sell at flea markets, craft sales and holiday sales, you probably do not know methods of displaying it in a beautiful fashion. When you are shopping for materials to make your jewelry, don't forget about creative displays. You can make attractive jewelry displays out of virtually anything, like boxes, mirrors, etc.
</p><p class=\"mine\">			
			This electric charge is literally a dust and dirt. This accelerates the rate at which the tourmaline gets dirty, so it needs to be cleaned frequently.
			Know which kind of stone you make a jewelry purchase. The three different types of stones are natural, synthetic and natural. Imitation is plastic that is colored to looked like the stone, while synthetic and natural are real. Natural stones are dug up out of the ground and synthetic gems are created in a lab.
			You could also make a plan to receive an upgraded diamond ring on your wedding anniversary, maybe for a special occasion.
</p><p class=\"mine\">			
			Use a polishing cloth on your jewelry clean and free from damage. This is a fairly simple way to shine without relying on abrasives or other harsh chemicals. Use the two-sided cloth on your jewelry as if you would a delicate glass. Use one side to shine it and the other for improving its shine.
			If you are wearing a simple outfit, don't wear a gaudy outfit to match. Try wearing something simple black dress for a gorgeous and classy outfit.
</p><p class=\"mine\">			
			If you are wearing expensive, make sure you take them off before swimming, you should take them off before doing laundry, washing dishes or taking a bath.
			Be cautious of the way all of your pieces of jewelry together. It is better to use boxes, compartments, boxes, and hooks for keeping pieces separate. Resist the urge to jumble all your pieces into a community box. This can harm fragile and fine pieces, and make it difficult to find the necklace you want because it's tangled with other pieces.
</p><p class=\"mine\">			
			Keep your fashion and costume jewelry away from steam cleaners or powerful chemicals.
			You need to know how to care for all of your jewelry. What works well with one type of stone may not work for another. Ask a jeweler when you know how to take care of your jewelry.
</p><p class=\"mine\">			
			When shopping for expensive jewelry, purchase an item that will stay with you for a lifetime. You usually get good quality when you buy something expensive, but make sure you select something that will not go out of style. Something that is trendy now might not look so stylish in a couple of years. Try and find classic items that is timeless.
			This will help you a baseline price against which you now have an honest opinion of what that is.
			Costume jewelry can be very expensive and a great investment, but also a costly one; keep in mind the pieces you wish to add to your collection don't show too much wear. A piece in excellent condition will be much more resourceful to you in the future.
</p><p class=\"mine\">			
			Purchasing pre-owned jewelry can save you a lot of money. You can often find pre-owned jewelry in fantastic like-new condition, plus the cost is normally a lot better for used so your dollar will go a lot further.
			Synthetic lab-created stones are now available as an attractive choice when shopping for gemstones. These stones are pretty much identical in appearance to natural ones. The primary difference is cost, their cost is considerably lower than the naturally mined stones.
</p><p class=\"mine\">
			If you are getting jewelry for someone you consider to be one-of-a-kind, try finding a special piece that is crafted specifically for them. A unique piece like this that matches their personality appears creative and thoughtful, which is exactly what you want to express to a person you care enough about to buy jewelry for.
			There are a lot of different aspects to jewelry and jewelry appraisal. If you research jewelry items carefully, you can be certain that the pieces you purchase are high-quality. The more you learn about jewelry, the more you'll see what an awe-inspiring and dazzling world it can be. The tips that you've just been given will help you find your way through this vast and wonderful world.
</p>";
    }
    if ($title == 'leather bracelets for women') {
        return "<p class=\"mine\">
			Here are some suggestions on how to pick out the perfect piece of jewelry for your woman.
</p><p class=\"mine\">			
			A lot of people wear gold and silver jewelry at the same time. The best way to approach this trend is with a single piece that contains both metals. If you do not do this, this could look outdated or mismatched.
			A jewelry set is a no-fail gift for any woman on your list. You can often get a great deal of stores offer discounts when you buy sets of jewelry. You can even divide up the pieces and give them to multiple recipients or on multiple occasions. This is a fabulous way to give something every holiday season without having to worry that someone will love.
</p><p class=\"mine\">			
			The increasing cost of purchasing gold can interfere with your fine jewelry purchases. An 18 karat gold piece is made up of at least 75 percent pure gold, which is generally considered by many to be the most optimal combination of quality and price.
			If you create jewelry to sell, holiday markets and such, you may have trouble coming up with ways to properly display it. When you are out looking for materials to create your jewelry, you should remember to consider displays that are creative. You can make attractive jewelry displays out of virtually anything, like boxes, mirrors, etc.
</p><p class=\"mine\">			
			This will result in damage to both the stones and eat away their enamel.
			If you wear a diamonds on a day to day basis, have them cleaned at least two times every year, preferably every six months, even when they are new. The gemologist will clean your diamond and make the item shine as though it were new.
</p><p class=\"mine\">			
			You will need to take special attention when you are buying costume jewelry. Many of the stones and embellishments are glued instead of set in a professional setting. You want to avoid immersing your jewelry and make sure to stay away from the use of harsh chemicals. The best way to clean these pieces are to wipe them clean with a damp cloth and then dry with another cloth. This will keep costume jewelry looking great.
			This electric charge is literally a dust and dirt magnet. This causes the tourmaline to get dirtier easier than other stones, so frequent cleaning is needed.
			Clean your copper jewelry using a lemon juice. Copper will develop a tarnish over time. Some people like the patina it gets, but if you would like it to remain shiny, lemon juice and vinegar quickly remove tarnish.
</p><p class=\"mine\">			
			You can earn a little cash from your gold necklaces and bracelet without sacrificing the pieces. If you can do this with several chains made of real gold, you can make a few hundred dollars by just shortening the pieces.
			When shopping for sterling silver jewelry, you need both a discerning eye and a small magnet. You are able to detect fake pieces of sterling jewelry with a magnet, since non-precious metals are drawn to magnets. You can identify sterling silver by its markings, or alternately,\" \"ster, \"STERLING\". If a particular piece is not stamped, be leery of its authenticity because oftentimes it is a sign of a fake.
</p><p class=\"mine\">			
			Take your favorite jeweler or a jewelry store.
			Buying jewelry can be extremely cost effective. You generally can't tell the difference between brand new and used in items of jewelry, but at a fraction of the cost.
</p><p class=\"mine\">			
			Be cautious of the way all of your pieces of jewelry together. It is best to use holders, compartments, boxes, and hooks for keeping pieces separate. Do not just throw them into piles in a pile. This can damage fragile, and tangle some pieces with others, like necklaces.
			You can get that new ring on a special occasion in the future, maybe for a special occasion.
			Before adding a piece of jewelry to your collection, do research to determine which styles are hot and which are not. The only thing that beats getting a fantastic piece of jewelry better is if you get it at a discount.
</p><p class=\"mine\">			
			This pertains to saunas as well as steam ones. The high levels of moisture and heat can damage the pieces.
			If you're going to wear gaudy jewelry, wear bigger jewelery.Try wearing something simple black dress for a gorgeous and classy outfit.
</p><p class=\"mine\">			
			Synthetic or man-made gemstones are becoming a budget-friendly alternative. These stones look a lot like their natural ones. The main difference is the cost; because these stones are not very rare, since synthetic stones are created in the laboratory rather then uncovered during the mining process.
			Pay attention to the types, white gold or yellow, and any other typical jewelry that they wear. These types of observations will provide a reasonable starting point to purchase an item they'll cherish.
			Have a purpose in mind for every piece of jewelry you buy. You do not have a lot of jewelry you will never going to put on. Think about your most-worn wardrobe pieces when you are choosing jewelry.
</p><p class=\"mine\">			
			Chlorine is a very strong and harsh chemical that can damage your precious pieces. Salt water is equally damaging over time. Taking these off before swimming will protect their beauty and extend the life of the jewelry.
			Don't fall for the hype of fancy designer jewelry with someone's name on it. While well known brands of jewelers are more widely known, is the quality really superior?Browse through all the designer jewelry until you find something you like, then look at some non-designer choices to see if you can find some similar styles that you like just as well for less.
</p><p class=\"mine\">		
			Always check with your jeweler about insurance policy before buying a new piece of jewelry. If you can get insurance, you can return it to the source and have it repaired. Some jewelers even offer insurance for jewelry pieces that have been stolen or lost.
			As mentioned above, jewelry is a wonderful gift for a special woman, even when you're at a loss of what to get her. These tips can help you find the right jewelery that will complement the special lady in your life.
</p>";
    }
    if ($title == 'leather wrap bracelet') {
        return "<p class=\"mine\">
			It is necessary to have a deep understanding of jewelry in order to buy or sell. This can make you confused about where you should start.
			Keep your jewelery in a space that is free from humidity or air. Air and humidity can cause the metals that the jewelry are made of all types. Precious metals can easily be polished, but non-precious metals coated with a finish will never get back to their previous state.
</p><p class=\"mine\">			
			A diamond's cut and clarity may be more important than how big it is. You must also consider the diamond to really suit the person that's going to wear it.
			Before beginning to clean any of your jewelry pieces, look it over to be sure that there aren't any loose stones or breaks that could worsen or come out if you continue the cleaning process. If this is the case, take the item(s) to your local jeweler or gemologist and let them clean your item.
</p><p class=\"mine\">	
			Every diamond is unique in both its beauty and has individual flaws.Some flaws are less noticeable than others and may not seem that critical to you when you see the diamond in person.
			When buying an expensive jewelry piece, choose wisely and select something you will use for years to come. Although more expensive jewelry is normally high quality, don't forget to consider the style as well. Something that is trendy at this time may not look so great several years from now. Look for something classic and trends.
</p><p class=\"mine\">			
			You could save big money if you take the time to look for better prices. Check online, on the Internet, and in stores for the best deals. If you buy fashion items at the end of their season, you can get it for almost 50 percent off of its original price.
			Crystal or onyx stones both stand out well and make bold statements. You don't need to completely empty your money and still get a beautiful piece to be pleased with the results.
</p><p class=\"mine\">			
			Jewelry is an investment that should last for years to come. When choosing jewelry, you should always buy from a reputable store or dealer, ensuring that the piece you choose is of high-quality. High-quality jewelry can be told by its superior craftsmanship and displays excellent craftsmanship.Ask the jeweler what the origin of the piece is, as well as the origin of the materials. It is essential to purchase high-quality if you want it to become a treasured heirloom passed down for generations.
			Diamond shopping is an emotional endeavor.
</p><p class=\"mine\">			
			Show your significant other how much you are in love her by surprising them with a beautiful piece of jewelry. Every woman loves to get a piece of jewelery from the one they love. You can see someone's face light up with joy when you give her such a gift.
			Know the distinctions between kinds of stone you make a jewelry purchase. There are three unique types of stones: imitation, synthetic and imitation. Natural gems and synthetic gems are real gemstones, but imitation is just plastic colored to look like the real thing. Natural stones are found underground and synthetic gems are grown in a lab.
			If you are wearing expensive, loose rings, you should take them off before doing laundry, or taking a bath.
</p><p class=\"mine\">			
			This is particularly important with necklaces and earrings more than anything else.
			Brand name should not be the only consideration when purchasing jewelry. There are excellent quality brands of jewelry available for purchase.
			Always remain in the strict range of your budget when you are buying jewelry.A young couple just starting out may need to buy a cheaper ring and upgrade later. You can always add to the ring when finances are better or add a bit more financially sound.
</p><p class=\"mine\">			
			It can be very hard to tell natural ruby or sapphire from a synthetic one. The fake ones look identical to real ones, and they are incredibly inexpensive comparatively.
			This will help you a baseline price against which you now have an honest opinion of what that is.
			One underrated but beautiful gemstones out there is also one of the most underused: Alexandrite. Depending upon the lighting levels, an Alexandrite stone will change colors from green to purple. It can be made into rings, earrings, or earrings.
</p><p class=\"mine\">			
			Costume jewelry make good investments and they can be costly, but also a costly one; keep in mind the pieces you wish to add to your collection don't show too much wear. A piece that is in good condition will be much more resourceful to you in value.
			Rubies have long been one of the most popular stone for a long time for good reason. While it's true that rubies are red, there are a myriad shades of red from vivid deep rose pinks to nearly maroon. Rubies are especially hardy and withstand exposure to most chemicals and tear. Their strength and beauty make them a wonderful choice for jewelry.
</p><p class=\"mine\">			
			The high price of gold can be a hindrance to owning that piece you really desire. An 18 karat piece is comprised of no less than 75 percent of pure gold, which has been considered the best combination of price and quality.
			You can hang a whole row of these small pieces of hardware along a wall or the back of a closet door, color or material when you install a row of robe hooks on a wall or right on the inside of your closet door. This little display looks appealing and help you select the best necklace for your outfit.
</p><p class=\"mine\">
			A clasp is essential to any necklace or bracelet. If a clasp is not solid, you may lose them.You can get a safety clasp to secure expensive pieces of jewelry. Some people may even choose to put a second or three clasps on their extremely valuable pieces to keep them safe while wearing them.
			Through work, effort, and research you can be a success at buying and selling jewelry. If you use these suggestions you can be a winner!
</p>";
    }
    if ($title == 'handmade beaded jewelry') {
        return "<p class=\"mine\">
			Do you want to add the perfect jewelry to enhance and accessorize your outfit or style? Or perhaps you desire purchasing a gift for your friend? Either way, quite useful.
			While it may not be the best jewelry cleaner, it can act as a backup if there is nothing else available. Apply a very small amount of toothpaste onto a lint-free cloth or paper towel.Rub the tarnished jewelry with the paste, and then wipe or rinse it off with water. It might not be exactly perfect, but it will look much better and less tarnished.
</p><p class=\"mine\">			
			Look at the pieces up close before purchasing them, and compare them to other pieces you have seen. Be aware that jewelers use cheap tactics to make a diamond look better than it is.
			If you're shopping for a choker, choosing one that is 16 inches long is best. This is the usual length, but for a more specific number you can measure your neck and subtract up to one inch. This should give you with the perfect fit.
</p><p class=\"mine\">			
			Keep your jewelry from tarnish.Try not to wear jewelry away from water.Water can cause some types of metal if it is exposed to it too often.If you must take your jewelry somewhere wet, coat it thinly with clear nail polish.
			When selling jewelry on the Internet, be sure to develop attractive and persuasive imagery of the pieces. This is very important because a customer cannot handle the jewelry in an online transaction.
			Consider the stones when you buy jewelry. The right stone will enhance your skin tone and suit your personality. Neutral colors are versatile enough to wear with any outfit in your clothing.
</p><p class=\"mine\">			
			Some men might not be sure when considering cufflinks. Cufflinks provide a striking finish to an elegant look; wear cufflinks in a similar style to the shirt and suit.
			You should wear it for a few days to see how it feels and if it is comfortable. It will also allow you to test the item is durable enough.
			If you have small pieces of jewelry from your childhood that you'd like to keep wearing, try combining them with new pieces that are larger and more modern.
</p><p class=\"mine\">			
			A lot of people wear gold and silver jewelry at the same time. The easiest way to approach this is with a single piece that uses both metals. If you do not, it seems unstylish or mismatched.
			If you are getting jewelry for someone you consider to be one-of-a-kind, try finding a special piece that is crafted specifically for them. A unique piece to match their personality shows thoughtfulness and creativity, necklace or bracelet conveys respect for and appreciation of the recipient's creativity and personality.
			A brooch can add a little character to your belt. Pin it near your hip or your hip.
</p><p class=\"mine\">			
			Never clean jewelry at a sink without double-checking that you've plugged the drain first. It is very common for an item of jewelry by dropping it down the sink's drain. By plugging the drain, it will not fall down into the drain pipe.
			You need to know how to best care for each piece in your jewelry collection. A treatment that is safe for one type of gemstone may scratch another kind. Ask a jeweler to make sure you do not know how to maintain your jewelry.
</p><p class=\"mine\">			
			Untangle your knotted necklaces with delicate chains and necklaces.It's easy to get frustrated when trying to get the knots out of a badly tangled necklace, but saran wrap can come to the rescue.Put the necklace on the plastic wrap and cover it with a little mineral oil or baby oil. Use a sewing needle to untangle the knot. Wash it gently with dish soap and then pat dry.
			Buying jewelry sets is worth considering when you want to give that special someone a gift. You can often get a great deal of stores offer discounts when you buy an entire set. You could always break the sets up and give them to multiple recipients or on multiple occasions. This is an excellent way to always have a gift that you will love.
</p><p class=\"mine\">			
			If you want the wow factor of a large diamond, consider purchasing an illusion setting. An illusion setting involves placing a mirrored plate placed on your ring prior to the diamond is set. The diamond will look bigger and magnifies the amount of light it reflects. The only problem with this setting comes at repair time as it can be difficult.
			Before you buy any gemstone, find out if it has been treated, if any, how. You have to select the type of care.
			Keep costume jewelry away from steam cleaners and harsh chemicals.
</p><p class=\"mine\">			
			When creating jewelry for selling at craft sales, craft sales and holiday sales, you may be at a loss for ways to display it beautifully. When you are shopping for materials to make your jewelry, also be on the lookout for creative display materials. You can use every day items to display your jewelery, baskets, mirrors, etc.
			There are very good reasons that rubies are such a classic. While true rubies are always red, rubies also come in a variety of shades ranging from deep rose to almost maroon. Rubies are especially hardy and can withstand considerable wear and tear. Their ability to last many years make them an excellent choice for most people.
			Use a soft cloth to keep your jewelry as often as you want. This method ensures your jewelry stays shiny without the use any chemical cleansers or solvents. Use this two-sided cloth on your jewelry as you were cleaning glass. Use one side for polishing and the other to polish it.
</p><p class=\"mine\">
			Brand should not be the primary concern when buying jewelry.There are excellent quality jewelry available for purchase.
			Now that you know more about jewelry, you will be able to make wise design and color decisions. The investment that you make now in a quality-piece will be something to be proud of and enjoy for years to come.
</p>";
    }
    if ($title == 'silver bangle bracelets') {
        return "<p class=\"mine\">
			What do you to jewelry? Can you tell the difference between costume jewelry and characteristics of different pieces? The advice provided in make you a more of an understanding about the complexities of jewelry. This article will provide some great tricks for all of your jewelry related questions.
</p><p class=\"mine\">			
			A brooch can add a little character to your belt. You can pin it centered at the front-center of the belt or near the hip.
			The right sale can save you a lot of cash. Check for great sales online, the Internet, and in the paper for the greatest sales. If you wait to buy jewelry until that particular style is going out of fashion, you can save a lot of money.
</p><p class=\"mine\">			
			The high price of purchasing gold can be a hindrance to owning that piece you really desire. An 18 karat piece is comprised of no less than 75 percent of pure gold, which has been considered the best combination of price and quality.
			You can make some extra cash from your gold bracelets and necklaces without giving them up entirely. If it is real gold and you have a few chains, you can earn a couple hundred dollars with this method.
</p><p class=\"mine\">			
			Take a good look at all the pieces that you like, and then hold everything else you consider to that standard. Be careful of tricks that jewelers use cheap tactics to make a diamond look bigger or better.
			You can hang a whole row of these small pieces of hardware along a wall or the back of a closet door, color or material when you install a row of robe hooks on a wall or right on the inside of your closet door. This can make your bedroom look more stylish and keeps chains from tangling at the same time.
</p><p class=\"mine\">			
			Jewelry is an investment that should last a life-time. When you are ready to chose your next selection of jewelry, be sure to deal with a reputable dealer to ensure you attain a high-quality piece. A high-quality piece of jewelry will be well-made and show superior craftsmanship. A jeweler should know about each piece he sells, including the person that made it, the origin of precious stones or other materials and other history, and where any stones in it came from. It is important that your pieces are high-quality jewelry if you want it to become a long time.
			The stone is an important consideration when shopping for new jewelry. The right stone will enhance your skin tone and suit your personality. Neutral colors work well with any outfit in your closet.
			Keep your jewelry pieces looking beautiful by protecting them from getting tarnished to preserve its best appearance. Try not to wear jewelry away from water.Water can cause some types of metal if it is exposed to it too often.If you must take your jewelry somewhere wet, coat it thinly with clear nail polish.
</p><p class=\"mine\">			
			This can dull your stones and the metal of the piece.
			Before cleaning, make sure that there are no breaks or loose gemstones that could potentially worsen or fall out if you were to clean the item. If something is wrong, take the item to a gemologist or jeweler and let them take care of the cleaning.
			Onyx or crystal jewelry looks beautiful and can make a statement. Be kinder to your wallet and you may just like the results are gorgeous.
</p><p class=\"mine\">			
			A tight fitting choker should have a length of about 16 inches, so bear this in mind when shopping. This is the most common length; if you want a customized length, but you can obtain a more specific size by measuring your neck and subtracting an inch. This will yield a perfect fit.
			Pay attention if they usually wear studs or hoop earrings, white gold or yellow, and colors of jewelry that the person wears.These types of observations will provide a reasonable starting point for your shopping.
			Chlorine is a strong chemical and it can damage the luster and life of metals that jewelry is made of. Salt water is equally damaging over time. Taking these off before swimming will protect their beauty and extend the life of the jewelry.
</p><p class=\"mine\">			
			Keep your fashion and costume jewelry away from steam cleaners or powerful chemicals.
			This is extra important when you are cleaning necklaces and earrings.
			If any of your rings are too big or loose on your fingers, loose rings, washing dishes, or taking a bath.
</p><p class=\"mine\">			
			Surprise your sweetheart and express your admiration with buying them a thoughtful piece of jewelry. Every woman loves receiving an unexpected gift of jewelery from the one they love. You can see someone's face light up with joy when you give her such a beautiful gift.
			Every diamond is unique in both its beauty and has individual flaws.Some flaws may be less important to you once you actually see the diamond in person.
			Dirt and dust cling to this electrical charge. This causes the tourmaline to get dirtier easier than other stones, so frequent cleaning is needed.
</p><p class=\"mine\">			
			Be careful when storing all of your pieces of jewelry together. It is better to use boxes, compartments, boxes, and hooks so that everything is kept separate. Do not just throw them in a pile. This can damage fragile jewelry, and items like necklaces can entangle with each other and other pieces into a big mess.
			A matched jewelry set is a no-fail gift for that special someone. You may be able to find great deals on jewelry sets. You can even divide up the pieces and give them to multiple recipients or on multiple occasions. This is an excellent way to give something every holiday season without having to worry that you will love.
			If you are in the market for jewelry or know someone who is, consult these tips. You can save money and get a beautiful piece at the same time. Getting, giving, and caring for great jewelry is really just a matter of educating yourself in the field.
</p>";
    }
}

function getArticleTitle($title)
{
    if ($title == 'rear view mirror') {
        return "Keep Your Car In Tip-top Shape";
    }
    if ($title == 'side view mirror') {
        return "Excellent (And Helpful!) Auto Repair Tips And Tricks";
    }
    if ($title == 'pearl pendant') {
        return "The Guide To Jewelry Know-How";
    }
    if ($title == 'black pearl necklace') {
        return "Where To Find The Best Deals On Jewelry";
    }
    if ($title == 'freshwater pearl necklace') {
        return "Things To Remember When It Comes To Jewelry";
    }
    if ($title == 'pearl necklace urban') {
        return "Tips To Use When Making A Jewelry Purchase";
    }
    if ($title == 'black pearl earrings') {
        return "You Can Find Great Jewelry For Anyone";
    }
    if ($title == 'pearl stud earrings') {
        return "Smarten Your Jewelry Shopping With These Handy Tips";
    }
    if ($title == 'opal jewelry') {
        return "Learn To Sell Your Jewelry Online With These Tips";
    }
    if ($title == 'amethyst jewelry') {
        return "Tips For Purchasing Jewelry That's Right For You";
    }
    if ($title == 'ruby jewelry') {
        return "Tips For Finding Great Jewelry For Any Situation";
    }
    if ($title == 'silver charm bracelet') {
        return "Strategies On How To Get The Right Jewelry";
    }
    if ($title == 'leather bracelets for women') {
        return "Buying Jewelry? Read These Tips Before You Buy";
    }
    if ($title == 'leather wrap bracelet') {
        return "Follow These Tips And Tricks About Jewelry";
    }
    if ($title == 'handmade beaded jewelry') {
        return "Looking To Get More Knowledge About Jewelry? Try These Tips!";
    }
    if ($title == 'silver bangle bracelets') {
        return "There's More To Jewelry Than Meets The Eye";
    }
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

?>
