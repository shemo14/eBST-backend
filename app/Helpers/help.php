<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Models\Role;
//use App\Html;
//use App\Contact;
//use App\SmsEmailNotification;
use App\Models\Permission;
use App\Models\Report;

function Home()
{
	
    $colors = [
        '#8cc759','#8c6daf','#ef5d74','#f9a74b','#60beeb','#fbef5a','#FC600A','#0247FE','#FCCB1A',
        '#EA202C','#448D76','#AE0D7A','#7FBD32','#FD4D0C','#66B032','#091534','#8601AF','#C21460',
        '#FFA500','#800080','#008000','#964B00','#D2B48C','#f5f5dc','#4281A4','#48A9A6','#'
    ];
    $home =[
        [
        'name'=>'الاعضاء',
        'count'=>User::count() -1,
        'icon'=>'<i style="font-size: 90px;" class="fa fa-users"></i>',
        'color'=>$colors[array_rand($colors)],
        ],
        [
            'name'=>'المشرفين',
            'count'=>User::where('role', '>', 0)->count(),
            'icon'=>'<i style="font-size: 90px;" class="fa fa-user-circle"></i>',
            'color'=>$colors[array_rand($colors)],
        ],
        [
            'name'=>'التقارير',
            'count'=>Report::count(),
            'icon'=>'<i style="font-size: 90px" class="fa fa-flag-checkered"></i>',
            'color'=>$colors[array_rand($colors)],
        ],
    ];

    return $blocks[]=$home; 
}

#role name
function Role()
{
    $role = Role::findOrFail(Auth::user()->role);
    if(count($role) > 0)
    {
        return $role->role;
    }else{
        return 'عضو';
    }
}

#messages notification
function Notification()
{
	$messages = Contact::where('showOrNow',0)->latest()->get(); 
	return $messages;
}

#upload image base64
function save_img($base64_img, $img_name, $path)
{
	$full_path = $_SERVER['DOCUMENT_ROOT'].'/'.$path;
	$image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_img));
	$image_data;
	$source = imagecreatefromstring($image_data);
	$angle = 0;
	$rotate = imagerotate($source, $angle, 0); // if want to rotate the image
	$imageName = $img_name . '.png';
	$path_new = $full_path . '/' . $imageName;
	$imageSave = imagejpeg($rotate, $path_new, 100);
	if($imageSave)
	{
	    return true;
	}else
	{
	    return false;
	}  
}
	


#report
function addReport($user_id,$event, $ip)
{
    if ($ip == "127.0.0.1") {
        $ip = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
    }

    $location = \Location::get($ip);
	$report = new Report;
	$user = User::findOrFail($user_id);
    if($user->role > 0)
    {
        $report->user_id = $user->id;
        $report->event   = 'قام '.$user->name .' '.$event;
        $report->supervisor = 1;
        $report->ip = $ip;
        $report->country = ($location->countryCode != null) ? $location->countryCode : '';
        $report->area = ($location->regionName != null) ? $location->regionName : '';
        $report->city = ($location->cityName != null) ? $location->cityName : '';
        $report->save();
    }else
    {
        $report->user_id = $user->id;
        $report->event   = 'قام '.$user->name .' '.$event;
        $report->supervisor = 0;
        $report->ip = $ip;
        $report->country = ($location->countryName != null) ? $location->countryName : 'localhost';
        $report->area = ($location->regionName != null) ? $location->regionName : 'localhost';
        $report->city = ($location->cityName != null) ? $location->cityName : 'localhost';
        $report->save();
    }

}

#current route
function currentRoute()
{
    $routes = Route::getRoutes();
    foreach ($routes as $value)
    {
        if($value->getName() === Route::currentRouteName()) 
        {
            echo $value->getAction()['title'] ;
        }
    }
}

#email colors
function EmailColors()
{
    $html = Html::select('email_header_color','email_footer_color','email_font_color')->first();
    return $html;
}

function convert2english($string) {
    $newNumbers = range(0, 9);
    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $string =  str_replace($arabic, $newNumbers, $string);
    return $string;
}

function is_unique($key,$value){
    $user                = User::where($key , $value)->first();
    if(  $user   )
    {
        return 1;
    }
}
function generate_code() {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $token = '';
    $length = 6;
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, $charactersLength - 1)];
    }
    return $token;
}
#mobily

