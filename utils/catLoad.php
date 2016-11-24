<?php
function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);
    if ($pos !== false) {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

//$file = 'allCategories';
$file = 'new';
$searchfor = $_POST['search'];

if ($searchfor) {
    $contents = file_get_contents($file);

    $pattern = preg_quote($searchfor, '/');
    $pattern = "/^.*$pattern.*\$/m";
    $res1 = preg_match_all($pattern, $contents, $matches);

    $patternReverse = preg_quote(implode(' ', array_reverse(explode(' ', $searchfor))), '/');
    $patternReverse = "/^.*$patternReverse.*\$/m";
    $res2 = preg_match_all($patternReverse, $contents, $matches2);

    $result = "></div>";

    if ($res1 || $res2) {
        if (count($matches[0]) > 1000 || count($matches2[0]) > 1000) {
            $result .= "<table>";
            $merged = array_merge($matches[0], $matches2[0]);
            $uniqueCategories_ = array();
            foreach ($merged as $match) {
                $s1 = explode("***", $match);
                $s2 = explode(":::", $s1[0]);
                foreach ($s2 as $c) {
                    if (strpos($c, $searchfor) !== false) {
                        $categoryWithMatching = $c;
                    }
                }
                $highlightedCategory = str_replace($searchfor, "<b>$searchfor</b>", $categoryWithMatching);
                array_push($uniqueCategories_, ucwords($highlightedCategory));
            }
            $uniqueCategories = array_unique($uniqueCategories_);
            sort($uniqueCategories);
            $tip = "<div id=\"live-search-too-many-matches-div\" style=\"height:412px;overflow:auto;\"><table class=\"live-search-many-matches-table\">";
            foreach ($uniqueCategories as $cat) {
                $tip .= "<tr><td onclick=\"forceLiveSearch('" . strip_tags($cat) . "');\"><span class=\"live-search-category-many\">" . $cat . "</span></td></tr>";
            }
            $tip .= "</table></div>";
            $result .= "<tr><td><span class=\"live-search-category-title\">Too many matches.<br>What it might mean:</span><br><br>$tip</td></tr>";
        } else {
            $merged_ = array_merge($matches[0], $matches2[0]);
            $merged = array_unique($merged_);
            $result .= "<table width=\"100%\"><tr><td valign=\"top\" width=\"70%\">";
            $result .= "<div id=\"live-search-matched-categoies\" style=\"height:412px;overflow:auto;\"><table class=\"live-search-table\" id=\"live-search-table\">";
            $parentCategoies_ = array();
            foreach ($merged as $match) {
                $result .= handleMatches($match);
                $parentC = getParentCategory($match);
                if ($parentC) {
                    array_push($parentCategoies_, $parentC);
                }
                $parentCategoies = array_count_values($parentCategoies_);
                $parentCategoriesDiv = "Live search on this matches:<br><input style=\"width:100%;\" type=\"text\" id=\"ls-exclude\" onkeyup=\"filterTableRows('live-search-table', 'ls-exclude');\"><br><br><span onclick=\"filterUncheckAll();\" id=\"filter-checkbox-all\" class=\"example-search\" style=\"position:relative;bottom:2px;\"><b>Uncheck all</b></span>&nbsp;&nbsp;&nbsp;" .
                    "<span onclick=\"filterReset();\" id=\"filter-checkbox-reset\" class=\"example-search\" style=\"position:relative;bottom:2px;\"><b>Reset to default</b></span>" .
                    "<br><div id=\"live-search-parent-categories\" style=\"height:325px; overflow:auto; border:none;\"><br><table>";
                $countCh = 1;
                foreach ($parentCategoies as $key => $value) {
                    $parentCategoriesDiv .=
                        "<tr><td align=\"left\"><span style=\"margin-left:3px;\"><input type=\"radio\" style=\"display:none;\"" .
                        "onchange=\"liveSearchFilterRadioCheck('filter-radio-$countCh', 'filter-checkbox-$countCh', 'ls-ch-lbl-$countCh');\"" .
                        "class=\"live-search-filter-radio\"" .
                        "id=\"filter-radio-$countCh\"" .
                        "name=\"filter-radio\">" .
                        "<label class=\"live-search-filter-checkbox-label\" for=\"filter-radio-$countCh\"><span class=\"radio-span\"><img src=\"img/circle-green.png\"></span></label></span>" .
                        "<span style=\"margin-left:3px;\"><input type=\"checkbox\"" .
                        "checked=\"true\"" .
                        "onchange=\"liveSearchFilterChange(this, 'ls-ch-lbl-$countCh');\"" .
                        "class=\"live-search-filter-checkbox\"" .
                        "id=\"filter-checkbox-$countCh\"" .
                        "name=\"filter-checkbox-$countCh\"" .
                        "value=\"$key\"><" .
                        "label class=\"live-search-filter-checkbox-label\" for=\"filter-checkbox-$countCh\"><span class=\"checkbox-span\"><img src=\"img/mark.png\"></span><span class=\"live-search-filter-checkbox-label-list\" id=\"ls-ch-lbl-$countCh\">" . $key . "</span></label></span>" .
                        "</td></tr>";
                    $countCh++;
                }
                $parentCategoriesDiv .= "</table><div>";
                $filterTable = "<div>$parentCategoriesDiv</div>";
            }
            $result .= "</table></div></td>" .
                "<td valign=\"top\" width=\"30%\">" .
                "<div style=\"margin-left:10px;\">$filterTable</div>" .
                "</td></tr></table>";
        }
    } else {
        $fileLines = explode("\n", $contents);
        $distances = array();
        foreach ($fileLines as $line) {
            $s1 = explode("***", $line);
            $s2 = explode(":::", $s1[0]);
            $str = $s2[count($s2) - 1];
            //$distances[$distance] = str_replace(":::", "&mdash;", $s1[0]);
            $distance = levenshtein($str, $searchfor);
            $distances[$str] = $distance;
        }
        asort($distances);
        $count = 1;
        $limit = 14;
        foreach ($distances as $key => $value) {
            if ($count == $limit) {
                break;
            }
            if ($value > 0 && $value <= 4) {
                if (strlen($key) > 2) {
                    $mostSimilarWord .= "<span class=\"live-search-category-tip\" onclick=\"forceLiveSearch('" . $key . "');\">$key</span><br>";
                    $count++;
                }
            }
        }
        $additions = "";
        if ($mostSimilarWord) {
            $additions = "<br><span id=\"no-res-ls-div\" class=\"live-search-category-title\">However, maybe you are looking for:<br><br>" . $mostSimilarWord;
        }
        $result .= "<tr><td><span id=\"no-res-title\" class=\"live-search-category-title\">No results for <font style=\"color:red\">$searchfor</font></span>$additions</td></tr>";
        $result .= "</table>";
    }
    echo $result;
}

function handleMatches($match)
{
    $result = "";
    $splittedCategoryString = explode("***", $match);
    $rawCategory = $splittedCategoryString[0];
    $browseNodeId = $splittedCategoryString[1];
    $result .= "<tr>";
    $categoryParts = explode(":::", $rawCategory);
    $path = "";
    for ($index = 0; $index <= count($categoryParts) - 2; $index++) {
        $path .= ucwords($categoryParts[$index]) . "&mdash;";
    }
    $path_ = str_lreplace("&mdash;", "", $path);
    $lastPart = ucwords($categoryParts[count($categoryParts) - 1]);
    $result .= "<td align=\"left\" style=\"position:relative;padding-bottom:10px;\" onclick=\"selectCagetory('$lastPart', $browseNodeId, '" . base64_encode($path_ . "&mdash;" . $lastPart) . "');\"><span class=\"live-search-category-title\">$lastPart</span><br><span class=\"live-search-category-path\">$path_</span></td>";
    $result .= "</tr>";
    return $result;
}

function getParentCategory($match)
{
    $splittedCategoryString = explode("***", $match);
    $rawCategory = $splittedCategoryString[0];
    $browseNodeId = $splittedCategoryString[1];
    $categoryParts = explode(":::", $rawCategory);
    return $categoryParts[0];
}

function getSubParentCategory($match)
{
    $splittedCategoryString = explode("***", $match);
    $rawCategory = $splittedCategoryString[0];
    $browseNodeId = $splittedCategoryString[1];
    $categoryParts = explode(":::", $rawCategory);
    $result = "";
    if (count($categoryParts >= 2)) {
        $result = $categoryParts[1];
    }
    return $result;
}

?>