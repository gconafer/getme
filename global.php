<?php
define('COUNTRY_ID', 1);
if(isset($_COOKIE['city_id'])) {
	$POP_UP = 0;
	$cityId = base64_decode($_COOKIE['city_id']);
	define('CITY_ID', $cityId);
} else {
	$POP_UP = 1;
	define('CITY_ID', 1);
}

define('MAIN_URL', ABS_URL.'/coaching-institutes');
define('ABS_JS_URL', ABS_URL.'/assets/js');
define('ABS_CSS_URL', ABS_URL.'/assets/css');
define('ABS_IMG_URL', ABS_URL.'/assets/img');
define('ABS_ICON_URL', ABS_URL.'/assets/img/icon');
define('ABS_C_IMG_URL', DASH_URL.'/assets/img/courses_image');
define('ABS_T_IMG_URL', DASH_URL.'/assets/img/teacher_image');
define('ABS_I_IMG_URL', DASH_URL.'/assets/img/instituate_image');
define('URL_DEFINE', '-coaching');
define('RECORD_PER_PAGE', 10);
define('BLOG_URL', ABS_URL.'/blog');
define('LOGIN_URL', ABS_URL);

// SMTP Credential
define('SMTP_PORT', 465);
define('SMTP_HOST', 'tls://email-smtp.us-west-2.amazonaws.com');
define('SMTP_USERNAME', 'AKIAJOYKO3E6TGPKPWCA');
define('SMTP_PASSWORD', 'Ar53Fh15H9ts2wgtGh14/XEzv7xmSO73GvIEuU5uanLj');

$AVTAR_IMG_Array = array('red', 'orange', 'teal', 'pink', 'blue', 'amber', 'light-blue', 'light-green', 'brown', 'blue-grey');
$TEST_LEVEL = array(1 => 'Easy', 2 => 'Medium', 3 => 'Hard');
$VALID_FORMATS = array("jpg", "jpeg", "JPG", "JPEG","gif","GIF");

$sector = array('Sectors','Advertising','Aeronautics/Aerospace','Agriculture','AI','Analytics','Animation','AR/VR (Augmented / Virtual Reality)','Architecture','Art & Photography','Automotive','Beauty','Big Data','Blockchain','Careers','Communication','Computer Vision','Construction','Consumer Goods','Dating/Matrimonial','Defence','Design','Education','Energy & Sustainability','Enterprise Software','Events','Fashion','FinTech','Food & Beverages','Gaming','Gifting','Grocery','Hardware','Healthcare','Human Resources','Information/Tech','Internet of Things','IT Services','Legal','Logistics','Manufacturing','Marketing','Media & Entertainment','Nanotechnology','Networking','Pets & Animals','Printing','Real Estate','Retail','Robotics','Safety','Security','Services','Social Impact','Social Network','Sports','Storage','Transportation','Travel & Tourism');
$stage = array('ideation','proof of concept','beta launched','early revenues','steady revenues');
$type_of_startup = array('Type of Startup','Tech Based','Service Based','Mixture of both');
$Avg_monthly_revenue = array('0','0-2 Lakhs','2-5 Lakhs','5-10 Lakhs','10-15 Lakhs','15-20 Lakhs','20-30 Lakhs','30-50 Lakhs','50-80 Lakhs','80-100 Lakhs','1-5 Cr','5-10 Cr','>10 Cr');
$total_revenue_till_now = array('0','0-2 Lakhs','2-5 Lakhs','5-10 Lakhs','10-15 Lakhs','15-20 Lakhs','20-30 Lakhs','30-50 Lakhs','50-80 Lakhs','80-100 Lakhs','1-5 Cr','5-10 Cr','>10 Cr');
$expected_monthly_revenue_in_next_5_years = array('0','0-2 Lakhs','2-5 Lakhs','5-10 Lakhs','10-15 Lakhs','15-20 Lakhs','20-30 Lakhs','30-50 Lakhs','50-80 Lakhs','80-100 Lakhs','1-5 Cr','5-10 Cr','>10 Cr');
$amount_wants_to_raise = array('<50K','50K-100K','1-2 Lakhs','2-5 Lakhs','5-10 Lakhs','10-15 Lakhs','15-20 Lakhs','20-30 Lakhs','30-50 Lakhs','50-80 Lakhs','80-100 Lakhs','1-5 Cr','5-10 Cr','>10 Cr');
$equity_diluted_for_above_amount = array('0-2%','2-5%','5-8%','8-10%','10-15%','15-20%','20-25%','25-30%','30-40%','40-50%','50-60%','60-70%','70-80%','80-90%','90-100%');
$funding_raised_already = array('No','Angel Funding','Seed Funding','Others');
$Amount_Invested_already = array('0-2 Lakhs','2-5 Lakhs','5-10 Lakhs','10-15 Lakhs','15-20 Lakhs','20-30 Lakhs','30-50 Lakhs','50-80 Lakhs','80-100 Lakhs','1-5 Cr','5-10 Cr','>10 Cr');
$Suggested_Tags = array('Consulting','Consumer Internet','E-commerce','Engineering','Enterprise Mobility','Government','Hyperlocal','Location Based Services','Marketplace','Mobile','Offline','Online Aggregator','Peer to Peer','Platform','Rental','Research','SaaS','Sharing Economy','Subscription Commerce','AdTech','Online Classified','Drones','UX','E-learning','Renewable','Cloud','Weddings','Fashion','Crowdfunding','Restaurants','Mobile games','Social Gifting','Solar','Event Management','Renewable','Wind','Nuclear Energy','ERP','CXM','SCM','Customer Collaboration','Location Based','Enterprise Mobility','Dairy','Farming','Organic','Agriculture','Agri-Tech','Food Processing','Machine Learning','NLP','Business Intelligence','Interior Design','E-mail','Messaging','Handicraft Art Photography','Consumer Electronics','Food','Microbrewery','Jewellery','Bitcoin','Counselling','Telecom','Toys','Home Appliances','Garden products','Books','Home Decor','Furniture','FMCG','Technology','Lifestyle','Apparel','Fan','Payments Point','Sales','Payment platforms','Trading','Billing','Embedded Semiconductor','Medical','Recruitment/Jobs','Search','Smart','IT','Loyalty','Digital','Housing','Retail','Personal','Personal','NGO','Taxi','Holiday','Electronics','3d','printing','Devices/Biomedical','Health & Wellness','Pharmaceutical','Biotechnology','Healthcare Services','Healthcare','IT','Healthcare Technology','Home','Wearables','Consulting','BPO','KPO','Web Development','Product development','Application Development','Branding','Digital Marketing','Marketing','(SEO/Automation)','Discovery','Sales','Market Research','Testing','IT Management','Project Management','Media','News','Digital Media','Social Media','Media','Entertainment','Blogging','Publishing','Movies','OOH','Coworking','Technology','Social Commerce','Comparison','Shopping','Security','Laundry','Baby Care','Home Care','Corporate','Social Responsibility','Car Rentals','Hotel','Travel','Ticketing','Hospitality','Facility Management');




















?>