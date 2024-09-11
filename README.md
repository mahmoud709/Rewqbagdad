# Unisharp filemanager

### يمكنك استخراج الملفات من داخل vendor.zip واستبدال الملفات لكي يتم اصلاح بعض الاخطاء في Unisharp

### اذا قمت باستبدال الملفات لا يمكن اتباع الخطوات التاليه تكتفي فقط باستخراج الملفات فقط

### This function must be replaced in the following path
``` /vendor/unisharp/laravel-filemanager/src/Lfm.php ```

```
public function translateFromUtf8($input)
{
    $rInput = [];
    if ($this->isRunningOnWindows()) {
        if (is_array($input)) {
            foreach ($input as $k => $i) {
                $rInput[] = iconv('UTF-8', mb_detect_encoding($i), $i);
            }
        } else {
            $rInput = $input;
        }
    } else {
        $rInput = $input;
    }
    return $rInput;
}
```
### You should also delete this line => ```Route::get('/demo', 'DemoController@index');```
