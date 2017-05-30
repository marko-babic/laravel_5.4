<script>
    var ajax_admin_url = {
        ticket_delete: "{{url('dashboard/tickets')}}",
        all_posts: "{{route('posts.index')}}",
        action_screenshot: "{{url('dashboard/screenshots')}}",
        remove_post: "{{url('dashboard/posts')}}",
        mark_as_read: "{{route('notification.update')}}",
        navbar: "{{url('dashboard/navbar')}}",
        notifications : "{{route('notification.index')}}"
    };
</script>