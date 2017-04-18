<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SPMBGenerated extends Notification implements ShouldQueue
{
    use Queueable;

    public $spmb;
    public $spmbdetail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($spmb)
    {
        $this->spmb = $spmb;
        foreach ($this->spmb->spmbdetails as $key => $value) {
            $this->spmbdetail .= $value->spmb_detail_item_name . ' (' . $value->spmb_detail_qty . ' ' . $value->unit->unit_code . ' ) , ';
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('e-SPMB NOTIFICATION - SPMB ' . $this->spmb->spmb_no . ' has been received')
                    ->line('SPMB ' . $this->spmb->spmb_no . ' has been received.')
                    ->line('Below are the details of SPMB:')
                    ->line('-------------------------------------------')
                    ->line('SPMB No : ' . $this->spmb->spmb_no)
                    ->line('No PR SAP : ' . $this->spmb->spmb_no_pr_sap)
                    ->line('Cost Center : ' . $this->spmb->spmb_cost_center)
                    ->line('No I/O DIPK : ' . $this->spmb->spmb_io_no)
                    ->line('Request By : ' . $this->spmb->spmb_applicant_name)
                    ->line('Token : ' . $this->spmb->spmb_token)
                    ->line('Items : ' . $this->spmbdetail)
                    ->line('-------------------------------------------')
                    ->line('')
                    ->line('Please click button below to check the current SPMB status.')
                    ->action('Track SPMB', url('/spmb/' . $this->spmb->spmb_id))
                    ->line('If you have question or need help, please call Administrator. ')
                    ->line('Thank you.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}