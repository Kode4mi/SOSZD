@unless(session('message') === null)
<div class="flash-message">
    <div
        x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 4000)"
         x-transition:leave.duration.1000ms
         class="fixed-top flash-message-content">
        {{session('message')}}
    </div>
</div>
@endunless
