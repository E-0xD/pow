<?php

namespace App\Services;

use App\Enums\NotificationType;
use App\Models\Notification;
use App\Models\User;


class NotificationService
{
    /**
     * Send a notification to all users.
     *
     * @param string $title
     * @param string|null $body
     * @param array $data
     * @return Notification
     */
    public function sendToAll(NotificationType $notification_type, string $title, ?string $body = null, array $data = []): Notification
    {
        $notification = Notification::create([
            'type' => $notification_type,
            'title' => $title,
            'body' => $body,
            'data' => $data,
            'target_type' => 'all',
        ]);

        // attach to all users
        $userIds = User::query()->pluck('id')->toArray();
        if (!empty($userIds)) {
            $attach = array_fill_keys($userIds, ['is_read' => false]);
            $notification->users()->attach($attach);
        }

        return $notification;
    }

    /**
     * Send to a group of users identified by a callback or role.
     * $group can be a string (role) or a Closure that returns a query for users.
     *
     * @param string $title
     * @param string|null $body
     * @param array $data
     * @param string|\Closure $group
     * @return Notification
     */
    public function sendToGroup(NotificationType $notification_type, string $title, ?string $body = null, array $data = [], $group = null): Notification
    {
        $notification = Notification::create([
            'type' => $notification_type,
            'title' => $title,
            'body' => $body,
            'data' => $data,
            'target_type' => 'group',
            'target_group' => is_string($group) ? $group : null,
        ]);

        $query = User::query();

        if ($group instanceof \Closure) {
            $query = $group($query) ?: $query;
        } elseif (is_string($group) && !empty($group)) {
            // assume role column on users
            $query->where('role', $group);
        }

        $userIds = $query->pluck('id')->toArray();
        if (!empty($userIds)) {
            $attach = array_fill_keys($userIds, ['is_read' => false]);
            $notification->users()->attach($attach);
        }

        return $notification;
    }

    /**
     * Send to a single user.
     */
    public function sendToUser(NotificationType $notification_type, int|User $user, string $title, ?string $body = null, array $data = []): Notification
    {
        $userId = $user instanceof User ? $user->id : $user;

        $notification = Notification::create([
            'type' => $notification_type,
            'title' => $title,
            'body' => $body,
            'data' => $data,
            'target_type' => 'user',
        ]);

        $notification->users()->attach($userId, ['is_read' => false]);

        return $notification;
    }

    /**
     * Get notifications for a user (paginated friendly) with pivot data.
     */
    public function getUserNotifications(User $user, int $limit = 20)
    {
        return $user->notifications()->withPivot(['is_read', 'read_at'])->latest('notifications.created_at')->paginate($limit);
    }

    /**
     * Mark a single notification as read for a user.
     */
    public function markAsRead(User $user, int $notificationId): bool
    {
        $pivot = $user->notifications()->where('notifications.id', $notificationId)->first();
        if (!$pivot) return false;

        $user->notifications()->updateExistingPivot($notificationId, [
            'is_read' => true,
            'read_at' => now(),
        ]);

        return true;
    }

    /**
     * Mark all notifications as read for a user.
     */
    public function markAllRead(User $user): int
    {
        $unread = $user->notifications()->wherePivot('is_read', false)->pluck('notifications.id')->toArray();
        foreach ($unread as $id) {
            $user->notifications()->updateExistingPivot($id, [
                'is_read' => true,
                'read_at' => now(),
            ]);
        }

        return count($unread);
    }

    /**
     * Count unread notifications for a user.
     */
    public function countUserNotifications(User $user) :int
    {
        return $user->notifications()
            ->wherePivot('is_read', false)
            ->count();
    }
}
