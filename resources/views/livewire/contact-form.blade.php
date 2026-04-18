<div>
    <form wire:submit="submit" class="contact-form">
        <div class="form-row">
            <div class="field">
                <label>01 · Name</label>
                <input wire:model="name" type="text" placeholder="Your full name" required />
                @error('name') <span class="field-error">{{ $message }}</span> @enderror
            </div>
            <div class="field">
                <label>02 · Email</label>
                <input wire:model="email" type="email" placeholder="you@company.com" required />
                @error('email') <span class="field-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="field">
            <label>03 · Topic</label>
            <select wire:model="subject">
                <option>Project inquiry</option>
                <option>Full-time role</option>
                <option>Laravel audit</option>
                <option>Consulting / advisory</option>
                <option>Other</option>
            </select>
        </div>

        <div class="field">
            <label>04 · Message</label>
            <textarea wire:model="message" placeholder="A few lines about what you're building…" required></textarea>
            @error('message') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="form-submit{{ $sent ? ' sent' : '' }}" wire:loading.attr="disabled">
            <span wire:loading.remove>
                @if ($sent)
                    ✓ Message sent
                @else
                    Send Message
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="12" height="12" style="display:inline;vertical-align:middle;margin-left:4px"><path d="M7 17L17 7M17 7H8M17 7V16" stroke-linecap="round" stroke-linejoin="round"/></svg>
                @endif
            </span>
            <span wire:loading>Sending…</span>
        </button>
    </form>
</div>
