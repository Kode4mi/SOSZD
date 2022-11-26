@unless(session('message') === null)
<div class="flash-message" xmlns:x-transition="http://www.w3.org/1999/xhtml">
    <div
        class="fixed-top flash-message-content"
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:leave.duration.1000ms>
        {{session('message')}}
    </div>
</div>
@endunless
