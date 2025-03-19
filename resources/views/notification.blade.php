<!-- filepath: /media/jeremie/Dataset/Projects/Web/Laravel/Jr-tracking/resources/views/dashboard.blade.php -->
@foreach (Auth::user()->unreadNotifications as $notification)
    <div class="notification">
        {{ $notification->data['message'] }}
    </div>
@endforeach
