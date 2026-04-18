<?php

namespace App\Livewire;

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
        $this->validate();

        // TODO: Replace with Mail::send() or notification in production.
        $this->sent = true;
        $this->reset(['name', 'email', 'subject', 'message']);
        $this->subject = 'Project inquiry';

        $this->dispatch('form-sent');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.contact-form');
    }
}
