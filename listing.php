<?php
/*-------------------     Include File Start      ---------------*/

include_once("config.php");
include_once("global.php");
// include_once("./class/blog_class.php");
// include_once("./class/join_class.php");
// include_once("./class/common_class.php");
// include_once("./class/teacher_class.php");
// include_once("./class/gallery_class.php");
// include_once("./class/instituate_class.php");
// include_once("./class/city_master_class.php");
// include_once("./class/child_category_class.php");
// include_once("./class/location_master_class.php");

/*-------------------     Include File End      ---------------*/

/*-------------------     Class Object Start      ---------------*/

// $BlogDBLink = BlogDBConnection();
// $Blog = new Blog();

// $Join = new Join();
// $Common = new Common();
// $Teacher = new Teacher();
// $Gallery = new Gallery();
// $Instituate = new Instituate();
// $cityMaster = new City_Master();
// $childCategory = new Child_Category();
// $locationMaster = new Location_Master();

/*-------------------     Class Object End      ---------------*/

// if(!isset($_GET) || (empty($_GET['q']))) {
//     $url = ABS_URL.'/';
//     header("Location: $url");
//     die();
// } else {
//     $q = trim($_GET['q']);
//     $substr = URL_DEFINE.'-in-';
//     if (strpos($q, $substr) !== false) 
//     {
//         $pageNumber = $type = 1;
//         $subStringArray = explode($substr, $q);
        
//         // Pagination Logic in Url to show pagination
//         if(strpos($subStringArray[1], '-') !== false) {
//             $indexArray = explode('-', $subStringArray[1]);
//             $lastvalue = array_values(array_slice($indexArray, -1))[0];
//             if(is_numeric($lastvalue)) {
//                 $pageNumber = $lastvalue;
//                 $locationUrl = str_replace('-'.$pageNumber, "", $subStringArray[1]);
//             } else {
//                 $locationUrl = $subStringArray[1];
//             }
//         } else {
//             $locationUrl = $subStringArray[1];
//         }
        
//         $pageUrl = MAIN_URL.'/'.$subStringArray[0].URL_DEFINE.'-in-'.$locationUrl;
//         $locationArray = $Join->getIdOfLocationCityFromUrl($locationUrl, COUNTRY_ID);
//         $categoryArray = $childCategory->getDetailOfCategoryUrl($subStringArray[0], COUNTRY_ID);
//         $relatedCourseArray = $childCategory->getParentandChildCourses($categoryArray['category_id'], $categoryArray['parent_id']);
        
//         // To get CityId and LocationId Instituate list
//         $offSetValue = ($pageNumber - 1)*RECORD_PER_PAGE;  
//         if(trim($locationUrl) === trim($locationArray[0]['curl'])) {
//             $locType = 1;
//             $locId = $locationArray[0]['cid'];
//             $locationName = $locationArray[0]['cname'];
//             $CountofInstituate = $Join->getCountOfInstituateCityId($categoryArray['id'], $locationArray[0]['cid']);
//             $instituateListArray = $Join->getInstituateCourseListCityId($categoryArray['id'], $locationArray[0]['cid'], $offSetValue, RECORD_PER_PAGE);
//             $nearbyInstituateArray = $Instituate->getInstituateByCity($categoryArray['id'], $locationArray[0]['cid'], COUNTRY_ID);
//             $pageTitle = $Common->checkStringSanitize($categoryArray['name'])." Coaching in ".$Common->checkStringSanitize($locationName)." | Online Test Series - IBPS, SBI, SSC, RRB, RBI | Ecoaching.guru";
//             $pageDesc = $Common->checkStringSanitize($categoryArray['name'])." Coaching in ".$Common->checkStringSanitize($locationName)."; Get Online Demo Class for ".$Common->checkStringSanitize($categoryArray['name'])." Coaching on Ecoaching.guru; Free Mock Tests - Bank PO, Clerk, SSC CGL, CHSL, JE, GATE, Insurance, Railways, IBPS RRB, SBI, RBI, IPPB, BSNL TTA";
//         } else {
//             $locType = 2;
//             $locId = $locationArray[0]['lid'];
//             $locationName = $locationArray[0]['lname'];
//             $CountofInstituate = $Join->getCountOfInstituateLocationId($categoryArray['id'], $locationArray[0]['lid']);
//             $instituateListArray = $Join->getInstituateCourseListLocationId($categoryArray['id'], $locationArray[0]['lid'], $offSetValue, RECORD_PER_PAGE);
//             $nearbyInstituateArray = $Instituate->getInstituateByPincode($categoryArray['id'], $locationArray[0]['lpincode'], $locationArray[0]['lid'], COUNTRY_ID);
//             $nearbyLocationArray = $Instituate->getNearByLocation($locationArray[0]['lpincode'], $locationArray[0]['lid']);
//             $pageTitle = $Common->checkStringSanitize($categoryArray['name'])." Coaching in ".$Common->checkStringSanitize($locationName).", ".$Common->checkStringSanitize($locationArray[0]['cname'])." | Online Test Series - IBPS, SBI, SSC, RRB, RBI | Ecoaching.guru";
//             $pageDesc = $Common->checkStringSanitize($categoryArray['name'])." Coaching in ".$Common->checkStringSanitize($locationName).", ".$Common->checkStringSanitize($locationArray[0]['cname'])."; Get Online Demo Class for ".$Common->checkStringSanitize($categoryArray['name'])." on Ecoaching.guru; Free Mock Tests - Bank PO, Clerk, SSC CGL, CHSL, JE, GATE, Insurance, Railways, IBPS RRB, SBI, RBI, IPPB, BSNL TTA";
//         }

