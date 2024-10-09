<?php

namespace App\Mail;

use App\Models\VoucherModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VoucherMail extends Mailable
{
    use Queueable, SerializesModels;

    public $voucher;

    /**
     * Create a new message instance.
     *
     * @param VoucherModel $voucher
     * @return void
     */
    public function __construct(VoucherModel $voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bạn đã nhận được một Voucher mới!')
                    ->view('admin.emails.voucher');
    }
}
