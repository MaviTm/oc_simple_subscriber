# EN
You can create only subscription lists that do not have the ability to send mail or sms.
Communication applications (mail, sms, etc.) and subscriber requests to record id.
Allows you to create custom subscription lists for each page for blog or similar applications.

You can customize the "content_type" and "content_id" fields to your own, these fields are optional. You can use your pages to have separate subscription.

# TR
Mail veya sms gönderme özelliği bulunmayan sadece abonelik listeleri oluşturabilirsiniz.   
Haberleşme uygulamaları (mail, sms, vb.) id leri ile abone isteklerini kayıt altına alır.  
Blog veya benzeri uygulamalar için her sayfaya özel abonelik listeleri oluşturmanıza imkan sağlar.  

"content_type" ve "content_id" alanlarını kendinize göre özelleştirebilirsiniz, bu alanlar opsiyoneldir. Sayfalarınıza ayrı ayrı abonelik olmasını isterseniz kullanabilirsiniz.

--------------

# EN
You can install it form backend plugins install section of your site by searching "**mavitm simple subscriber**".
In the cms part, add **Subscriber Component*** to your layouts or pages. If you are pushing a custom subscription to the page, use the **content_id** part manually or with request values like **:id** or **:slug**. This is a nice way to mark your current page. You can specify the **content_type** field for which model you obtained with **content_id**.

# TR
Sitenizin backend plugins install bölümün de mavitm simple subscriber aratarak kurulumu yapabilirsiniz.
cms kısmın da layouts veya sayfalarınıza ** Subscriber Component ** ekleyin. Eğer sayfaya özel bir abonelik itiyorsanız ** content_id ** kısmını manuel veya **:id** yada **:slug** şeklinde request değerleri ile kullanın. Bu işlem bulunduğunuz sayfayı işaretlemek için güzel bir yöntemdir. ** content_type ** alanını **content_id** ile edindiğiniz değerin hangi model için olduğunu belirtebilirsiniz.

# component default html codes

```html
<form class="form-horizontal" data-request="onMavitmSubscriberRequest" data-request-flash="">
    {{ form_token() }}
    <div class="form-group">
        <div class="input-group">
            <span class="news">newsletter</span>
            <input  value="" name="subscribe_data" id="subscribe_data" placeholder="Email" type="text">
            <button class="btn btn-news" type="submit" value="submit">Subscribe Now</button>
        </div>
    </div>
</form>
```
# if you want to add an inactive record

You can do this by adding the **accepts** value

```html
<form class="form-horizontal" data-request="onMavitmSubscriberRequest" data-request-flash="">
    {{ form_token() }}
    <div class="form-group">
        <div class="input-group">
            <span class="news">newsletter</span>
            <input type="hidden" name="accepts" value="0">
            <input  value="" name="subscribe_data" id="subscribe_data" placeholder="Email" type="text">
            <button class="btn btn-news" type="submit" value="submit">Subscribe Now</button>
        </div>
    </div>
</form>
```

# If you want to register according to the user's own choice

This is also useful for unsubscribing by  user's own request.
```html
<form class="form-horizontal" data-request="onMavitmSubscriberRequest" data-request-flash="">
    {{ form_token() }}
    <div class="form-group">
        <div class="input-group">
            <span class="news">newsletter</span>
            <select name="accepts">
                        <option value="1">Subscribe</option>
                        <option value="0">Unsubscribe</option>
            </select>
            <input  value="" name="subscribe_data" id="subscribe_data" placeholder="Email" type="text">
            <button class="btn btn-news" type="submit" value="submit">Subscribe Now</button>
        </div>
    </div>
</form>
```

# events
```php
Event::fire('mavitm.subscription.beforeSaveRecord', [&$model, $this]);
Event::fire('mavitm.subscription.afterSaveRecord', [&$model, $this]);
```
