<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $requestID_1;
    public $registration_type_1;
    public $full_name_1;
    public $you_are_1;
    public $degree_1;
    public $learning_stream_1;
    public $master_name_1;
    public $year_1;
    public $group_1;
    public $email_1;
    public $telephone_1;
    public $request_type_1;
    public $message_1;

    public $fileName;
    public $path;
    public $fileExtension;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
      $requestID_1,
      $registration_type_1, 
      $full_name_1, 
      $you_are_1, 
      $degree_1,
      $learning_stream_1,
      $master_name_1,
      $year_1,
      $group_1,
      $email_1,
      $telephone_1,
      $request_type_1,
      $message_1,

      $fileName_1, 
      $fileExtension_1
    )
    {

        $this->requestID_1 = $requestID_1;
        $this->registration_type_1 = $registration_type_1;
        $this->full_name_1 = $full_name_1;
        $this->you_are_1 = $you_are_1;
        $this->degree_1 = $degree_1;
        $this->learning_stream_1 = $learning_stream_1;
        $this->master_name_1 = $master_name_1;
        $this->year_1 = $year_1;
        $this->group_1 = $group_1;
        $this->email_1 = $email_1;
        $this->telephone_1 = $telephone_1;
        $this->request_type_1 = $request_type_1;
        $this->message_1 = $message_1;

        $this->fileName = $fileName_1;
        $this->path = getcwd()."/upload-files/files/".$fileName_1;
        $this->fileExtension = $fileExtension_1;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $emailSendNow = $this->subject('Request Confirmation')->view('email-templates.confirm')
        ->with([
            'requestID_1' => $this->requestID_1,
            'registration_type_1' => $this->registration_type_1,
            'full_name_1' => $this->full_name_1,
            'you_are_1' => $this->you_are_1,
            'degree_1' => $this->degree_1,
            'learning_stream_1' => $this->learning_stream_1,
            'master_name_1' => $this->master_name_1,
            'year_1' => $this->year_1,
            'group_1' => $this->group_1,
            'email_1' => $this->email_1,
            'telephone_1' => $this->telephone_1,
            'request_type_1' => $this->request_type_1,
            'message_1' => $this->message_1
        ]);

        if ($this->path != "" && $this->fileExtension != "") {
            $file_path = $this->path;
            $attachments = [
                  // first attachment
                  $file_path => [
                      'as' => 'attachment.'.$this->fileExtension,
                      'mime' => 'application/'.$this->fileExtension,
                  ]
              ];

              foreach($attachments as $filePath => $fileParameters){
                  $emailSendNow->attach($filePath, $fileParameters);
              }
        }
        

          return $emailSendNow;
    }
}
