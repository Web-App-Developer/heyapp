<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $name_;
    public $subject_;
    public $message_;

    public $fileName;
    public $path;
    public $fileExtension;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
      $name_,
      $subject_, 
      $message_, 
      $file_, 
      $fileExtension)
    {
        $this->name_ = $name_;
        $this->subject_ = $subject_;
        $this->message_ = $message_;

        $this->fileName = $file_;
        $this->path = getcwd()."/upload-files/files/".$file_;
        $this->fileExtension = $fileExtension;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailSendNow = $this->subject($this->subject_)->view('email-templates.reply-mail')
        ->with([
            'name_' => $this->name_,
            'subject_' => $this->subject_,
            'message_' => $this->message_
        ]);
        $emailSendNow->from('office@fabiz.ase.ro');

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
