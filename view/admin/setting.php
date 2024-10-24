<h1 style="margin: 30px 0 ">صفحه تنظیمات پلاگین</h1>


<div style="width: 90%;height: 100%;background-color: #fff;padding: 30px;">
    <form action="" method="post"
          style="display: flex;justify-content: center;align-items: center;flex-direction:column ">
        <h2>به کلمات زیر کلمات مورد نظر خود را طبق این فرمت ضافه کنید: معادل انگلیسی,کلمه مورد نظر(نیاز به گداشتن | برای
            آخرین کلمه نمیباشد)</h2>
        <textarea name="filter_word" id="" style="width: 100%" rows="10"
                  placeholder="کلماتی که میخواهید به لینک تبدیل شوند را وارد کنید و آنها را با کاما (,) از هم جدا کنید"><?php
            $array = get_option('_wl_words');
            $str="";
            foreach ($array as $key => $value) {
               $str =$str."$key,$value|";
            }
//            $final_str=rtrim($str,'|');
//            echo $str;
            echo trim(rtrim($str,'|'));
            ?>
        </textarea>
        <div style="width:100%;display: flex;justify-content: end; align-items: center">
            <div >
                <label for="category">کتگوری را انتخاب کنید</label>
                <select id="category" name="category">
                    <option value="category">category</option>
                </select>
            </div>
            <input type="submit" value="ذخیره" name="btn-submit"
                   style="background-color: #00ba37;margin: 20px auto;padding: 15px 30px ;border: none;color: #fff;border-radius: 5px;font-size: 18px;cursor: pointer">
        </div>
    </form>
</div>
