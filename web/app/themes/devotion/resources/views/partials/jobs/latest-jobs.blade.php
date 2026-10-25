@if ($latestJobs)
    <div class="container section-page">
        <h2 class="text-2xl mb-5">Latest Jobs</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach ($latestJobs as $latestJob)
                <x-card-job :id="$latestJob" />
            @endforeach
        </div>
    </div>

@endif