//         /*-------------------  Page Specific Variable ---------------*/        
//         $ogTitle = $pageTitle;
//         $ogType = "website";
//         $ogUrl = MAIN_URL."/".$q;
//         $ogSiteName = "Ecoaching.guru";
//         $ogDesc = $pageDesc;
//         $ogImage = ABS_IMG_URL."/logo.png";
//         $ogImageHeight = 200;
//         $ogImageWidth = 150;

//         //echo "<pre>";  echo $CountofInstituate; print_r($nearbyLocationArray);die();
//     } else {
//         $type = 2;
//         $instituateArray = $Instituate->getInstituateCourses(1, $q);
//         $galleryArray = $Gallery->getGalleryByInstituateId($instituateArray['Iid']);
//         $TeacherArray = $Teacher->getTeacherByInstituateId($instituateArray['Iid']);
//         $similarInstituateArray = $Instituate->getSimilarInstituate($instituateArray['Iid'], $instituateArray['pincode'], $instituateArray['cid'], COUNTRY_ID);

//         /*-------------------  Page Specific Variable ---------------*/
//         $pageTitle = $Common->checkStringSanitize($instituateArray['name'])." in ".$Common->checkStringSanitize($instituateArray['location']).", ".$Common->checkStringSanitize($instituateArray['city'])." | Online Test Series - IBPS, SBI, SSC, RRB, RBI | Ecoaching.guru";
//         $pageDesc = $Common->checkStringSanitize($instituateArray['name'])." ".$Common->checkStringSanitize($instituateArray['city'])."; ".$Common->checkStringSanitize($instituateArray['name']).", ".$Common->checkStringSanitize($instituateArray['location'])."; ";
//         $Array = explode(',', $instituateArray['cname']);
//         foreach ($Array as $key => $value) {
//             $pageDesc.=$value." Coaching from ".$Common->checkStringSanitize($instituateArray['name'])." in ".$Common->checkStringSanitize($instituateArray['city']).";";
//         }
//         $pageDesc.=" Get Online Demo Class form ".$Common->checkStringSanitize($instituateArray['name'])." on Ecoaching.guru; Free Mock Tests - Bank PO, Clerk, SSC CGL, CHSL, JE, GATE, Insurance, Railways, IBPS RRB, SBI, RBI, IPPB, BSNL TTA;";
//         $ogTitle = $pageTitle;
//         $ogType = "website";
//         $ogUrl = MAIN_URL."/".$q;
//         $ogSiteName = "Ecoaching.guru";
//         $ogDesc = $pageDesc;
//         if(!empty($galleryArray)) {
//             $ogImage = ABS_IMG_URL."/".$galleryArray[0]['url'];
//             $ogImageHeight = 400;
//             $ogImageWidth = 300;
//         }

//         //echo '<pre>'; echo $pageTitle.'#####'.$pageDesc;print_r($instituateArray); print_R($TeacherArray); print_r($similarInstituateArray); die();
//     }
// }

// $cityDetailArray = $cityMaster->getDetailOfCity(CITY_ID);
// $cityUrl = $cityDetailArray['url'];
// $cityName = ucwords($cityDetailArray['name']);
// $latestBlogArray = $Blog->getLatestBlog($BlogDBLink);
// $countAvtar = count($AVTAR_IMG_Array);

?>

<?php include_once("layout/header.php"); ?>
</header>
<style type="text/css">
.cd-accordion-menu ul {
  display: none;
}
.cd-accordion-menu input[type=checkbox] {
  position: absolute;
  opacity: 0;
}
.cd-accordion-menu label, .cd-accordion-menu a {
  position: relative;
  display: block;
}

.cd-accordion-menu label::after {
  /* folder icons */
  left: 41px;
  background-position: -16px 0;
}

