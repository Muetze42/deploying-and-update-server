<?php

namespace App\Mail\Releases;

use App\Models\Release;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PublishSuccessful extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The Release instance.
     *
     * @var \App\Models\Release
     */
    protected Release $release;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Release $release
     */
    public function __construct(Release $release)
    {
        $this->release = $release;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Publish Successful',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.releases.publish-successful',
            with: [
                'release' => $this->release,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
