<div class="card organigram-card h-100 border-0 shadow-sm rounded-4 text-center p-3" data-bs-toggle="modal"
    data-bs-target="#memberModal" data-member-name="{{ $member->affiliate->user->full_name }}"
    data-member-role="{{ $member->name }}" data-member-email="{{ $member->affiliate->user->email ?? '' }}"
    data-member-phone="{{ $member->affiliate->user->phones->first()->number ?? '' }}"
    data-member-image="{{ $member->affiliate->user->image ?? asset('images/default-avatar.png') }}"
    data-member-title="{{ $member->affiliate->user->title ?? '' }}">


    <div class="d-flex flex-column h-100">
        <!-- Badge e imagen (parte superior) -->
        <span class="badge bg-success-subtle text-success rounded-pill mb-3 px-3 py-2">
            {{ $member->name }}
        </span>

        <div class="position-relative mx-auto mb-3" style="width: 120px; height: 120px;">
            <img src="{{ $member->affiliate->user->image ?? asset('images/default-avatar.png') }}"
                class="member-image rounded-circle w-100 h-100" alt="{{ $member->affiliate->user->full_name }}"
                data-bs-toggle="tooltip" data-bs-placement="top"
                title="{{ $member->affiliate->user->title }} {{ $member->affiliate->user->full_name }}">
            <div class="pulse-circle position-absolute top-0 start-0 w-100 h-100 rounded-circle opacity-0"></div>
        </div>

        <!-- Bloque que siempre irá al final -->
        <div class="mt-auto">
            <p class="text-muted mb-3">{{ $member->affiliate->user->title ?? '' }}</p>
            <h5 class="member-name mb-1">{{ $member->affiliate->user->full_name }}</h5>
            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-4" data-bs-toggle="modal"
                data-bs-target="#memberModal">
                Ver perfil <i class="fas fa-arrow-right ms-1"></i>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const memberModal = document.getElementById('memberModal');
        if (memberModal) {
            memberModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const card = button.closest('.organigram-card');
                if (!card) return;

                document.getElementById('modalName').innerText = card.getAttribute(
                    'data-member-name') || '';
                document.getElementById('modalRole').innerText = card.getAttribute(
                    'data-member-role') || '';
                document.getElementById('modalEmail').innerText = card.getAttribute(
                    'data-member-email') || 'No disponible';
                document.getElementById('modalPhone').innerText = card.getAttribute(
                    'data-member-phone') || 'No disponible';
                document.getElementById('modalImage').src = card.getAttribute('data-member-image') ||
                    '';
            });
        }
    });
</script>
