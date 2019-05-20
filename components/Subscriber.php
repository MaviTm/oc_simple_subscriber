<?php namespace Mavitm\Subscription\Components;

use Lang, Flash, Redirect, Request, Session;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Event;
use Mavitm\Subscription\Models\Subtype;
use October\Rain\Exception\ApplicationException;

class Subscriber extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Subscriber Component',
            'description' => 'Form application for subscribers'
        ];
    }

    public function defineProperties()
    {
        return [
            'subType' => [
                'title'       => 'mavitm.subscription::lang.subscriber.subtype',
                'type'        => 'dropdown',
            ],
            'content_type' => [
                'title'       => 'mavitm.subscription::lang.subscriber.content_type',
                'description' => 'mavitm.subscription::lang.subscriber.content_type_desc',
                'type'        => 'string',
            ],
            'content_id' => [
                'title'       => 'mavitm.subscription::lang.subscriber.content_id',
                'description' => 'mavitm.subscription::lang.subscriber.content_id_desc',
                'default'     => '{{ :slug }}',
                'type'        => 'string',
            ],
            'validateEmail' => [
                'title'       => 'mavitm.subscription::lang.component.validateEmail',
                'type'        => 'checkbox',
            ],
        ];
    }

    public function getSubTypeOptions()
    {
        return Subtype::all()->lists("name", "id");
    }

    public function onRun()
    {
        $this->page['mavitm_subscriber_subtype'] = $this->property("subType");
        $this->page['mavitm_subscriber_content_type'] = $this->property("content_type");
        $this->page['mavitm_subscriber_content_id'] = $this->property("content_id");
    }

    public function onMavitmSubscriberRequest()
    {
        if (Session::token() != post('_token')) {
            throw new ApplicationException(Lang::get('mavitm.subscription::lang.component.csrf_error'));
        }

        if(!input("subscribe_data", 0))
        {
            throw new ApplicationException(Lang::get('mavitm.subscription::lang.component.empty_error'));
        }

        if($this->property("validateEmail"))
        {
            if (!filter_var(input("subscribe_data", 0), FILTER_VALIDATE_EMAIL)) {

                throw new ApplicationException(
                    sprintf(
                        Lang::get('mavitm.subscription::lang.component.email_error'),
                        input("subscribe_data", 0)));
            }
        }

        $model = \Mavitm\Subscription\Models\Subscriber::firstOrNew([
            "subtype_id"    => $this->property("subType"),
            "content_id"    => $this->property("content_id",0),
            "content_type"  => $this->property("content_type", "undefined"),
            "data"          => input("subscribe_data", 0)
        ]);

        $model->accepts         = input("subscribe_accepts",1);
        $model->ip              = Request::getClientIp();
        //$model->subtype_id      = $this->property("subType");
        //$model->content_id      = $this->property("content_id");
        //$model->content_type    = $this->property("content_type");
        //$model->data            = input("subscribe_data", 0);

        try {
            Event::fire('mavitm.subscription.beforeSaveRecord', [&$model, $this]);
            $model->save();
            Event::fire('mavitm.subscription.afterSaveRecord', [&$model, $this]);

            if (input("subscribe_accepts", 1)) {
                Flash::success(Lang::get('mavitm.subscription::lang.component.in_success_text'));
            } else {
                Flash::success(Lang::get('mavitm.subscription::lang.component.out_success_text'));
            }
        }
        catch (\Exception $e)
        {
            \Log::error($e);
            Flash::error(Lang::get('mavitm.subscription::lang.component.save_error'));
        }

    }

}
