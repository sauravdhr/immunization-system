<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Patient;
use App\VaccRecord;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use DB;
use Auth;
use Validator, Input, Redirect;
use Session;

/**
* handles the patient's part that includes viewing notifications. 
* 
* 
*
*/
class PatController extends Controller
{
    /**
     * loads the first page of viewing notifications.In here many notification's campaign
     * name is shown.User has to select one of the notifications to see the details of the 
     * notification
     *
     * @return view page of the view notification's first page 
     */

    public function getviewNotifications()
    {
        $temp = DB::select('SELECT noti_no, ( select campaign_name 
        from campaigns where campaign_no = A.campaign_no ) as "campaign_name", DATE_FORMAT(msg_date, "%d-%m-%Y %h-%i-%s %p") 
        as msg_date FROM notifications as A order by msg_date');

        return view('pat.viewNotify')->withTemp($temp);
    }
    /**
     * takes the notification number and sends the details of the notification to the next page
     * the details of notification is saved in the session for the 2nd page to reacquire it and
     * show it at the view.
     *
     * @param  notfication no.
     * @return redirect to the 2nd page 
     */

    public function getviewNotifications2($notification)
    {
        $campaign = DB::select('select campaign_no from notifications
            where noti_no = :somevariable',array('somevariable'=>$notification));
        $temp = $campaign[0]->campaign_no;
        $campaign2 = DB::select('SELECT campaign_name, vaccine_name, DATE_FORMAT(campaign_date, "%d-%m-%Y") as "campaign_date",
            start_age, end_age FROM campaigns 
            where campaign_no = :somevariable',array('somevariable'=>$temp));
        
        $centers = DB::select('select B.center_name,B.location,B.district,B.contact_no 
            from campaigncenters as A,centers as B
            where A.center_no = B.center_no and
            campaign_no = :somevariable',array('somevariable'=>$temp));
        $message = DB::select('select msg from notifications where noti_no = :somevariable',array('somevariable'=>$notification));
        
        $data = array($campaign2[0],$centers,$message[0]);
        Session::put('notify',$data);
        return Redirect::to('viewNotifications2');
    }
    /**
     * loads the 2nd page of view notification where details of the notification is 
     * shown.the data is reacquired from the view and sent to view page.
     *   
     * @return view of 2nd page of view notification
     */

    public function getviewNotifications3()
    {
        $data = Session::get('notify');
        return view('pat.viewNotify2')->withData($data);
    }
}
