jQuery.cookie = function (name, value, options) {
    if (typeof value !== 'undefined') {
        options = options || {};
        if (value === null) {
            value = '';
            options = $.extend({}, options);
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires === 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires === 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString();
        }
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else {
        var cookieValue = null;
        if (document.cookie && document.cookie !== '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                if (cookie.substring(0, name.length + 1) === (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

var accessKeyID = $.cookie('access_key_id') || "";
var secretAccessKey = $.cookie('secret_access_key') || "";
var trackingID = $.cookie('tracking_id') || "";

var selectedBaseItem = 0;
var selectedIndexItem = 0;
var baseItemsCount = 0;
var indexItemCount = 0;
var searchCapacity = 0;
var viewedCapacity = 0;


$(document).ready(function () {
    $(".search-button").mouseover(function () {
        $(".search-button img")
            .animate({top: "-10px"}, 200).animate({top: "-4px"}, 200)
            .animate({top: "-7px"}, 100).animate({top: "-4px"}, 100)
            .animate({top: "-6px"}, 100).animate({top: "-4px"}, 100);
    });
});

$.extend($.expr[":"], {
    "contains-ci": function (elem, i, match, array) {
        return (elem.textContent || elem.innerText || elem.innerHTML || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
});

function filterTableRows(tableId, searchBoxId) {
    var inputBoxValue = trim($("#" + searchBoxId).val());
    if (inputBoxValue !== "") {
        $("#" + tableId + " tbody>tr").hide();
        $("#" + tableId + " td:contains-ci('" + inputBoxValue + "')").parent("tr").show();
    } else {
        $("#" + tableId + " tbody>tr").show();
    }
}


function show(item, num, isScroll, type) {
    $("#welcome-info").hide();
    $("#search-error").html("");
    selectedBaseItem = num;

    $('#itemTip').css('display', 'inline');
    $('#itemTip').attr('class', 'itemTip_');

    $("#lbi-" + num).css("border", "1px solid #123456");
    $("#lbi-" + num).css("box-shadow", "5px 5px 19px rgb(84,36,247)");
    $("#lbi-" + num).css("-o-box-shadow", "5px 5px 19px rgb(84,36,247)");
    $("#lbi-" + num).css("-webkit-box-shadow", "5px 5px 19px rgb(84,36,247)");
    $("#lbi-" + num).css("-moz-box-shadow", "5px 5px 19px #fff");

    $("#lbi-" + num).unbind('mouseenter mouseleave');

    for (var i = 1; i <= baseItemsCount; i++) {
        if (i !== num) {
            $("#lbi-" + i).css("border", "1px solid #346789");
            $("#lbi-" + i).css("box-shadow", "2px 2px 19px #e0e0e0");
            $("#lbi-" + i).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
            $("#lbi-" + i).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
            $("#lbi-" + i).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
            $("#lbi-" + i).hover(function () {
                $(this).css("border", "1px solid #123456");
                $(this).css("box-shadow", "2px 2px 19px #444");
                $(this).css("-o-box-shadow", "2px 2px 19px #444");
                $(this).css("-webkit-box-shadow", "2px 2px 19px #444");
                $(this).css("-moz-box-shadow", "2px 2px 19px #fff");
            }, function () {
                $(this).css("border", "1px solid #346789");
                $(this).css("box-shadow", "2px 2px 19px #e0e0e0");
                $(this).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
                $(this).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
                $(this).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
            });
        }
    }

    var hscroll = (document.all ? document.scrollLeft : window.pageXOffset);
    var vscroll = (document.all ? document.scrollTop : window.pageYOffset);
    //$("#baseItem").css("display", "none");
    $("#variations-div").css("display", "none");
    $("#indexSearchTitle").css("display", "none");
    $("#loader-from-history").html("<img src='img/histloader.gif'><br><br>");
    $("#loader-from-history").attr("style", "position:absolute; margin-top:15px; left:45%;");
    $("#loader-from-history").show();
    var path = $('#item-' + num + '-cached-file').html();
    $.ajax({
        url: "loaders/loadItemInfo.php",
        type: 'POST',
        data: {
            'path': path,
            'folder': 'base_search',
            'fb_id': fb_id,
            'imageType': type,
            'accessKeyID': accessKeyID,
            'secretAccessKey': secretAccessKey,
            'trackingID': trackingID
        }
    }).done(function (response) {
        if (response === 'expired') {
            $('#keyword').val(currentKeyword);
            helpMessageIfCacheExpired = "Sorry, your search has been expired. Retrying..<br>";
            printCircles();
        } else {
            $("#loader-from-history").hide();
            $("#baseItem").html(response);
            $("#baseItem").show();
            window.scrollTo(hscroll, vscroll);
            if (fb_id > 0) {
                populateSearchArrows();
            }
            ScrollToElement(document.getElementById('picturesMode'));
        }
    });
}

var helpMessageIfCacheExpired = null;

function trim(stringToTrim) {
    return stringToTrim.replace(/^\s+|\s+$/g, "");
}

function hideElements() {
    hideLiveSearch();
    $("#welcome-info").hide();
    $("#indexSearch").css("display", "none");
    $("#indexCircles").css("display", "none");
    $("#baseItem").css("display", "none");
    $("#baseSearch").css("display", "none");
    $("#circles").css("display", "none");
    $("#variations-div").css("display", "none");
}

function getRandomSmile() {
    var index = Math.floor(Math.random() * 8) + 1;
    return "<img src='img/k" + index + ".png'>";
}

function getRandomForEmptyKeyword() {
    var phrases = [
        "<br><span class='loader-text'>You have missed something, did you?</span><br>" + getRandomSmile(),
        "<br><span class='loader-text'>I'm afraid it is too short keyword..</span><br>" + getRandomSmile(),
        "<br><span class='loader-text'>You should enter at least 2 symbols!</span><br>" + getRandomSmile(),
        "<br><span class='loader-text'>Can you imagine an item with such name? o_O</span><br>" + getRandomSmile(),
        "<pre>" + getASCIIText('Empty ???') + "</pre>",
        "<pre>" + getASCIIText('No') + "</pre>",
        "<pre>" + getASCIIText('(*_*)') + "</pre>"
    ];
    return phrases[Math.floor(Math.random() * phrases.length)];
}

function getASCIIText(text) {
    var result = "Too short..";
    if (myFiglet.isReady()) {
        result = myFiglet.getText(text);
    }
    return result;
}

function getRandomForShortKeyword(letter) {
    var phrases = [
        "<br><span class='loader-text'>I believe Amazon has at least a billion items which start with <b>" + letter + "</b></span><br>" + getRandomSmile(),
        "<br><span class='loader-text'><b>" + letter + "</b>? And what are you trying to find with that keyword? =)</span><br>" + getRandomSmile(),
        "<pre>" + getASCIIText('Too short') + "</pre>",
        "<pre>" + getASCIIText(letter + " ???") + "</pre>",
        "<pre>" + getASCIIText("One symbol? o_O") + "</pre>",
        "<pre>" + getASCIIText("Nope :P") + "</pre>",
        "<pre>" + getASCIIText(":)") + "</pre>",
        "<pre>" + getASCIIText(":(") + "</pre>",
        "<pre>" + getASCIIText(":'(") + "</pre>",
        "<pre>" + getASCIIText("o_O") + "</pre>",
        "<pre>" + getASCIIText(";)") + "</pre>",
        "<pre>" + getASCIIText('(*_*)') + "</pre>"
    ];
    return phrases[Math.floor(Math.random() * phrases.length)];
}

function newKeyword(key) {
    $('#keyword').css("background", "white");
    $('#keyword').val(key);
    printCircles(false);
}

function printError(keyword) {
    var words = keyword.split(' ');
    var filtered = [];
    for (var int = 0; int < words.length; int++) {
        var word = words[int];
        if (word.length < 7) {
            filtered.push(word);
        }
    }
    var newKeyword = filtered.join(" ");


    var corrected = "<br><br><span class='loader-text'>May be this one will succeed:</span><br><span class='corrected-keyword' onclick=\"newKeyword('" + newKeyword + "');\">" + newKeyword + "</span>";
    var phrases = [
        "<br><span class='loader-text'>Seems there are no results with that keyword. Sorry.</span><br>" + getRandomSmile() + corrected,
        "<br><span class='loader-text'>Sorry, no matches.</span><br>" + getRandomSmile() + corrected,
        "<br><span class='loader-text'>Try another keyword and category..</span><br>" + getRandomSmile() + corrected
    ];
    return phrases[Math.floor(Math.random() * phrases.length)];
}

function printIndexError(keyword, index) {
    var phrases = [
        "<br><br><span class='loader-text'>I apologize, but there are no results for <b>" + keyword + "</b> in <b>" + index + "</b> department</span><br>" + getRandomSmile(),
        "<br><br><span class='loader-text'><b>" + index + "</b> category has no items related to <b>" + keyword + "</b>, I'm, sorry.</span><br>" + getRandomSmile(),
        "<br><br><span class='loader-text'>There are no any popular goods in <b>" + index + "</b> for that item..</span><br>" + getRandomSmile()
    ];
    return phrases[Math.floor(Math.random() * phrases.length)];
}

function getFirstString() {
    var phrases = [
        loaderBefore + "Analyze.." + loaderAfter + "<br><br>Did you know:<br> ",
        loaderBefore + "Still working.." + loaderAfter + "<br><br>Did you know:<br> ",
        loaderBefore + "Gathering information.." + loaderAfter + "<br><br>Did you know:<br> "
    ];
    return phrases[Math.floor(Math.random() * phrases.length)];
}

//

function getSearchStringAgain() {
    var spanOpen = "<font face='Lucida Console;' style='font-size: 16pt'>";
    var spanClose = "</font>";
    var phrases = [
        loaderBefore + "<Analyze.." + loaderAfter,
        loaderBefore + "Still working.." + loaderAfter,
        loaderBefore + "Gathering information.." + loaderAfter,
        getFirstString() + spanOpen + "It is impossible to lick your elbow :P" + spanClose,
        getFirstString() + spanOpen + "A crocodile can't stick it's tongue out" + spanClose,
        getFirstString() + spanOpen + "A shrimp's heart is in it's head" + spanClose,
        getFirstString() + spanOpen + "People say 'Bless you' when you sneeze because when you sneeze, your heart stops for a mili-second" + spanClose,
        getFirstString() + spanOpen + "It is physically impossible for pigs to look up into the sky :(" + spanClose,
        getFirstString() + spanOpen + "A pregnant goldfish is called a twit :)" + spanClose,
        getFirstString() + spanOpen + "More than 50% of the people in the world have never made or received a telephone call" + spanClose,
        getFirstString() + spanOpen + "Rats and horses can't vomit.." + spanClose,
        getFirstString() + spanOpen + "If you sneeze too hard, you can fracture a rib" + spanClose,
        getFirstString() + spanOpen + "If you keep your eyes open by force when you sneeze, you might pop an eyeball out" + spanClose,
        getFirstString() + spanOpen + "Rats multiply so quickly that in 18 months, two rats could have over a million descendants" + spanClose,
        getFirstString() + spanOpen + "Wearing headphones for just an hour will increase the bacteria in your ear by 700 times" + spanClose,
        getFirstString() + spanOpen + "In every episode of Seinfeld there is a Superman somewhere" + spanClose,
        getFirstString() + spanOpen + "The cigarette lighter was invented before the match" + spanClose,
        getFirstString() + spanOpen + "35% of the people who use personal ads for dating are already married" + spanClose,
        getFirstString() + spanOpen + "A duck's quack doesn't echo, and no one knows why" + spanClose,
        getFirstString() + spanOpen + "23% of all photocopier faults worldwide are caused by people sitting on them and photocopying their butts" + spanClose,
        getFirstString() + spanOpen + "In the course of an average lifetime you will, while sleeping, eat 70 assorted insects and 10 spiders" + spanClose,
        getFirstString() + spanOpen + "Most lipstick contains fish scales" + spanClose,
        getFirstString() + spanOpen + "Like fingerprints, everyone's tongue print is different" + spanClose,
        getFirstString() + spanOpen + "A person can live without food for about a month, but only about a week without water" + spanClose,
        getFirstString() + spanOpen + "Ethernet is a registered trademark of Xerox, Unix is a registered trademark of AT&T" + spanClose,
        getFirstString() + spanOpen + "Uranus' orbital axis is tilted at 90 degrees" + spanClose,
        getFirstString() + spanOpen + "Outside the USA, Ireland is the largest software producing country in the world" + spanClose,
        getFirstString() + spanOpen + "Every human spent about half an hour as a single cell" + spanClose,
        getFirstString() + spanOpen + "Every year about 98% of atoms in your body are replaced" + spanClose,
        getFirstString() + spanOpen + "Hot water is heavier than cold" + spanClose,
        getFirstString() + spanOpen + "The radioactive substance, Americanium-241 is used in many smoke detectors" + spanClose,
        getFirstString() + spanOpen + "Sound travels 15 times faster through steel than through the air" + spanClose,
        getFirstString() + spanOpen + "On average, half of all false teeth have some form of radioactivity" + spanClose,
        getFirstString() + spanOpen + "European Space Agency's Olympus satellite been destroyed by a meteor in 1993" + spanClose,
        getFirstString() + spanOpen + "Ostriches are often not taken seriously. They can run faster than horses, and the males can roar like lions" + spanClose,
        getFirstString() + spanOpen + "Seals used for their fur get extremely sick when taken aboard ships" + spanClose,
        getFirstString() + spanOpen + "Sloths take two weeks to digest their food" + spanClose,
        getFirstString() + spanOpen + "Guinea pigs and rabbits can't sweat" + spanClose,
        getFirstString() + spanOpen + "The porpoise is second to man as the most intelligent animal on the planet" + spanClose,
        getFirstString() + spanOpen + "Young beavers stay with their parents for the first two years of their lives before going out on their own" + spanClose,
        getFirstString() + spanOpen + "Skunks can accurately spray their smelly fluid as far as ten feet" + spanClose,
        getFirstString() + spanOpen + "Deer can't eat hay" + spanClose,
        getFirstString() + spanOpen + "On average, dogs have better eyesight than humans, although not as colorful" + spanClose,
        getFirstString() + spanOpen + "The duckbill platypus can store as many as six hundred worms in the pouches of its cheeks" + spanClose,
        getFirstString() + spanOpen + "The lifespan of a squirrel is about nine years" + spanClose,
        getFirstString() + spanOpen + "North American oysters do not make pearls of any value" + spanClose,
        getFirstString() + spanOpen + "Human birth control pills work on gorillas" + spanClose,
        getFirstString() + spanOpen + "Gorillas sleep as much as fourteen hours per day" + spanClose,
        getFirstString() + spanOpen + "A biological reserve has been made for golden toads because they are so rare" + spanClose,
        getFirstString() + spanOpen + "There are more than fifty different kinds of kangaroos" + spanClose,
        getFirstString() + spanOpen + "The female lion does ninety percent of the hunting" + spanClose,
        getFirstString() + spanOpen + "A group of twelve or more cows is called a flink" + spanClose,
        getFirstString() + spanOpen + "You can tell the sex of a horse by its teeth. Most males have 40, females have 36" + spanClose,
        getFirstString() + spanOpen + "Money isn't made out of paper; it's made out of cotton" + spanClose,
        getFirstString() + spanOpen + "The 57 on Heinz ketchup bottle represents the varieties of pickle the company once had" + spanClose,
        getFirstString() + spanOpen + "Your stomach produces a new layer of mucus every two weeks - otherwise it will digest itself" + spanClose,
        getFirstString() + spanOpen + "The Declaration of Independence was written on hemp paper" + spanClose,
        getFirstString() + spanOpen + "Susan Lucci is the daughter of Phyllis Diller" + spanClose,
        getFirstString() + spanOpen + "Every person has a unique tongue print as well as fingerprints" + spanClose,
        getFirstString() + spanOpen + "315 entries in Webster's 1996 Dictionary were misspelled" + spanClose,
        getFirstString() + spanOpen + "On average, 12 newborns will be given to the wrong parents daily" + spanClose,
        getFirstString() + spanOpen + "During the chariot scene in 'Ben Hur' a small red car can be seen in the distance" + spanClose,
        getFirstString() + spanOpen + "Warren Beatty and Shirley MacLaine are brother and sister" + spanClose,
        getFirstString() + spanOpen + "Most lipstick contains fish scales" + spanClose,
        getFirstString() + spanOpen + "Donald Duck comics were banned from Finland because he doesn't wear any pants" + spanClose,
        getFirstString() + spanOpen + "Ketchup was sold in the 1830s as medicine" + spanClose,
        getFirstString() + spanOpen + "Leonardo da Vinci could write with one hand and draw with the other at the same time" + spanClose,
        getFirstString() + spanOpen + "Because metal was scarce, the Oscars given out during World War II were made of wood" + spanClose,
        getFirstString() + spanOpen + "There are no clocks in Las Vegas gambling casinos" + spanClose,
        getFirstString() + spanOpen + "The name Wendy was made up for the book Peter Pan, there was never a recorded Wendy before!" + spanClose,
        getFirstString() + spanOpen + "There are no words in the dictionary that rhyme with: orange, purple, and silver!" + spanClose,
        getFirstString() + spanOpen + "Leonardo Da Vinci invented scissors" + spanClose,
        getFirstString() + spanOpen + "A tiny amount of liquor on a scorpion will make it instantly go mad and sting itself to death" + spanClose,
        getFirstString() + spanOpen + "Chewing gum while peeling onions will keep you from crying!" + spanClose,
        getFirstString() + spanOpen + "The glue on Israeli postage stamps is certified kosher" + spanClose,
        getFirstString() + spanOpen + "Guinness Book of Records holds the record for being the book most often stolen from Public Libraries" + spanClose,
        getFirstString() + spanOpen + "Beetles taste like apples, wasps like pine nuts, and worms like fried bacon" + spanClose,
        getFirstString() + spanOpen + "Of all the words in the English language, the word 'set' has the most definitions!" + spanClose,
        getFirstString() + spanOpen + "What is called a 'French kiss' in the English speaking world is known as an 'English kiss' in France" + spanClose,
        getFirstString() + spanOpen + "'Almost' is the longest word in the English language with all the letters in alphabetical order" + spanClose,
        getFirstString() + spanOpen + "'Rhythm' is the longest English word without a vowel" + spanClose,
        getFirstString() + spanOpen + "In 1386, a pig in France was executed by public hanging for the murder of a child" + spanClose,
        getFirstString() + spanOpen + "A cockroach can live several weeks with its head cut off" + spanClose,
        getFirstString() + spanOpen + "Human thigh bones are stronger than concrete" + spanClose,
        getFirstString() + spanOpen + "You can't kill yourself by holding your breath" + spanClose,
        getFirstString() + spanOpen + "There is a city called Rome on every continent" + spanClose,
        getFirstString() + spanOpen + "It's against the law to have a pet dog in Iceland" + spanClose,
        getFirstString() + spanOpen + "Your heart beats over 100,000 times a day" + spanClose,
        getFirstString() + spanOpen + "The skeleton of Jeremy Bentham is present at all important meetings of the University of London" + spanClose,
        getFirstString() + spanOpen + "Right handed people live, on average, nine years longer than left-handed people" + spanClose,
        getFirstString() + spanOpen + "Your ribs move about 5 million times a year, everytime you breathe!" + spanClose,
        getFirstString() + spanOpen + "The elephant is the only mammal that can't jump!" + spanClose,
        getFirstString() + spanOpen + "One quarter of the bones in your body, are in your feet!" + spanClose,
        getFirstString() + spanOpen + "Like fingerprints, everyone's tongue print is different!" + spanClose,
        getFirstString() + spanOpen + "Fingernails grow nearly 4 times faster than toenails!" + spanClose,
        getFirstString() + spanOpen + "Most dust particles in your house are made from dead skin!" + spanClose,
        getFirstString() + spanOpen + "The present population of 5 billion plus people of the world is predicted to become 15 billion by 2080" + spanClose,
        getFirstString() + spanOpen + "Women blink nearly twice as much as men" + spanClose,
        getFirstString() + spanOpen + "Adolf Hitler was a vegetarian, and had only ONE testicle" + spanClose,
        getFirstString() + spanOpen + "Months that begin on a Sunday will always have a 'Friday the 13th'" + spanClose,
        getFirstString() + spanOpen + "Coca-Cola would be green if colouring weren't added to it" + spanClose,
        getFirstString() + spanOpen + "On average a hedgehog's heart beats 300 times a minute" + spanClose,
        getFirstString() + spanOpen + "More people are killed each year from bees than from snakes" + spanClose,
        getFirstString() + spanOpen + "More people are allergic to cow's milk than any other food" + spanClose,
        getFirstString() + spanOpen + "Camels have three eyelids to protect themselves from blowing sand" + spanClose,
        getFirstString() + spanOpen + "The placement of a donkey's eyes in its' heads enables it to see all four feet at all times!" + spanClose,
        getFirstString() + spanOpen + "The six official languages of the United Nations are: English, French, Arabic, Chinese, Russian and Spanish" + spanClose,
        getFirstString() + spanOpen + "Earth is the only planet not named after a god" + spanClose,
        getFirstString() + spanOpen + "It's against the law to burp, or sneeze in a church in Nebraska, USA" + spanClose,
        getFirstString() + spanOpen + "You're born with 300 bones, but by the time you become an adult, you only have 206" + spanClose,
        getFirstString() + spanOpen + "Some worms will eat themselves if they can't find any food!" + spanClose,
        getFirstString() + spanOpen + "Dolphins sleep with one eye open!" + spanClose,
        getFirstString() + spanOpen + "It is impossible to sneeze with your eyes open" + spanClose,
        getFirstString() + spanOpen + "The worlds oldest piece of chewing gum is 9000 years old!" + spanClose,
        getFirstString() + spanOpen + "The longest recorded flight of a chicken is 13 seconds" + spanClose,
        getFirstString() + spanOpen + "Slugs have 4 noses" + spanClose,
        getFirstString() + spanOpen + "Owls are the only birds who can see the colour blue" + spanClose,
        getFirstString() + spanOpen + "A man named Charles Osborne had the hiccups for 69 years!" + spanClose,
        getFirstString() + spanOpen + "A giraffe can clean its ears with its 21-inch tongue!" + spanClose,
        getFirstString() + spanOpen + "The average person laughs 10 times a day!" + spanClose,
        getFirstString() + spanOpen + "An ostrich's eye is bigger than its brain" + spanClose,
        getFirstString() + spanOpen + "A pig's orgasm lasts 30 minutes o_O" + spanClose,
        getFirstString() + spanOpen + "A cockroach will live nine days without its head before it starves to death!" + spanClose,
        getFirstString() + spanOpen + "Banging your head against a wall uses 150 calories a hour" + spanClose,
        getFirstString() + spanOpen + "The flea can jump 350 times its body length. It's like a human jumping the length of a football field" + spanClose,
        getFirstString() + spanOpen + "The catfish has over 27,000 taste buds" + spanClose,
        getFirstString() + spanOpen + "Some lions mate over 50 times a day ><" + spanClose,
        getFirstString() + spanOpen + "Butterflies taste with their feet" + spanClose,
        getFirstString() + spanOpen + "The strongest muscle in the body is the tongue" + spanClose,
        getFirstString() + spanOpen + "A cat's urine glows under a black light" + spanClose,
        getFirstString() + spanOpen + "An ostrich's eye is bigger than its brain" + spanClose,
        getFirstString() + spanOpen + "Starfish have no brains" + spanClose,
        getFirstString() + spanOpen + "Polar bears are left-handed" + spanClose,
        getFirstString() + spanOpen + "Humans and dolphins are the only species that have sex for pleasure" + spanClose
    ];
    return phrases[Math.floor(Math.random() * phrases.length)];
}

var loaderBefore = "<img src='img/l10.gif'>&nbsp;&nbsp;";
var loaderAfter = "&nbsp;<img src='img/l10.gif'>";

function getSearchString() {
    var searchMode = $("input:radio[name ='searchMode']:checked").val();
    var keyword = $('#keyword').val();
    keyword = trim(keyword);
    keyword = keyword.replace(/(<([^>]+)>)/ig, "");
    var category = $('#category').val();
    category = trim(category);
    category = category.replace(/(<([^>]+)>)/ig, "");
    var mainSearchText = keyword + " " + category;
    mainSearchText = trim(mainSearchText);
    if (searchMode === "default") {
        return loaderBefore + mainSearchText + loaderAfter + "<br><br>";
    }
    if (searchMode === "topsellers") {
        return loaderBefore + "Top Sellers in " + category + "..." + loaderAfter + "<br><br>";
    }
    if (searchMode === "mostwished") {
        return loaderBefore + "Most Wished of " + category + "..." + loaderAfter + "<br><br>";
    }
    if (searchMode === "mostgifted") {
        return loaderBefore + "Most Gifted " + category + "..." + loaderAfter + "<br><br>";
    }
    if (searchMode === "newreleases") {
        return loaderBefore + "New Releases of " + category + "..." + loaderAfter + "<br><br>";
    }
    var keyword = $('#keyword').val();
    keyword = trim(keyword);
    keyword = keyword.replace(/(<([^>]+)>)/ig, "");
    var cat = $('#category').val();
    cat = trim(cat);
    cat = cat.replace(/(<([^>]+)>)/ig, "");
    keyword = keyword + " " + cat;
    keyword = trim(keyword);
    var category = $('#categories-select option:selected').html();
    if (searchMode === "incat") {
        return loaderBefore + keyword + " in " + category + loaderAfter;
    }
}

function node(group, isAgain) {
    $("#baseSearchSummary").html("");
    $("#baseSearchSummary").hide();
    $("#welcome-info").hide();
    $('#nodes').html("");
    $('#nodes').hide();
    var nodeId = $('#browseNodeId').html();
    $('#keyword').css("background", "white");
    $('#category').css("background", "white");
    $('#picturesMode').hide();
    var searchModeTitle = $('#searchMode').html();
    var browseNodeFullTitleEncoded = $('#browseNodeFullTitleEncoded').html();
    hideElements();
    if (nodeId.length < 1) {
        $('#nodes').html("<center><span style='font-size:15pt;font-family: georgia, serif;color: #2a2a2a;'>Please, re-select the category from live search</span></center>");
        $('#nodes').show();
        $('#category').css("background", "yellow");
        return;
    }
    var text = loaderBefore + "Searching.." + loaderAfter;
    if (isAgain) {
        text = getSearchStringAgain();
    }
    $('#nodes-loader').html("<center><span class='loader-text' style='position:relative;top:20px;'>" + text + "</span></center>");
    $('#nodes-loader').show();
    $.ajax({
        url: "node/load.php",
        type: 'POST',
        data: {
            'id': nodeId,
            'group': group,
            'searchModeTitle': searchModeTitle,
            'browseNodeFullTitleEncoded': browseNodeFullTitleEncoded,
            'accessKeyID': accessKeyID,
            'secretAccessKey': secretAccessKey,
            'trackingID': trackingID
        }
    }).done(function (resp) {
        $('#nodes-loader').hide();
        if (resp.indexOf('No results') > 0) {
            $('#category').css("background", "yellow");
        }
        $('#nodes').html(resp + "<br>");
        $('#nodes').show();
    }).error(function (data) {
        $(this).delay(5000).queue(function (nxt) {
            node(group, true);
        });
    });
}

function searchTypeChanged(type) {
    //$('#nodes').html("");
    //$('#nodes').hide();
    $('#searchMode').html("");
    $('#keyword').removeAttr("onkeypress");
    $('#main-search-button').removeAttr("onclick");
    $('#keyword').css("background", "white");
    $('#category').css("background", "white");
    var nodeId = $('#browseNodeId').html();
    if (type === "default") {
        $('#keyword').attr("onkeypress", "if (event.keyCode==13) { printCircles(true); }");
        $('#main-search-button').attr("onclick", "printCircles(true);");
        $('#keyword').removeAttr("class");
        $('#keyword').attr("class", "keyword-highlighted");
        $('#category').removeAttr("class");
        $('#category').attr("class", "keyword-highlighted");
        $('#main-search-button').html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
        $('#under-search-tip').html("");
        isIndexSearch = false;
    }
    if (type === "topsellers") {
        $('#keyword').attr("onkeypress", "if (event.keyCode==13) { node('TopSellers'); }");
        $('#main-search-button').attr("onclick", "node('TopSellers');");
        $('#searchMode').html("Top Sellers");
        $('#keyword').removeAttr("class");
        $('#keyword').attr("class", "keyword");
        $('#category').removeAttr("class");
        $('#category').attr("class", "keyword-highlighted");
        $('#main-search-button').html("Find best-selling products");
        if (nodeId.length < 1) {
            $('#under-search-tip').html("For this search mode you need to specify a category. Please, select one.");
        } else {
            $('#under-search-tip').html("");
        }
        isIndexSearch = false;
    }
    if (type === "mostwished") {
        $('#keyword').attr("onkeypress", "if (event.keyCode==13) { node('MostWishedFor'); }");
        $('#main-search-button').attr("onclick", "node('MostWishedFor');");
        $('#searchMode').html("Most Wished for");
        $('#keyword').removeAttr("class");
        $('#keyword').attr("class", "keyword");
        $('#category').removeAttr("class");
        $('#category').attr("class", "keyword-highlighted");
        $('#main-search-button').html("Find most wished products");
        if (nodeId.length < 1) {
            $('#under-search-tip').html("For this search mode you need to specify a category. Please, select one.");
        } else {
            $('#under-search-tip').html("");
        }
        isIndexSearch = false;
    }
    if (type === "mostgifted") {
        $('#keyword').attr("onkeypress", "if (event.keyCode==13) { node('MostGifted'); }");
        $('#main-search-button').attr("onclick", "node('MostGifted');");
        $('#searchMode').html("Most Gifted");
        $('#keyword').removeAttr("class");
        $('#keyword').attr("class", "keyword");
        $('#category').removeAttr("class");
        $('#category').attr("class", "keyword-highlighted");
        $('#main-search-button').html("Find most gifted products");
        if (nodeId.length < 1) {
            $('#under-search-tip').html("For this search mode you need to specify a category. Please, select one.");
        } else {
            $('#under-search-tip').html("");
        }
        isIndexSearch = false;
    }
    if (type === "newreleases") {
        $('#keyword').attr("onkeypress", "if (event.keyCode==13) { node('NewReleases'); }");
        $('#main-search-button').attr("onclick", "node('NewReleases');");
        $('#searchMode').html("New Releases in");
        $('#keyword').removeAttr("class");
        $('#keyword').attr("class", "keyword");
        $('#category').removeAttr("class");
        $('#category').attr("class", "keyword-highlighted");
        $('#main-search-button').html("Look for new releases");
        if (nodeId.length < 1) {
            $('#under-search-tip').html("For this search mode you need to specify a category. Please, select one.");
        } else {
            $('#under-search-tip').html("");
        }
        isIndexSearch = false;
    }
    if (type === "incat") {
        $('#keyword').attr("onkeypress", "if (event.keyCode==13) { printCircles(true); }");
        $('#main-search-button').attr("onclick", "printCircles(true);");
        $('#keyword').removeAttr("class");
        $('#keyword').attr("class", "keyword-highlighted");
        $('#category').removeAttr("class");
        $('#category').attr("class", "keyword-highlighted");
        $('#main-search-button').html("Search in main categories");
        $('#under-search-tip').html("");
        isIndexSearch = true;
    }
}

var currentCacheFileNames = "";
var currentKeyword = "";
var isIndexSearch = false;

function printCircles(flag, isScroll, alternativeText, isIndex) {
    $("#baseSearchSummary").html("");
    $("#baseSearchSummary").hide();
    $("#welcome-info").hide();
    if ($('#nodes').html().indexOf("category from live search") > 0) {
        $('#nodes').html("");
        $('#nodes').hide();
    }
    $('#keyword').css("background", "white");
    $('#category').css("background", "white");
    var searchMode = $("input:radio[name ='searchMode']:checked").val();
    hideLiveSearch();
    $("#baseItem").css("display", "none");
    $("#indexSearch").css("display", "none");
    $("#indexCircles").css("display", "none");
    $("#indexSearchTitle").css("display", "none");
    $("#variations-div").css("display", "none");
    var keyword = $('#keyword').val();
    var category = $('#category').val();
    keyword = trim(keyword);
    keyword = keyword.replace(/(<([^>]+)>)/ig, "");
    category = trim(category);
    category = category.replace(/(<([^>]+)>)/ig, "");
    if (flag) {
        keyword = keyword + " " + category;
        keyword = trim(keyword);
    }
    currentKeyword = keyword;
    var correctedKeyword = keyword.replace("debugmodeon", "");
    if (keyword.length < 1) {
        hideElements();
        $("#baseSearch").css("display", "inline");
        $('#baseSearch').html("<br><div id=\"search-error\">" + getRandomForEmptyKeyword() + "</div>");
        $('#keyword').css("background", "yellow");
        $('#nodes').html("");
        $('#nodes').hide();
        $('#picturesMode').hide();
        ScrollToElement(document.getElementById('baseSearch'));
        return;
    }
    if (keyword.length < 2) {
        hideElements();
        $("#baseSearch").css("display", "inline");
        $('#baseSearch').html("<br><div id=\"search-error\">" + getRandomForShortKeyword(keyword) + "</div>");
        $('#keyword').css("background", "yellow");
        $('#nodes').html("");
        $('#nodes').hide();
        $('#picturesMode').hide();
        ScrollToElement(document.getElementById('baseSearch'));
        return;
    }
    $("#item-keyword").html(correctedKeyword);
    var text = getSearchString();
    if (helpMessageIfCacheExpired) {
        text = helpMessageIfCacheExpired;
        helpMessageIfCacheExpired = null;
    }
    if (alternativeText) {
        text = getSearchStringAgain();
    }
    $("#baseSearch").html("");
    $('#baseSearch').html("<span class='loader-text' style='position:relative;top:20px;'>" + text + "</span>");
    $("#baseSearch").show();
    ScrollToElement(document.getElementById('baseSearch'));
    var successSearch = false;
    var category = "undefined";
    if (isIndexSearch) {
        category = $('#categories-select option:selected').val();
    }
    $.ajax({
        url: "loaders/loadCircles.php",
        type: 'POST',
        data: {
            'keyword': keyword,
            'fb_id': fb_id,
            'category': category,
            'accessKeyID': accessKeyID,
            'secretAccessKey': secretAccessKey,
            'trackingID': trackingID
        }
    }).done(function (resp) {
        $('#circles').html(resp);
        $("#circles").css("display", "none");
        if (resp === 'no') {
            $('#baseSearch').html("<div id=\"search-error\">" + printError(keyword) + "</div>");
            $('#keyword').css("background", "yellow");
            $('#picturesMode').hide();
            ScrollToElement(document.getElementById('search-error'));
            return;
        }
        var itemsCount = $("#found-items-count").html();
        baseItemsCount = itemsCount;
        baseItems = itemsCount;
        var fileNamesParam_ = "";
        for (i = 1; i <= itemsCount; i++) {
            var cachedFileName = $("#cached-item-" + i).html();
            fileNamesParam_ += cachedFileName + ";";
        }
        var fileNamesParam = fileNamesParam_.substring(0, fileNamesParam_.length - 1);
        currentCacheFileNames = fileNamesParam;
        $('#picturesMode').show();
        if ($('#itemset-default').attr("class") === 'cat-part-selected') {
            loadItemFromPrecache('default', isScroll);
        } else {
            loadItemFromPrecache('big', isScroll);
        }
    }).error(function (data) {
        $(this).delay(5000).queue(function (nxt) {
            printCircles(flag, isScroll, true);
        });
    });
}

function itemTipShow(divId, divType) {
//		var content = $('#' + divId).html();
//		$('#itemTipOuter').html("<div id=\"itemTip\"></div>");
//		$('#itemTip').html(content);
//		$('#itemTipOuter').attr('class', 'itemTip');
//		$('#itemTipOuter').css('display', 'inline');
//		var maxHeight = 0;
//		$('#itemTipOuter').each(function() { maxHeight = Math.max(maxHeight, $(this).height()); }).height(maxHeight);		
//		var top = document.getElementById(divType).offsetTop - maxHeight - 30 - window.pageYOffset;
//		$('#itemTipOuter').css('top', top + "px");
}

function itemTipHide(divId) {
//		$('#itemTipOuter').attr('class', 'itemTip_');
//		$('#itemTip').html("");
//		$('#itemTipOuter').css('display', 'none');
}

function ScrollToElement(theElement) {
    var selectedPosX = 0;
    var selectedPosY = 0;
    while (theElement !== null) {
        selectedPosX = theElement.offsetLeft;
        selectedPosY += theElement.offsetTop;
        theElement = theElement.offsetParent;
    }
    animateTo(selectedPosY);
    //window.scrollTo(selectedPosX,selectedPosY);
}

function pastePhraseInSearch(phrase, divId) {
    document.getElementById(divId).value = phrase;
}

function addToIconTextShow(msgSpan, text) {
    $('#' + msgSpan).html(text);
    $('#' + msgSpan).show();
}

function addToIconTextHide(msgSpan) {
    $('#' + msgSpan).css('display', 'none');
}

function openSimilar() {
    $('.simEl').each(function (index) {
        if ($(this).prop("checked")) {
            var valArr = $(this).val().split('-');
            var url = $('#hidden-sl-' + valArr[valArr.length - 1]).html();
            window.location = url;
        }
    });
}

function findSimilar() {
    $('.simEl').each(function (index) {
        if ($(this).prop("checked")) {
            var valArr = $(this).val().split('-');
            var title = $('#hidden-st-' + valArr[valArr.length - 1]).html();
            $('#keyword').val(title.replace(/&amp;/g, "&"));
            printCircles(false);
        }
    });
}

function openAcc() {
    $('.accEl').each(function (index) {
        if ($(this).prop("checked")) {
            var valArr = $(this).val().split('-');
            var url = $('#hidden-al-' + valArr[valArr.length - 1]).html();
            window.location = url;
        }
    });
}

function findAcc() {
    $('.accEl').each(function (index) {
        if ($(this).prop("checked")) {
            var valArr = $(this).val().split('-');
            var title = $('#hidden-at-' + valArr[valArr.length - 1]).html();
            $('#keyword').val(title);
            printCircles(false);
        }
    });
}

function simChange(num) {
    var url = $('#hidden-sl-' + num).html();
    $('#sim-link').attr('href', url);
}

function accChange(num) {
    var url = $('#hidden-al-' + num).html();
    $('#acc-link').attr('href', url);
}

function getDocHeight() {
    var D = document;
    return Math.max(
        Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
        Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
        Math.max(D.body.clientHeight, D.documentElement.clientHeight)
    );
}

function showBig() {
    $('#prelarge').html("<div onclick=\"hideBig('lbBig');\" style='position: absolute; display: none; top: 0; left: 0; height: " + getDocHeight() + "px; width: " + $(window).width() + "px; background-color: #181818; filter: alpha(opacity = 90, finishopacity = 10; style =0); z-index: 998; opacity: 0.8' id='large'></div>");
    $('#large').css('display', 'inline');
    //var top = Math.max(0, (($(window).height() - $('#lbBig').outerHeight() / 2)) + $(window).scrollTop()) + "px";
    //var left = Math.max(0, (($(window).width() - $('#lbBig').outerWidth() / 2)) + $(window).scrollLeft()) + "px";
    var img = document.getElementById('imgb');
    var imgWidth = img.clientWidth;
    var imgHeight = img.clientHeight;
    //var top = ($(window).height() - imgHeight) / 2+ "px";
    var top = document.getElementById('shwb').offsetTop;
    var left = ($(window).width() - imgWidth) / 2 + "px";
    $('#lbBig').css('position', 'absolute');
    $('#lbBig').css('top', window.pageYOffset + imgWidth);
    $('#lbBig').css('left', left);
    $('#lbBig').css('display', 'inline');
}

function hideBig(id) {
    $('#large').css('display', 'none');
    $('#' + id).css('display', 'none');
}

function findByTitle() {
    var title = $('#curr-item-title-64').html();
    $('#keyword').val(decode64(title));
    resetSearchMode();
    printCircles(false);
}

function addToFavorites(asin, title, imgUrl, cacheFileUrl) {
    if (fb_id > 0) {
        var imgH = $('#small_img_height').html();
        var imgW = $('#small_img_width').html();
        $.ajax({
            url: "favorites/add.php",
            type: 'POST',
            data: {
                'fb_id': fb_id,
                'asin': asin,
                'title': title,
                'imgUrl': imgUrl,
                'img_height': imgH,
                'img_width': imgW,
                'cacheFileUrl': cacheFileUrl,
                'accessKeyID': accessKeyID,
                'secretAccessKey': secretAccessKey,
                'trackingID': trackingID
            }
        }).done(function (resp) {
            $("#add-to-favorites").fadeOut("slow");
            $("#update-favorites").fadeOut("slow");
            $("#remove-from-favorites").show();
            favorites();
        });
    } else {
        $('#dialog-need-login').dialog('open');
    }
}

function hideFav() {
    //$('#open-hide-fav').html("show favorites");
    $('#open-hide-fav').attr("onclick", "favorites();");
    $("#scroll-out").hide();
}

function favorites() {
    $("#welcome-info").hide();
    $('#scroll-out').html("<img src='img/loader1.gif' style='margin:50px;'>");
    $('#scroll-out').show();
    $.ajax({
        url: "favorites/load.php",
        type: 'POST',
        data: {
            'fb_id': fb_id
        }
    }).done(function (resp) {
        var absense = false;
        if (resp === "You have not added any items to favorites") {
            absense = true;
            var h = "<span style=\"font-family:georgia,serif;color:#2a2a2a;font-size:12pt;position:relative;bottom:4px;\">You have not added any favorites yet..</span>";
            html = "<center><div class=\"scroll\" id=\"fav\">" + h + "</div></center>";
        } else {
            html = "<center><div class=\"scroll\" id=\"fav\">" + resp + "</div></center>";
        }
        var scHtml = html;
        scHtml += "<div style=\"cursor:pointer;position:absolute;top:2px;right:2px;\" onclick=\"$('#scroll-out').fadeOut('fast');\"><img src=\"img/close_tr.png\"></div>";
        $('#scroll-out').html(scHtml);
        $('#scroll-out').show();
        $('#fav').jScrollPane();
    });
}

function removeFav() {
    $('#dialog-remove-fav').dialog('open');
}

function removeFavConfirmed() {
    $.ajax({
        url: "favorites/removeAll.php",
        type: 'POST',
        data: {
            'fb_id': fb_id
        }
    });
    $('#scroll-out').fadeOut("slow");
}

function loadLastViewedItem(asin, isAgain, isNotHide, isClearBaseSearch) {
    for (var i = 1; i <= baseItemsCount; i++) {
        $("#lbi-" + i).css("border", "1px solid #346789");
        $("#lbi-" + i).css("box-shadow", "2px 2px 19px #e0e0e0");
        $("#lbi-" + i).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
        $("#lbi-" + i).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
        $("#lbi-" + i).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
        $("#lbi-" + i).hover(function () {
            $(this).css("border", "1px solid #123456");
            $(this).css("box-shadow", "2px 2px 19px #444");
            $(this).css("-o-box-shadow", "2px 2px 19px #444");
            $(this).css("-webkit-box-shadow", "2px 2px 19px #444");
            $(this).css("-moz-box-shadow", "2px 2px 19px #fff");
        }, function () {
            $(this).css("border", "1px solid #346789");
            $(this).css("box-shadow", "2px 2px 19px #e0e0e0");
            $(this).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
            $(this).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
            $(this).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
        });
    }
    $('#keyword').css("background", "white");
    $('#category').val("");
    $("#baseItem").hide();
    $("#search-error").html("");
    if (!isNotHide) {
        $("#nodes").html("");
        $("#nodes").hide();
    }
    hideLastViewedDialod();
    var text = "<img src='img/histloader.gif'><br><br><br>";
    if (isAgain) {
        text = "<center>" + getSearchStringAgain() + "</center>";
    }
    if (isClearBaseSearch) {
        $("#baseSearch").hide();
        $("#picturesMode").hide();
        $("#baseSearchSummary").hide();
    }
    $("#loader-from-history").html(text);
    $("#loader-from-history").attr("style", "position:absolute; margin-top:15px; left:44%;");
    $("#loader-from-history").show();
    ScrollToElement(document.getElementById('loader-from-history'));
    $.ajax({
        url: "loaders/loadItemInfo.php",
        type: 'POST',
        data: {
            'db': true,
            'asin': asin,
            'fb_id': fb_id,
            'type': 'viewed',
            'accessKeyID': accessKeyID,
            'secretAccessKey': secretAccessKey,
            'trackingID': trackingID
        }
    }).done(function (response) {
        if (fb_id > 0) {
            populateSearchArrows();
        }
        $("#loader-from-history").fadeOut("fast");
        $("#baseItem").html(response);
        $("#baseItem").show();
        var title = $('#curr-item-title-64').html();
        $('#keyword').val(decode64(title));
        $('#key').html(decode64(title));
        ScrollToElement(document.getElementById('baseItem'));
    }).error(function (data) {
        $(this).delay(5000).queue(function (nxt) {
            loadLastViewedItem(asin, true);
        });
    });
}

function loadFav(asin) {
    for (var i = 1; i <= baseItemsCount; i++) {
        $("#lbi-" + i).css("border", "1px solid #346789");
        $("#lbi-" + i).css("box-shadow", "2px 2px 19px #e0e0e0");
        $("#lbi-" + i).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
        $("#lbi-" + i).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
        $("#lbi-" + i).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
        $("#lbi-" + i).hover(function () {
            $(this).css("border", "1px solid #123456");
            $(this).css("box-shadow", "2px 2px 19px #444");
            $(this).css("-o-box-shadow", "2px 2px 19px #444");
            $(this).css("-webkit-box-shadow", "2px 2px 19px #444");
            $(this).css("-moz-box-shadow", "2px 2px 19px #fff");
        }, function () {
            $(this).css("border", "1px solid #346789");
            $(this).css("box-shadow", "2px 2px 19px #e0e0e0");
            $(this).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
            $(this).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
            $(this).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
        });
    }
    $('#search-error').html("");
    $('#keyword').css("background", "white");
    $("#nodes").html("");
    $("#nodes").hide();
    var hscroll = (document.all ? document.scrollLeft : window.pageXOffset);
    var vscroll = (document.all ? document.scrollTop : window.pageYOffset);
    $("#baseItem").hide();
    $("#loader-from-history").html("<img src='img/histloader.gif'>");
    $("#loader-from-history").attr("style", "position:absolute; margin-top:15px; left:44%;");
    $("#loader-from-history").show();
    ScrollToElement(document.getElementById('loader-from-history'));
    $.ajax({
        url: "loaders/loadItemInfo.php",
        type: 'POST',
        data: {
            'db': true,
            'asin': asin,
            'fb_id': fb_id,
            'type': 'fav',
            'accessKeyID': accessKeyID,
            'secretAccessKey': secretAccessKey,
            'trackingID': trackingID
        }
    }).done(function (response) {
        $("#loader-from-history").hide();
        for (var i = 1; i <= baseItemsCount; i++) {
            $("#lbi-" + i).css("border", "1px solid #346789");
            $("#lbi-" + i).css("box-shadow", "2px 2px 19px #e0e0e0");
            $("#lbi-" + i).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
            $("#lbi-" + i).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
            $("#lbi-" + i).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
            $("#lbi-" + i).hover(function () {
                $(this).css("border", "1px solid #123456");
                $(this).css("box-shadow", "2px 2px 19px #444");
                $(this).css("-o-box-shadow", "2px 2px 19px #444");
                $(this).css("-webkit-box-shadow", "2px 2px 19px #444");
                $(this).css("-moz-box-shadow", "2px 2px 19px #fff");
            }, function () {
                $(this).css("border", "1px solid #346789");
                $(this).css("box-shadow", "2px 2px 19px #e0e0e0");
                $(this).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
                $(this).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
                $(this).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
            });
        }
        for (var i = 1; i <= indexItemCount; i++) {
            $("#ilbi-" + i).css("border", "1px solid #346789");
            $("#ilbi-" + i).css("box-shadow", "2px 2px 19px #e0e0e0");
            $("#ilbi-" + i).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
            $("#ilbi-" + i).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
            $("#ilbi-" + i).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
            $("#ilbi-" + i).hover(function () {
                $(this).css("border", "1px solid #123456");
                $(this).css("box-shadow", "2px 2px 19px #444");
                $(this).css("-o-box-shadow", "2px 2px 19px #444");
                $(this).css("-webkit-box-shadow", "2px 2px 19px #444");
                $(this).css("-moz-box-shadow", "2px 2px 19px #fff");
            }, function () {
                $(this).css("border", "1px solid #346789");
                $(this).css("box-shadow", "2px 2px 19px #e0e0e0");
                $(this).css("-o-box-shadow", "2px 2px 19px #e0e0e0");
                $(this).css("-webkit-box-shadow", "2px 2px 19px #e0e0e0");
                $(this).css("-moz-box-shadow", "2px 2px 19px #e0e0e0");
            });
        }
        $("#baseItem").html(response);
        $("#baseItem").show();
        var title = $('#curr-item-title-64').html();
        $('#keyword').val(decode64(title));
        $('#key').html(decode64(title));
        ScrollToElement(document.getElementById('baseItem'));
    });
}

function removeFromFavorites(asin, fbId, refresh) {
    $.ajax({
        url: "favorites/removeSingle.php",
        type: 'POST',
        data: {
            'asin': asin,
            'fb_id': fbId,
            'deleted': 1
        }
    }).done(function (response) {
        $("#add-to-favorites").show();
        $("#remove-from-favorites").fadeOut("slow");
        if (refresh) {
            favorites();
        }
    });

}

function restoreFav(asin, fbId) {
    $.ajax({
        url: "favorites/removeSingle.php",
        type: 'POST',
        data: {
            'asin': asin,
            'fb_id': fbId,
            'deleted': 0
        }
    }).done(function (response) {
        $("#add-to-favorites").fadeOut("slow");
        $("#remove-from-favorites").show();
        favorites();
        $('#itemTip2').fadeOut("slow");
    });

}

var keyStr = "ABCDEFGHIJKLMNOP" +
    "QRSTUVWXYZabcdef" +
    "ghijklmnopqrstuv" +
    "wxyz0123456789+/" +
    "=";

function decode64(input) {
    var output = "";
    var chr1, chr2, chr3 = "";
    var enc1, enc2, enc3, enc4 = "";
    var i = 0;

    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

    do {
        enc1 = keyStr.indexOf(input.charAt(i++));
        enc2 = keyStr.indexOf(input.charAt(i++));
        enc3 = keyStr.indexOf(input.charAt(i++));
        enc4 = keyStr.indexOf(input.charAt(i++));

        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;

        output = output + String.fromCharCode(chr1);

        if (enc3 !== 64) {
            output = output + String.fromCharCode(chr2);
        }
        if (enc4 !== 64) {
            output = output + String.fromCharCode(chr3);
        }

        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";

    } while (i < input.length);

    return unescape(output);
}

function favOver(code) {
//		$('#itemTipFav').css('display', 'none');
//		$('#itemTipFav').html(decode64(code));
//		$('#itemTipFav').attr('class', 'itemTip');
//		$('#itemTipFav').css('display', 'inline');
//		var maxHeight = 0;
//		$('#fav').each(function() { maxHeight = Math.max(maxHeight, $(this).height()); }).height(maxHeight);		
//		var top = document.getElementById("fav").offsetTop + maxHeight + 40 - window.pageYOffset;
//		$('#itemTipFav').css('top', top + "px");
}

function favOut() {
//		 $('#itemTipFav').attr('class', 'itemTip_');
//		 $('#itemTipFav').html("");
//		 $('#itemTipFav').css('display', 'none');
}

function favRemOver(code) {
//		$('#itemTipRem').html("<b><font style='color:red'>REMOVE</font></b> " + decode64(code) + " <b><font style='color:red'>?</font></b>");
//		$('#itemTipRem').attr('class', 'itemTip');
//		var maxHeight = 0;
//		$('#fav').each(function() { maxHeight = Math.max(maxHeight, $(this).height()); }).height(maxHeight);		
//		var top = document.getElementById("fav").offsetTop + maxHeight - window.pageYOffset;
//		$('#itemTipRem').css('top', top + "px");
}

function favRemOut() {
//		 $('#itemTipRem').attr('class', 'itemTip_');
}

function remFavFromImg(asin, fbId, title, count) {
    $('#fav-item-' + count).css('display', 'none');
    removeFromFavorites(asin, fbId, false);

    $('#itemTip2').html(decode64(title) + " removed&nbsp;&nbsp;&nbsp;<span class='example-search' onclick=\"$('#itemTip2').fadeOut('slow');\">ok</span>&nbsp;&nbsp;&nbsp;<span class='example-search' onclick=\"restoreFav('" + asin + "', '" + fbId + "');\">restore</span>");
    $('#itemTip2').attr('class', 'itemTip');
    $('#itemTip2').show();
    var maxHeight = 0;
    $('#fav').each(function () {
        maxHeight = Math.max(maxHeight, $(this).height());
    }).height(maxHeight);
    var top = document.getElementById("scroll-out").offsetTop + maxHeight - window.pageYOffset;
    $('#itemTip2').css('top', top + "px");

}

function capitaliseFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function bestBN(id, isAgain) {
    $("#welcome-info").hide();
    if (fb_id > 0) {
        var text = loaderBefore + "Looking for " + $('#mp-bn').html() + loaderAfter;
        if (isAgain) {
            text = getSearchStringAgain();
        }
        $('#bn-load').html("");
        $('#bn-load').html("<center><span class='loader-text'>" + text + "</span></center>");
        $('#bn-load').show();
        $.ajax({
            url: "best/bn.php",
            type: 'POST',
            data: {
                'id': id,
                'fb_id': fb_id,
                'div_id': 'bn-content',
                'accessKeyID': accessKeyID,
                'secretAccessKey': secretAccessKey,
                'trackingID': trackingID
            }
        }).done(function (resp) {
            $('#bn-load').css('display', 'none');
            var title = $('#mp-bn').html();
            title = capitaliseFirstLetter(title);
            var html_ = "<span style=\"font-family:georgia,serif;color:#2a2a2a;font-size:18pt;\">" + title + "<br></span>";
            html_ += resp;
            $('#bn-content').html(html_);
            $('#bn-content').show();
        }).error(function (data) {
            $(this).delay(5000).queue(function (nxt) {
                bestBN(id, true);
            });
        });
    } else {
        $('#dialog-need-login').dialog('open');
    }
}

function bestAns(id, isAgain) {
    $("#welcome-info").hide();
    if (fb_id > 0) {
        var text = loaderBefore + "Looking for " + $('#mp-ans').html() + loaderBefore;
        if (isAgain) {
            text = getSearchStringAgain();
        }
        $('#ans-load').html("");
        $('#ans-load').html("</center><span class='loader-text'>" + text + "</span></center>");
        $('#ans-load').show();
        $.ajax({
            url: "best/bn.php",
            type: 'POST',
            data: {
                'id': id,
                'fb_id': fb_id,
                'div_id': 'ans-content',
                'accessKeyID': accessKeyID,
                'secretAccessKey': secretAccessKey,
                'trackingID': trackingID
            }
        }).done(function (resp) {
            $('#ans-load').css('display', 'none');
            var title = $('#mp-ans').html();
            title = capitaliseFirstLetter(title);
            var html_ = "<span style=\"font-family:georgia,serif;color:#2a2a2a;font-size:18pt;\">" + title + "<br></span>";
            html_ += resp;
            $('#ans-content').html(html_);
            $('#ans-content').show();
        }).error(function (data) {
            $(this).delay(5000).queue(function (nxt) {
                bestAns(id, true);
            });
        });
    } else {
        $('#dialog-need-login').dialog('open');
    }
}

function closeDiv(id) {
    $("#welcome-info").hide();
    $('#' + id).fadeOut("fast");
}

function findByTitle_(title, divId, isScroll) {
    $("#welcome-info").hide();
    $('#keyword').val(decode64(title));
    closeDiv(divId);
    resetSearchMode();
    printCircles(false, isScroll);
}

function resetSearchMode() {
    $('#category').css("background", "white");
    $('#default').click();
}

function loadVariants(asin, isAgain) {
    if (fb_id > 0) {
        var text = loaderBefore + "Parsing variants for " + $('#curr-item-title').html() + loaderAfter;
        if (isAgain) {
            text = getSearchStringAgain();
        }
        $('#var-load').html("<span class='loader-text'>" + text + "</span>");
        $('#var-load').show();
        $.ajax({
            url: "loaders/loadVariations.php",
            type: 'POST',
            data: {
                'asin': asin,
                'accessKeyID': accessKeyID,
                'secretAccessKey': secretAccessKey,
                'trackingID': trackingID
            }
        }).done(function (resp) {
            $('#var-load').css("display", "none");
            $("#var-content").html(resp);
            $('#var-content').show();
            //ScrollToElement(document.getElementById('variations-div'));
        }).error(function (data) {
            $(this).delay(5000).queue(function (nxt) {
                loadVariants(asin, true);
            });
        });
    } else {
        $('#dialog-need-login').dialog('open');
    }
}

function updateFavHintShow(days, img) {
    $('#itemTip3').html("<center><font style=\"font-family: georgia, serif;font-size: 14pt;\">Item has been added to your list " + days + " days ago and should be updated. Press for update.</font></center>");
    $('#itemTip3').attr('class', 'itemTip');
    $('#itemTip3').show();
    var maxHeight = 0;
    $('#fav').each(function () {
        maxHeight = Math.max(maxHeight, $(this).height());
    }).height(maxHeight);
    $('#itemTip3').css('top', $(img).position().top + "px");
}

function updateFavHintHide() {
    $('#itemTip3').hide();
}

function updateFav(asin, fbId, itemDivCount) {
    $('#itemTip3').hide();
    $("#baseItem").fadeOut("slow");
    $('#fav-item-' + itemDivCount).html("<div style=\"position:relative;top:7px;left:1px;\"><img src='img/loader1.gif'></div>");
    $.ajax({
        url: "favorites/update.php",
        type: 'POST',
        data: {
            'asin': asin,
            'fb_id': fbId,
            'div_count': itemDivCount,
            'accessKeyID': accessKeyID,
            'secretAccessKey': secretAccessKey,
            'trackingID': trackingID
        }
    }).done(function (resp) {
        $('#fav-item-' + itemDivCount).html(resp);
        var result = $('#fav-update-result').html();
        if (result === 'bad') {
            var title = $('#fav-update-result-title').html();
            $('#itemTip3').html("<font style=\"font-family: georgia, serif;font-size: 14pt;\">Seems this item has been deleted in Amazon store. You still can to <span class=\"example-search\" onclick=\"reFind('" + title + "');\">find it again</span> or <span class=\"example-search\" onclick=\"$('#itemTip3').fadeOut('slow');\">close</span></font>");
            $('#itemTip3').attr('class', 'itemTip');
            var maxHeight = 0;
            $('#fav').each(function () {
                maxHeight = Math.max(maxHeight, $(this).height());
            }).height(maxHeight);
            var top = document.getElementById("fav").offsetTop + maxHeight + 40 - window.pageYOffset;
            $('#itemTip3').css('top', top + "px");
        }
    });
}

function reFind(encodedTitle) {
    var title = decode64(encodedTitle);
    $('#keyword').val(title);
    printCircles(false);
}

function populateSearchArrows() {
    $.ajax({
        url: "history/prevSearch.php",
        type: 'POST',
        data: {
            'fb_id': fb_id,
            'limit': searchCapacity
        }
    }).done(function (resp) {
        $('#prev-search-content').html(resp);
        var left = ($(window).width() / 2) - ($(window).width() / 4) - 6;
        $('.arrow-history').css("left", left + "px");
        $('.arrow-history').css("top", "140px");
        $('#sc-table').tablesorter();
        var count = $('#prev-history-count').html();
        $('#prev-search').html("<img src=\"img/prevsearch.png\" width=\"48\" height=\"48\" title=\"Last searches\" alt=\"Last searches\">");
        $('#prev-search').attr("onclick", "showPrevSearch();");
        $('#prev-search').show();
        $.ajax({
            url: "history/lastViewed.php",
            type: 'POST',
            data: {
                'fb_id': fb_id,
                'limit': viewedCapacity
            }
        }).done(function (resp) {
            $('#last-viewed-content').html(resp);
            $('#lw-table').tablesorter();
            var count = $('#viewed-count').html();
            $('#last-viewed').html("<img src=\"img/viewhistory.png\" width=\"72\" height=\"72\" title=\"Last viewed\" alt=\"Last viewed\">");
            $('#last-viewed').attr("onclick", "showLastViewed();");
            $('#last-viewed').removeClass("viewed-history-btn2");
            $('#last-viewed').attr("class", "viewed-history-btn");
            $('#last-viewed').show();
        });
    });
}

function pointToKeyword(encodedKey) {
    $('#keyword').val(decode64(encodedKey).replace(/&amp;/g, "&"));
    hidePrevSearchDialod();
    $('#category').val("");
    $('#keyword').css("background", "white");
    printCircles(false);
}

function hideDuplicateRows(duplicatesClassName, linkDivId) {
    $('.' + duplicatesClassName).hide();
    $('#' + linkDivId).html("show duplicates");
    var divHeight = $('#sc-table-div').height();
    $('#' + linkDivId).attr("onclick", "showDuplicateRows('" + duplicatesClassName + "', '" + linkDivId + "', " + divHeight + ");");
    resizePrevSearchDiv();
}

function showDuplicateRows(duplicatesClassName, linkDivId, divHeight) {
    $('.' + duplicatesClassName).show();
    $('#' + linkDivId).html("hide duplicates");
    $('#' + linkDivId).attr("onclick", "hideDuplicateRows('" + duplicatesClassName + "', '" + linkDivId + "');");
    resizePrevSearchDiv(divHeight);
}

function getBodyScrollTop() {
    return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
}

function getBodyScrollLeft() {
    return self.pageXOffset || (document.documentElement && document.documentElement.scrollLeft) || (document.body && document.body.scrollLeft);
}

function getClientWidth() {
    return document.compatMode === 'CSS1Compat' && !window.opera ? document.documentElement.clientWidth : document.body.clientWidth;
}

function getClientHeight() {
    return document.compatMode === 'CSS1Compat' && !window.opera ? document.documentElement.clientHeight : document.body.clientHeight;
}

function doCenter(blockId) {
    var block = document.getElementById(blockId);
    block.style.top = Math.floor(getClientHeight() / 2 + getBodyScrollTop()) + "px";
    block.style.left = Math.floor(getClientWidth() / 2 + getBodyScrollLeft()) + "px";
    block.style.margin = "-" + Math.floor(block.clientWidth / 2) + "px 0px 0px -" + Math.floor(block.clientHeight / 2) + "px";
}

function showPrevSearch() {
    hideLastViewedDialod();
    $('#prelarge').html("<div onclick=\"hidePrevSearchDialod();\" style='position: absolute; top: 0; left: 0; height:100%; width:100%; z-index: 998;' id='large'></div>");
    $('#prev-search-content').css("height", getClientHeight() - 50);
    $('#sc-table-div').css("height", getClientHeight() - 115);
    $('#prev-search-content').show();
    $('#sc-table-div').jScrollPane();
    doCenter("prev-search-content");
}

function showLastViewed() {
    hidePrevSearchDialod();
    $('#prelarge').html("<div onclick=\"hideLastViewedDialod();\" style='position: absolute; top: 0; left: 0; height:100%; width:100%; z-index: 998;' id='large'></div>");
    $('#last-viewed-content').css("height", getClientHeight() - 50);
    $('#lw-table-div').css("height", getClientHeight() - 115);
    $('#last-viewed-content').show();
    $('#lw-table-div').jScrollPane();
    doCenter("last-viewed-content");
}

function hidePrevSearchDialod() {
    $('#prev-search-content').hide();
    $('#large').hide();
}

function hideLastViewedDialod() {
    $('#last-viewed-content').hide();
    $('#large').hide();
}

function hlHistory() {
    var typed = $('#prev-search-h').val();
    if (typed.length > 0) {
        $('#sc-table').highlight(typed);
        $('#history-qs-found').html(hlCount + " matches");
    }
}

function lwHistory() {
    var typed = $('#last-viewed-h').val();
    if (typed.length > 0) {
        $('#lw-table').highlight(typed);
        $('#last-viewed-found').html(hlCount + " matches");
    }
}

function checkIfQSEmpty() {
    if ($('#prev-search-h').val().length < 1) {
        $('#sc-table').removeHighlight();
        $('#history-qs-found').html("");
    }
}

function checkIfLWEmpty() {
    if ($('#last-viewed-h').val().length < 1) {
        $('#lw-table').removeHighlight();
        $('#last-viewed-found').html("");
    }
}

function settings() {
    hideFav();
    $('#scroll-out').html("<img src='img/loader1.gif' style='margin:50px;'>");
    $('#scroll-out').show();
    $.ajax({
        url: "settings/main.php",
        type: 'POST',
        data: {
            'fb_id': fb_id
        }
    }).done(function (resp) {
        $('#scroll-out').html(resp);
        var sC = $('#search-capacity').html();
        var vC = $('#viewed-capacity').html();
        $("#search-h-capacity").slider({
            range: "min",
            min: 10,
            max: 100,
            value: sC,
            slide: function (event, ui) {
                $("#search-amount").html(ui.value);
            }
        });
        $("#search-amount").html($("#search-h-capacity").slider("value"));
        $("#viewed-h-capacity").slider({
            range: "min",
            min: 10,
            max: 100,
            value: vC,
            slide: function (event, ui) {
                $("#viewed-amount").html(ui.value);
            }
        });
        $("#viewed-amount").html($("#viewed-h-capacity").slider("value"));
        $("#user-background").buttonset();
        var d = new Date();
        loadAndCorrectBackgroundImage('http://simpleamazonsearch.com/settings/showimg.php?id=' + fb_id + "&rnd=" + d.getTime());
    });
}

function userStats() {
    hideFav();
    $('#scroll-out').html("<img src='img/loader1.gif' style='margin:50px;'>");
    $('#scroll-out').show();
    $.ajax({
        url: "stat/main.php",
        type: 'POST',
        data: {
            'fb_id': fb_id
        }
    }).done(function (resp) {
        $('#scroll-out').html(resp);
        $('#scroll-out').show();
    });
}

function saveSettings() {
    var sc = $("#search-amount").html();
    var vc = $("#viewed-amount").html();
    searchCapacity = sc;
    viewedCapacity = vc;
    $('#prev-search').hide();
    $('#last-viewed').hide();
    $('#settings-save-btn').html("Saving..");
    $.ajax({
        url: "settings/saveHistory.php",
        type: 'POST',
        data: {
            'fb_id': fb_id,
            'sc': sc,
            'vc': vc
        }
    }).done(function (resp) {
        $('#settings-save-btn').html("Save");
        populateSearchArrows();
        var selectedBack = $('input[name=user-back]:checked').val();
        if (selectedBack === "no-back-div") {
            $.ajax({
                url: "settings/deleteBackground.php",
                type: 'POST',
                data: {
                    'fb_id': fb_id
                }
            }).done(function (resp) {
                var d = new Date();
                loadAndCorrectBackgroundImage('http://simpleamazonsearch.com/settings/showimg.php?id=' + fb_id + "&rnd=" + d.getTime());
                $('body').css("background", "white");
            });
        } else if (selectedBack === "def-back-div") {
            $.ajax({
                url: "settings/defaultBackground.php",
                type: 'POST',
                data: {
                    'fb_id': fb_id
                }
            }).done(function (resp) {
                var d = new Date();
                loadAndCorrectBackgroundImage('http://simpleamazonsearch.com/settings/showimg.php?id=' + fb_id + "&rnd=" + d.getTime());
                //$('body').css("background", "url(http://simpleamazonsearch.com/settings/showimg.php?id=" + fb_id + ") repeat scroll 0 0");
                $('body').removeAttr('style').attr("style", "background-image: url(http://simpleamazonsearch.com/settings/showimg.php?id=" + fb_id + "&rnd=" + d.getTime() + ");");
            });
        } else {
            var d = new Date();
            loadAndCorrectBackgroundImage('http://simpleamazonsearch.com/settings/showimg.php?id=' + fb_id + "&rnd=" + d.getTime());
            //$('body').css("background", "url(http://simpleamazonsearch.com/settings/showimg.php?id=" + fb_id + ") repeat scroll 0 0");
            $('body').removeAttr('style').attr("style", "background-image: url(http://simpleamazonsearch.com/settings/showimg.php?id=" + fb_id + "&rnd=" + d.getTime() + ");");
        }
    });
}

function showBackgroundsMenu() {
    var divs = ['def-back-div', 'cust-back-div', 'no-back-div'];
    var selectedBack = $('input[name=user-back]:checked').val();
    $('#' + selectedBack).show();
    for (var i = 0; i < divs.length; i++) {
        if (divs[i] !== selectedBack) {
            $('#' + divs[i]).hide();
        }
    }
}

function settingsBackUpdate() {
    var d = new Date();
    $('#settings-back-image').attr('src', 'img/loading.gif?' + d.getTime());
}

function refreshBackImageInSettings(state) {
    var d = new Date();
    if (state) {
        loadAndCorrectBackgroundImage('http://simpleamazonsearch.com/settings/showimg.php?id=' + fb_id + "&rnd=" + d.getTime());
    } else {
        loadAndCorrectBackgroundImage('http://simpleamazonsearch.com/img/badupdate.jpg?' + d.getTime());
    }
}

function loadAndCorrectBackgroundImage(imgSrc) {
    var d = new Date();
    var imgWidth = 0;
    var imgHeight = 0;
    var img = new Image();
    img.src = imgSrc;
    img.onload = function () {
        imgWidth = img.width;
        imgHeight = img.height;
        if (imgWidth < 200) {
            $('#settings-back-image').attr('width', imgWidth);
        } else {
            $('#settings-back-image').attr('width', 200);
        }
        if (imgHeight < 200) {
            $('#settings-back-image').attr('height', imgHeight);
            $('#back-img-pos').css('position', "relative");
            $('#back-img-pos').css('top', (100 - (imgHeight / 2)) + "px");
        } else {
            $('#settings-back-image').attr('height', 200);
            $('#back-img-pos').css('position', "relative");
            $('#back-img-pos').css('top', "0px");
        }
        $('#settings-back-image').attr('src', imgSrc);
    };
}

function liveSearch() {
    $('#category').css("background", "white");
    $('#browseNodeId').html("");
    $('.cat-tip').html("");
    var searchMode = $("input:radio[name ='searchMode']:checked").val();
    if (searchMode === 'topsellers' || searchMode === 'mostwished' || searchMode === 'mostgifted' || searchMode === 'newreleases') {
        $('#under-search-tip').html("For this search mode you need to specify a category. Please, select one.");
    }
    $('#browseNodeFullTitleEncoded').html("");
    $('#search-error').html("");
    $("#nodes").html("");
    $("#nodes").hide();
    $('#live-search-div').show();
    var search = $('#category').val();
    search = trim(search.toLowerCase());
    search = search.replace(/(<([^>]+)>)/ig, "");
    if (search.length > 2) {
        $("#welcome-info").hide();
        $("#live-search-loader").html("<img src='img/histloader.gif'>");
        var top = $('#category').offset().top + 10;
        var left = $('#category').offset().left + $('#category').outerWidth() - 205;
        $("#live-search-loader").css("position", "absolute");
        $("#live-search-loader").css("top", top);
        $("#live-search-loader").css("left", left);
        $("#live-search-loader").show();
        $.ajax({
            url: "catLoad.php",
            type: 'POST',
            data: {
                'search': search
            }
        }).done(function (resp) {
            $("#live-search-loader").hide();
            $('#live-search-div').html(resp);
            if (resp.indexOf('Too many matches') > 0) {
                $('#live-search-div').attr("class", "live-search-div-visible-auto-width");
                var w = $('#live-search-too-many-matches-div').width();
                $('#live-search-div').css("width", (w + 30) + "px");
                $('#live-search-too-many-matches-div').jScrollPane();
            } else if (resp.indexOf('No results for') > 0) {
                $('#live-search-div').attr("class", "live-search-div-visible-auto-width");
                var w = $('#no-res-ls-div').width();
                if (w) {
                    $('#live-search-div').css("width", (w + 30) + "px");
                } else {
                    var w_ = $('#no-res-title').width();
                    $('#live-search-div').css("width", (w_ + 30) + "px");
                }
                $('#live-search-too-many-matches-div').jScrollPane();
            } else {
                $('#live-search-div').removeAttr("class");
                $('#live-search-div').removeAttr("style");
                $('#live-search-div').attr("class", "live-search-div-visible-fixed-width");
                $('#live-search-matched-categoies').jScrollPane();
                $('#live-search-parent-categories').jScrollPane();
            }
            $('#live-search-div').show();
        });
    } else {
        $('#live-search-div').hide();
    }

}

function forceLiveSearch(key) {
    $('#category').val(key);
    liveSearch();
}

function liveSearchFilterChange(ch, labelId) {
    if (ch.checked) {
        document.getElementById(labelId).style.color = "black";
        showFiltered(ch.value);
    } else {
        document.getElementById(labelId).style.color = "graytext";
        hideFiltered(ch.value);
    }
    $('.live-search-filter-radio').each(function (index, ch) {
        ch.checked = false;
    });
    var allUnchecked = true;
    var hasChecked = false;
    $('.live-search-filter-checkbox').each(function (index, ch) {
        if (ch.checked === true) {
            allUnchecked = false;
            hasChecked = true;
        }
    });
    if (allUnchecked) {
        $('#filter-checkbox-all').html("<b>Check all</b>");
        $('#filter-checkbox-all').attr("onclick", "filterCheckAll();");
    }
    if (hasChecked) {
        $('#filter-checkbox-all').html("<b>Uncheck all</b>");
        $('#filter-checkbox-all').attr("onclick", "filterUncheckAll();");
    }
}

function hideFiltered(filterValue) {
    if (filterValue !== "") {
        $("#live-search-table td:contains-ci('" + filterValue + "')").parent("tr").hide();
    }
    $('#live-search-matched-categoies').jScrollPane();
}

function showFiltered(filterValue) {
    if (filterValue !== "") {
        $("#live-search-table td:contains-ci('" + filterValue + "')").parent("tr").show();
    }
    $('#live-search-matched-categoies').jScrollPane();
}

function filterUncheckAll() {
    $('#filter-checkbox-all').html("<b>Check all</b>");
    $('#filter-checkbox-all').attr("onclick", "filterCheckAll();");
    $('.live-search-filter-checkbox').each(function (index, ch) {
        var chIdArr = ch.id.split('-');
        ch.checked = false;
        liveSearchFilterChange(ch, 'ls-ch-lbl-' + chIdArr[2]);
    });
}

function filterCheckAll() {
    $('#filter-checkbox-all').html("<b>Uncheck all</b>");
    $('#filter-checkbox-all').attr("onclick", "filterUncheckAll();");
    $('.live-search-filter-checkbox').each(function (index, ch) {
        var chIdArr = ch.id.split('-');
        ch.checked = 'checked';
        liveSearchFilterChange(ch, 'ls-ch-lbl-' + chIdArr[2]);
    });
}

function liveSearchFilterRadioCheck(radioId, chId, chLabelId) {
    $('.live-search-filter-checkbox').each(function (index, ch) {
        ch.checked = false;
    });
    $('.live-search-filter-checkbox-label-list').each(function (index, ch) {
        if (ch.id !== chLabelId) {
            ch.style.color = "graytext";
        } else {
            ch.style.color = "black";
        }
    });
    $("#live-search-table td").parent("tr").hide();
    var filterValue = $('#' + chId).val();
    $("#live-search-table td:contains-ci('" + filterValue + "')").parent("tr").show();
    $('#live-search-matched-categoies').jScrollPane();
}

function filterReset() {
    $("#live-search-table td").parent("tr").show();
    $('.live-search-filter-checkbox').each(function (index, ch) {
        ch.checked = true;
    });
    $('.live-search-filter-checkbox-label-list').each(function (index, ch) {
        ch.style.color = "green";
    });
    $('.live-search-filter-radio').each(function (index, ch) {
        ch.checked = false;
    });
    $('#filter-radio').removeAttr("checked");
    $('#live-search-matched-categoies').jScrollPane();
}

function selectCagetory(title, nodeId, fullTitleEncoded) {
    $('#under-search-tip').html("");
    $('#category').val(title);
    var cat = decode64(fullTitleEncoded);
    var splitted = cat.split('&mdash;');
    var catSpans = [];
    for (var int = 0; int < splitted.length; int++) {
        var word = splitted[int];
        if (int !== splitted.length - 1) {
            var span = "<span onclick='switchCategoryPart(this);' class='cat-part-unselected'>" + word + "</span>&nbsp;";
        } else {
            var span = "<span onclick='switchCategoryPart(this);' class='cat-part-selected'>" + word + "</span>&nbsp;";
        }
        catSpans.push(span);
    }
    $('.cat-tip').html("<b>Current category. Click to add/switch:<br></b>&nbsp;" + catSpans.join("&mdash;"));
    $('#browseNodeId').html(nodeId);
    $('#browseNodeFullTitleEncoded').html(fullTitleEncoded);
    hideLiveSearch();
    animateTo(0);
}

function animateTo(topNumber) {
    $('html, body').animate({scrollTop: topNumber}, 'fast');
}

function switchCategoryPart(span) {
    var content = $(span).html().replace("&amp;", "&");
    var currentClass = $(span).attr("class");
    var categoryInputValue = $('#category').val();
    if (currentClass === 'cat-part-unselected') {
        $(span).removeAttr("class");
        $(span).attr("class", "cat-part-selected");
        categoryInputValue += " " + content;
    }
    if (currentClass === 'cat-part-selected') {
        $(span).removeAttr("class");
        $(span).attr("class", "cat-part-unselected");
        categoryInputValue = categoryInputValue.replace(content, "");
    }
    $('#category').val(trim(categoryInputValue));
}

function hideLiveSearch() {
    $('#live-search-div').html("");
    $('#live-search-div').hide();
}

function clearKeywordField() {
    $('#keyword').css("background", "white");
    $('#keyword').val("");
}

function clearCategoryField() {
    $('#category').css("background", "white");
    $('#category').val("");
    hideLiveSearch();
    $('.cat-tip').children('span').each(function () {
        $(this).removeAttr("class");
        $(this).attr("class", "cat-part-unselected");
    });
}


function getShortLink(link, outer, result) {
    $('#' + outer).hide();
    $('#' + result).html("<img src='img/histloader.gif' style='position:relative;top:4px;'>");
    $.ajax({
        url: "core/shortlink.php",
        type: 'POST',
        data: {
            'link': link
        }
    }).done(function (resp) {
        $('#' + result).html("<input style='height:18px;' type='text' size='20' value='" + resp + "' onclick='this.select();'>");
    });

}

function defaultPictures() {
    $('#baseItem').html("");
    $('#baseItem').hide();
    $('#itemset-default').removeAttr("class");
    $('#itemset-default').attr("class", "cat-part-selected");
    $('#itemset-big').removeAttr("class");
    $('#itemset-big').attr("class", "cat-part-unselected");
    loadItemFromPrecache('default', true, 'big', 'baseSearch');
}

function bigPictures() {
    $('#baseItem').html("");
    $('#baseItem').hide();
    $('#itemset-default').removeAttr("class");
    $('#itemset-default').attr("class", "cat-part-unselected");
    $('#itemset-big').removeAttr("class");
    $('#itemset-big').attr("class", "cat-part-selected");
    loadItemFromPrecache('big', true, 'big', 'baseSearch');
}

function itemsSortByPrice() {
    $('#baseItem').html("");
    $('#baseItem').hide();
    $('#itemset-sort-price').removeAttr("class");
    $('#itemset-sort-price').attr("class", "cat-part-selected");
    $('#itemset-sort-offers').removeAttr("class");
    $('#itemset-sort-offers').attr("class", "cat-part-unselected");
    if ($('#itemset-default').attr("class") === "cat-part-selected") {
        var imgType = 'default';
    }
    if ($('#itemset-big').attr("class") === "cat-part-selected") {
        var imgType = 'big';
    }
    loadItemFromPrecache(imgType, true, 'big', 'baseSearch', 'price');
}

function itemsSortByOffers() {
    $('#baseItem').html("");
    $('#baseItem').hide();
    $('#itemset-sort-price').removeAttr("class");
    $('#itemset-sort-price').attr("class", "cat-part-unselected");
    $('#itemset-sort-offers').removeAttr("class");
    $('#itemset-sort-offers').attr("class", "cat-part-selected");
    if ($('#itemset-default').attr("class") === "cat-part-selected") {
        var imgType = 'default';
    }
    if ($('#itemset-big').attr("class") === "cat-part-selected") {
        var imgType = 'big';
    }
    loadItemFromPrecache(imgType, true, 'big', 'baseSearch', 'offers');
}

function loadItemFromPrecache(mode, isScroll, loaderType, scrollAfter, sortType) {
    if (loaderType = 'one') {
        $('#baseSearch').html("<img src='img/loader1.gif'>");
    } else {
        $('#baseSearch').html(loaderBefore + "<span class='loader-text'>Building offers list..</span>" + loaderAfter);
    }
    $('#baseSearch').show();
    ScrollToElement(document.getElementById('baseSearch'));
    var debug = $("#debug").html();
    if (!sortType) {
        if ($('#itemset-sort-price').attr("class") === "cat-part-selected") {
            sortType = 'price';
        }
        if ($('#itemset-sort-offers').attr("class") === "cat-part-selected") {
            sortType = 'offers';
        }
    }
    $.ajax({
        url: "loaders/loadBaseItems.php",
        type: 'POST',
        data: {
            'files': currentCacheFileNames,
            'folder': 'base_search',
            'debug': debug,
            'mode': mode,
            'sort': sortType
        }
    }).done(function (response) {
        $('#baseSearch').html(response);
        $("#baseSearch").show();
        var totalItemsMatches = $('#total-items-matches-search').html();
        var totalOffersCount = $('#total-offers-count').html();
        var key = $("#item-keyword").html();
        $("#baseSearchSummary").html("<span class='welcome-info-bold'>&quot;" + key + "&quot;:</span>&nbsp;<span class='welcome-info'>" + totalItemsMatches + " results, " + totalOffersCount + " best offers, top " + baseItemsCount + " of them:</span>");
        $("#baseSearchSummary").show();
        $('#key').html(key);
        baseItemsCount = $('#found-items-count').html();
        if (fb_id > 0) {
            populateSearchArrows();
        }
        if (mode === 'default') {
            ScrollToElement(document.getElementById('baseSearch'));
            show(document.getElementById('img-inside-inline-rectangle-1'), 1, isScroll);
        }
        if (scrollAfter) {
            ScrollToElement(document.getElementById(scrollAfter));
        }
    });
}

function test() {
    $.ajax({
        url: "temp_test.php",
        type: 'POST'
    }).done(function (response) {
        console.log("Test passed");
    }).error(function (data) {
        console.log("Error. Pausing..");
        $(this).delay(2000).queue(function (nxt) {
            console.log("End pausing. Testing " + numberOfAttempts);
            test();
        });
    });
}

function sortBaseItems() {
    var rows = $('#big-items-table tr');
    rows.eq(0).find('td').sort(function (a, b) {
        return $.text([a]) > $.text([b]) ? 1 : -1;
    }).each(function (newIndex) {
        var originalIndex = $(this).index();
        rows.each(function () {
            var td = $(this).find('td');
            if (originalIndex !== newIndex)
                td.eq(originalIndex).insertAfter(td.eq(newIndex));
        });
    });
}

function bestCat(index, indexR, currentSpan) {
    for (var int = 1; int <= 41; int++) {
        $('#top-menu-' + int).removeAttr("class");
        $('#top-menu-' + int).attr("class", "top-menu-item");
    }

    $(currentSpan).removeAttr("class");
    $(currentSpan).attr("class", "top-menu-item-selected");

    $('#topItems').html("<img src='img/loader1.gif'>");
    $('#topItems').show();
    $.ajax({
        url: "getfilledcat.php",
        type: 'POST',
        data: {
            'index': index,
            'indexR': indexR
        }
    }).done(function (response) {
        $('#topItems').html(response);
        $('#top-item-content-1').find("div.top-items").each(function () {
            var encodedImageDiv = $(this).find('div.encodedImage');
            var decodedImageSpan = $(this).find('span.decodedImage');
            if ($(decodedImageSpan).html().length < 10) {
                $(decodedImageSpan).html(decode64($(encodedImageDiv).html()));
            }
        });
        bestItemQuickInfoShow();
        $('#top-items-menu-div').jScrollPane();
        ScrollToElement(document.getElementById('topItems'));
    });
}

function bestItemQuickInfoShow() {
    $('.top-items').each(function () {
        $(this).poshytip({
            className: 'tip-twitter',
            showTimeout: 1,
            alignTo: 'target',
            alignX: 'center',
            offsetY: 5,
            allowTipHover: false
        });
    });
}

function selectMenu(num) {
    $("#welcome-info").hide();
    $('.top-items-menu-selected').each(function () {
        $(this).removeAttr("class");
        $(this).attr("class", "top-items-menu-unselected");
    });
    $('#top-items-menu-span-' + num).removeAttr("class");
    $('#top-items-menu-span-' + num).attr("class", "top-items-menu-selected");
    $('#top-items-content-div > div').each(function () {
        $(this).hide();
    });
    $('#top-item-content-' + num).show();
    $('#top-item-content-' + num).find("div.top-items").each(function () {
        var encodedImageDiv = $(this).find('div.encodedImage');
        var decodedImageSpan = $(this).find('span.decodedImage');
        if ($(decodedImageSpan).html().length < 10) {
            $(decodedImageSpan).html(decode64($(encodedImageDiv).html()));
        }
    });
    bestItemQuickInfoShow();
}

function doFilterTopItemsMenu() {
    filterTableRows('top-items-menu-table', 'top-items-menu-filter');
}

function hideTopItems() {
    $('.top-items-menu-selected').each(function () {
        $(this).removeAttr("class");
        $(this).attr("class", "top-items-menu-unselected");
    });
    $('#topItems').hide();
}

function showWelcomeInfo() {
    $('#prelarge').html("<div onclick=\"hideBig('welcome-info');\" style='position: absolute; display: none; top: 0; left: 0; height: " + getDocHeight() + "px; width: " + $(window).width() + "px; background-color: #181818; filter: alpha(opacity = 90, finishopacity = 10; style =0); z-index: 998; opacity: 0.8' id='large'></div>");
    $('#large').css('display', 'inline');
    $('#welcome-info').css('position', 'absolute');
    $('#welcome-info').css('top', "0");
    $('#welcome-info').css('left', "25%");
    $('#welcome-info').show();
}

function showThanks() {
    $('#prelarge').html("<div onclick=\"hideBig('thanks');\" style='position: absolute; display: none; top: 0; left: 0; height: " + getDocHeight() + "px; width: " + $(window).width() + "px; background-color: #181818; filter: alpha(opacity = 90, finishopacity = 10; style =0); z-index: 998; opacity: 0.8' id='large'></div>");
    $('#large').css('display', 'inline');
    $('#thanks').css('position', 'absolute');
    $('#thanks').css('top', "0");
    $('#thanks').css('left', "25%");
    $('#thanks').show();
}