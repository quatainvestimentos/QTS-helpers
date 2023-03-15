<?php 

namespace QuataInvestimentos\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Notifications
 */

 use Illuminate\Support\Facades\Notification;
 use GeneralEmailNotification;
 use GeneralTeamsNotification;
 use GeneralTeamsErrorNotification;

 class NotificationController extends Controller
 {
     public function send($notification=[])
     {
         $notification = (object)[
             'to' => (isset($notification['headers']['to']) && $notification['headers']['to'] ? $notification['headers']['to'] : ''),
             'template' => (isset($notification['headers']['template']) && $notification['headers']['template'] ? $notification['headers']['template'] : ''),
             'subject' => (isset($notification['subject']) && $notification['subject'] ? $notification['subject'] : 'E-mail sem assunto'),
             'body' => (isset($notification['body']) && $notification['body'] ? $notification['body'] : []),
             'cc' => (isset($notification['headers']['cc']) && $notification['headers']['cc'] ? $notification['headers']['cc'] : []),
             'bcc' => (isset($notification['headers']['bcc']) && $notification['headers']['bcc'] ? $notification['headers']['bcc'] : []),
             'attachments' => (isset($notification['attachments']) && $notification['attachments'] ? $notification['attachments'] : [])
         ];
 
         /**
          * Send (Email)
          */
 
         $status = 201;
         $data = ['message' => 'E-mail enviado com sucesso'];
         
         try {
 
             /**
              * Send Successful Notification (EMAIL)
              */
                 
             Notification::route('mail', $notification->to)
             ->notify( new GeneralEmailNotification( $notification ) );
 
             /**
              * Send Successful Notification (TEAMS)
              */
 
             Notification::route('teams', null)
             ->notify(new GeneralTeamsNotification( $notification ) );
 
         } catch (\Exception $e){
 
             $status = 400;
 
             $data = [
                 'file' => basename(__FILE__),
                 'details' => ['erro' => 'Erro de envio de chamado de suporte por e-mail'],
                 'exception' => $e->getMessage()
             ];
 
             /**
              * Send Fail Notification
              */     
 
             Notification::route('teams',null)
                 ->notify(new GeneralTeamsErrorNotification( $data )
             ); 
 
         }
 
         /**
          * Send (Teams)
          */
 
         return (object)[
             'status' => $status,
             'data' => $data
         ];
 
     }
 }