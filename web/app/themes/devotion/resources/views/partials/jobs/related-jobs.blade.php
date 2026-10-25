@if ($relatedJobs)
    <div class="container section-page">
        <h2 class="text-2xl mb-5">More {!! $jobType !!} Jobs</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach ($relatedJobs as $relatedJob)
                <x-card-job :id="$relatedJob" />
            @endforeach
        </div>
    </div>

@endif
