@extends('layouts.app')

@section('content')

<style>
    .operator-hero {
        width: 100%;
        padding: 16px 20px;
        border-radius: 18px;
        background: linear-gradient(135deg, #4B49AC 0%, #7978E9 55%, #F3797E 100%);
        color: #fff;
        box-shadow: 0 14px 32px rgba(75,73,172,0.24);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .operator-hero-title {
        font-size: 20px;
        font-weight: 800;
        letter-spacing: -0.3px;
    }

    .operator-hero-subtitle {
        font-size: 12px;
        opacity: 0.85;
        margin-top: 4px;
    }

    .btn-add-operator {
        border: none;
        min-width: 190px;
        padding: 12px 22px;
        border-radius: 16px;
        background: #ffffff;
        color: #4B49AC;
        font-weight: 800;
        font-size: 15px;
        box-shadow: 0 12px 24px rgba(31,41,55,0.18);
        transition: .22s ease;
        text-decoration: none !important;
        text-align: center;
    }

    .btn-add-operator:hover {
        background: #f8fafc;
        color: #F3797E;
        transform: translateY(-2px);
    }

    .notification-card {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(75, 73, 172, 0.10);
        border: 1px solid rgba(75, 73, 172, 0.06);
    }

    .notification-item {
        border-radius: 20px;
        padding: 16px;
        border: 1px solid rgba(75, 73, 172, 0.08);
        box-shadow: 0 8px 20px rgba(75, 73, 172, 0.08);
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        transition: .2s ease;
        margin-bottom: 14px;
    }

    .notification-item:last-child {
        margin-bottom: 0;
    }

    .notification-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(75, 73, 172, 0.12);
        background: #f8faff;
    }

    .notification-unread {
        background: #eef3ff;
    }

    .notification-read {
        background: #fff;
    }

    .notification-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 10px 20px rgba(75, 73, 172, 0.18);
    }

    .notification-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .notification-message {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 10px;
        line-height: 1.5;
    }

    .nik-badge {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eef3ff;
        color: #4B49AC;
        font-size: 12px;
        font-weight: 700;
    }

    .status-active {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 11px;
        border-radius: 999px;
        background: #ecfdf5;
        color: #059669;
        font-size: 12px;
        font-weight: 800;
    }

    .status-inactive {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 11px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
    }

    .btn-action-edit {
        border: none;
        border-radius: 999px;
        padding: 7px 12px;
        background: rgba(125, 160, 250, 0.14);
        color: #4B49AC;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-action-edit:hover {
        background: #4B49AC;
        color: #fff;
    }

    .empty-state {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
        padding: 36px;
        text-align: center;
        color: #64748b;
    }

    .pagination svg {
        width: 16px !important;
        height: 16px !important;
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-link {
        border: none;
        margin: 0 3px;
        border-radius: 8px;
        color: #4B49AC;
        font-weight: 600;
        background: #eef2ff;
    }

    .pagination .active .page-link {
        background: linear-gradient(135deg, #4B49AC, #7DA0FA);
        color: #fff;
        box-shadow: 0 6px 14px rgba(75,73,172,0.25);
    }

    .pagination-wrap {
        margin-top: 18px;
        display: flex;
        justify-content: flex-end;
    }
</style>

<div class="operator-page">

    <div class="operator-hero mb-4">
        <div>
            <div class="operator-hero-title">Notifikasi</div>
            <div class="operator-hero-subtitle">
                Pengingat proses assessment, penilaian, approval, dan periode.
            </div>
        </div>

        <form action="{{ route('notifications.readAll') }}" method="POST">
            @csrf
            <button class="btn btn-add-operator">
                <i class="bi bi-check2-all me-1"></i>
                Tandai Semua Dibaca
            </button>
        </form>
    </div>
    <div class="notification-card p-3">
        @forelse($notifications as $notification)
            <div class="notification-item {{ $notification->is_read ? 'notification-read' : 'notification-unread' }}">
                <div class="d-flex gap-3">
                    <div class="notification-icon">
                    <i class="bi bi-bell-fill"></i>
                </div>

                    <div>
                        <div class="notification-title">
                            {{ $notification->title }}
                        </div>

                        <div class="notification-message">
                            {{ $notification->message }}
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <span class="nik-badge">
                                {{ $notification->title }}
                            </span>

                            @if($notification->is_read)
                                <span class="status-inactive">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Sudah dibaca
                                </span>
                            @else
                                <span class="status-active">
                                    <i class="bi bi-circle-fill"></i>
                                    Belum dibaca
                                </span>
                            @endif

                            <span class="small text-muted d-flex align-items-center">
                                {{ $notification->created_at ? \Carbon\Carbon::parse($notification->created_at)->format('d-m-Y H:i') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>

                @if(!$notification->is_read)
                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                        @csrf
                        <button class="btn-action-edit">
                            Dibaca
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <div class="empty-state">
                <i class="bi bi-bell-slash fs-1 d-block mb-2"></i>
                <div class="fw-semibold mb-1">Belum ada notifikasi.</div>
                <div class="small">
                    Notifikasi akan tampil setelah ada aktivitas assessment, penilaian, approval, atau periode.
                </div>
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="pagination-wrap">
            {{ $notifications->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

@endsection