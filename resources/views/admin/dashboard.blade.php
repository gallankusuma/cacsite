@section('title', 'Dashboard')

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="rounded-lg bg-white border p-4">
        <div class="text-sm text-gray-500">Total Users</div>
        <div class="text-2xl font-semibold mt-1">—</div>
    </div>
    <div class="rounded-lg bg-white border p-4">
        <div class="text-sm text-gray-500">Active Sessions</div>
        <div class="text-2xl font-semibold mt-1">—</div>
    </div>
    <div class="rounded-lg bg-white border p-4">
        <div class="text-sm text-gray-500">System Status</div>
        <div class="mt-1 inline-flex items-center gap-2 text-green-700">
            <span class="h-2 w-2 rounded-full bg-green-500"></span> OK
        </div>
    </div>
</div>
