<div class="modal fade" id="notification" tabindex="-1" aria-labelledby="notificationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 p-4">
            <div class="modal-header border-0 p-1">
                <h6 class="modal-title fw-bold text-body fs-6 d-flex justify-content-center" id="notificationLabel">Notifications</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 px-0">

                    <ul class="list-group">
                        <!-- Research Project Notifications -->
                        @foreach($notifications as $notification)
                            @if($notification->project)
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Project: {{ \Illuminate\Support\Str::limit($notification->project->title, 10) }}</span>
                                        <small class="text-muted">Invited by: {{ $notification->project->creator->name ?? 'Unknown' }}</small>
                                    </div>
                                    <div>
                                        <form action="{{ route('normal-user.research-project.request.respond', $notification->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="status" value="2" class="btn btn-sm btn-success">Accept</button>
                                            <button type="submit" name="status" value="3" class="btn btn-sm btn-danger">Reject</button>
                                            <a href="{{ route('normal-user.research-project.detail', $notification->project->id) }}" class="btn btn-sm btn-primary">View</a>
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endforeach

                        <!-- Resource Space Joining Request Notifications -->
                        @foreach($resourceSpaceNotifications as $resourceSpaceNotification)
                            @if($resourceSpaceNotification->resourceSpace)
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Resource Space: {{ \Illuminate\Support\Str::limit($resourceSpaceNotification->resourceSpace->name, 10) }}</span>
                                        <small class="text-muted">{{ $resourceSpaceNotification->user->name }} has requested to join {{ \Illuminate\Support\Str::limit($resourceSpaceNotification->resourceSpace->name, 1) }}</small>
                                    </div>
                                    <div>
                                        <form action="{{ route('normal-user.resource-space.join-request.respond', $resourceSpaceNotification->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="action" value="accept" class="btn btn-sm btn-success">Accept</button>
                                            <button type="submit" name="action" value="deny" class="btn btn-sm btn-danger">Reject</button>
                                            <a href="{{ route('normal-user.resource-space.responses', $resourceSpaceNotification->resourceSpace->id) }}" class="btn btn-sm btn-primary">View</a>
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                        @foreach($userNotifications as $userNotification)
                            @php
                                // Safely extract notification data with null coalescing
                                $notificationData = $userNotification->data['message'] ?? null;
                                $resourceSpaceName = $userNotification->data['resourceSpaceName'] ?? null;
                                $action = $userNotification->data['action'] ?? null;
                                $creatorId = $userNotification->data['creatorId'] ?? null;

                                // Skip the notification if the resource space creator is the current user
                                // Or if any required data is missing
                                $skipNotification = (
                                    $creatorId === auth()->user()->id ||
                                    is_null($notificationData) ||
                                    is_null($resourceSpaceName) ||
                                    is_null($action)
                                );
                            @endphp

                            @if(!$skipNotification)
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                    <div>
                                        <span>{{ $notificationData }}</span>
                                    </div>
                                    <div>
                                        <small class="text-muted">{{ $userNotification->created_at->diffForHumans() }}</small>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                        @foreach (auth()->user()->notifications as $notification)
                            @if ($notification->type === \App\Notifications\MeetingFinalizedNotification::class)
                                <li>
                                    {{ $notification->data['message'] }}
                                    <br>Finalized Time: {{ $notification->data['finalized_time'] }}
                                    <a href="{{ $notification->data['action_url'] }}">View Details</a>
                                </li>
                            @endif
                        @endforeach




                    </ul>



            </div>
            <div class="modal-footer border-0 p-1">
                <button type="button" class="btn btn-danger w-100 text-decoration-none rounded-5 py-3 fw-bold text-uppercase m-0" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    .list-group-item {
        border: none;
        padding: 1rem;
        background-color: #f9f9f9;
        margin-bottom: 0.5rem;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #f1f1f1;
    }

    .modal-content {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-secondary {
        border-color: #ccc;
        color: #555;
    }

    .btn-outline-secondary:hover {
        background-color: #ddd;
    }
</style>
<script>
    function markAsRead(button) {
        button.closest('li').remove();
    }

    function clearNotifications() {
        const listGroup = document.querySelector('.list-group');
        listGroup.innerHTML = '<p class="text-center text-muted">No notifications available.</p>';
    }
</script>
