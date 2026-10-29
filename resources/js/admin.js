/**
 * Enhance the admin pages: dismissible toasts, drag-and-drop image previews, password visibility,
 * delete confirmations, and loading states on submit buttons.
 */
export function initAdmin() {
    // Auto-dismiss the status toast, or close it on demand.
    document.querySelectorAll('[data-toast]').forEach((toast) => {
        const dismiss = () => {
            toast.classList.add('is-leaving');
            toast.addEventListener('animationend', () => toast.remove(), { once: true });
        };

        const timer = window.setTimeout(dismiss, 5000);

        toast.querySelector('[data-toast-close]')?.addEventListener('click', () => {
            window.clearTimeout(timer);
            dismiss();
        });
    });

    // Show the chosen file's name and a thumbnail, and accept files dropped onto the drop zone.
    document.querySelectorAll('[data-file-input]').forEach((input) => {
        const label = document.querySelector(`label[for="${input.id}"]`);
        const dropzone = label?.querySelector('[data-file-drop]');

        if (!dropzone) {
            return;
        }

        const fileName = dropzone.querySelector('[data-file-name]');
        const preview = dropzone.querySelector('[data-file-preview]');
        const defaultName = fileName.textContent;
        let previewUrl = null;

        const showSelection = () => {
            const file = input.files?.[0];

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }

            if (!file) {
                fileName.textContent = defaultName;
                preview.classList.add('hidden');
                dropzone.classList.remove('has-file');

                return;
            }

            fileName.textContent = `${file.name} · ${(file.size / 1024 / 1024).toFixed(1)} MB`;

            if (file.type.startsWith('image/')) {
                previewUrl = URL.createObjectURL(file);
                preview.src = previewUrl;
                preview.classList.remove('hidden');
                dropzone.classList.add('has-file');
            }
        };

        input.addEventListener('change', showSelection);

        ['dragenter', 'dragover'].forEach((eventName) => {
            dropzone.addEventListener(eventName, (event) => {
                event.preventDefault();
                dropzone.classList.add('is-dragging');
            });
        });

        ['dragleave', 'dragend', 'drop'].forEach((eventName) => {
            dropzone.addEventListener(eventName, () => dropzone.classList.remove('is-dragging'));
        });

        dropzone.addEventListener('drop', (event) => {
            event.preventDefault();

            if (event.dataTransfer?.files.length) {
                input.files = event.dataTransfer.files;
                showSelection();
            }
        });
    });

    // Toggle password visibility.
    document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
        const input = document.getElementById(toggle.dataset.passwordToggle);

        toggle.addEventListener('click', () => {
            const isVisible = input.type === 'text';
            input.type = isVisible ? 'password' : 'text';
            toggle.setAttribute('aria-pressed', String(!isVisible));
            toggle.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
            toggle.querySelector('[data-password-icon="show"]').classList.toggle('hidden', !isVisible);
            toggle.querySelector('[data-password-icon="hide"]').classList.toggle('hidden', isVisible);
        });
    });

    // Ask before destructive submissions, then show a loading state on the button that submitted.
    document.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (form.dataset.confirm && !window.confirm(form.dataset.confirm)) {
                event.preventDefault();

                return;
            }

            const submitter = event.submitter;

            if (submitter?.dataset.loadingText) {
                submitter.classList.add('is-loading');
                submitter.textContent = submitter.dataset.loadingText;
                window.setTimeout(() => {
                    submitter.disabled = true;
                }, 0);
            }
        });
    });
}
