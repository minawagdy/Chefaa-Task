<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NotificationRequest;
use App\Http\Services\NotificationsService;
use App\Http\Services\UserService;
use App\Libraries\Notification;
use App\Mail\NotificationEmail;
use App\SendMessage\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;

class NotificationsController extends HomeController
{

    private  $UserService;
    private  $Notification;
    private  $NotificationsService;

    public function __construct(UserService  $UserService, Notification  $Notification, NotificationsService $NotificationsService)
    {
        $this->UserService          = $UserService;
        $this->Notification         = $Notification;
        $this->NotificationsService = $NotificationsService;
    }

    public function index()
    {
        $data = $this->UserService->getAllUsersWithOutPagination();
        return view('AdminPanel.PagesContent.Notifications.index')->with('users',$data);
    }

    public function store(NotificationRequest $request)
    {
        $validated = $request->all();
        $title     = $validated['title'];
        $body      = $validated['body'];
        $mediaType = $validated['mediaType'];
        $usersId    = $validated['usersId'];
        foreach ($usersId as  $userId)
        {
            $userRow = $this->UserService->getUser($userId);
            if (in_array(1,$mediaType))
            {

                //SEND Notification
                $title = str_replace("&nbsp;", "", $title);
                $title = html_entity_decode($title);

                $body = str_replace("&nbsp;", "", $body);
                $body = html_entity_decode($body);

                $this->Notification->send($userRow->device_id,strip_tags($title),strip_tags($body));
                $this->NotificationsService->create([
                    "user_id" => $userRow->id,
                    "title" => $title,
                    "body" => $body
                ]);
            }
            if (in_array(2,$mediaType))
            {
                //SEND SMS
                 SendMessage::sendMessage($userRow->phone,$body);
            }
            if (in_array(3,$mediaType))
            {

                //SEND Email
                $emailData['subject'] = "NettingHub";
                $emailData['title']   = $title;
                $emailData['body']    = $body;
                Mail::to($userRow->email)->send(new NotificationEmail($emailData));
            }
        }
        return redirect()->back()->with('message' , "Send Successfully");
    }

    private function test($body)
    {

    }
}