.cd-accordion-menu input[type=checkbox]:checked + label + ul,
.cd-accordion-menu input[type=checkbox]:checked + label:nth-of-type(n) + ul {
  /* use label:nth-of-type(n) to fix a bug on safari (<= 8.0.8) with multiple adjacent-sibling selectors*/
  /* show children when item is checked */
  display: block;
}
</style>
<?php if($type == 1 || 1) { ?>

<div class="action-header affix-top hide">
    <div class="container">
        <div class="action-header__item action-header__item--search">
            <form>
                <input class="hidden-xs" placeholder="Search by neighborhood, city, zip or address..." type="text"><!-- For desktop -->
                <input class="visible-xs" placeholder="Search..." type="text"><!-- For mobile -->
            </form>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <header class="section__title">
            <?php 
            if($locType == 1) {
                echo "<h1>".$Common->checkStringSanitize($categoryArray['name'])." Coaching in ".$Common->checkStringSanitize($locationName)."</h1>";
            } elseif ($locType == 2) {
                echo "<h1>".$Common->checkStringSanitize($categoryArray['name'])." Coaching in ".$Common->checkStringSanitize($locationName).", ".$Common->checkStringSanitize($locationArray[0]['cname'])."</h1>";
            }
            ?>
            <small><a href="<?=ABS_URL?>"><i class="zmdi zmdi-long-arrow-left"></i> back</a></small>
        </header>

        <div class="row">
            <div class="col-sm-8 listings-list">

            <div class="listings-grid__item">
            <a href="<?=MAIN_URL?>/<?=$value['unique_url']?>" class="media">
                        <div class="listings-grid__main pull-left">
                            <a href="<?=MAIN_URL?>/<?=$value['unique_url']?>">
                                <img style="width:120px;height:120px;" src="<?=ABS_I_IMG_URL?>/<?=$image?>" alt="Test">
                            </a>
                            <div class="listings-grid__price"><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>">View More</a></div>
                        </div>

                        <div class="media-body">
                            <div class="listings-grid__body">
                                <h4><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>">Test</a></h4>
                                <small><b>Courses:</b> <?=$courseArray['cname']?></small>
                                <small><i class="zmdi zmdi-pin"></i>&nbsp;<?=$value['address']?></small>
                            </div>
                            <ul class="list-group__attrs" style="padding-left:20px;">
                                <div><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Courses</a></div>
                                <div><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><i class="zmdi zmdi-accounts-alt zmdi-hc-fw"></i>Faculty</a></div>
                                <div><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><i class="zmdi zmdi-star zmdi-hc-fw"></i>Reviews</a></div>
                            </ul>
                        </div>
                    </a>
                <div class="actions listings-grid__favorite">
                        <div class="actions__toggle">
                            <input type="checkbox">
                            <i class="zmdi zmdi-favorite-outline"></i>
                            <i class="zmdi zmdi-favorite"></i>
                        </div>
                    </div>
            </div>

            <div class="listings-grid__item">
            <a href="<?=MAIN_URL?>/<?=$value['unique_url']?>" class="media">
                        <div class="listings-grid__main pull-left">
                            <a href="<?=MAIN_URL?>/<?=$value['unique_url']?>">
                                <img style="width:120px;height:120px;" src="<?=ABS_I_IMG_URL?>/<?=$image?>" alt="Test">
                            </a>
                            <div class="listings-grid__price"><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>">View More</a></div>
                        </div>

                        <div class="media-body">
                            <div class="listings-grid__body">
                                <h4><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>">Test</a></h4>
                                <small><b>Courses:</b> <?=$courseArray['cname']?></small>
                                <small><i class="zmdi zmdi-pin"></i>&nbsp;<?=$value['address']?></small>
                            </div>
                            <ul class="list-group__attrs" style="padding-left:20px;">
                                <div><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Courses</a></div>
                                <div><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><i class="zmdi zmdi-accounts-alt zmdi-hc-fw"></i>Faculty</a></div>
                                <div><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><i class="zmdi zmdi-star zmdi-hc-fw"></i>Reviews</a></div>
                            </ul>
                        </div>
                    </a>
                <div class="actions listings-grid__favorite">
                        <div class="actions__toggle">
                            <input type="checkbox">
                            <i class="zmdi zmdi-favorite-outline"></i>
                            <i class="zmdi zmdi-favorite"></i>
                        </div>
                    </div>
            </div>
            
            <!-- <?php 
            if(is_array($instituateListArray) && !empty($instituateListArray)) {
                foreach ($instituateListArray as $key => $value) { 
                    $courseArray = $Instituate->getInstituateCourses(1, $value['unique_url']);
                    if(empty($value['i_image_url'])) $image = 'noimage.png'; else $image = $value['i_image_url'];
            ?> -->
                <div class="listings-grid__item">
                    <a href="<?=MAIN_URL?>/<?=$value['unique_url']?>" class="media">
                        <div class="listings-grid__main pull-left">
                            <a href="<?=MAIN_URL?>/<?=$value['unique_url']?>">
                                <img style="width:120px;height:120px;" src="<?=ABS_I_IMG_URL?>/<?=$image?>" alt="<?=$Common->checkStringSanitize($value['name'])?>">
                            </a>
                            <div class="listings-grid__price"><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>">Test</a></div>
                        </div>

                        <div class="media-body">
                            <div class="listings-grid__body">
                                <h4><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><?=$Common->checkStringSanitize($value['name'])?></a></h4>
                                <small><b>Courses:</b> <?=$courseArray['cname']?></small>
                                <small><i class="zmdi zmdi-pin"></i>&nbsp;<?=$value['address']?></small>
                            </div>
                            <ul class="list-group__attrs" style="padding-left:20px;">
                                <div><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Courses</a></div>
                                <div><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><i class="zmdi zmdi-accounts-alt zmdi-hc-fw"></i>Faculty</a></div>
                                <div><a href="<?=MAIN_URL?>/<?=$value['unique_url']?>"><i class="zmdi zmdi-star zmdi-hc-fw"></i>Reviews</a></div>
                            </ul>
                        </div>
                    </a>
                </div>
                <!-- <?php } ?> -->
                <!-- <?php echo $Common->paginationList($CountofInstituate, RECORD_PER_PAGE, $pageNumber, $pageUrl); ?> -->
            <!-- <?php } else { ?>        -->
                <div class="listings-grid__item"><center><h2>No Record Foundd!<h2></center></div>
            <!-- <?php } ?> -->
            </div>

            <aside class="col-sm-4 hidden-xs">
                <form id="inquiryForm" class="card hidden-print">
                    <div class="card__header">
                    <?php 
                    if($locType == 1) {
                        echo "<h4>Inquire about ".$Common->checkStringSanitize($categoryArray['name'])." Coaching in ".$Common->checkStringSanitize($locationName)."</h4>";
                    } elseif ($locType == 2) {
                        echo "<h4>Inquire about ".$Common->checkStringSanitize($categoryArray['name'])." Coaching in ".$Common->checkStringSanitize($locationName).", ".$Common->checkStringSanitize($locationArray[0]['cname'])."</h4>";
                    }
                    ?>
                        <small>Call us now or send us your query</small>
                    </div>

                    <div id="formBody" class="card__body">
                        <div class="inquire__number">
                            <i class="zmdi zmdi-phone"></i>
                            +91-9560807518
                        </div>

                        <div class="form-group form-group--float">
                            <input id="name" name="name" class="form-control" type="text">
                            <label>Name</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="form-group form-group--float">
                            <input id="email" name="email" class="form-control" type="text">
                            <label>Email Address</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="form-group form-group--float">
                            <input id="contact_no" name="contact_no" class="form-control" type="text">
                            <label>Contact Number</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <p style="color:red;" id = "errorMsgD"></p>
                        <input type="hidden" id="type" name="type" value="<?=$locType?>">
                        <input type="hidden" id="flowtype" name="flowtype" value="1">
                        <input type="hidden" id="instituate_id" name="instituate_id" value="0">
                        <input type="hidden" id="category_id" name="category_id" value="<?=$Common->checkStringSanitize($categoryArray['id'])?>">
                        <input type="hidden" id="location_id" name="location_id" value="<?=$Common->checkStringSanitize($locId)?>">
                        <input type="hidden" id="value1" name="value1" value="">
                        <input type="hidden" id="value2" name="value2" value="">
                        <input type="hidden" id="value3" name="value3" value="">
                    </div>

                    <div id="formFooter" class="card__footer">
                        <button type="submit" class="btn btn-primary">Send Query</button>
                    </div>
                </form>

                <?php if(is_array($nearbyInstituateArray) && !empty($nearbyInstituateArray)) { ?>
                <div class="card hidden-xs hidden-sm hidden-print">
                    <div class="card__header">
                        <h2>You may also like...</h2>
                        <?php if($locType == 1) { ?>
                            <small>Popular <b><?=$Common->checkStringSanitize($categoryArray['name'])?> Coaching</b> in <b><?=$Common->checkStringSanitize($locationName)?></b></small>
                        <?php } elseif ($locType == 2) { ?>
                            <small>Popular <b><?=$Common->checkStringSanitize($categoryArray['name'])?> Coaching</b> near by <b><?=$Common->checkStringSanitize($locationName)?>, <?=$Common->checkStringSanitize($locationArray[0]['cname'])?></b></small>
                        <?php } ?>
                        
                    </div>

                    <div class="list-group">
                    <?php foreach ($nearbyInstituateArray as $key => $value) { 
                            if(empty($value['i_image_url'])) $image = 'noimage.png'; else $image = $value['i_image_url'];
                    ?>
                        <a href="<?=MAIN_URL?>/<?=$value['unique_url']?>" class="list-group-item media">
                            <div class="pull-left">
                                <img style="width:65px;height:65px;" src="<?=ABS_I_IMG_URL?>/<?=$image?>"" alt="<?=$Common->checkStringSanitize($value['name'])?>" class="list-group__img">
                            </div>
                            <div class="media-body list-group__text">
                                <strong><?=$value['name']?></strong>
                                <small><i class="zmdi zmdi-pin"></i>&nbsp;<?=$value['address']?></small>
                            </div>
                        </a>
                    <?php } ?>

                        <div class="p-10"></div>
                    </div>
                </div>
                <?php } ?>

                <?php if(!empty($nearbyLocationArray)) { ?>
                    <div class="card hidden-xs hidden-sm hidden-print">
                        <?php if($locType == 1) { ?>
                            <div class="card__header"><h2><?=$Common->checkStringSanitize($categoryArray['name'])?> Coaching in <?=$Common->checkStringSanitize($locationName)?></h2></div>
                        <?php } elseif ($locType == 2) { ?>
                            <div class="card__header"><h2><?=$Common->checkStringSanitize($categoryArray['name'])?> Coaching near by <?=$Common->checkStringSanitize($locationName)?>, <?=$Common->checkStringSanitize($locationArray[0]['cname'])?></h2></div>
                        <?php } ?>
                        <div class="list-group">
                            <?php
                            $html = '<ul class="main-navigation">';
                            foreach ($nearbyLocationArray as $key => $value) {
                                $html.='<li><a href="'.MAIN_URL.'/'.$categoryArray['url'].URL_DEFINE.'-in-'.$value['url'].'">'.$Common->checkStringSanitize($value['name']).' ('.$value['count'].')</a></li>';
                            }
                            $html.= '</ul>';
                            echo $html;
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="card hidden-xs hidden-sm hidden-print">
                    <div class="card__header"><h2>Related Courses...</h2></div>
                    <div class="list-group">
                        <?php 
                        foreach ($relatedCourseArray as $key => $value) {
                            if(!$value['parent_id']) {
                                $Array[$value['id']]['name'] = $value['name']; 
                                $Array[$value['id']]['url'] = $value['url'];
                            } else {
                                $Array[$value['parent_id']][0][$value['id']]['name'] = $value['name']; 
                                $Array[$value['parent_id']][0][$value['id']]['url'] = $value['url'];
                            }
                        }
                        
                        $html = '<ul class="cd-accordion-menu animated">';
                        foreach ($Array as $key => $value) {
                            $html.='<li class="has-children"><input type="checkbox" name ="group-'.$key.'" id="group-'.$key.'" checked><label for="group-'.$key.'"><a href="'.MAIN_URL.'/'.$value['url'].URL_DEFINE.'-in-'.$locationUrl.'">'.$Common->checkStringSanitize($value['name']).'</a></label><ul>';
                            foreach ($value[0] as $k => $v) {
                                $html.='<li><a href="'.MAIN_URL.'/'.$v['url'].URL_DEFINE.'-in-'.$locationUrl.'">'.$Common->checkStringSanitize($v['name']).'</a></li>';
                            }
                            $html.='</ul></li>';
                        }
                        $html.= '</ul>';
                        echo $html;
                        ?>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</section>

<?php } elseif ($type == 2) { ?>

<section class="section">
    <div class="container">
        <header class="section__title section__title-alt">
            <h1><?=$Common->checkStringSanitize($instituateArray['name'])?></h1>
            <small><?=$Common->checkStringSanitize($instituateArray['address'])?></small>

            <div class="actions actions--section">
                <div class="dropdown">
                    <a href="" data-toggle="dropdown"><i class="zmdi zmdi-share"></i></a>

                    <div class="dropdown-menu pull-right rmd-share">
                        <div class="jssocials">
                            <div class="jssocials-shares">
                                <div class="jssocials-share jssocials-share-facebook rmds-item mdc-bg-indigo-400 animated bounceIn">
                                    <a target="_blank" href="<?=MAIN_URL.$instituateArray['unique_url']?>" class="jssocials-share-link">
                                        <i class="zmdi zmdi-facebook jssocials-share-logo"></i>
                                        <span class="jssocials-share-label"></span>
                                    </a>

                                    <div class="jssocials-share-count-box jssocials-share-no-count">
                                        <span class="jssocials-share-count"></span>
                                    </div>
                                </div>
                                
                                <div class="jssocials-share jssocials-share-twitter rmds-item mdc-bg-cyan-500 animated bounceIn">
                                    <a target="_blank" href="<?=MAIN_URL.$instituateArray['unique_url']?>" class="jssocials-share-link">
                                        <i class="zmdi zmdi-twitter jssocials-share-logo"></i>
                                        <span class="jssocials-share-label"></span>
                                    </a>

                                    <div class="jssocials-share-count-box jssocials-share-no-count">
                                        <span class="jssocials-share-count"></span>
                                    </div>
                                </div>

                                <div class="jssocials-share jssocials-share-googleplus rmds-item mdc-bg-red-400 animated bounceIn">
                                    <a target="_blank" href="<?=MAIN_URL.$instituateArray['unique_url']?>" class="jssocials-share-link">
                                        <i class="zmdi zmdi-google jssocials-share-logo"></i>
                                        <span class="jssocials-share-label"></span>
                                    </a>

                                    <div class="jssocials-share-count-box jssocials-share-no-count">
                                        <span class="jssocials-share-count"></span>
                                    </div>
                                </div>

                                <div class="jssocials-share jssocials-share-linkedin rmds-item mdc-bg-blue-600 animated bounceIn">
                                    <a target="_blank" href="<?=MAIN_URL.$instituateArray['unique_url']?>" class="jssocials-share-link">
                                        <i class="zmdi zmdi-linkedin jssocials-share-logo"></i>
                                        <span class="jssocials-share-label"></span>
                                    </a>

                                    <div class="jssocials-share-count-box jssocials-share-no-count">
                                        <span class="jssocials-share-count"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="detail-media">
                        <div class="tab-content">
                            <?php if(!empty($galleryArray)) { ?>
                                <div class="tab-pane fade light-gallery" id="detail-media-images">
                                <?php
                                foreach ($galleryArray as $key => $value) {
                                    if($value['type'] == 1) {
                                        echo '<a href="'.ABS_I_IMG_URL.'/'.$value['url'].'"><center><img style="width:800px;height:400px;"src="'.ABS_I_IMG_URL.'/'.$value['url'].'"></center></a>';
                                    } elseif ($value['type'] == 2) {
                                        $videoUrl = str_replace("watch?v=", "embed/", $value['url']);
                                    }
                                }
                                ?>
                                </div>
                            <?php } ?>
                            <?php if($videoUrl) { ?>
                                <div class="tab-pane fade light-gallery" id="detail-media-floorplan">
                                    <a href="<?=ABS_URL?>/assets/img/loading.gif">
                                        <iframe width="800" height="400" src="<?=$videoUrl?>" frameborder="0" allowfullscreen></iframe>
                                    </a>
                                </div>
                            <?php } ?>
                            <div class="tab-pane fade light-gallery active in" id="detail-media-map">
                                <iframe style = 'border:0; margin-top:-150px;' width = '100%' height = '600' frameborder = '0' scrolling = 'no' marginheight = '0' marginwidth = '0' src = 'https://maps.google.com/maps?&q=<?=rawurlencode($instituateArray['map_address'])?>&output=embed'></iframe>
                            </div>
                        </div>
                    </div>

                    <ul class="detail-media__nav hidden-print">
                        <li title="Institute Map" class="active"><a href="#detail-media-map" data-toggle="tab" aria-expanded="false"><i class="zmdi zmdi-map"></i></a></li>
                        <?php if(!empty($galleryArray)) { ?>
                            <li title="Institute Gallery" class=""><a href="#detail-media-images" data-toggle="tab" aria-expanded="true"><i class="zmdi zmdi-collection-image"></i></a></li>
                        <?php } ?>
                        <?php if($videoUrl) { ?>
                            <li title="Institute Demo Video" class=""><a href="#detail-media-floorplan" data-toggle="tab" aria-expanded="false"><i class="zmdi zmdi-play-circle"></i></a></li>
                        <?php } ?>
                        
                    </ul>

                    <div class="detail-info">

                        <ul class="detail-info__list clearfix">
                            <li>
                                <span>Running Since</span>
                                <span><?php if($instituateArray['founded']) { echo $instituateArray['founded']; } else { echo 'N/A'; } ?></span>
                            </li>
                            <li>
                                <span>Number of Running Batches</span>
                                <span><?php if($instituateArray['avg_no_batches']) { echo $instituateArray['avg_no_batches']; } else { echo 'N/A'; } ?></span>
                            </li>
                            <li>
                                <span>Number of Teachers</span>
                                <span><?php if($instituateArray['no_of_teachers']) { echo $instituateArray['no_of_teachers']; } else { echo 'N/A'; } ?></span>
                            </li>
                            <li>
                                <span>Average Batch Size</span>
                                <span><?php if($instituateArray['avg_batch_size']) { echo $instituateArray['avg_batch_size']; } else { echo 'N/A'; } ?></span>
                            </li>
                            <li>
                                <span>Average Teacher Experience</span>
                                <span><?php if($instituateArray['avg_teacher_exp']) { echo $instituateArray['avg_teacher_exp']; } else { echo 'N/A'; } ?></span>
                            </li>
                            <li>
                                <span style="width:110px;">Working Days</span>
                                <span><?php if(!empty($instituateArray['working_days'])) { echo $instituateArray['working_days']; } else { echo 'N/A'; } ?></span>
                            </li>
                            <?php if(!empty($instituateArray['website_url'])) { ?>
                                <li>
                                    <span>Official Website</span>
                                    <span><a target="_blank" href="<?=$instituateArray['website_url']?>"><i class="zmdi zmdi-laptop zmdi-hc-2x"></i></a></span>
                                </li>
                            <?php } ?>
                            <?php if(!empty($instituateArray['fb_page_url'])) { ?>
                                <li>
                                    <span>Social Links</span>
                                    <span><a target="_blank" href="<?=$instituateArray['fb_page_url']?>"><i class="zmdi zmdi-facebook zmdi-hc-2x"></i></a></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="card detail-amenities">
                    <div class="card__header">
                        <div class="list-group__header text-left">
                            <h2>Courses offered:</h2>
                        </div>
                    </div>

                    <div class="card__body">
                        <ul class="detail-amenities__list">
                        <?php
                        if(stripos($instituateArray['cname'], ',') !== false) {
                            $Array = explode(',', $instituateArray['cname']);
                            foreach ($Array as $k => $v) {
                                $index = $k%$countAvtar;
                                echo '<li class="mdc-bg-'.$AVTAR_IMG_Array[$index].'-400">'.trim(ucwords($v)).'</li>&nbsp;&nbsp;';
                            }
                        } else {
                            echo '<li class="mdc-bg-red-400">'.$instituateArray['cname'].'</li>';
                        }
                        ?>
                        </ul>
                    </div>
                </div>

                <div class="card detail-amenities">
                    <div class="card__header">
                        <div class="list-group__header text-left">
                            <h2>Amenities :</h2>
                        </div>
                    </div>

                    <div class="card__body">
                        <ul class="detail-amenities__list">
                        <?php
                        if($instituateArray['study_material']) {
                            echo '<li class="mdc-bg-red-300"><i class="zmdi zmdi-check-all hidden-xs"></i>&nbsp;study material</li>';
                        }
                        if ($instituateArray['test_series']) {
                            echo '&nbsp;&nbsp;<li class="mdc-bg-teal-400"><i class="zmdi zmdi-check-all hidden-xs"></i>&nbsp;test series</li>';
                        }
                        if ($instituateArray['online_portal']) {
                            echo '&nbsp;&nbsp;<li class="mdc-bg-purple-300"><i class="zmdi zmdi-check-all hidden-xs"></i>&nbsp; online portal</li>';
                        }
                        if ($instituateArray['ac']) {
                            echo '&nbsp;&nbsp;<li class="mdc-bg-light-blue-500"><i class="zmdi zmdi-check-all hidden-xs"></i>&nbsp;ac</li>';
                        }
                        if ($instituateArray['wifi']) {
                            echo '&nbsp;&nbsp;<li class="mdc-bg-red-300"><i class="zmdi zmdi-check-all hidden-xs"></i>&nbsp;wifi</li>';
                        }
                        if ($instituateArray['pick_and_drop']) {
                            echo '&nbsp;&nbsp;<li class="mdc-bg-light-green-500"><i class="zmdi zmdi-check-all hidden-xs"></i>&nbsp;pick and drop</li>';
                        }
                        if ($instituateArray['library']) {
                            echo '&nbsp;&nbsp;<li class="mdc-bg-blue-grey-400"><i class="zmdi zmdi-check-all hidden-xs"></i>&nbsp;library</li>';
                        }
                        ?>
                        <br /><br />
                        <?php
                        if(!$instituateArray['study_material']) {
                            echo '<li class="mdc-bg-red-300"><i class="zmdi zmdi-close hidden-xs"></i>&nbsp;study material</li>&nbsp;&nbsp;';
                        }
                        if (!$instituateArray['test_series']) {
                            echo '<li class="mdc-bg-teal-400"><i class="zmdi zmdi-close hidden-xs"></i>&nbsp;test series</li>&nbsp;&nbsp;';
                        }
                        if (!$instituateArray['online_portal']) {
                            echo '<li class="mdc-bg-purple-300"><i class="zmdi zmdi-close hidden-xs"></i>&nbsp; online portal</li>&nbsp;&nbsp;';
                        }
                        if (!$instituateArray['ac']) {
                            echo '<li class="mdc-bg-light-blue-500"><i class="zmdi zmdi-close hidden-xs"></i>&nbsp;ac</li>&nbsp;&nbsp;';
                        }
                        if (!$instituateArray['wifi']) {
                            echo '<li class="mdc-bg-red-300"><i class="zmdi zmdi-close hidden-xs"></i>&nbsp;wifi</li>&nbsp;&nbsp;';
                        }
                        if (!$instituateArray['pick_and_drop']) {
                            echo '<li class="mdc-bg-light-green-500"><i class="zmdi zmdi-close hidden-xs"></i>&nbsp;pick and drop</li>&nbsp;&nbsp;';
                        }
                        if (!$instituateArray['library']) {
                            echo '<li class="mdc-bg-blue-grey-400"><i class="zmdi zmdi-close hidden-xs"></i>&nbsp;library</li>';
                        }
                        ?>
                        </ul>
                    </div>
                </div>

                <?php if(!empty($instituateArray['description'])) { ?>
                <div class="card">
                    <div class="card__header">
                        <div class="list-group__header text-left">
                            <h2>About Instituate :</h2>
                        </div>
                    </div>
                    <div class="card__body">
                        <p><?=$instituateArray['description']?></p>
                    </div>
                </div>
                <?php } ?>

                <?php if(is_array($TeacherArray) && !empty($TeacherArray)) { ?>
                <div class="list-group list-group--block card">
                    <div class="card__header">
                        <div class="list-group__header text-left">
                            <h2>Faculty :</h2>
                        </div>
                    </div>
                    <?php foreach ($TeacherArray as $key => $value) {
                                $index = $value['id']%$countAvtar;
                                if(!empty($value['designation'])) {
                                    $name = $value['designation'].' '.$value['first_name'].' '.$value['last_name'];
                                } else {
                                    $name = $value['first_name'].' '.$value['last_name'];
                                }
                    ?>
                    <div class="list-group-item media">
                        <div class="pull-left">
                        <?php if(!empty(trim($value['image']))) { ?>
                            <img src="<?=ABS_T_IMG_URL?>/<?=$value['image']?>" alt="<?=$name?>" class="list-group__img" width="60">
                        <?php } else { ?>
                            <div class="pull-left">
                                <div class="avatar-char mdc-bg-<?=$AVTAR_IMG_Array[$index]?>-400"><?=strtoupper($value['first_name'][0])?></div>
                            </div>
                        <?php } ?>
                        </div>

                        <div class="media-body list-group__text">
                            <strong><a href="#"><?=ucfirst($name)?></a></strong>
                            <small><b>Experience:</b>&nbsp;<?php if($value['experience']) echo $value['experience']; else echo 'N/A'; ?> Years,&nbsp;<b>Qualification:</b>&nbsp;<?php if($value['qualtification']) echo $value['qualtification']; else echo 'N/A'; ?></small>
                            <small><b>Subjects:</b> <?=$value['subject']?></small>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>

            </div>

            <div id="inquire" class="col-md-4 rmd-sidebar-mobile">
                <form id="inquiryForm" class="card hidden-print">
                    <div class="card__header">
                        <h2>Inquire about this Instituate</h2>
                        <small>Call us now or send us your query</small>
                    </div>

                    <div id="formBody" class="card__body">
                        <div class="inquire__number">
                            <i class="zmdi zmdi-phone"></i>
                            +91-9560807518
                        </div>

                        <div class="form-group form-group--float">
                            <input id="name" name="name" class="form-control" type="text">
                            <label>Name</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="form-group form-group--float">
                            <input id="email" name="email" class="form-control" type="text">
                            <label>Email Address</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="form-group form-group--float">
                            <input id="contact_no" name="contact_no" class="form-control" type="text">
                            <label>Contact Number</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <p style="color:red;" id = "errorMsgD"></p>
                        <input type="hidden" id="type" name="type" value="3">
                        <input type="hidden" id="flowtype" name="flowtype" value="1">
                        <input type="hidden" id="instituate_id" name="instituate_id" value="<?=$Common->checkStringSanitize($instituateArray['id'])?>">
                        <input type="hidden" id="category_id" name="category_id" value="">
                        <input type="hidden" id="location_id" name="location_id" value="">
                        <input type="hidden" id="value1" name="value1" value="">
                        <input type="hidden" id="value2" name="value2" value="">
                        <input type="hidden" id="value3" name="value3" value="">
                    </div>

                    <div id="formFooter" class="card__footer">
                        <button type="submit" class="btn btn-primary">Send Query</button>
                    </div>
                </form>

                <?php if(is_array($similarInstituateArray) && !empty($similarInstituateArray)) { 
                        if(empty($value['i_image_url'])) $image = 'noimage.png'; else $image = $value['i_image_url'];
                ?>
                <div class="card hidden-xs hidden-sm hidden-print">
                    <div class="card__header">
                        <h2>Similar Instituate...</h2>
                        <small>Institute like <b><?=$Common->checkStringSanitize($instituateArray['name'])?></b> near by <b><?=$Common->checkStringSanitize($instituateArray['location'])?></b></small>
                    </div>

                    <div class="list-group">
                    <?php foreach ($similarInstituateArray as $key => $value) { ?>
                        <a href="<?=MAIN_URL?>/<?=$value['unique_url']?>" class="list-group-item media">
                            <div class="pull-left">
                                <img src="<?=ABS_I_IMG_URL?>/<?=$image?>" alt="" class="list-group__img" width="65">
                            </div>
                            <div class="media-body list-group__text">
                                <strong><?=$value['name']?></strong>
                                <small title="<?=$value['address']?>"><i class="zmdi zmdi-pin"></i>&nbsp;<?=$value['address']?></small>
                            </div>
                        </a>
                    <?php } ?>
                        <div class="p-10"></div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</section>

<?php } ?>

<script type="text/javascript">

$(document).ready(function() {

    var abs_url = '<?=ABS_URL?>';
    var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    $(document).on("submit", "form#inquiryForm", function() {
        var name = $('#name').val();
        var email = $('#email').val();
        var type = $('#type').val();
        var contact_no = $('#contact_no').val();
        var flowtype = $('#flowtype').val();
        var instituate_id = $('#instituate_id').val();
        var category_id = $('#category_id').val();
        var location_id = $('#location_id').val();
        var value1 = $('#value1').val();
        var value2 = $('#value2').val();
        var value3 = $('#value3').val();
        if(!name) {
            $('#errorMsgD').text('Please enter name');
        } else if (!email) {
            $('#errorMsgD').text('Please enter email');
        } else if (!regEx.test(email)) {
            $('#errorMsgD').text('Please enter valid email');
        } else if (!contact_no) {
            $('#errorMsgD').text('Please enter conatct no');
        } else {
            $.post(abs_url+"/controller/common_controller.php", {name:name, email:email, contact_no:contact_no, flowtype:flowtype, type:type, instituate_id:instituate_id, category_id:category_id, location_id:location_id, value1:value1, value2:value2, value3:value3},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    $('#formBody').html('');
                    $('#formFooter').html('');
                    $('#formBody').html('<div class="submit-property__success"><i style="margin-left:30%;" class="zmdi zmdi-check"></i><h2 style="margin-left:10%;">Successfully Submitted!</h2></div>');
                } else {
                    $('#errorMsgD').text('Something went wrong.');
                }
            });
        }
        return false;
    });

    var accordionsMenu = $('.cd-accordion-menu');
    if( accordionsMenu.length > 0 ) {
        accordionsMenu.each(function() {
            var accordion = $(this);
            accordion.on('change', 'input[type="checkbox"]', function() {
                var checkbox = $(this);
                (checkbox.prop('checked')) ? checkbox.siblings('ul').attr('style','display:none;').slideDown(300) : checkbox.siblings('ul').attr('style', 'display:block;').slideUp(300);
            });
        });
    }

});    

</script>

<?php include_once("layout/footer.php"); ?>