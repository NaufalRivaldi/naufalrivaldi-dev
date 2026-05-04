<?php

namespace App\Livewire;

use App\Mail\ContactInquiry;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $subject = 'Project inquiry';

    public string $message = '';

    public bool $sent = false;

    /** @var array<string, string[]> */
    protected array $rules = [
        'name' => ['required', 'string', 'min:2', 'max:100'],
        'email' => ['required', 'email', 'max:255'],
        'subject' => ['required', 'string'],
        'message' => ['required', 'string', 'min:10', 'max:2000'],
    ];

    /** @var array<string, string> */
    protected array $messages = [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email.',
        'email.email' => 'Please enter a valid email address.',
        'message.required' => 'Please enter a message.',
        'message.min' => 'Your message should be at least 10 characters.',
    ];

    public function submit(): void
    {
        $key = 'contact:'.\request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('message', "Too many submissions. Please try again in {$seconds} seconds.");

            return;
        }

        $this->validate();

        $settings = app(GeneralSettings::class);

        Mail::to($settings->contact_email)
            ->send(new ContactInquiry(
                senderName: $this->name,
                senderEmail: $this->email,
                topic: $this->subject,
                body: $this->message,
            ));

        RateLimiter::hit($key, 3600);

        $this->sent = true;
        $this->reset(['name', 'email', 'message']);
        $this->subject = 'Project inquiry';

        $this->dispatch('form-sent');
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