function send_mobile_sms($numbers, $msg) {
    include(app_path() . '/Mobily/includeSettings.php');
    $chrArray[0] = "،";
    $unicodeArray[0] = "060C";
    $chrArray[1] = "؛";
    $unicodeArray[1] = "061B";
    $chrArray[2] = "؟";
    $unicodeArray[2] = "061F";
    $chrArray[3] = "ء";
    $unicodeArray[3] = "0621";
    $chrArray[4] = "آ";
    $unicodeArray[4] = "0622";
    $chrArray[5] = "أ";
    $unicodeArray[5] = "0623";
    $chrArray[6] = "ؤ";
    $unicodeArray[6] = "0624";
    $chrArray[7] = "إ";
    $unicodeArray[7] = "0625";
    $chrArray[8] = "ئ";
    $unicodeArray[8] = "0626";
    $chrArray[9] = "ا";
    $unicodeArray[9] = "0627";
    $chrArray[10] = "ب";
    $unicodeArray[10] = "0628";
    $chrArray[11] = "ة";
    $unicodeArray[11] = "0629";
    $chrArray[12] = "ت";
    $unicodeArray[12] = "062A";
    $chrArray[13] = "ث";
    $unicodeArray[13] = "062B";
    $chrArray[14] = "ج";
    $unicodeArray[14] = "062C";
    $chrArray[15] = "ح";
    $unicodeArray[15] = "062D";
    $chrArray[16] = "خ";
    $unicodeArray[16] = "062E";
    $chrArray[17] = "د";
    $unicodeArray[17] = "062F";
    $chrArray[18] = "ذ";
    $unicodeArray[18] = "0630";
    $chrArray[19] = "ر";
    $unicodeArray[19] = "0631";
    $chrArray[20] = "ز";
    $unicodeArray[20] = "0632";
    $chrArray[21] = "س";
    $unicodeArray[21] = "0633";
    $chrArray[22] = "ش";
    $unicodeArray[22] = "0634";
    $chrArray[23] = "ص";
    $unicodeArray[23] = "0635";
    $chrArray[24] = "ض";
    $unicodeArray[24] = "0636";
    $chrArray[25] = "ط";
    $unicodeArray[25] = "0637";
    $chrArray[26] = "ظ";
    $unicodeArray[26] = "0638";
    $chrArray[27] = "ع";
    $unicodeArray[27] = "0639";
    $chrArray[28] = "غ";
    $unicodeArray[28] = "063A";
    $chrArray[29] = "ف";
    $unicodeArray[29] = "0641";
    $chrArray[30] = "ق";
    $unicodeArray[30] = "0642";
    $chrArray[31] = "ك";
    $unicodeArray[31] = "0643";
    $chrArray[32] = "ل";
    $unicodeArray[32] = "0644";
    $chrArray[33] = "م";
    $unicodeArray[33] = "0645";
    $chrArray[34] = "ن";
    $unicodeArray[34] = "0646";
    $chrArray[35] = "ه";
    $unicodeArray[35] = "0647";
    $chrArray[36] = "و";
    $unicodeArray[36] = "0648";
    $chrArray[37] = "ى";
    $unicodeArray[37] = "0649";
    $chrArray[38] = "ي";
    $unicodeArray[38] = "064A";
    $chrArray[39] = "ـ";
    $unicodeArray[39] = "0640";
    $chrArray[40] = "ً";
    $unicodeArray[40] = "064B";
    $chrArray[41] = "ٌ";
    $unicodeArray[41] = "064C";
    $chrArray[42] = "ٍ";
    $unicodeArray[42] = "064D";
    $chrArray[43] = "َ";
    $unicodeArray[43] = "064E";
    $chrArray[44] = "ُ";
    $unicodeArray[44] = "064F";
    $chrArray[45] = "ِ";
    $unicodeArray[45] = "0650";
    $chrArray[46] = "ّ";
    $unicodeArray[46] = "0651";
    $chrArray[47] = "ْ";
    $unicodeArray[47] = "0652";
    $chrArray[48] = "!";
    $unicodeArray[48] = "0021";
    $chrArray[49]='"';
    $unicodeArray[49] = "0022";
    $chrArray[50] = "#";
    $unicodeArray[50] = "0023";
    $chrArray[51] = "$";
    $unicodeArray[51] = "0024";
    $chrArray[52] = "%";
    $unicodeArray[52] = "0025";
    $chrArray[53] = "&";
    $unicodeArray[53] = "0026";
    $chrArray[54] = "'";
    $unicodeArray[54] = "0027";
    $chrArray[55] = "(";
    $unicodeArray[55] = "0028";
    $chrArray[56] = ")";
    $unicodeArray[56] = "0029";
    $chrArray[57] = "*";
    $unicodeArray[57] = "002A";
    $chrArray[58] = "+";
    $unicodeArray[58] = "002B";
    $chrArray[59] = ",";
    $unicodeArray[59] = "002C";
    $chrArray[60] = "-";
    $unicodeArray[60] = "002D";
    $chrArray[61] = ".";
    $unicodeArray[61] = "002E";
    $chrArray[62] = "/";
    $unicodeArray[62] = "002F";
    $chrArray[63] = "0";
    $unicodeArray[63] = "0030";
    $chrArray[64] = "1";
    $unicodeArray[64] = "0031";
    $chrArray[65] = "2";
    $unicodeArray[65] = "0032";
    $chrArray[66] = "3";
    $unicodeArray[66] = "0033";
    $chrArray[67] = "4";
    $unicodeArray[67] = "0034";
    $chrArray[68] = "5";
    $unicodeArray[68] = "0035";
    $chrArray[69] = "6";
    $unicodeArray[69] = "0036";
    $chrArray[70] = "7";
    $unicodeArray[70] = "0037";
    $chrArray[71] = "8";
    $unicodeArray[71] = "0038";
    $chrArray[72] = "9";
    $unicodeArray[72] = "0039";
    $chrArray[73] = ":";
    $unicodeArray[73] = "003A";
    $chrArray[74] = ";";
    $unicodeArray[74] = "003B";
    $chrArray[75] = "<";
    $unicodeArray[75] = "003C";
    $chrArray[76] = "=";
    $unicodeArray[76] = "003D";
    $chrArray[77] = ">";
    $unicodeArray[77] = "003E";
    $chrArray[78] = "?";
    $unicodeArray[78] = "003F";
    $chrArray[79] = "@";
    $unicodeArray[79] = "0040";
    $chrArray[80] = "A";
    $unicodeArray[80] = "0041";
    $chrArray[81] = "B";
    $unicodeArray[81] = "0042";
    $chrArray[82] = "C";
    $unicodeArray[82] = "0043";
    $chrArray[83] = "D";
    $unicodeArray[83] = "0044";
    $chrArray[84] = "E";
    $unicodeArray[84] = "0045";
    $chrArray[85] = "F";
    $unicodeArray[85] = "0046";
    $chrArray[86] = "G";
    $unicodeArray[86] = "0047";
    $chrArray[87] = "H";
    $unicodeArray[87] = "0048";
    $chrArray[88] = "I";
    $unicodeArray[88] = "0049";
    $chrArray[89] = "J";
    $unicodeArray[89] = "004A";
    $chrArray[90] = "K";
    $unicodeArray[90] = "004B";
    $chrArray[91] = "L";
    $unicodeArray[91] = "004C";
    $chrArray[92] = "M";
    $unicodeArray[92] = "004D";
    $chrArray[93] = "N";
    $unicodeArray[93] = "004E";
    $chrArray[94] = "O";
    $unicodeArray[94] = "004F";
    $chrArray[95] = "P";
    $unicodeArray[95] = "0050";
    $chrArray[96] = "Q";
    $unicodeArray[96] = "0051";
    $chrArray[97] = "R";
    $unicodeArray[97] = "0052";
    $chrArray[98] = "S";
    $unicodeArray[98] = "0053";
    $chrArray[99] = "T";
    $unicodeArray[99] = "0054";
    $chrArray[100] = "U";
    $unicodeArray[100] = "0055";
    $chrArray[101] = "V";
    $unicodeArray[101] = "0056";
    $chrArray[102] = "W";
    $unicodeArray[102] = "0057";
    $chrArray[103] = "X";
    $unicodeArray[103] = "0058";
    $chrArray[104] = "Y";
    $unicodeArray[104] = "0059";
    $chrArray[105] = "Z";
    $unicodeArray[105] = "005A";
    $chrArray[106] = "[";
    $unicodeArray[106] = "005B";
    $char="\ ";
    $chrArray[107]=trim($char);
    $unicodeArray[107] = "005C";
    $chrArray[108] = "]";
    $unicodeArray[108] = "005D";
    $chrArray[109] = "^";
    $unicodeArray[109] = "005E";
    $chrArray[110] = "_";
    $unicodeArray[110] = "005F";
    $chrArray[111] = "`";
    $unicodeArray[111] = "0060";
    $chrArray[112] = "a";
    $unicodeArray[112] = "0061";
    $chrArray[113] = "b";
    $unicodeArray[113] = "0062";
    $chrArray[114] = "c";
    $unicodeArray[114] = "0063";
    $chrArray[115] = "d";
    $unicodeArray[115] = "0064";
    $chrArray[116] = "e";
    $unicodeArray[116] = "0065";
    $chrArray[117] = "f";
    $unicodeArray[117] = "0066";
    $chrArray[118] = "g";
    $unicodeArray[118] = "0067";
    $chrArray[119] = "h";
    $unicodeArray[119] = "0068";
    $chrArray[120] = "i";
    $unicodeArray[120] = "0069";
    $chrArray[121] = "j";
    $unicodeArray[121] = "006A";
    $chrArray[122] = "k";
    $unicodeArray[122] = "006B";
    $chrArray[123] = "l";
    $unicodeArray[123] = "006C";
    $chrArray[124] = "m";
    $unicodeArray[124] = "006D";
    $chrArray[125] = "n";
    $unicodeArray[125] = "006E";
    $chrArray[126] = "o";
    $unicodeArray[126] = "006F";
    $chrArray[127] = "p";
    $unicodeArray[127] = "0070";
    $chrArray[128] = "q";
    $unicodeArray[128] = "0071";
    $chrArray[129] = "r";
    $unicodeArray[129] = "0072";
    $chrArray[130] = "s";
    $unicodeArray[130] = "0073";
    $chrArray[131] = "t";
    $unicodeArray[131] = "0074";
    $chrArray[132] = "u";
    $unicodeArray[132] = "0075";
    $chrArray[133] = "v";
    $unicodeArray[133] = "0076";
    $chrArray[134] = "w";
    $unicodeArray[134] = "0077";
    $chrArray[135] = "x";
    $unicodeArray[135] = "0078";
    $chrArray[136] = "y";
    $unicodeArray[136] = "0079";
    $chrArray[137] = "z";
    $unicodeArray[137] = "007A";
    $chrArray[138] = "{";
    $unicodeArray[138] = "007B";
    $chrArray[139] = "|";
    $unicodeArray[139] = "007C";
    $chrArray[140] = "}";
    $unicodeArray[140] = "007D";
    $chrArray[141] = "~";
    $unicodeArray[141] = "007E";
    $chrArray[142] = "©";
    $unicodeArray[142] = "00A9";
    $chrArray[143] = "®";
    $unicodeArray[143] = "00AE";
    $chrArray[144] = "÷";
    $unicodeArray[144] = "00F7";
    $chrArray[145] = "×";
    $unicodeArray[145] = "00F7";
    $chrArray[146] = "§";
    $unicodeArray[146] = "00A7";
    $chrArray[147] = " ";
    $unicodeArray[147] = "0020";
    $chrArray[148] = "\n";
    $unicodeArray[148] = "000D";
    $chrArray[149] = "\r";
    $unicodeArray[149] = "000A";
    $strResult = "";
    for($i=0; $i<strlen($msg); $i++)
    {
        if(in_array(mb_substr($msg,$i,1,'UTF-8'), $chrArray))
            $strResult.= $unicodeArray[array_search(mb_substr($msg,$i,1,'UTF-8'), $chrArray)];
    }
    $mobile = "966550007652";
    $password = "asd555asd";
    $sender = "AAIT.SA";


    $MsgID = rand(1, 99999);
    $first_val = substr($numbers, 0, 1);
    if ($first_val == "0") {
        $numbers = substr($numbers, 1, 9);
    }
    global $arraySendMsg;
    $applicationType = "68";
    $msg = $strResult;
    $sender = urlencode($sender);
    $domainName = $_SERVER['SERVER_NAME'];
    $contextPostValues = http_build_query(array('mobile'=>$mobile, 'password'=>$password, 'numbers'=>'00966'.$numbers, 'sender'=>$sender, 'msg'=>$msg, 'timeSend'=>0, 'dateSend'=>0, 'applicationType'=>$applicationType, 'domainName'=>$domainName, 'msgId'=>$MsgID));
    $contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/x-www-form-urlencoded', 'content'=> $contextPostValues, 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
    $contextResouce  = stream_context_create($contextOptions);
    $url = "http://www.mobily.ws/api/msgSend.php";
    $arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
    $result = $arrayResult[0];
    // if($viewResult)
    $result = printStringResult(trim($result), $arraySendMsg);
    if ($result) {
        return true;
    } else {
        return false;
    }
}
function upload_img($base64_img ,$path) {
    $file     = base64_decode($base64_img);
    $safeName = str_random(10) . '.' . 'png';
    file_put_contents($path . $safeName, $file);
    return $safeName;
}