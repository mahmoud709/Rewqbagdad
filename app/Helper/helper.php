<?php

function trimText($text, $length)
{

    if(appLangKey()=='ar'):
        $readMore = 'أقرأ المزيد';
    else :
        $readMore = 'Read More';
    endif;

    if ( mb_strlen($text, 'UTF-8') > $length) {
        return mb_substr($text, 0, $length, 'utf-8').'...'.'<span style="color:#045198;">'.$readMore.'</span>';
    }else {
        return $text;
    }
}

function SendMailFromCreate($content, $title, $img, $slug)
{
    \App\Models\Newsletter::whereNotNull('email_verified_at')->chunk(50, function($emails) use ($content, $title, $img, $slug) {
        dispatch(new \App\Jobs\SendFromCreateJob($emails, $content, $title, $img, $slug))->delay(now()->addSeconds(5));
    });
}

function tagify_to_array( $value ) {

    if( empty( $value ) ) {
        return $output = [];
    } else {
        // Remove squarebrackets
        $value = str_replace( ['[',']'] , '' , $value );

        // Fix escaped double quotes
        $value = str_replace( '\"', "\"" , $value );

        // Create an array of json objects
        $value = explode(',', $value);

        // Let's transform into an array of inputed values
        // Create an array
        $value_array = [];

        // Check if is array and not empty
        if ( is_array($value) && 0 !== count($value) ) {

            foreach ($value as $value_inner) {
                $value_array[] = json_decode( $value_inner );
            }
            $value_array = json_decode(json_encode($value_array), true);
            $output = array();
            foreach($value_array as $value_array_inner) {
                foreach ($value_array_inner as $key=>$val) {
                    $output[] = $val;
                }
            }
        }
        return $output;
    }

}

function SupportedLangs()
{
    return \LaravelLocalization::getSupportedLocales();
}

function SupportedKeys()
{
    return \LaravelLocalization::getSupportedLanguagesKeys();
}

function appLangKey()
{
    return \LaravelLocalization::getCurrentLocale();
}
function LangNative($key)
{
    $langs = SupportedLangs();
    return $langs[$key]['native'];
}

function arabicDate($time)
{
    $time = $time->timestamp;
    $months = ["Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"];
    $days = ["Sat" => "السبت", "Sun" => "الأحد", "Mon" => "الإثنين", "Tue" => "الثلاثاء", "Wed" => "الأربعاء", "Thu" => "الخميس", "Fri" => "الجمعة"];
    $am_pm = ['AM' => 'صباحاً', 'PM' => 'مساءً'];

    $day = $days[date('D', $time)];
    $month = $months[date('M', $time)];
    $am_pm = $am_pm[date('A', $time)];
    // $date = $day . ' ' . date('d', $time) . ' - ' . $month . ' - ' . date('Y', $time) . '   ' . date('h:i', $time) . ' ' . $am_pm;
    $date = date('d', $time) . ' / ' . $month . ' / ' . date('Y', $time); // . '   ' . date('h:i', $time) . ' ' . $am_pm;
    $numbers_ar = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    $numbers_en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    return str_replace($numbers_en, $numbers_ar, $date);
}

function formatDate($date)
{
    if( appLangKey() == 'ar' ):
        return ArabicDate($date);
    endif;
    return \Carbon\Carbon::parse($date)->format('Y / d / M');
}

function langDir($key='ar')
{
    $langs = SupportedLangs();
    switch ($langs[$key]['script']) {
        case 'Arab':
        case 'Hebr':
        case 'Mong':
        case 'Tfng':
        case 'Thaa':
        return 'rtl';
        default:
        return 'ltr';
    }
}
// ||||||||||||||||||||||||||||

function formatSizeUnits($path)
{
    $bytes = sprintf('%u', filesize($path));

    if ($bytes > 0){
        $unit = intval(log($bytes, 1024));
        $units = array('B', 'KB', 'MB', 'GB');

        if (array_key_exists($unit, $units) === true)
        {
            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
        }
    }
    return $bytes;
}

function text_shuffle($len)
{
    $text = bcrypt(time());
    $text = str_replace('$', '', $text);
    $text = str_replace('/', '', $text);
    $text = str_replace('.', '', $text);
    return str_shuffle(substr($text, 0, intval($len)));
}

function set_timezone($timezone='Africa/Cairo', $app_name="https://fb.com/alnefelys")
{
    $path = base_path('.env');
    $data = file_get_contents($path);
    $NewTimeZone = 'APP_TIMEZONE='.config('app.timezone');
    file_put_contents($path, str_replace(env('APP_NAME'), $app_name, $data));
    if (str_contains($data, $NewTimeZone)):
        file_put_contents($path, str_replace($NewTimeZone, "APP_TIMEZONE=$timezone",$data) );
    else:
        file_put_contents($path, $data.PHP_EOL.'APP_TIMEZONE='.$timezone);
    endif;
    return true;
}

function set_app_name($app_name="https://fb.com/alnefelys")
{
    $path = base_path('.env');
    file_put_contents($path, str_replace(env('APP_NAME'), $app_name, file_get_contents($path)));
    return true;
}

function langUrl($uri='/')
{
    return url(appLangKey().$uri);
}

